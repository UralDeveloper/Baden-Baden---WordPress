<?php

/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Baden_Baden
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<meta name="yandex-verification" content="29e3004ba0159609" />
	<?php wp_head(); ?>
</head>

<style>
	.btn {
		font-size: 16px;
	}
</style>

<body <?php body_class(); ?>>
	<?php wp_body_open(); ?>
	<section class="header">
		<div class="container header__container">
			<div class="header__logo">
				<a href="<?php echo home_url('/'); ?>">
					<?php if ( get_field( 'logotip_v_shapke', 'option' ) ) : ?>
						<img style="width: 167px; height: 46px; object-fit: contain; object-position: left center;" src="<?php the_field( 'logotip_v_shapke', 'option' ); ?>" alt="Баден баден"/>
					<?php else : ?>
						<img src="<?php the_badden_assets('img', 'logo-main.svg'); ?>" alt="Баден баден">
					<?php endif; ?>
				</a>
			</div>
			<div class="header__menu navbar">
				<?php
				wp_nav_menu([
					'theme_location' => 'menu-1', // Указываем место в теме
					'container'      => false, // Без обертки <div>
					'menu_class'     => 'nav', // Класс для <ul>
					'items_wrap'     => '<ul class="%2$s">%3$s</ul>',
					'depth'          => 2, // Глубина вложенности
					'walker'         => new Custom_Walker_Nav_Menu(), // Кастомный Walker
				]);
				?>
			</div>

			<div class="header__social">
				<a href="<?php the_field( 'op_ssylka_na_whatsapp', 'option' ); ?>"><img src="<?php the_badden_assets('img', 'whatsapp.svg'); ?>" alt="Связаться с нами в WhatsApp"></a>
				<a href="<?php the_field( 'op_ssylka_na_vk', 'option' ); ?>"><img src="<?php the_badden_assets('img', 'vk.svg'); ?>" alt="Мы в ВКонтакте"></a>
			</div>
			<div class="header__mobile">
				<?/*
				На всякий случай оставлю здесь
                <button class="header__menu-btn btn-offcanvas-open" type="button"
					data-bs-toggle="offcanvas"
					title="Навигация"
                    data-bs-target="#offcanvasRight"
					aria-controls="offcanvasRight">
                    <i class="fa-sharp fa-solid fa-bars"></i>
                </button>
				*/?>
                <button class="header__menu-btn btn-offcanvas-open" type="button"
					aria-controls="offcanvasRight">
                    <i class="fa-sharp fa-solid fa-bars"></i>
                </button>
                <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight"
					data-bs-scroll="true"
                    aria-labelledby="offcanvasRightLabel">
                    <div class="offcanvas-header">
                        <h5 class="offcanvas-title" id="offcanvasRightLabel">
							<a href="/">
							<?php if ( get_field( 'logotip_mob', 'option' ) ) : ?>
								<img src="<?php the_field( 'logotip_mob', 'option' ); ?>" />
							<?php endif ?>
							</a>
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body">
						<div class="navbar">
						<?php
							wp_nav_menu([
								'theme_location' => 'menu-1', // Указываем место в теме
								'container'      => false, // Без обертки <div>
								'menu_class'     => 'navbar-nav', // Класс для <ul>
								'items_wrap'     => '<ul class="%2$s">%3$s</ul>',
								'depth'          => 2, // Глубина вложенности
								'walker'         => new Custom_Walker_Nav_Menu(), // Кастомный Walker
							]);
						?>
						</div>
                        <ul class="subNav">
                            <li class="nav-item">
                                <a href="https://baden-baden.ru/" class="nav-link" target="_blank">Баден-Баден</a>
                            </li>
                            <li class="nav-item">
                                <a href="https://baden-apart.ru/" class="nav-link" target="_blank">Купить апартамент</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
		</div>
	</section>
	<div id="swup">