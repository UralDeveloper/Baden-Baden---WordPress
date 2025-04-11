<div class="accommodation__item">
    <div class="accommodation__img">
        <?php if ( has_post_thumbnail() ) : ?>
            <img src="<?php echo get_the_post_thumbnail_url( get_the_ID(), 'thumbnail' ); ?>" alt="<?php the_title(); ?>">
        <?php endif; ?>
        <?php if ( get_field( 'price' ) ) : ?>
            <p class="price">от <?php echo esc_html( get_field( 'price' ) ); ?> ₽ / сутки</p>
        <?php endif; ?>
    </div>
    <div class="accommodation__text">
        <h4><a href="<?php the_permalink(); ?>"><?php echo get_post_(); ?></a></h4>
        <?php if ( get_field( 'opisanie' ) ) : ?>
            <p><?php echo esc_html( get_field( 'opisanie' ) ); ?></p>
        <?php endif; ?>
        <a href="<?php the_permalink(); ?>" class="accommodation__button">Подробнее</a>
    </div>
</div>
