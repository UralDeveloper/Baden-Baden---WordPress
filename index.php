<?php

/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Baden_Baden
 */

get_header();
?>
<section class="firstScreen_singlePage">
	<div class="firstScreen_singlePage__bg">
		<?php
		// Определяем текущий URL
		$current_page_url = rtrim($_SERVER['REQUEST_URI'], '/'); // Убираем последний слэш

		// Проверяем список страниц в ACF
		if (have_rows('spisok_stranicz', 'option')) :
			while (have_rows('spisok_stranicz', 'option')) : the_row();
				$acf_url = rtrim(get_sub_field('stranicza'), '/'); // Убираем последний слэш из ACF

				echo "<p>Проверка: ACF URL - " . esc_html($acf_url) . ", Текущий URL - " . esc_html($current_page_url) . "</p>"; // Отладка

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
		?>



	</div>
	<div class="firstScreen_singlePage__content container">
		<div class="firstScreen_singlePage__title">
			<h1>Новости</h1>
		</div>
	</div>
</section>

<section id="travelline" class="container">
	<div class="travel-script"></div>
</section>

<main class="singleArticle container">
	<div>
		<?php if (have_posts()) : the_post(); ?>
			<?php while (have_posts()) : the_post(); ?>
				<article>
					<div class="article-meta">
						<div class="article-date">
							<img src="<?php the_badden_assets('img', 'calendar.svg') ?>" alt="Дата публикации">
							<span><?php echo get_the_date(); ?></span>
						</div>
						<div class="article-category">
							<img src="<?php the_badden_assets('img', 'mark.svg') ?>" alt="Категория публикации">
							<?php
							// Указываем нужные таксономии вручную (если пусто, будут выведены все таксономии)
							$custom_taxonomies = [];
							if (empty($custom_taxonomies)) {
								$custom_taxonomies = get_taxonomies(['public' => true], 'names');
							}
							$post_id = get_the_ID();

							if ($post_id) {
								foreach ($custom_taxonomies as $taxonomy) {
									// Получаем термины (категории) текущей записи для указанной таксономии
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
							echo '<img src="' . esc_url(get_the_post_thumbnail_url()) . '" alt="' . esc_attr(get_the_title()) . '">';
						}
						?>
					</div>
					<div class="article-content">
						<?php the_content(); ?>
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
