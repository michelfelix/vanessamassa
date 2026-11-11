<?php
/**
 * Theme functions.
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

function estetica_institucional_setup() {
    add_theme_support( 'title-tag' );
    add_theme_support( 'post-thumbnails' );
    add_post_type_support( 'page', 'excerpt' ); // Resumo nas páginas de procedimento.
    add_theme_support( 'custom-logo', array(
        'height'      => 80,
        'width'       => 240,
        'flex-height' => true,
        'flex-width'  => true,
    ) );

    register_nav_menus(
        array(
            'primary' => __( 'Menu principal', 'estetica-institucional' ),
            'footer'  => __( 'Menu do rodapé', 'estetica-institucional' ),
        )
    );
}
add_action( 'after_setup_theme', 'estetica_institucional_setup' );

function estetica_institucional_assets() {
    wp_enqueue_style(
        'estetica-institucional-style',
        get_stylesheet_uri(),
        array(),
        wp_get_theme()->get( 'Version' )
    );

    wp_enqueue_script(
        'estetica-institucional-script',
        get_template_directory_uri() . '/assets/js/main.js',
        array(),
        wp_get_theme()->get( 'Version' ),
        true
    );
}
add_action( 'wp_enqueue_scripts', 'estetica_institucional_assets' );

function estetica_institucional_customize_register( $wp_customize ) {
    $wp_customize->add_section(
        'estetica_contact',
        array(
            'title'    => __( 'Informações do site', 'estetica-institucional' ),
            'priority' => 30,
        )
    );

    $settings = array(
        'booking_url' => array(
            'label'   => 'URL da agenda',
            'default' => '#agendamento',
        ),
        'whatsapp' => array(
            'label'   => 'WhatsApp',
            'default' => '',
        ),
        'address' => array(
            'label'   => 'Endereço',
            'default' => '',
        ),
        'instagram' => array(
            'label'   => 'Instagram',
            'default' => '',
        ),
        // Campos estruturados usados no mapa e no schema (SEO local).
        'street' => array(
            'label'   => 'Rua e número (schema)',
            'default' => '',
        ),
        'neighborhood' => array(
            'label'   => 'Bairro',
            'default' => 'Vila Madalena',
        ),
        'city' => array(
            'label'   => 'Cidade',
            'default' => 'São Paulo',
        ),
        'state' => array(
            'label'   => 'Estado (sigla)',
            'default' => 'SP',
        ),
        'postal_code' => array(
            'label'   => 'CEP',
            'default' => '',
        ),
        'maps_url' => array(
            'label'   => 'Link do perfil no Google Maps (botão "Como chegar")',
            'default' => '',
        ),
    );

    foreach ( $settings as $id => $field ) {
        $wp_customize->add_setting(
            'estetica_' . $id,
            array(
                'default'           => $field['default'],
                'sanitize_callback' => 'sanitize_text_field',
            )
        );

        $wp_customize->add_control(
            'estetica_' . $id,
            array(
                'label'   => $field['label'],
                'section' => 'estetica_contact',
                'type'    => 'text',
            )
        );
    }
}
add_action( 'customize_register', 'estetica_institucional_customize_register' );

function estetica_booking_url() {
    return esc_url( get_theme_mod( 'estetica_booking_url', '#agendamento' ) );
}

require_once get_template_directory() . '/data/procedures.php';
/* -------------------------------------------------------------------------
 * SEO local: endereço, mapa, páginas de procedimento e schema.org
 * ---------------------------------------------------------------------- */

/**
 * Endereço completo em uma linha (usado no mapa e como fallback).
 */
function estetica_full_address() {
    $street = trim( get_theme_mod( 'estetica_street', '' ) );

    if ( $street ) {
        $parts = array_filter( array(
            $street,
            get_theme_mod( 'estetica_neighborhood', 'Vila Madalena' ),
            get_theme_mod( 'estetica_city', 'São Paulo' ) . ' - ' . get_theme_mod( 'estetica_state', 'SP' ),
            get_theme_mod( 'estetica_postal_code', '' ),
        ) );
        return implode( ', ', $parts );
    }

    return trim( get_theme_mod( 'estetica_address', '' ) );
}

/**
 * URL do iframe do Google Maps (não precisa de chave de API).
 */
function estetica_map_embed_url() {
    $address = estetica_full_address();
    if ( ! $address ) {
        return '';
    }
    return 'https://www.google.com/maps?q=' . rawurlencode( $address ) . '&output=embed';
}

/**
 * Link "Como chegar": usa o perfil do Google Maps se configurado,
 * senão monta uma rota para o endereço.
 */
function estetica_directions_url() {
    $maps_url = get_theme_mod( 'estetica_maps_url', '' );
    if ( $maps_url ) {
        return $maps_url;
    }
    $address = estetica_full_address();
    return $address ? 'https://www.google.com/maps/dir/?api=1&destination=' . rawurlencode( $address ) : '';
}

/**
 * Slug do procedimento a partir da âncora definida em data/procedures.php.
 */
function estetica_procedure_slug( $procedure ) {
    return sanitize_title( (string) parse_url( $procedure['url'], PHP_URL_FRAGMENT ) );
}

/**
 * Se existir a página filha /procedimentos/{slug}/, linka para ela.
 * Enquanto a página não for criada, mantém a âncora antiga.
 */
function estetica_procedure_url( $procedure ) {
    $page = get_page_by_path( 'procedimentos/' . estetica_procedure_slug( $procedure ) );
    if ( $page && 'publish' === $page->post_status ) {
        return get_permalink( $page );
    }
    return home_url( $procedure['url'] );
}

