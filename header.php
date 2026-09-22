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
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Serif+Display:wght@400;500;600;700&family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.3.1/css/all.min.css" integrity="sha512-QeR2VH+lsBE5LSAe1Q5EnTBbe7XTBubt8dG93Y7gidSgdMCr8nVqKcfKAMyN96SV8KDbZVTDXChatu5G2KQGzg==" crossorigin="anonymous" referrerpolicy="no-referrer">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<header class="site-header" id="site-header">
    <div class="header-inner">
            <?php
            if ( has_custom_logo() ) {
                the_custom_logo();
            } else {
                bloginfo( 'name' );
            }
            ?>

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
        <li><a href="<?php echo esc_url( home_url( '/#inicio' ) ); ?>">Início</a></li>
        <li><a href="<?php echo esc_url( home_url( '/#sobre' ) ); ?>">Sobre</a></li>
        <li><a href="<?php echo esc_url( home_url( '/procedimentos' ) ); ?>">Procedimentos</a></li>
        <li><a href="<?php echo esc_url( home_url( '/blog' ) ); ?>">Blog</a></li>
    </ul>
    <?php
}
?>
