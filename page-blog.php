<?php
get_header();
?>

<main class="blog-page">
    <?php get_template_part( 'template-parts/blog-sidebar' ); ?>

    <section class="section">

        <div class="container">

            <p class="section-kicker">Blog</p>

            <h1 class="section-title">
                Todos os Artigos
            </h1>

            <?php
            $posts_query = new WP_Query([
                'post_type'      => 'post',
                'posts_per_page' => 10,
                'paged'          => get_query_var( 'paged' ) ?: 1,
            ]);
            ?>

            <?php if ( $posts_query->have_posts() ) : ?>

                <div class="blog-grid">

                    <?php while ( $posts_query->have_posts() ) : $posts_query->the_post(); ?>

                        <article class="card">

                            <?php if ( has_post_thumbnail() ) : ?>

                                <a href="<?php the_permalink(); ?>">
                                    <?php the_post_thumbnail( 'large' ); ?>
                                </a>

                            <?php endif; ?>
                            <div class="card-content">
                                <p class="blog-card-date">
                                    <?php echo esc_html( get_the_date() ); ?>
                                </p>

                                <h3>
                                    <?php the_title(); ?>
                                </h3>

                                <div class="blog-card-excerpt">
                                    <?php the_excerpt(); ?>
                                </div>

                                <a href="<?php the_permalink(); ?>">
                                    Leia mais
                                </a>
                            </div>

                        </article>

                    <?php endwhile; ?>

                </div>

            <?php else : ?>

                <p>Nenhum artigo encontrado nesta categoria.</p>

            <?php endif; ?>

        </div>

    </section>

</main>

<?php get_footer(); ?>