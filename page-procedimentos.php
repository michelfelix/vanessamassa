<?php get_header(); ?>

<section class="procedures">

    <p class="section-kicker">Vila Madalena · São Paulo</p>
    <h1 class="section-title">Procedimentos estéticos</h1>
    <?php foreach ( $procedures as $index => $procedure ) : ?>

        <article id="<?php echo esc_attr( rtrim( parse_url( $procedure['url'], PHP_URL_FRAGMENT ), '/' ) ); ?>" class="procedure-item">

            <div class="procedure-image">
                <img src="<?php echo esc_url( home_url() ) . esc_url( $procedure['image'] ); ?>" alt="<?php echo esc_attr( $procedure['title'] . ' na Vila Madalena – Dra. Vanessa Massa' ); ?>" loading="lazy" />
            </div>

            <div class="procedure-content">

                <h2>
                    <?php echo esc_html( $procedure['title'] ); ?>
                </h2>

                <p>
                    <?php echo esc_html( $procedure['text'] ); ?>
                </p>

                <a class="button procedure-button" href="<?php echo esc_url( estetica_procedure_url( $procedure ) ); ?>">
                    Saiba mais sobre <?php echo esc_html( $procedure['title'] ); ?>
                </a>
            </div>

        </article>

    <?php endforeach; ?>

</section>

<?php get_footer(); ?>