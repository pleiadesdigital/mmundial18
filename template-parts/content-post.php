<!-- <div class="post-item">
  <h2 class="headline headline--medium headline--post-title"><a href="<?php //the_permalink(); ?>"><?php //the_title(); ?></a></h2>
  <div class="metabox">
    <p>Posted by <?php //the_author_posts_link(); ?> on <?php //the_time('M j, Y'); ?> in <?php //echo get_the_category_list('|'); ?></p>
  </div>
  <div class="generic-content">
    <?php //the_excerpt(); ?>
    <p><a class="btn btn--blue" href="<?php //the_permalink(); ?>">Continue reading &raquo;</a></p>
  </div>
</div> -->

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

  <div class="index-box">
    <header class="entry-header">
      <!-- FEATURE IMAGE -->
      <?php if (has_post_thumbnail()) : ?>
      <div class="single-post-thumbnail clear">
        <a href="<?php the_permalink(); ?>" title="<?php echo __('Click', 'mmundial18') . get_the_title(); ?>" rel="bookmark"><?php echo the_post_thumbnail(); ?></a>
      </div>
      <?php endif; ?>
      <!-- THE TITLE -->
      <?php the_title(sprintf('<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url(get_permalink())), '</a></h2>'); ?>
      <!-- METADATA -->
      <?php if ('post' === get_post_type()) : ?>
        <div class="entry-meta">
          <p>Posted by <?php the_author_posts_link(); ?> on <?php the_time('M j, Y'); ?> in <?php echo get_the_category_list('|'); ?></p>
        </div>
      <?php endif; ?>
    </header>

    <div class="entry-summary">
      <?php the_excerpt(); ?>
    </div>

    <footer class="entry-footer continue-reading">
      <div class="continue-reading">
        <a href="<?php echo get_permalink(); ?>" title="<?php echo __('Continue Reading ', 'mmundial18') . get_the_title(); ?>" rel="bookmark">Continue reading...<i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </footer>

  </div>


</article>
