<?php
/**
 * Template Name: Home
 */
get_header();?>
<section class="firstScreen">
    <div class="firstScreen__videoBackground">
        <video poster="<?php the_badden_assets('img', 'main-img.jpg')?>" muted autoplay loop>
            <source src="<?php echo bloginfo('template_url')?>/assets/img/video/Optimizirovannyy_vidos.mp4" type="video/mp4">
            <source src="<?php echo bloginfo('template_url')?>/assets/img/video/new_video.webm" type="video/webm">
        </video>
    </div>
    <div class="container firstScreen__container">
        <div class="firstScreen__logo">
            <img src="<?php the_badden_assets('img', 'logotip-main.svg')?>" alt="">
        </div>
        <div class="firstScreen__description">
            <p>Баден-Баден Сысерть — это уникальный термальный курорт, объединяющий в себе «Фабрику отдыха» с
                бассейнами, банями и СПА, и апарт-отелем, а также уютную эко-деревню для комфортного проживания на
                природе</p>
        </div>
    </div>
</section>

<?php the_content(); ?>

<?php get_footer();?>