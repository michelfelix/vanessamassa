<?php
/**
 * Template Name: Procedimento
 *
 * Usado automaticamente por qualquer página filha de "Procedimentos"
 * (ex.: /procedimentos/botox/). O conteúdo — texto e o bloco
 * "FAQ" do Yoast — vem do editor da página.
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

get_header();

global $procedures;

$current_slug = get_post_field( 'post_name', get_the_ID() );
$neighborhood = get_theme_mod( 'estetica_neighborhood', 'Vila Madalena' );
$city         = get_theme_mod( 'estetica_city', 'São Paulo' );
?>

<main class="procedure-page">
    <?php while ( have_posts() ) : the_post(); ?>

        <section class="procedure-hero">
            <div class="container procedure-hero-grid">
                <div>
                    <nav class="breadcrumbs" aria-label="Você está em">
                        <a href="<?php echo esc_url( home_url( '/' ) ); ?>">Início</a>
                        <span aria-hidden="true">/</span>
                        <a href="<?php echo esc_url( home_url( '/procedimentos/' ) ); ?>">Procedimentos</a>
                        <span aria-hidden="true">/</span>
                        <span aria-current="page"><?php the_title(); ?></span>
                    </nav>

                    <p class="section-kicker">
                        <?php echo esc_html( 'Biomédica esteta · ' . $neighborhood . ', ' . $city ); ?>
                    </p>
                    <h1 class="section-title"><?php the_title(); ?></h1>

                    <?php if ( has_excerpt() ) : ?>
                        <p class="section-lead"><?php echo esc_html( get_the_excerpt() ); ?></p>
                    <?php endif; ?>

                    <a class="button" href="<?php echo estetica_booking_url(); ?>" target="_blank" rel="noopener">
                        Agende sua avaliação
                    </a>
                </div>

                <?php if ( has_post_thumbnail() ) : ?>
                    <div class="procedure-hero-image">
                        <?php
                        the_post_thumbnail(
                            'large',
                            array( 'alt' => get_the_title() . ' com a Dra. Vanessa Massa, biomédica esteta na ' . $neighborhood )
                        );
                        ?>
                    </div>
                <?php endif; ?>
            </div>
        </section>

        <article class="section procedure-body">
            <div class="container entry-content">
                <?php the_content(); ?>
            </div>
        </article>

    <?php endwhile; ?>

    <section class="section">
        <div class="container">
            <div class="cta">
                <div>
                    <h2>Ficou com alguma dúvida?</h2>
                    <p>Agende sua avaliação ou fale comigo pelo WhatsApp.</p>
                </div>
                <div class="cta-actions">
                    <a class="button" href="<?php echo estetica_booking_url(); ?>" target="_blank" rel="noopener">
                        Agende sua avaliação
                    </a>
                    <?php if ( get_theme_mod( 'estetica_whatsapp' ) ) : ?>
                        <a class="button button--light" href="https://wa.me/<?php echo esc_attr( get_theme_mod( 'estetica_whatsapp' ) ); ?>?text=<?php echo rawurlencode( 'Olá, gostaria de saber mais sobre ' . get_the_title() . '.' ); ?>" target="_blank" rel="noopener">
                            WhatsApp
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>

    <?php if ( ! empty( $procedures ) ) : ?>
        <section class="section section--primary">
            <div class="container">
                <p class="section-kicker">Conheça também</p>
                <h2 class="section-title">Outros procedimentos</h2>
                <ul class="other-procedures">
                    <?php foreach ( $procedures as $procedure ) : ?>
                        <?php if ( estetica_procedure_slug( $procedure ) === $current_slug ) { continue; } ?>
                        <li>
                            <a href="<?php echo esc_url( estetica_procedure_url( $procedure ) ); ?>">
                                <?php echo esc_html( $procedure['title'] ); ?> →
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </section>
    <?php endif; ?>
</main>

<?php get_footer(); ?>
