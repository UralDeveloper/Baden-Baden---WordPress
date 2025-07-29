<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Baden_Baden
 */

get_header();
?>
<section class="firstScreen_singlePage">
    <div class="firstScreen_singlePage__bg">
		<picture>
			<?php if ( have_rows( 'dopolnitelnye_foto' ) ) : ?>
				<?php while ( have_rows( 'dopolnitelnye_foto' ) ) : the_row(); ?>
					<?php $dlya_telefona = get_sub_field( 'dlya_telefona' ); ?>
					<?php if ( $dlya_telefona ) : ?>
						<source media="(max-width: 767px)" srcset="<?php echo esc_url( $dlya_telefona['url'] ); ?>" />
					<?php endif; ?>
					
					<?php $dlya_plansheta = get_sub_field( 'dlya_plansheta' ); ?>
					<?php if ( $dlya_plansheta ) : ?>
						<source media="(min-width: 768px) and (max-width: 1024px)" srcset="<?php echo esc_url( $dlya_plansheta['url'] ); ?>" />
					<?php endif; ?>
				<?php endwhile; ?>
			<?php endif; ?>
			<img src="<?php the_post_thumbnail_url(); ?>" title="<?php the_title(); ?>" alt="<?php the_title(); ?>">
		</picture>
    </div>
    <div class="firstScreen_singlePage__content container">
        <div class="firstScreen_singlePage__title">
            <h1><?php the_title(); ?></h1>
        </div>
    </div>
</section>

<?php if (get_post_status( get_the_ID() ) == 'draft') : ?>
	<div class="post_draft">
		<div class="container">
			<div class="post_draft--wrapper">
				<div class="post_draft--text">
					<?php $post_deadline_zapis_s_fotootchetom = get_field( 'post_deadline_zapis_s_fotootchetom' ); ?>
					<?php if ( $post_deadline_zapis_s_fotootchetom ) : ?>
						<p>Данная акция завершилась, вы можете ознакомиться с другими акциями или посмотреть фотоотчет</p>
					<?php else : ?>
						<p>Данная акция завершилась, вы можете ознакомиться с другими акциями</p>
					<?php endif; ?>
				</div>
				<div class="post_draft--btn">
					<a href="<?php echo home_url( '/akcii/' )?>" class="cookies__btn">Другие акции</a>
					<?php $post_deadline_zapis_s_fotootchetom = get_field( 'post_deadline_zapis_s_fotootchetom' ); ?>
					<?php if ( $post_deadline_zapis_s_fotootchetom ) : ?>
						<?php foreach ( $post_deadline_zapis_s_fotootchetom as $post_ids ) : ?>
							<a href="<?php echo get_permalink( $post_ids ); ?>" class="cookies__btn">Фотоотчет</a>
						<?php endforeach; ?>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</div>
	<style>
		.firstScreen_singlePage:has(~ .post_draft) {
			filter: grayscale(1);
		}
		.post_draft--wrapper {
			padding: 32px;
			-webkit-box-shadow: 0 8px 32px 0 #27294014;
			box-shadow: 0 8px 32px 0 #27294014;
			background-color: #fff;
			border-radius: 32px;
			display: -webkit-box;
			display: -ms-flexbox;
			display: flex;
			-webkit-box-orient: horizontal;
			-webkit-box-direction: normal;
			-ms-flex-direction: row;
			flex-direction: row;
			-webkit-box-align: center;
			-ms-flex-align: center;
			align-items: center;
			-webkit-box-pack: justify;
			-ms-flex-pack: justify;
			justify-content: space-between;
			max-width: 720px;
			margin: 0 auto;
			@media screen and (max-width: 767px) {
				flex-direction: column;
			}
		}
		.post_draft--text {
			font-size: 18px;
			line-height: 22px;
			max-width: 540px;
			font-weight: 500;
			max-width: 460px;
			p {
				margin-bottom: 0;
			}
		}
		.post_draft--btn {
			display: -webkit-box;
			display: -ms-flexbox;
			display: flex;
			-webkit-box-orient: horizontal;
			-webkit-box-direction: normal;
			-ms-flex-direction: column;
			flex-direction: column;
			-webkit-box-align: center;
			-ms-flex-align: center;
			align-items: center;
			-webkit-box-pack: justify;
			-ms-flex-pack: justify;
			justify-content: space-between;
			gap: 12px;
			.cookies__btn {
				width: 100%;
				text-align: center;
			}
			.cookies__btn:hover {
				color: #fff;
			}
		}
	</style>
<?php endif; ?>

<section id="travelline" class="container" data-travelLine="<?php the_field( 'travelline_id', 'option' ); ?>">
	<div class="grid">
		<div class="travel-script">
			<!-- start TL Search form script -->
			<div id="block-search">
				<div id="tl-search-form" class="tl-container">
				</div>
			</div>
		</div>
	</div>
</section>


