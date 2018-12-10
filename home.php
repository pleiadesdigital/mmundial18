<?php get_header(); ?>

<?php
  page_banner(array(
    'title'     => 'Welcome to our blog!',
    'subtitle'  => 'Keep up with our latest news',
    'photo' => get_theme_file_uri('images/blog-cover.jpg')
  ));
?>

<div class="container page-section">
  <div class="grid">
    <?php while (have_posts()) : the_post(); ?>
      <div class="grid-item">
        <?php get_template_part('template-parts/content-post', get_post_format()); ?>
      </div>
    <?php endwhile; ?>
  </div>

  <br>
  <center>
    <?php
      echo paginate_links(array(
        'prev_text'     => __('<< Previous'),
        'next_text'     => __('Next >>'),
        'type'          => 'plain'
      ));
    ?>
  </center>
</div>

<?php get_footer(); ?>
