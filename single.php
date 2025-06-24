<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Baden_Baden
 */

get_header();
?>
<section class="firstScreen_singlePage">
    <div class="firstScreen_singlePage__bg">
		<picture>
			<?php if ( have_rows( 'dopolnitelnye_foto' ) ) : ?>
				<?php while ( have_rows( 'dopolnitelnye_foto' ) ) : the_row(); ?>
					<?php $dlya_telefona = get_sub_field( 'dlya_telefona' ); ?>
					<?php if ( $dlya_telefona ) : ?>
						<source media="(max-width: 767px)" srcset="<?php echo esc_url( $dlya_telefona['url'] ); ?>" />
					<?php endif; ?>
					
					<?php $dlya_plansheta = get_sub_field( 'dlya_plansheta' ); ?>
					<?php if ( $dlya_plansheta ) : ?>
						<source media="(min-width: 768px) and (max-width: 1024px)" srcset="<?php echo esc_url( $dlya_plansheta['url'] ); ?>" />
					<?php endif; ?>
				<?php endwhile; ?>
			<?php endif; ?>
			<img src="<?php the_post_thumbnail_url(); ?>" alt="">
		</picture>
    </div>
    <div class="firstScreen_singlePage__content container">
        <div class="firstScreen_singlePage__title">
            <h1><?php the_title(); ?></h1>
        </div>
    </div>
</section>

    <section id="travelline" class="container" data-travelLine="<?php the_field( 'travelline_id', 'option' ); ?>">
		<div class="grid">
			<div class="travel-script">
				<!-- start TL Search form script -->
				<div id="block-search">
					<div id="tl-search-form" class="tl-container">
						<!-- <noindex><a href="https://www.travelline.ru/products/tl-hotel/" rel="nofollow" target="_blank">TravelLine</a></noindex> -->
					</div>
				</div>
				<!-- end TL Search form script -->
			</div>
		</div>
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
		<?php
		$post_type = get_post_type();
		$excluded_types = ['prozhivanie']; // сюда можно добавлять новые типы

		if (!in_array($post_type, $excluded_types)) {
			get_sidebar('mobile');
		}
			get_sidebar();
		?>
    </aside>
</main>

<?php
get_footer();
