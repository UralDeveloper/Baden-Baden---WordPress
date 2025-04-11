<?php

/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Baden_Baden
 */

if (! is_active_sidebar('sidebar-1')) {
	return;
}
?>

<div class="sidebar">
	<h2>Категории</h2>
	<?php
	// Массив типов записей, которые НЕ нужно выводить
	$exclude_post_types = ['attachment', 'revision', 'nav_menu_item', 'page', 'spa', 'sertifikaty', 'bannaya_kollekciya']; // Добавьте сюда ненужные типы

	// Получаем все зарегистрированные типы записей
	$all_post_types = get_post_types(['public' => true], 'objects');

	if (!empty($all_post_types)) {
		echo '<ul>';

		foreach ($all_post_types as $post_type) {
			// Проверяем, нет ли типа записи в списке исключённых
			if (!in_array($post_type->name, $exclude_post_types)) {
				// Получаем ссылку на архив типа записи (если поддерживает архив)
				$post_type_link = get_post_type_archive_link($post_type->name);

				echo '<li>';
				if ($post_type_link) {
					echo '<a href="' . esc_url($post_type_link) . '">' . esc_html($post_type->labels->name) . '</a>';
				} else {
					echo esc_html($post_type->labels->name); // Если архивов нет, просто выводим название
				}
				echo '</li>';
			}
		}

		echo '</ul>';
	} else {
		echo '<p>Типы записей не найдены.</p>';
	}
	?>



</div>
<div class="sidebar">
	<h2>Случайные публикации</h2>
	<?php
	// Типы записей, которые НЕ нужно выводить
	$exclude_post_types = ['attachment', 'revision', 'nav_menu_item', 'page', 'spa', 'sertifikaty', 'bannaya_kollekciya']; // Добавьте сюда ненужные типы

	// Получаем все публичные типы записей, кроме исключённых
	$all_post_types = get_post_types(['public' => true], 'names');
	$post_types_to_query = array_diff($all_post_types, $exclude_post_types);

	// Запрос на 3 случайные записи
	$args = [
		'post_type'      => $post_types_to_query,
		'posts_per_page' => 3,
		'orderby'        => 'rand',
	];

	$query = new WP_Query($args);

	if ($query->have_posts()) : ?>
		<ul>
			<?php while ($query->have_posts()) : $query->the_post(); ?>
				<li>
					<div class="article-meta article-meta_small">
						<div class="article-date">
							<img src="<?php the_badden_assets('img', 'calendar.svg')?>" alt="">
							<span><?php echo get_the_date('d F Y'); ?></span>
						</div>
						<div class="article-category">
							<img src="<?php the_badden_assets('img', 'mark.svg')?>" alt="">
							<span>
								<?php
								// Получаем первую категорию/таксономию записи
								$terms = get_the_terms(get_the_ID(), get_post_taxonomies(get_the_ID())[0] ?? '');
								echo (!empty($terms) && !is_wp_error($terms)) ? esc_html($terms[0]->name) : 'Без категории';
								?>
							</span>
						</div>
					</div>
					<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
					<p><?php echo wp_trim_words(get_the_excerpt(), 15, '...'); ?></p>
				</li>
			<?php endwhile; ?>
		</ul>
		<?php wp_reset_postdata(); ?>
	<?php else : ?>
		<p>Записей не найдено.</p>
	<?php endif; ?>

</div>