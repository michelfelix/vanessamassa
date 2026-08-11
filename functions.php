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
