<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<header class="site-header" id="site-header">
    <div class="header-inner">
        <a class="site-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>" aria-label="<?php bloginfo( 'name' ); ?>">
            <?php
            if ( has_custom_logo() ) {
                the_custom_logo();
            } else {
                bloginfo( 'name' );
            }
            ?>
        </a>

        <nav class="main-navigation" id="main-navigation" aria-label="<?php esc_attr_e( 'Menu principal', 'estetica-institucional' ); ?>">
            <?php
            wp_nav_menu(
                array(
                    'theme_location' => 'primary',
                    'container'      => false,
                    'fallback_cb'    => 'estetica_fallback_menu',
                )
            );
            ?>
        </nav>

        <a class="button header-cta" href="<?php echo estetica_booking_url(); ?>">
            Agende sua consulta
        </a>

        <button class="menu-toggle" type="button" aria-controls="main-navigation" aria-expanded="false">
            <span aria-hidden="true">☰</span>
            <span class="screen-reader-text">Abrir menu</span>
        </button>
    </div>
</header>

<?php
function estetica_fallback_menu() {
    ?>
    <ul>
        <li><a href="<?php echo esc_url( home_url( '/' ) ); ?>">Início</a></li>
        <li><a href="<?php echo esc_url( home_url( '/#sobre' ) ); ?>">Sobre</a></li>
        <li><a href="<?php echo esc_url( get_permalink( get_option( 'page_for_posts' ) ) ); ?>">Blog</a></li>
        <li><a href="<?php echo estetica_booking_url(); ?>">Fale conosco</a></li>
    </ul>
    <?php
}
?>
