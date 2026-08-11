<?php
get_header();
?>

<main class="blog-page">
    <section class="section">
        <div class="container">
            <p class="section-kicker">No blog</p>
            <h1 class="section-title">Conteúdos para você</h1>

            <div class="posts-grid">
                <?php if ( have_posts() ) : ?>
                    <?php while ( have_posts() ) : the_post(); ?>
                        <article class="card">
                            <?php if ( has_post_thumbnail() ) : ?>
                                <?php the_post_thumbnail( 'medium_large', array( 'class' => 'card-image' ) ); ?>
                            <?php endif; ?>

                            <div class="card-content">
                                <div class="post-meta"><?php echo esc_html( get_the_date() ); ?></div>
                                <h2 class="card-title"><?php the_title(); ?></h2>
                                <p class="card-text"><?php echo esc_html( wp_trim_words( get_the_excerpt(), 25 ) ); ?></p>
                                <a class="card-link" href="<?php the_permalink(); ?>">Ler mais →</a>
                            </div>
                        </article>
                    <?php endwhile; ?>
                <?php else : ?>
                    <p>Nenhum post publicado ainda.</p>
                <?php endif; ?>
            </div>

            <?php the_posts_pagination(); ?>
        </div>
    </section>
</main>

<?php get_footer(); ?>
