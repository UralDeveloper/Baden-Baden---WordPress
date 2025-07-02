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

<div class="sidebar sidebar--mobile">
    <button class="btn btn--category_filter" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
        Категории
        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M16 12H8" stroke="#363853" stroke-width="1.5" stroke-linecap="round"/>
            <path d="M18 7L6 7" stroke="#363853" stroke-width="1.5" stroke-linecap="round"/>
            <path d="M10 17L14 17" stroke="#363853" stroke-width="1.5" stroke-linecap="round"/>
        </svg>

    </button>
    
    <div class="collapse" id="collapseExample">
		<?php
			$post_type = get_post_type();
			$taxonomies = get_object_taxonomies($post_type, 'objects');

			// Таксономии, которые нужно скрыть
			$excluded_taxonomies = ['post_tag', 'nav_menu', 'post_format', 'post_tag', 'tip_kompleksa'];

			if ($taxonomies) {
				foreach ($taxonomies as $taxonomy) {
					if (in_array($taxonomy->name, $excluded_taxonomies)) {
						continue; // пропускаем эту таксономию
					}
					if ($taxonomy->labels->name == 'Рубрики') {
						$taxonomy->labels->name = 'Категории';
					}

					$terms = get_terms([
						'taxonomy' => $taxonomy->name,
						'hide_empty' => true,
					]);

					if (!empty($terms) && !is_wp_error($terms)) {
						echo '<ul>';
						foreach ($terms as $term) {
							echo '<li><a href="' . esc_url(get_term_link($term)) . '">' . esc_html($term->name) . '</a></li>';
						}
						echo '</ul>';
					} else {
						echo '<p><em>Нет категорий.</em></p>';
					}
				}
			}
		?>
    </div>
</div>
