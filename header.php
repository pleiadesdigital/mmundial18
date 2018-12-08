<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

  <header class="site-header">
    <div class="container">
    <?php if (is_front_page()) : ?>
      <!-- <a href="<?php //echo site_url(); ?>"><img class="site_logo" src="<?php //echo get_theme_file_uri('/images/logo_mm.png'); ?>"></a> -->
    <?php else : ?>
      <h1 class="school-logo-text shadow float-left"><a href="<?php echo site_url(); ?>"><strong>La Mariposa Mundial</strong></a></h1>
    <?php endif; ?>
      <!-- BEFORE no-JS SUPPORT -->
      <!-- <span class="js-search-trigger site-header__search-trigger"><i class="fa fa-search" aria-hidden="true"></i></span> -->
      <a href="<?php echo esc_url(site_url('/search')); ?>" class="js-search-trigger site-header__search-trigger"><i class="fa fa-search" aria-hidden="true"></i></a>
      <i class="site-header__menu-trigger fa fa-bars" aria-hidden="true"></i>

      <div class="site-header__menu group">

        <!-- MAIN NAVIGATION -->
        <nav class="main-navigation">
          <ul>
            <li <?php if (is_page('about-us') || wp_get_post_parent_id(0) == 39) { echo 'class="current-menu-item"'; } ?>><a href="<?php echo site_url('/about'); ?>">About Us</a></li>

            <li <?php if (get_post_type() == 'magazine') { echo 'class="current-menu-item"'; } ?>><a href="<?php echo get_post_type_archive_link('magazine'); ?>">Magazines</a></li>

            <li <?php if (is_page('books') || get_post_type() == 'book') { echo 'class="current-menu-item"'; } ?>><a href="<?php echo site_url('/books'); ?>">Books</a></li>

            <li <?php if (get_post_type() == 'archive') { echo 'class="current-menu-item"'; } ?>><a href="<?php echo get_post_type_archive_link('archive'); ?>">Archives</a></li>

            <li <?php if (get_post_type() == 'post') { echo 'class="current-menu-item"'; } ?>><a href="<?php echo site_url('/blog'); ?>">Blog</a></li>
          </ul>
          <?php //wp_nav_menu(array('theme_location'  => 'header-menu')); ?>
        </nav>

        <!-- LOGIN LOGOUT BUTTONS -->
        <div class="site-header__util">
          <?php if (is_user_logged_in()) : ?>
            <a href="<?php echo wp_logout_url(); ?>" class="btn btn--small btn--beigeNew float-left btn--with-photo">
              <span class="site-header__avatar"><?php echo get_avatar(get_current_user_id(), 60); ?></span>
              <span class="btn__text">Log Out</span>
            </a>
          <?php else : ?>
            <a href="<?php echo wp_login_url(); ?>" class="btn btn--small btn--petrol float-left push-right">Login</a>

            <a href="<?php echo wp_registration_url(); ?>" class="btn btn--small  btn--beigeNew float-left">Sign Up</a>
          <?php endif; ?>
          <a href="<?php echo esc_url(site_url('/search')); ?>" class="search-trigger js-search-trigger"><i class="fa fa-search" aria-hidden="true"></i></a>
        </div>
      </div>
    </div>

  </header>
