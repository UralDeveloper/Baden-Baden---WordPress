<?php

/**
 * Block template file: E:\Program Files (x86)\Local_Sites\baden-sysert\app\public/wp-content/themes/baden/template-parts/blocks/acf-certificates.php
 *
 * Certificates Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'certificates-' . $block['id'];
if (! empty($block['anchor'])) {
    $id = $block['anchor'];
}
?>

<section id="<?php echo esc_attr($id); ?>" class="certificate">
    <?php if (have_rows('block_sertifikaty')) : ?>
        <?php while (have_rows('block_sertifikaty')) : the_row(); ?>
            <div class="container certificate__container">
                <div class="titleBlock">
                    <h2><?php the_sub_field('zagolovok'); ?></h2>
                </div>
                <div class="titleWrapper">
                    <?php the_sub_field('opisanie'); ?>
                </div>
                <div class="certificate__wrapper">
                    <?php $sertifikaty = get_sub_field('sertifikaty');
                    if ($sertifikaty) : ?>
                        <?php foreach ($sertifikaty as $post) : ?>
                            <div class="certificate__item">
                                <div class="certificate__item--preview">
                                    <div class="certificate__item--image">
                                        <img src="<?php echo get_the_post_thumbnail_url($post->ID); ?>" alt="">
                                    </div>
                                    <div class="certificate__item--meta">
                                        <div class="certificate__item--price"><?php echo get_the_title($post->ID); ?> ₽</div>
                                        <div class="certificate__item--cart">
                                            <button 
                                                data-bs-toggle="modal"
                                                data-bs-target="#modal-<?php echo $post->ID; ?>"
                                                class="btn btn--border-darkBlue border-radius-90"
                                                data-id="<?php echo $post->ID; ?>"
                                            >
                                                <img src="<?php the_badden_assets('img', 'cart.svg'); ?>" alt="Купить сертификат <?php echo get_the_title($post->ID)?>">
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="certificate__item--info">
                                    <div class="certificate__item--subTitle">Подарочный сертификат</div>
                                    <div class="certificate__item--title">Baden-Baden gift card</div>
                                </div>
                            </div>
                            <div class="modal__certificate modal fade" id="modal-<?php echo $post->ID; ?>" class="btn btn--border-darkBlue border-radius-90" data-id="<?php echo $post->ID; ?>" data-bs-toggle="modal" data-bs-target="#modal- tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-body">
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            <div class="modal-preview">
                                                <div class="modal-image">
                                                    <img src="<?php echo get_the_post_thumbnail_url($post->ID); ?>" alt="">
                                                </div>
                                                <div class="modal-price">
                                                    <div class="modal-price--subTitle">Номинал:</div>
                                                    <div class="modal-price--sum"><?php echo get_the_title($post->ID);?> ₽</div>
                                                </div>
                                            </div>
                                            <div class="modal-info">
                                                <div class="modal-description">
                                                    <p>Подарочный сертификат</p>
                                                </div>
                                                <div class="modal-total">
                                                    <span class="modal-total--title">Итого: </span>
                                                    <span class="modal-total--price"><?php echo get_the_title($post->ID);?> ₽</span>
                                                </div>
                                            </div>
                                            <div class="modal-form">
                                                <div class="">
                                                    <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="E-mail для отправки чека">
                                                </div>
                                                <div class="modal-buttons">
                                                    <button class="btn border-radius-90 btn--darkBlue">Оплатить по СБП</button>
                                                    <button class="btn border-radius-90 btn--border-darkBlue">Оплатить картой</button>
                                                </div>
                                                <p>Нажимая на кнопку я согласен на <br><a href="#">обработку персональных данных</a></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                        <?php wp_reset_postdata(); ?>
                    <?php endif; ?>
                </div>
            </div>
        <?php endwhile; ?>
    <?php endif; ?>
</section>