/**
 * Páginas filhas de "Procedimentos" usam automaticamente o template de procedimento.
 */
function estetica_is_procedure_page( $post = null ) {
    $post = get_post( $post );
    if ( ! $post || 'page' !== $post->post_type || ! $post->post_parent ) {
        return false;
    }
    return 'procedimentos' === get_post_field( 'post_name', $post->post_parent );
}

function estetica_procedure_template( $template ) {
    if ( is_page() && estetica_is_procedure_page() && ! get_page_template_slug() ) {
        $custom = locate_template( 'template-procedimento.php' );
        if ( $custom ) {
            return $custom;
        }
    }
    return $template;
}
add_filter( 'template_include', 'estetica_procedure_template' );

/**
 * Schema.org (JSON-LD) do negócio local: home e páginas de procedimento.
 * O Yoast continua gerando o schema dele; este bloco complementa com os
 * dados de negócio local que o Yoast gratuito não tem.
 */
function estetica_local_business_schema() {
    if ( ! is_front_page() && ! is_page( 'procedimentos' ) && ! ( is_page() && estetica_is_procedure_page() ) ) {
        return;
    }

    global $procedures;

    $home        = home_url( '/' );
    $business_id = $home . '#negocio';
    $person_id   = $home . '#dra-vanessa';
    $neighborhood = get_theme_mod( 'estetica_neighborhood', 'Vila Madalena' );
    $city         = get_theme_mod( 'estetica_city', 'São Paulo' );
    $whatsapp     = preg_replace( '/\D+/', '', (string) get_theme_mod( 'estetica_whatsapp', '' ) );

    $address = array(
        '@type'           => 'PostalAddress',
        'addressLocality' => $city,
        'addressRegion'   => get_theme_mod( 'estetica_state', 'SP' ),
        'addressCountry'  => 'BR',
    );
    if ( get_theme_mod( 'estetica_street' ) ) {
        $address['streetAddress'] = get_theme_mod( 'estetica_street' ) . ', ' . $neighborhood;
    }
    if ( get_theme_mod( 'estetica_postal_code' ) ) {
        $address['postalCode'] = get_theme_mod( 'estetica_postal_code' );
    }

    $services = array();
    $procedure_names = array();
    foreach ( (array) $procedures as $procedure ) {
        $procedure_names[] = $procedure['title'];
        $services[] = array(
            '@type'       => 'Offer',
            'itemOffered' => array(
                '@type'       => 'Service',
                'name'        => $procedure['title'] . ' – ' . $neighborhood . ', ' . $city,
                'description' => $procedure['text'],
                'url'         => estetica_procedure_url( $procedure ),
                'provider'    => array( '@id' => $business_id ),
            ),
        );
    }

    $same_as = array_values( array_filter( array(
        get_theme_mod( 'estetica_instagram', '' ),
        get_theme_mod( 'estetica_maps_url', '' ),
    ) ) );

    $business = array(
        '@type'       => array( 'HealthAndBeautyBusiness', 'MedicalBusiness' ),
        '@id'         => $business_id,
        'name'        => 'Dra. Vanessa Massa – Biomédica Esteta',
        'alternateName' => get_bloginfo( 'name' ),
        'description' => 'Biomédica esteta na ' . $neighborhood . ', ' . $city . '. Harmonização facial e corporal: ' . implode( ', ', $procedure_names ) . '.',
        'url'         => $home,
        'image'       => home_url( '/wp-content/uploads/2026/08/perfil2.jpg' ),
        'address'     => $address,
        'areaServed'  => array(
            array( '@type' => 'Place', 'name' => $neighborhood . ', ' . $city ),
            array( '@type' => 'City', 'name' => $city ),
        ),
        'founder'     => array( '@id' => $person_id ),
        'employee'    => array( '@id' => $person_id ),
        'knowsAbout'  => array_merge( $procedure_names, array( 'Harmonização facial', 'Harmonização corporal', 'Estética avançada' ) ),
        'hasOfferCatalog' => array(
            '@type'           => 'OfferCatalog',
            'name'            => 'Procedimentos estéticos',
            'itemListElement' => $services,
        ),
    );

    if ( $whatsapp ) {
        $business['telephone'] = '+' . ( 0 === strpos( $whatsapp, '55' ) ? $whatsapp : '55' . $whatsapp );
    }
    if ( estetica_directions_url() ) {
        $business['hasMap'] = estetica_directions_url();
    }
    if ( $same_as ) {
        $business['sameAs'] = $same_as;
    }

    $person = array(
        '@type'      => 'Person',
        '@id'        => $person_id,
        'name'       => 'Vanessa Massa',
        'honorificPrefix' => 'Dra.',
        'jobTitle'   => 'Biomédica Esteta',
        'worksFor'   => array( '@id' => $business_id ),
        'knowsAbout' => $business['knowsAbout'],
        'url'        => $home,
    );
    if ( get_theme_mod( 'estetica_instagram' ) ) {
        $person['sameAs'] = array( get_theme_mod( 'estetica_instagram' ) );
    }

    $schema = array(
        '@context' => 'https://schema.org',
        '@graph'   => array( $business, $person ),
    );

    echo "\n<script type=\"application/ld+json\">" . wp_json_encode( $schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE ) . "</script>\n";
}
add_action( 'wp_head', 'estetica_local_business_schema', 20 );
