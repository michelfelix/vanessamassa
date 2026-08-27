<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
?>

<div class="instagram-feed container">
    <div>
        <h2>
            Confira nossas últimas publicações no Instagram
        </h2>
    </div>
    <?php echo do_shortcode('[instagram-feed feed=1]'); ?>
</div>

<footer class="site-footer">
    <div class="container">
        <div class="footer-grid">
            <div>
                <div class="footer-brand"><?php bloginfo( 'name' ); ?></div>
                <p>Beleza, cuidado e atendimento personalizado para você.</p>
            </div>

            <div>
                <h2 class="footer-title">Navegação</h2>
                <?php
                wp_nav_menu(
                    array(
                        'theme_location' => 'footer',
                        'container'      => false,
                        'fallback_cb'    => 'estetica_footer_fallback_menu',
                        'menu_class'     => 'footer-list',
                    )
                );
                ?>
            </div>

            <div>
                <h2 class="footer-title">Posts recentes</h2>
                <ul class="footer-list">
                    <?php
                    $recent_posts = new WP_Query(
                        array(
                            'post_type'      => 'post',
                            'posts_per_page' => 3,
                            'post_status'    => 'publish',
                        )
                    );

                    if ( $recent_posts->have_posts() ) :
                        while ( $recent_posts->have_posts() ) :
                            $recent_posts->the_post();
                            ?>
                            <li>
                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                            </li>
                            <?php
                        endwhile;
                        wp_reset_postdata();
                    else :
                        ?>
                        <li>Nenhum post publicado ainda.</li>
                        <?php
                    endif;
                    ?>
                </ul>
            </div>

            <div>
                <h2 class="footer-title">Contato</h2>

                <?php if ( get_theme_mod( 'estetica_whatsapp' ) ) : ?>
                    <p>WhatsApp<br><?php echo esc_html( get_theme_mod( 'estetica_whatsapp' ) ); ?></p>
                <?php endif; ?>

                <?php if ( get_theme_mod( 'estetica_address' ) ) : ?>
                    <p><?php echo nl2br( esc_html( get_theme_mod( 'estetica_address' ) ) ); ?></p>
                <?php endif; ?>

                <?php if ( get_theme_mod( 'estetica_instagram' ) ) : ?>
                    <p><a href="<?php echo esc_url( get_theme_mod( 'estetica_instagram' ) ); ?>" target="_blank" rel="noopener">Instagram</a></p>
                <?php endif; ?>

                <a class="button" href="<?php echo estetica_booking_url(); ?>">
                    Agende sua consulta
                </a>
            </div>
        </div>

        <div class="footer-bottom">
            <span>&copy; <?php echo esc_html( date_i18n( 'Y' ) ); ?> <?php bloginfo( 'name' ); ?>. Todos os direitos reservados.</span>
            <span>Desenvolvido com carinho.</span>
        </div>
    </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>

<?php
function estetica_footer_fallback_menu() {
    ?>
    <ul class="footer-list">
        <li><a href="<?php echo esc_url( home_url( '/' ) ); ?>">Início</a></li>
        <li><a href="<?php echo esc_url( home_url( '/#sobre' ) ); ?>">Sobre</a></li>
        <li><a href="<?php echo esc_url( get_permalink( get_option( 'page_for_posts' ) ) ); ?>">Blog</a></li>
        <li><a href="<?php echo estetica_booking_url(); ?>">Agende sua consulta</a></li>
    </ul>
    <?php
}
?>
