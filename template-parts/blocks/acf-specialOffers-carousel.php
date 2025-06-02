<?php
/**
 * Block template file: /baden/template-parts/blocks/acf-specialOffers-carousel.php
 *
 * Special Offers Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'special-offers-' . $block['id'];
if ( ! empty($block['anchor'] ) ) {
    $id = $block['anchor'];
}
?>

<style type="text/css">
	<?php echo '#' . $id; ?> {
		/* Add styles that use ACF values here */
	}
</style>


<section id="<?php echo esc_attr( $id ); ?>" class="specialOffers">
    <?php if ( have_rows( 'kuresel_akczij' ) ) : ?>
        <?php while ( have_rows( 'kuresel_akczij' ) ) : the_row(); ?>
        <div class="container-fluid">
            <div class="titleBlock">
                <h2><?php the_sub_field( 'zagolovok' ); ?></h2>
            </div>
            <div class="titleWrapper">
                <ul class="nav nav-pills" id="pills-bathCollection">
                    <li class="nav-item">
                        <a class="nav-tab btn--link active" data-category="Все">Все</a>
                    </li>
                        <?php
                        $akczii = get_sub_field('akczii');
                        $taxonomies = ['akcii_category', 'tour_category']; // здесь можно добавить свои таксономии
                        $all_terms = [];

                        if ($akczii) {
                            foreach ($akczii as $post_id) {
                                foreach ($taxonomies as $taxonomy) {
                                    $terms = get_the_terms($post_id, $taxonomy);

                                    if (!empty($terms) && !is_wp_error($terms)) {
                                        foreach ($terms as $term) {
                                            $all_terms[$term->term_id] = $term; // уникальность по term_id
                                        }
                                    }
                                }
                            }

                            // Выводим уникальные категории
                            foreach ($all_terms as $term) {
                                $category = esc_html($term->name); ?>
                                <li class="nav-item">
                                    <a class="nav-tab btn--link" data-category="<?php echo $category; ?>">
                                        <?php echo $category; ?>
                                    </a>
                                </li>
                            <?php }
                        }
                        ?>


                </ul>
            </div>
            <?php $akczii = get_sub_field( 'akczii' ); ?>
            <?php if ( $akczii ) : ?>
            <div class="swiper specialOffers__wrapper">
                <div class="swiper-wrapper">
                    <?php
                    $akczii = get_sub_field('akczii');
                    $taxonomies = ['akcii_category', 'tour_category']; // Добавляйте сюда свои таксономии

                    if ($akczii) :
                        foreach ($akczii as $post_id) :
                            $added_terms = []; // Для предотвращения дублирования терминов для одного поста

                            foreach ($taxonomies as $taxonomy) {
                                $terms = get_the_terms($post_id, $taxonomy);

                                if (!empty($terms) && !is_wp_error($terms)) {
                                    foreach ($terms as $term) {
                                        // Уникальный ключ по tax+term_id, чтобы исключить дубликаты в случае совпадений
                                        $unique_key = $taxonomy . '_' . $term->term_id;
                                        if (isset($added_terms[$unique_key])) {
                                            continue;
                                        }
                                        $added_terms[$unique_key] = true;

                                        $category = esc_html($term->name);
                                        ?>
                                        <div data-category="<?php echo $category; ?>" class="swiper-slide specialOffers__item swiper-slide-original specialOffers__item--theme_3">
                                            <div class="specialOffers__photo">
                                                <img src="<?php echo get_the_post_thumbnail_url($post_id); ?>" alt="<?php echo esc_attr(get_the_title($post_id)); ?>">
                                            </div>
                                            <div class="specialOffers__content">
                                                <h3><?php echo get_the_title($post_id); ?></h3>
                                                <span class="category">Категория: <?php echo $category; ?></span>
                                                <?php /* пример опционального поля
                                                if (get_field('akcii_lokacziya', $post_id)) : ?>
                                                    <span class="specialOffers__item--location">
                                                        <i class="fa-thin fa-location-dot"></i> <?php the_field('akcii_lokacziya', $post_id); ?>
                                                    </span>
                                                <?php endif;
                                                */ ?>
                                                <a href="<?php echo get_permalink($post_id); ?>">Подробнее</a>
                                            </div>
                                        </div>
                                        <?php
                                    }
                                }
                            }
                        endforeach;
                    endif;
                    ?>
                </div>
            </div>
            <?php endif; ?>
            <div class="specialOffers__footer">
                <a href="/akcii/" class="btn btn--blue">Все акции</a>
            </div>
        </div>
        <?php endwhile; ?>
    <?php endif; ?>
</section>