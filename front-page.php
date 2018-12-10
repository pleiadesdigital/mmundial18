<?php get_header(); ?>

  <div class="page-banner">
  	<div class="page-banner__bg-image" style="background-image: url(<?php echo get_theme_file_uri('/images/mm-home-cover.jpg'); ?>);"></div>
    <div class="page-banner__content container t-center c-white">
      <h1 class="headline headline--large main--title">La Mariposa Mundial</h1>
      <!-- <h2 class="headline headline--medium">Revista de Literatura</h2> -->
      <div class="logo-main">
        <div class="logo-main__background">
          <a href="<?php site_url(); ?>"><img src="<?php echo get_theme_file_uri('/images/mm-logo-transp-title.png'); ?>" class="logo-main__image"></a>
        </div>
      </div>
      <h3 class="headline headline--smaller">ediciones | publicaciones | archivo</h3>
      <a href="<?php echo get_post_type_archive_link('magazine'); ?>" class="btn btn--small btn--beigeNew btn--less-padding"><img src="<?php echo get_theme_file_uri('/images/bigote-churata.png'); ?>" width="150"></a>
    </div>
  </div>

  <div class="full-width-split group">
    <!-- LATEST PUBLICATIONS -->
    <div class="full-width-split__one">
      <div class="full-width-split__inner">
        <h2 class="headline headline--small-plus t-center">Latest Publications</h2>
        <?php
          $today = date('Ymd');
          $args = array(
            'posts_per_page'      => 2,
            'post_type'           => array('magazine', 'book')
          );
          $homepageEvents = new WP_Query($args);
        ?>
        <?php while ($homepageEvents->have_posts()) : $homepageEvents->the_post(); ?>
          <?php get_template_part('template-parts/content', 'event'); ?>
        <?php endwhile; wp_reset_postdata(); ?>

        <p class="t-center no-margin"><a href="<?php echo get_post_type_archive_link('event'); ?>" class="btn btn--beigeNew">View All Publications</a></p>

      </div>
    </div>

    <!-- LATEST POSTS -->
    <div class="full-width-split__two">
      <div class="full-width-split__inner">
        <h2 class="headline headline--small-plus t-center">Latest Posts</h2>
        <?php
          $args = array(
            'posts_per_page'      => 2,
            'post_type'           => 'post'
          );
          $homepage_posts = new WP_Query($args);

        ?>
        <?php while($homepage_posts->have_posts()) : $homepage_posts->the_post(); ?>

        <div class="event-summary">
          <a class="event-summary__date event-summary__date--petrol t-center" href="<?php the_permalink(); ?>">
            <span class="event-summary__month"><?php the_time('M'); ?></span>
            <span class="event-summary__day"><?php the_time('d'); ?></span>
          </a>
          <div class="event-summary__content">
            <h5 class="event-summary__title headline headline--tiny"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
            <p><?php if (has_excerpt()) { echo get_the_excerpt(); } else  { echo wp_trim_words(get_the_content(), 22); } ?><br><a href="<?php the_permalink(); ?>" class="nu gray">Read more</a></p>
          </div>
        </div>
        <?php endwhile; wp_reset_postdata(); ?>

        <p class="t-center no-margin"><a href="<?php echo site_url('/blog'); ?>" class="btn btn--petrol">View All Blog Posts</a></p>
      </div>
    </div>
  </div>

<!-- HERO SLIDER -->

  <div class="hero-slider">
  <div class="hero-slider__slide" style="background-image: url(<?php echo get_theme_file_uri('/images/mapa-magazines-slider.jpg'); ?>);">
    <div class="hero-slider__interior container">
      <div class="hero-slider__overlay">
        <h2 class="headline headline--medium t-center">Magazines / Revistas</h2>
        <p class="t-center">[Última Sude]</p>
        <p class="t-center no-margin"><a href="<?php echo get_post_type_archive_link('magazine'); ?>" class="btn btn--beigeNew">Learn more</a></p>
      </div>
    </div>
  </div>
  <div class="hero-slider__slide" style="background-image: url(<?php echo get_theme_file_uri('/images/books-slider.jpg'); ?>)">
    <div class="hero-slider__interior container">
      <div class="hero-slider__overlay">
        <h2 class="headline headline--medium t-center">Books / Libros</h2>
        <p class="t-center">muchas lenguaxes ajuntando</p>
        <p class="t-center no-margin"><a href="<?php echo get_post_type_archive_link('book'); ?>" class="btn btn--beigeNew">Learn more</a></p>
      </div>
    </div>
  </div>
  <div class="hero-slider__slide" style="background-image: url(<?php echo get_theme_file_uri('/images/archives-slider.jpg'); ?>);">
    <div class="hero-slider__interior container">
      <div class="hero-slider__overlay">
        <h2 class="headline headline--medium t-center">Archives / Archivo</h2>
        <p class="t-center">muchas lenguaxes ajuntando</p>
        <p class="t-center no-margin"><a href="<?php echo get_post_type_archive_link('archive'); ?>" class="btn btn--beigeNew">Learn more</a></p>
      </div>
    </div>
  </div>
</div>





<?php get_footer(); ?>