<main class="singleArticle container">
    <article>
        <div class="article-meta">
            <div class="article-date">
                <img src="<?php the_badden_assets('img', 'calendar.svg')?>" alt="Дата публикации" title="Дата публикации">
                <span><?php echo get_the_date(); ?></span>
            </div>
            <div class="article-category">
                <img src="<?php the_badden_assets('img', 'mark.svg')?>" alt="Категория публикации"  title="Категория публикации">
				<?php
					// Указываем нужные таксономии вручную (если пусто, будут выведены все таксономии)
					$custom_taxonomies = [];
					if ( empty( $custom_taxonomies ) ) {
						$custom_taxonomies = get_taxonomies( [ 'public' => true ], 'names' );
					}
					$post_id = get_the_ID();

					if ( $post_id ) {
						foreach ( $custom_taxonomies as $taxonomy ) {
							// Получаем термины (категории) текущей записи для указанной таксономии
							$terms = get_the_terms( $post_id, $taxonomy );

							if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) {
								foreach ( $terms as $term ) {
									echo '<span>' . esc_html( $term->name ) . '</span>';
								}
							}
						}
					}
				?>
            </div>
        </div>
        <div class="article-content">
			<?php the_content(); ?>

			<?php
			$current_term_ids = wp_get_object_terms(get_the_ID(), 'akcii_category', ['fields' => 'ids']);

			// Формирование аргументов для выборки случайных акций из той же категории
			$args = [
				'post_type'      => 'akcii',
				'posts_per_page' => 40,
				'orderby'        => 'rand',
				'post__not_in'   => [get_the_ID()],
			];

			$query = new WP_Query($args);

			if ($query->have_posts()) : ?>
				<section class="specialOffers">
					<div class="titleBlock">
						<h2>Другие акции</h2>
					</div>
					<div class="swiper specialOffers__wrapper-akcii">
						<div class="swiper-wrapper">
							<?php while ($query->have_posts()) : $query->the_post(); ?>
								<div class="swiper-slide specialOffers__item swiper-slide-original specialOffers__item--theme_3">
									<div class="specialOffers__photo">
										<?php the_post_thumbnail('full'); ?>
									</div>
									<div class="specialOffers__content">
										<p class="specialOffers__content--title"><?php the_title(); ?></p>
										<span class="category">
											<?php
												// Извлекаем название категории конкретной таксономии
												$terms = get_the_terms(get_the_ID(), 'akcii_category');
												if (!empty($terms) && !is_wp_error($terms)):
													echo esc_html($terms[0]->name); // Первая категория из нужной таксономии
												else:
													echo 'Без категории';
												endif;
											?>
										</span>
										<a href="<?php the_permalink(); ?>" class="btn btn-primary">Подробнее</a>
									</div>
								</div>
							<?php endwhile; ?>
						</div>
						<div class="swiper-nav">
							<!-- Добавляем кнопки навигации -->
							<div class="swiper-button-next">
								<svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" width="512" height="512" x="0" y="0" viewBox="0 0 492.004 492.004" style="enable-background:new 0 0 512 512" xml:space="preserve" class=""><g><path d="M382.678 226.804 163.73 7.86C158.666 2.792 151.906 0 144.698 0s-13.968 2.792-19.032 7.86l-16.124 16.12c-10.492 10.504-10.492 27.576 0 38.064L293.398 245.9l-184.06 184.06c-5.064 5.068-7.86 11.824-7.86 19.028 0 7.212 2.796 13.968 7.86 19.04l16.124 16.116c5.068 5.068 11.824 7.86 19.032 7.86s13.968-2.792 19.032-7.86L382.678 265c5.076-5.084 7.864-11.872 7.848-19.088.016-7.244-2.772-14.028-7.848-19.108z" fill="#ffffff" opacity="1" data-original="#000000" class=""></path></g></svg>
							</div>
							<div class="swiper-button-prev">
								<svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" width="512" height="512" x="0" y="0" viewBox="0 0 492 492" style="enable-background:new 0 0 512 512" xml:space="preserve" class=""><g><path d="M198.608 246.104 382.664 62.04c5.068-5.056 7.856-11.816 7.856-19.024 0-7.212-2.788-13.968-7.856-19.032l-16.128-16.12C361.476 2.792 354.712 0 347.504 0s-13.964 2.792-19.028 7.864L109.328 227.008c-5.084 5.08-7.868 11.868-7.848 19.084-.02 7.248 2.76 14.028 7.848 19.112l218.944 218.932c5.064 5.072 11.82 7.864 19.032 7.864 7.208 0 13.964-2.792 19.032-7.864l16.124-16.12c10.492-10.492 10.492-27.572 0-38.06L198.608 246.104z" fill="#ffffff" opacity="1" data-original="#000000" class=""></path></g></svg>
							</div>
						</div>
					</div>
				</section>
			<?php endif; ?>
			<?php wp_reset_postdata(); ?>

        </div>
    </article>
    <aside>
		<?php
		$post_type = get_post_type();
		$excluded_types = ['prozhivanie']; // сюда можно добавлять новые типы

		if (!in_array($post_type, $excluded_types)) {
			get_sidebar('mobile');
		}
			get_sidebar();
		?>
    </aside>
</main>
<?php
get_footer();