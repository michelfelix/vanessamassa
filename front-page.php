<?php
get_header();

$blog_page_id = get_option( 'page_for_posts' );
?>

<main>
    <section class="hero" id="inicio">
        <div class="container hero-grid">
            <div class="hero-content">
                <p class="section-kicker">Bem-vinda ao meu espaço</p>
                <h1 class="hero-title">Realce sua beleza, revele sua essência.</h1>
                <p class="hero-description">
                    Cuidados personalizados para realçar sua melhor versão com naturalidade,
                    segurança e bem-estar.
                </p>
                <a class="button" href="<?php echo estetica_booking_url(); ?>">
                    Agende sua consulta
                </a>
            </div>

            <div class="hero-media">
                <div class="hero-shape" aria-hidden="true"></div>
                <?php if ( has_post_thumbnail() ) : ?>
                    <?php the_post_thumbnail( 'large', array( 'class' => 'hero-image' ) ); ?>
                <?php else : ?>
                    <div class="hero-image" style="background:#ffffff;"></div>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <section class="section" id="sobre">
        <div class="container about-grid">
            <div class="about-media">
                <div aria-hidden="true"></div>
                <?php if ( has_post_thumbnail() ) : ?>
                    <?php the_post_thumbnail( 'large' ); ?>
                <?php else : ?>
                    <div style="aspect-ratio:4/5;background:#fff0f9;border-radius:32px;"></div>
                <?php endif; ?>
            </div>

            <div>
                <p class="section-kicker">Sobre mim</p>
                <h2 class="section-title">Muito prazer, sou [Nome da profissional]</h2>
                <p class="section-lead">
                    Escreva aqui uma apresentação curta, humana e profissional.
                    Conte sua especialidade, experiência e principalmente o que torna
                    seu atendimento diferente.
                </p>
                <p>
                    Esse texto pode crescer futuramente em uma página completa de apresentação.
                </p>
            </div>
        </div>
    </section>

    <section class="section section--primary" id="procedimentos">
        <div class="container">
            <p class="section-kicker">Procedimentos</p>
            <h2 class="section-title">Como posso te ajudar?</h2>

            <div class="procedures-grid">
                <?php
                $procedures = array(
                    array(
                        'title' => 'Procedimento 01',
                        'text'  => 'Breve descrição do procedimento e seu principal benefício.',
                    ),
                    array(
                        'title' => 'Procedimento 02',
                        'text'  => 'Breve descrição do procedimento e seu principal benefício.',
                    ),
                    array(
                        'title' => 'Procedimento 03',
                        'text'  => 'Breve descrição do procedimento e seu principal benefício.',
                    ),
                );

                foreach ( $procedures as $procedure ) :
                    ?>
                    <article class="card">
                        <div class="card-image" style="background:#ffffff;"></div>
                        <div class="card-content">
                            <h3 class="card-title"><?php echo esc_html( $procedure['title'] ); ?></h3>
                            <p class="card-text"><?php echo esc_html( $procedure['text'] ); ?></p>
                            <a class="card-link" href="<?php echo esc_url( home_url( '/procedimentos/' ) ); ?>">
                                Saiba mais →
                            </a>
                        </div>
                    </article>
                    <?php
                endforeach;
                ?>
            </div>
        </div>
    </section>

    <section class="section">
        <div class="container">
            <div class="blog-heading">
                <div>
                    <p class="section-kicker">No blog</p>
                    <h2 class="section-title">Conteúdos para você</h2>
                </div>

                <?php if ( $blog_page_id ) : ?>
                    <a class="card-link" href="<?php echo esc_url( get_permalink( $blog_page_id ) ); ?>">
                        Ver todos os posts →
                    </a>
                <?php endif; ?>
            </div>

            <div class="posts-grid">
                <?php
                $posts = new WP_Query(
                    array(
                        'post_type'      => 'post',
                        'posts_per_page' => 3,
                        'post_status'    => 'publish',
                    )
                );

                if ( $posts->have_posts() ) :
                    while ( $posts->have_posts() ) :
                        $posts->the_post();
                        ?>
                        <article class="card">
                            <?php if ( has_post_thumbnail() ) : ?>
                                <?php the_post_thumbnail( 'medium_large', array( 'class' => 'card-image' ) ); ?>
                            <?php else : ?>
                                <div class="card-image" style="background:#fff0f9;"></div>
                            <?php endif; ?>

                            <div class="card-content">
                                <div class="post-meta"><?php echo esc_html( get_the_date() ); ?></div>
                                <h3 class="card-title"><?php the_title(); ?></h3>
                                <p class="card-text"><?php echo esc_html( wp_trim_words( get_the_excerpt(), 18 ) ); ?></p>
                                <a class="card-link" href="<?php the_permalink(); ?>">Ler mais →</a>
                            </div>
                        </article>
                        <?php
                    endwhile;
                    wp_reset_postdata();
                else :
                    ?>
                    <p>Os conteúdos do blog aparecerão aqui assim que o primeiro post for publicado.</p>
                    <?php
                endif;
                ?>
            </div>
        </div>
    </section>

    <section class="section" id="agendamento">
        <div class="container">
            <div class="cta">
                <div>
                    <h2>Pronta para realçar sua melhor versão?</h2>
                    <p>Agende sua consulta e vamos cuidar de você.</p>
                </div>
                <a class="button" href="<?php echo estetica_booking_url(); ?>">
                    Agende sua consulta
                </a>
            </div>
        </div>
    </section>
</main>

<?php get_footer(); ?>
