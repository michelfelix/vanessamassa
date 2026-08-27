<?php
    $categories = get_categories([
        'hide_empty' => true,
        'exclude' => get_cat_ID( 'Sem categoria' ),
    ]);
?>

<aside class="blog-sidebar">
    <div class="widget-categories">
        <h3>Categorias</h3>
        <ul>
            <li>
                <a href="<?php echo esc_url( home_url( '/blog/' ) ); ?>" <?php if(is_page( 'blog' )): ?> style="font-weight: 600;" <?php endif; ?> >
                    Todos os Artigos
                </a>
            </li>

            <?php foreach ( $categories as $category ) : ?>

                <li class="<?php echo is_category( $category->term_id ) ? 'active' : ''; ?>">
                    <a href="<?php echo esc_url( get_category_link( $category->term_id ) ); ?>">
                        <?php echo esc_html( $category->name ); ?>
                    </a>
                </li>

            <?php endforeach; ?>

        </ul>
    </div>
</aside>