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
	// Определяем текущий URL без UTM и других параметров
	$uri_path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
	$current_page_url = rtrim($uri_path, '/'); // Убираем последний слэш

	// Проверяем список страниц в ACF
	if (have_rows('spisok_stranicz', 'option')) :
		while (have_rows('spisok_stranicz', 'option')) : the_row();
			$acf_url = rtrim(get_sub_field('stranicza'), '/'); // Убираем последний слэш из ACF

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

<section id="travelline" class="container" data-travelLine="<?php the_field( 'travelline_id', 'option' ); ?>">
	<div class="grid">
		<div class="travel-script">
			<div id="block-search">
				<div id="tl-search-form" class="tl-container"></div>
			</div>
		</div>
	</div>
</section>


<main class="singleArticle container">
	<div>
		<div class="singleArticle__wrapper">
		<?php
		if (have_posts()) : ?>
			<?php while (have_posts()) : the_post(); ?>
				<article class="singleArticle__item">
					<div class="article-title">
						<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
					</div>
					<div class="article-meta">
						<div class="article-date">
							<img src="<?php the_badden_assets('img', 'calendar.svg') ?>" alt="Дата публикации"  title="Дата публикации">
							<span><?php echo get_the_date(); ?></span>
						</div>
						<div class="article-category">
							<img src="<?php the_badden_assets('img', 'mark.svg') ?>" alt="Категория публикации"  title="Категория публикации">
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
						// endif
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
		<?php endif; 
		?>
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
		<?php /*
		if (have_posts()) : ?>
			<?php while (have_posts()) : the_post(); ?>
				<article class="singleArticle__item">
					<div class="article-title">
						<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
					</div>
					<div class="article-meta">
						<div class="article-date">
							<img src="<?php the_badden_assets('img', 'calendar.svg') ?>" alt="Дата публикации"  title="Дата публикации">
							<span><?php echo get_the_date(); ?></span>
						</div>
						<div class="article-category">
							<img src="<?php the_badden_assets('img', 'mark.svg') ?>" alt="Категория публикации"  title="Категория публикации">
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
						// endif
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
		<?php endif; 
		*/ ?>
	</div>
	<aside>
		<?php get_sidebar('mobile'); ?>
		<?php get_sidebar(); ?>
	</aside>
</main>

<?php
get_footer();
