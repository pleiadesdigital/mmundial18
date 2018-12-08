<?php get_header(); ?>

<?php
  page_banner(array(
    'title'     => 'Magazines',
    'subtitle'  => 'Large collection of the most amazing literature',
  ));
?>

<div class="container container--narrow page-section">

  <div class="row row--equal-height">
    <?php while(have_posts()) : the_post(); ?>
      <div class="mag mag__box-medium">
        <div class="mag__item">
          <h2 class="headline headline--medium headline--post-title headline--post-title-mag"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
          <div class="metabox metabox--mag">
            <p>Posted by <?php the_author_posts_link(); ?> on <?php the_time('M j, Y'); ?></p>
          </div>
          <div class="generic-content">
            <?php the_excerpt(); ?>
            <p><a class="btn btn--blue btn--mag" href="<?php the_permalink(); ?>">Continue reading &raquo;</a></p>
          </div>
        </div>
      </div>
    <?php endwhile; ?>
  </div><!-- class="row row--equal-height" -->

  <!-- PAGINATION -->
  <?php
    echo paginate_links(array(
      'prev_text'     => __('<< Previo'),
      'next_text'     => __('Siguiente >>'),
      'type'          => 'plain'
    )); ?>

</div>


<?php get_footer(); ?>
