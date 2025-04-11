<?php
/**
 * Block template file: E:\Program Files (x86)\Local_Sites\baden-sysert\app\public/wp-content/themes/baden/template-parts/blocks/acf-readMoreHomes.php
 *
 * Read More Homes Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'read-more-homes-' . $block['id'];
if ( ! empty($block['anchor'] ) ) {
    $id = $block['anchor'];
}
?>

<section id="<?php echo esc_attr( $id ); ?>" class="readMoreHomes">
	<?php if ( have_rows( 'block_podrobnee_o_domikah' ) ) : ?>
		<?php while ( have_rows( 'block_podrobnee_o_domikah' ) ) : the_row(); ?>
        <div class="titleBlock">
            <h2><?php the_sub_field( 'zagolovok' ); ?></h2>
        </div>
        <div class="titleWrapper">
            <p><?php the_sub_field( 'opisanie' ); ?></p>
        </div>
        <div class="readMoreHomes__wrapper">
            <div class="container">
                <div class="readMoreHomes__list">
                    <?php the_sub_field( 'stolbecz_1' ); ?>
                </div>
                <div class="readMoreHomes__list">
                    <?php the_sub_field( 'stolbecz_2' ); ?>
                </div>
            </div>
        </div>
        <div class="readMoreHomes__footer">
            <button class="btn btn--blue">Забронировать</button>
        </div>
		<?php endwhile; ?>
	<?php endif; ?>
</section>