<?php get_header(); ?>

<?php
  page_banner(array(
    'title'     => 'Welcome to our blog!',
    'subtitle'  => 'Keep up with our latest news',
    'photo' => get_theme_file_uri('images/blog-cover.jpg')
  ));
?>

<div class="container container--narrow page-section">
<?php while(have_posts()) : the_post(); ?>
  <div class="post-item">
    <h2 class="headline headline--medium headline--post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
    <div class="metabox">
      <p>Posted by <?php the_author_posts_link(); ?> on <?php the_time('M j, Y'); ?> in <?php echo get_the_category_list('|'); ?></p>
    </div>
    <div class="generic-content">
      <?php the_excerpt(); ?>
      <p><a class="btn btn--blue" href="<?php the_permalink(); ?>">Continue reading &raquo;</a></p>
    </div>
  </div>
<?php endwhile; ?>

  <!-- PAGINATION -->
  <?php
    echo paginate_links(array(
      'prev_text'     => __('<< Previo'),
      'next_text'     => __('Siguiente >>'),
      'type'          => 'plain'
    ));
  ?>

</div>

<?php get_footer(); ?>
