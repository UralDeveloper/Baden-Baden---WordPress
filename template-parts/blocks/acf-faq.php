<?php
/**
 * Block template file: E:\Program Files (x86)\Local_Sites\baden-sysert\app\public/wp-content/themes/baden/template-parts/blocks/acf-faq.php
 *
 * Faq Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'faq-' . $block['id'];
if ( ! empty($block['anchor'] ) ) {
    $id = $block['anchor'];
}
?>

<?php if ( have_rows( 'block_voprosy_i_otvety' ) ) : ?>
<section id="<?php echo esc_attr( $id ); ?>" class="faq">
    <?php while ( have_rows( 'block_voprosy_i_otvety' ) ) : the_row(); ?>
    <div class="container">
        <div class="titleBlock">
            <h2><?php the_sub_field( 'zagolovok' ); ?></h2>
        </div>
        <?php $zapisi = get_sub_field( 'zapisi' ); ?>
        <?php if ( $zapisi ) : ?>
        <div class="accordion accordion-flush" id="accordionFlushExample">
            <?php foreach ( $zapisi as $post_ids ) : ?>
            <div class="accordion-item">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#flush-collapse_<?php echo $post_ids; ?>" aria-expanded="false" aria-controls="flush-collapseOne">
                        <?php echo get_the_title( $post_ids ); ?>
                    </button>
                </h2>
                <div id="flush-collapse_<?php echo $post_ids; ?>" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                    <div class="accordion-body">
                        <?php echo get_the_content('', false, $post_ids); ?>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>
    </div>
    <?php endwhile; ?>
</section>
<?php endif; ?>