<?php get_header(); ?>

<section class="procedures">

    <h1 class="section-title">Procedimentos</h1>
    <?php foreach ( $procedures as $index => $procedure ) : ?>

        <article class="procedure-item">

            <div class="procedure-image">
                <img src="<?php echo esc_url( home_url() ) . esc_url( $procedure['image'] ); ?>" alt="<?php echo esc_attr( $procedure['title'] ); ?>" />
            </div>

            <div class="procedure-content">

                <h2>
                    <?php echo esc_html( $procedure['title'] ); ?>
                </h2>

                <p>
                    <?php echo esc_html( $procedure['text'] ); ?>
                </p>
            </div>

        </article>

    <?php endforeach; ?>

</section>

<?php get_footer(); ?>