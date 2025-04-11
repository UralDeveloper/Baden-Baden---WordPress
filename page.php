<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Baden_Baden
 */

get_header();
?>

<section class="firstScreen_singlePage">
    <div class="firstScreen_singlePage__bg">
        <img src="<?php the_post_thumbnail_url(); ?>" alt="">
    </div>
    <div class="firstScreen_singlePage__content container">
        <div class="firstScreen_singlePage__title">
            <h1><?php the_title(); ?></h1>
        </div>
    </div>
</section>

<section id="travelline" class="container">
	<div class="travel-script"></div>
</section>

<main class="singleArticle container">
    <article>
        <div class="article-meta">
            <div class="article-date">
                <img src="<?php the_badden_assets('img', 'calendar.svg')?>" alt="Дата публикации">
                <span><?php echo get_the_date(); ?></span>
            </div>
            <div class="article-category">
                <img src="<?php the_badden_assets('img', 'mark.svg')?>" alt="Категория публикации">
				<?php
					// Указываем нужные таксономии вручную (если пусто, будут выведены все таксономии)
					$custom_taxonomies = [];
					if ( empty( $custom_taxonomies ) ) {
						$custom_taxonomies = get_taxonomies( [ 'public' => true ], 'names' );
					}
					$post_id = get_the_ID();

					if ( $post_id ) {
						foreach ( $custom_taxonomies as $taxonomy ) {
							// Получаем термины (категории) текущей записи для указанной таксономии
							$terms = get_the_terms( $post_id, $taxonomy );

							if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) {
								foreach ( $terms as $term ) {
									echo '<span>' . esc_html( $term->name ) . '</span>';
								}
							}
						}
					}
				?>
            </div>
        </div>
        <div class="article-content">
			<?php the_content(); ?>
        </div>
    </article>
    <aside>
		<?php get_sidebar(); ?>
    </aside>
</main>

<?php
get_footer();
