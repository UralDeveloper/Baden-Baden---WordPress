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
	// Получаем текущий путь без GET-параметров
	$uri_path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

	// Удалим /page/X из URL (например, /page/2, /page/10 и т.п.)
	$uri_path = preg_replace('#/page/\d+/?#', '', $uri_path);

	// Удалим финальный слэш (если он есть)
	$current_page_url = rtrim($uri_path, '/');

	// Проверяем список страниц из ACF
	if (have_rows('spisok_stranicz', 'option')) :
		while (have_rows('spisok_stranicz', 'option')) : the_row();
			$acf_url = rtrim(get_sub_field('stranicza'), '/');

			if ($acf_url === $current_page_url) :
	?>
				<div class="firstScreen_singlePage__bg">
					<?php
					$izobrazhenie_v_shapku = get_sub_field('izobrazhenie_v_shapku');
					if (!empty($izobrazhenie_v_shapku)) : ?>
						<img src="<?php echo esc_url($izobrazhenie_v_shapku['url']); ?>"
							title="<?php echo esc_attr($izobrazhenie_v_shapku['alt']); ?>"
							alt="<?php echo esc_attr($izobrazhenie_v_shapku['alt']); ?>" />
					<?php endif; ?>
				</div>
	<?php
				break;
			endif;
		endwhile;
	endif;
	?>

	<div class="firstScreen_singlePage__content container">
		<div class="firstScreen_singlePage__title">
			<h1><?php the_archive_title(); ?></h1>
		</div>
	</div>
</section>

<?/*
<section class="firstScreen_singlePage">
	<?php
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
					$izobrazhenie_v_phone = get_sub_field('izobrazhenie_dlya_telefon');
					$izobrazhenie_v_pad = get_sub_field('izobrazhenie_dlya_plansheta');
					if (!empty($izobrazhenie_v_shapku)) : ?>
					<picture>
						<source srcset="<?php echo esc_url($izobrazhenie_v_phone['url']); ?>" media="(max-width: 767px)" />
						<source srcset="<?php echo esc_url($izobrazhenie_v_pad['url']); ?>" media="(min-width: 768px) and (max-width: 1024px)" />
						<img src="<?php echo esc_url($izobrazhenie_v_shapku['url']); ?>" title="<?php echo $izobrazhenie_v_shapku['title']; ?>" alt="<?php echo esc_attr($izobrazhenie_v_shapku['alt']); ?>" />
					</picture>
					<?php endif; ?>
				</div>
				<?php
				break;
			else :
			endif;
		endwhile;
	endif;
	?>
	<div class="firstScreen_singlePage__content container">
		<div class="firstScreen_singlePage__title">
			<h1><?php the_archive_title(); ?></h1>
		</div>
	</div>
</section>
*/?>

<section id="travelline" class="container" data-travelLine="<?php the_field( 'travelline_id', 'option' ); ?>">
	<div class="grid">
		<div class="travel-script">
			<!-- start TL Search form script -->
			<div id="block-search">
				<div id="tl-search-form" class="tl-container">
				</div>
			</div>
		</div>
	</div>
</section>

<main class="singleArticle singleArticle--archive container">
	<?/*
	<div class="singleArticle__wrapper">
		<?php if (have_posts()) : ?>
			<?php while (have_posts()) : the_post(); ?>
				<article class="singleArticle__item">
					<div class="article-title">
						<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
					</div>
					<div class="article-meta">
						<div class="article-date">
							<img src="<?php the_badden_assets('img', 'calendar.svg') ?>" title="Дата публикации" alt="Дата публикации">
							<span><?php echo get_the_date(); ?></span>
						</div>
						<div class="article-category">
							<img src="<?php the_badden_assets('img', 'mark.svg') ?>" title="Категория публикации" alt="Категория публикации">
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
					<?php $miniatyura_zapisi = get_field( 'dopolnitelnye_foto_miniatyura_zapisi', get_the_ID() ); ?>
					<?php if ( $miniatyura_zapisi ) : ?>
					<div class="article-image">
							<img src="<?php echo esc_url( $miniatyura_zapisi['url'] ); ?>"
								title="<?php echo esc_attr( $miniatyura_zapisi['alt'] ); ?>"
								alt="<?php echo esc_attr( $miniatyura_zapisi['alt'] ); ?>" />
						<?php elseif (has_post_thumbnail()) :
							echo '<div class="article-image">';
							echo '<img src="' . esc_url(get_the_post_thumbnail_url()) . '" title="' . esc_attr(get_the_title()) . '" alt="' . esc_attr(get_the_title()) . '">';
						?>
					</div>
					<?php endif; ?>
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
	*/?>


	<div class="singleArticle__сontent">
		<?php if (have_posts()) : ?>
			<div class="singleArticle__wrapper">
				<?php while (have_posts()) : the_post(); ?>
					<article class="singleArticle__item">
						<div class="article-title">
							<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
						</div>
						<div class="article-meta">
							<div class="article-date">
								<img src="<?php the_badden_assets('img', 'calendar.svg') ?>" title="Дата публикации" alt="Дата публикации">
								<span><?php echo get_the_date(); ?></span>
							</div>
							<div class="article-category">
								<img src="<?php the_badden_assets('img', 'mark.svg') ?>" title="Категория публикации" alt="Категория публикации">
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
						<?php $miniatyura_zapisi = get_field( 'dopolnitelnye_foto_miniatyura_zapisi', get_the_ID() ); ?>
						<?php if ( $miniatyura_zapisi ) : ?>
						<div class="article-image">
								<img src="<?php echo esc_url( $miniatyura_zapisi['url'] ); ?>"
									title="<?php echo esc_attr( $miniatyura_zapisi['alt'] ); ?>"
									alt="<?php echo esc_attr( $miniatyura_zapisi['alt'] ); ?>" />
							<?php elseif (has_post_thumbnail()) :
								echo '<div class="article-image">';
								echo '<img src="' . esc_url(get_the_post_thumbnail_url()) . '" title="' . esc_attr(get_the_title()) . '" alt="' . esc_attr(get_the_title()) . '">';
							?>
						</div>
						<?php endif; ?>
						<div class="article-content">
							<?php the_excerpt(); ?>
						</div>
						<div class="article-footer">
							<a href="<?php the_permalink(); ?>" class="btn btn--border btn--border-black btn--hoverBlue">Читать далее</a>
						</div>
					</article>
				<?php endwhile; ?>
			</div>

			<?php
			$big = 999999999;
			// Выводим пагинацию в формате Bootstrap, адаптируем стили
			$pagination_links = paginate_links([
				'base'      => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
				'format'    => '?paged=%#%',
				'current'   => max(1, get_query_var('paged')),
				'total'     => $wp_query->max_num_pages,
				'type'      => 'array',
				'prev_text' => '&laquo;',
				'next_text' => '&raquo;',
			]);

			if (is_array($pagination_links)) :
				echo '<ul class="pagination justify-content-center">';
				foreach ($pagination_links as $link) {
					$active = strpos($link, 'current') !== false ? ' active' : '';
					$link = str_replace('page-numbers', 'page-link', $link);
					echo '<li class="page-item' . $active . '">' . $link . '</li>';
				}
				echo '</ul>';
			endif;
			?>
		<?php endif; ?>
	</div>
	
	<aside>
		<?php get_sidebar('mobile'); ?>
		<?php get_sidebar(); ?>
	</aside>
</main>

<?php
get_footer();
