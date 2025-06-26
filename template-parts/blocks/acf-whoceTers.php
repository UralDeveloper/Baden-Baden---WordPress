<?php

/**
 * Block template file: /baden/template-parts/blocks/acf-whoceTers.php
 *
 * Whoceters Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create id attribute allowing for custom "anchor" value.
$id = 'whoceters-' . $block['id'];
if (! empty($block['anchor'])) {
    $id = $block['anchor'];
}
?>

<section class="whoceTers" id="whoceTers_<?php echo esc_attr($id); ?>">
    <?php if (have_rows('block_whoceters')) : ?>
        <?php while (have_rows('block_whoceters')) : the_row(); ?>
            <div class="container">
                <div class="titleBlock">
                    <h2><?php the_sub_field('zagolovok'); ?></h2>
                </div>
                <?php $count_slides = get_sub_field('kol-vo_elementov_na_ekran');
                if ($count_slides == "three") {
                    $photo_size = 'photoSize-1x1';
                } else {
                    $photo_size = "";
                }
                ?>
                <?php $zapisi = get_sub_field('zapisi'); ?>
                <?php if ($zapisi) : ?>
                    <div class="whoceTers__wrapper">
                        <div class="titleWrapper">
                            <?php if (count($zapisi) > 1) : ?>
                                <ul class="nav nav-pills" id="pills-tab" role="tablist">
                                    <?php foreach ($zapisi as $key => $post_ids) : ?>
                                        <?php if ($key == 0) : $status = "active";
                                        else: $status = "";
                                        endif; ?>
                                        <li class="nav-item" role="presentation">
                                            <a class="nav-tab btn--link <?php echo $status ?>"
                                                data-bs-toggle="pill"
                                                href="#pills-<?php echo get_post_field('post_name', $post_ids); ?>"
                                                role="tab"
                                                aria-controls="pills-<?php echo get_post_field('post_name', $post_ids); ?>"
                                                aria-selected="true"><?php echo get_the_title($post_ids); ?></a>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            <?php endif; ?>
                            <div class="tab-content" id="pills-tabContent">
                                <?php foreach ($zapisi as $key => $post_ids) : ?>
                                    <?php if ($key == 0) : $status = "show active";
                                    else: $status = "";
                                    endif; ?>
                                    <div class="tab-pane fade <?php echo $status ?>"
                                        id="pills-<?php echo get_post_field('post_name', $post_ids); ?>"
                                        role="tabpanel"
                                        aria-labelledby="pills-<?php echo get_post_field('post_name', $post_ids); ?>-tab">
                                        <?php if (have_rows('whoceTers_nastrojki', $post_ids)) : ?>
                                            <?php while (have_rows('whoceTers_nastrojki', $post_ids)) : the_row(); ?>
                                                <p><?php the_sub_field('opisanie'); ?></p>
                                            <?php endwhile; ?>
                                        <?php endif; ?>

                                        <?php if (have_rows('whoceTers_nastrojki', $post_ids)) : ?>
                                            <?php while (have_rows('whoceTers_nastrojki', $post_ids)) : the_row(); ?>
                                                <?php if (have_rows('post_knopka')) : ?>
                                                    <?php while (have_rows('post_knopka')) : the_row();
                                                        $dejstvie_knopki_selected_option = get_sub_field('dejstvie_knopki');
                                                        if (isset($dejstvie_knopki_selected_option['value'])) {
                                                            switch ($dejstvie_knopki_selected_option['value']) {
                                                            case 'post':
                                                                if (get_sub_field('yakor')) :
                                                                    $yakor = "#" . get_sub_field('yakor');
                                                                else:
                                                                    $yakor = "";
                                                                endif;
                                                                $zapis = get_sub_field('zapis');
                                                                if ($zapis) : ?>
                                                                    <a style="display: block; margin: 20px auto 0; width: fit-content;" class="btn btn--blue"
                                                                        href="<?php the_permalink($zapis); echo $yakor; ?>">
                                                                        <?php the_sub_field('zagolovok_knopki'); ?>
                                                                    </a>
                                                                <?php endif;
                                                                break;
                                                            case 'form':
                                                                ?>
                                                                <button style="display: block; margin: 20px auto 0; width: fit-content;" 
                                                                    class="btn btn--blue" data-bs-toggle="modal"
                                                                    data-bs-target="#bitrix__<?php echo $post_ids ?>">
                                                                    <?php the_sub_field('zagolovok_knopki'); ?>
                                                                </button>
                                                                <div class="modal fade" id="bitrix__<?php echo $post_ids ?>" tabindex="-1" aria-labelledby="bitrix__<?php echo $post_ids; ?>" aria-hidden="true">
                                                                    <div class="modal-dialog modal-dialog-centered">
                                                                        <div class="modal-content">
                                                                            <div class="modal-body">
                                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                                <?php echo get_sub_field( 'kod_knopki' ); ?>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <?php
                                                                break;
                                                            case 'hide':
                                                                break;
                                                            default:
                                                                if (get_field('block_whoceters_yakor')) :
                                                                    $yakor = "#" . get_field('block_whoceters_yakor');
                                                                else:
                                                                    $yakor = "";
                                                                endif;
                                                                if (get_field('block_whoceters_tip_knopki') == 1) :
                                                                    //echo 'Вкл.';
                                                                    if (have_rows('block_whoceters_knopka')) :
                                                                        while (have_rows('block_whoceters_knopka')) : the_row();
                                                                            $ssylka = get_sub_field('ssylka');
                                                                            if ($ssylka) : ?>
                                                                                <?php $post = $ssylka; ?>
                                                                                <?php setup_postdata($post); ?>
                                                                                <a style="display: block; margin: 20px auto 0; width: fit-content;" class="btn btn--blue"
                                                                                    href="<?php the_permalink($post->ID); echo $yakor; ?>">
                                                                                    <?php the_sub_field('tekst_knopki'); ?>
                                                                                </a>
                                                                    <?php wp_reset_postdata();
                                                                            endif;
                                                                        endwhile;
                                                                    endif; ?>
                                                                <?php else :?>
                                                                    <div id="<?php echo esc_attr($id); ?>" class="btn__bitrixForm">
                                                                        <?php if (have_rows('block_whoceters_bitrix')) : ?>
                                                                            <?php while (have_rows('block_whoceters_bitrix')) : the_row(); ?>
                                                                                <button class="btn btn--blue" data-bs-toggle="modal" data-bs-target="#bitrix__<?php echo $id; ?>">
                                                                                    <?php the_sub_field('tekst_knopki'); ?>
                                                                                </button>

                                                                                <div class="modal fade" id="bitrix__<?php echo $id; ?>" tabindex="-1" aria-labelledby="bitrix__<?php echo $id; ?>" aria-hidden="true">
                                                                                    <div class="modal-dialog modal-dialog-centered">
                                                                                        <div class="modal-content">
                                                                                            <div class="modal-body">
                                                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                                                <?php echo get_sub_field('kod_knopki'); ?>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            <?php endwhile; ?>
                                                                        <?php endif; ?>
                                                                    </div>
                                                                <?php endif;
                                                                break;
                                                            }
                                                        }
                                                    endwhile; ?>
                                                <?php endif; ?>
                                            <?php endwhile; ?>
                                        <?php endif; ?>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                            <?php
                            /*
                if (get_sub_field( 'yakor' )) : 
                    $yakor = "#" . get_sub_field( 'yakor' ); 
                else:
                    $yakor = ""; 
                endif;

                if ( have_rows( 'knopka' ) ) :
                    while ( have_rows( 'knopka' ) ) : the_row();
                        $ssylka = get_sub_field( 'ssylka' );
                        if ( $ssylka ) : ?>
                            <?php $post = $ssylka; ?>
                            <?php setup_postdata( $post ); ?> 
                            <a class="btn btn--blue" href="<?php the_permalink( $post->ID ); echo $yakor; ?>"><?php the_sub_field( 'tekst_knopki' ); ?></a>
                            <?php wp_reset_postdata();
                        endif;
                    endwhile;
                endif;*/ ?>
                        </div>

                        <div class="whoceTers__content tab-content" id="pills-<?php echo esc_attr($id); ?>-slides">
                            <?php foreach ($zapisi as $key => $post_ids) : ?>
                                <?php if ($key == 0) : $status = "show active";
                                else: $status = "";
                                endif; ?>
                                <div class="tab-pane fade <?php echo $status ?>"
                                    id="pills-<?php echo get_post_field('post_name', $post_ids); ?>-slide" role="tabpanel">
                                    <?php if (have_rows('whoceTers_nastrojki', $post_ids)) : ?>
                                        <?php while (have_rows('whoceTers_nastrojki', $post_ids)) : the_row(); ?>
                                            <?php $galereya_images = get_sub_field('galereya'); ?>
                                            <?php if ($galereya_images) : ?>
                                                <div class="swiper whoceTers-slider">
                                                    <div class="swiper-wrapper">
                                                        <?php foreach ($galereya_images as $galereya_image): ?>
                                                            <div class="swiper-slide <?php echo $photo_size; ?>">
                                                                <img src="<?php echo esc_url($galereya_image['url']); ?>"
                                                                    alt="<?php echo esc_attr($galereya_image['alt']); ?>">
                                                            </div>
                                                        <?php endforeach; ?>
                                                    </div>
                                                </div>
                                            <?php endif; ?>
                                        <?php endwhile; ?>
                                    <?php endif; ?>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        <?php endwhile; ?>
    <?php endif; ?>
</section>