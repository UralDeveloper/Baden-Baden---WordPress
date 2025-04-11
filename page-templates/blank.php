<?php
/**
 * Template Name: Пустой шаблон страницы
 */

get_header();?>
<section class="firstScreen_singlePage">
    <div class="firstScreen_singlePage__bg">
        <img src="<?php the_post_thumbnail_url(); ?>" alt="">
    </div>
    <div class="firstScreen_singlePage__content container">
        <div class="firstScreen_singlePage__title">
            <h1><?php the_title(); ?></h1>
        </div>
    </div>
</section>
<?php the_content(); ?>

<?php get_footer();?>