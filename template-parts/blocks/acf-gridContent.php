<?php
/**
 * Block template file: E:\Program Files (x86)\Local_Sites\baden-sysert\app\public/wp-content/themes/baden/template-parts/blocks/acf-gridContent.php
 *
 * Grid Content Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'grid-content-' . $block['id'];
if ( ! empty($block['anchor'] ) ) {
    $id = $block['anchor'];
}
?>


<?php if ( have_rows( 'block_shahmatka' ) ) : ?>
    <section id="<?php echo esc_attr( $id ); ?>" class="gridContent gridContent--chess">
        <?php while ( have_rows( 'block_shahmatka' ) ) : the_row(); ?>
        <div class="gridContent__content">
            <div class="gridContent__content--image">
                <?php $izobrazhenie = get_sub_field( 'izobrazhenie' ); ?>
                <?php if ( $izobrazhenie ) : ?>
                    <img src="<?php echo esc_url( $izobrazhenie['url'] ); ?>" alt="<?php echo esc_attr( $izobrazhenie['alt'] ); ?>" />
                <?php endif; ?>
            </div>
            <div class="gridContent__content--text">
                <div class="titleBlock">
                    <h2><?php the_sub_field( 'zagolovok' ); ?></h2>
                </div>
                <?php the_sub_field( 'kontent' ); ?>
                <?php if ( get_sub_field( 'status_knopki' ) == 1 ) : ?>
                    <button class="btn btn--blue">Забронировать</button>
                <?php endif; ?>
            </div>
        </div>
        <?php endwhile; ?>
    </section>
<?php endif; ?>