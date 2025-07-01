<?php

/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Baden_Baden
 */

get_header();
?>


<section class="firstScreen_singlePage">
	<?php
	$term = get_queried_object();
	$term_id_prefixed = $term ? $term->taxonomy . '_' . $term->term_id : null;

	$taxonomy_preview = $term_id_prefixed ? get_field('taxonomy_preview', $term_id_prefixed) : null;

	if ($taxonomy_preview) : ?>
		<div class="firstScreen_singlePage__bg">
			<img src="<?php echo esc_url($taxonomy_preview); ?>" title="<?php echo isset($term->name) ? esc_attr($term->name) : ''; ?>" alt="<?php echo isset($term->name) ? esc_attr($term->name) : ''; ?>" />
		</div>
		<?php
	elseif (have_rows('spisok_stranicz', 'option')) :
		$current_page_url = rtrim($_SERVER['REQUEST_URI'], '/');
		while (have_rows('spisok_stranicz', 'option')) : the_row();
			$acf_url = rtrim(get_sub_field('stranicza'), '/');
			if ($acf_url === $current_page_url) :
		?>
				<div class="firstScreen_singlePage__bg">
					<?php
					$izobrazhenie_v_shapku = get_sub_field('izobrazhenie_v_shapku');
					if (!empty($izobrazhenie_v_shapku)) : ?>
						<img src="<?php echo esc_url($izobrazhenie_v_shapku['url']); ?>" title="<?php echo esc_attr($izobrazhenie_v_shapku['alt']); ?>" alt="<?php echo esc_attr($izobrazhenie_v_shapku['alt']); ?>" />
					<?php else : ?>
						<img src="<?php echo the_badden_assets('img', 'main-img.jpg'); ?>" title="<?php echo single_cat_title(); ?>" alt="<?php echo single_cat_title(); ?>" />
					<?php endif; ?>
				</div>
			<?php
				break;
			else : ?>
				<div class="firstScreen_singlePage__bg">
					<img src="<?php echo the_badden_assets('img', 'main-img.jpg'); ?>"  alt="<?php echo single_cat_title(); ?>" title="<?php echo single_cat_title(); ?>"/>
				</div>
	<?php endif;
		endwhile;
	endif; ?>


	<?php
	/*
	// Определяем текущий URL
	$current_page_url = rtrim($_SERVER['REQUEST_URI'], '/'); // Убираем последний слэш

	// Проверяем список страниц в ACF
	if (have_rows('spisok_stranicz', 'option')) :
		while (have_rows('spisok_stranicz', 'option')) : the_row();
			$acf_url = rtrim(get_sub_field('stranicza'), '/');
			if ($acf_url === $current_page_url) :
	?>
				<div class="firstScreen_singlePage__bg">
					<?php
					$izobrazhenie_v_shapku = get_sub_field('izobrazhenie_v_shapku');
					if (!empty($izobrazhenie_v_shapku)) : ?>
						<img src="<?php echo esc_url($izobrazhenie_v_shapku['url']); ?>" alt="<?php echo esc_attr($izobrazhenie_v_shapku['alt']); ?>" />
					<?php endif; ?>
				</div>
	<?php
				break;
			endif;
		endwhile;
	endif;
	*/
	?>
	<div class="firstScreen_singlePage__content container">
		<div class="firstScreen_singlePage__title">
			<h1><?php echo single_cat_title(); ?></h1>
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


<main class="singleArticle singleArticle--archive container">
	<div class="singleArticle__wrapper">
		<?php if (have_posts()) : ?>
			<?php while (have_posts()) : the_post(); ?>
				<article class="singleArticle__item">
					<div class="article-title">
						<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
					</div>
					<div class="article-meta">
						<div class="article-date">
							<img src="<?php the_badden_assets('img', 'calendar.svg') ?>" alt="Дата публикации" title="Дата публикации">
							<span><?php echo get_the_date(); ?></span>
						</div>
						<div class="article-category">
							<img src="<?php the_badden_assets('img', 'mark.svg') ?>" alt="Категория публикации" title="Категория публикации">
							<?php
							$custom_taxonomies = [];
							if (empty($custom_taxonomies)) {
								$custom_taxonomies = get_taxonomies(['public' => true], 'names');
							}
							$post_id = get_the_ID();

							if ($post_id) {
								foreach ($custom_taxonomies as $taxonomy) {
									$terms = get_the_terms($post_id, $taxonomy);

									if (! empty($terms) && ! is_wp_error($terms)) {
										foreach ($terms as $term) {
											echo '<span>' . esc_html($term->name) . '</span>';
										}
									}
								}
							}
							?>
						</div>
					</div>
					<div class="article-image">
						<?php if (has_post_thumbnail()) {
							echo '<img src="' . esc_url(get_the_post_thumbnail_url()) . '" title="' . esc_attr(get_the_title()) . '" alt="' . esc_attr(get_the_title()) . '">';
						}
						?>
					</div>
					<div class="article-content">
						<?php the_excerpt(); ?>
					</div>
					<div class="article-footer">
						<a href="<?php the_permalink(); ?>" class="btn btn--border btn--border-black btn--hoverBlue">Читать далее</a>
					</div>
				</article>
			<?php endwhile; ?>
		<?php endif; ?>
	</div>
	<aside>
		<?php get_sidebar(); ?>
	</aside>
</main>

<?php
get_footer();
