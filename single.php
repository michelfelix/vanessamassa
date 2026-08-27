<?php
get_header();
?>

<main class="blog-page">
    <?php get_template_part( 'template-parts/blog-sidebar' ); ?>

    <article class="section">
        <div class="container entry-content">
            <?php while ( have_posts() ) : the_post(); ?>
                <p class="section-kicker"><?php echo esc_html( get_the_date() ); ?></p>
                <h1 class="section-title"><?php the_title(); ?></h1>

                <?php if ( has_post_thumbnail() ) : ?>
                    <?php the_post_thumbnail( 'large' ); ?>
                <?php endif; ?>

                <div>
                    <?php the_content(); ?>
                </div>
            <?php endwhile; ?>
        </div>
    </article>
</main>

<?php get_footer(); ?>
