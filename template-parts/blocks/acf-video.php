<?php
/**
 * Block template file: /baden/template-parts/blocks/acf-video.php
 *
 * Block Video Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'block-video-' . $block['id'];
if ( ! empty($block['anchor'] ) ) {
    $id = $block['anchor'];
}
?>
<?php if ( have_rows( 'block_video' ) ): ?>
    <section id="<?php echo esc_attr( $id ); ?>" class="videoBlock">
        <div class="container">
            <div class="videoBlock__wrapper">
                <div class="videoBlock__video">
                    <?php while ( have_rows( 'block_video' ) ) : the_row(); ?>
                        <?php if ( get_row_layout() == 'video_frame' ) : ?>
                            <?php echo get_sub_field( 'kod_vstavki' ); ?>
                        <?php endif; ?>
                    <?php endwhile; ?>
                    </div>
                </div>
            </div>
        </section>
<?php endif;?>