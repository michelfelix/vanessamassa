<?php
get_header();
?>

<main class="blog-page">
    <section class="section">
        <div class="container">
            <h1 class="section-title"><?php bloginfo( 'name' ); ?></h1>

            <?php if ( have_posts() ) : ?>
                <div class="posts-grid">
                    <?php while ( have_posts() ) : the_post(); ?>
                        <article class="card">
                            <?php if ( has_post_thumbnail() ) : ?>
                                <?php the_post_thumbnail( 'medium_large', array( 'class' => 'card-image' ) ); ?>
                            <?php endif; ?>
                            <div class="card-content">
                                <h2 class="card-title"><?php the_title(); ?></h2>
                                <p class="card-text"><?php echo esc_html( wp_trim_words( get_the_excerpt(), 25 ) ); ?></p>
                                <a class="card-link" href="<?php the_permalink(); ?>">Ler mais →</a>
                            </div>
                        </article>
                    <?php endwhile; ?>
                </div>
            <?php endif; ?>
        </div>
    </section>
</main>

<?php get_footer(); ?>
