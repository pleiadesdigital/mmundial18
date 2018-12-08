<?php get_header(); ?>

<?php while (have_posts()) : the_post(); ?>

  <?php
    page_banner(array(
      //'title'     => 'Hello there this is the title',
      //'subtitle'  => 'Hi, this is the sub title',
      //'photo'     => 'https://images.unsplash.com/photo-1530297604385-43095d70e95e?ixlib=rb-0.3.5&ixid=eyJhcHBfaWQiOjEyMDd9&s=ac9a6a2496170a3c21c63d8006d18328&auto=format&fit=crop&w=1350&q=80',
    ));
  ?>

  <div class="container container--narrow page-section">
  <?php //$current_id = get_the_ID(); $current_parent_id = wp_get_post_parent_id($current_id); ?>
  <?php $current_parent_id = wp_get_post_parent_id(get_the_ID()); ?>
    <!-- Breadcrumb Box -->
    <?php if ($current_parent_id) : ?>
      <div class="metabox metabox--position-up metabox--with-home-link">
        <p><a class="metabox__blog-home-link" href="<?php echo get_the_permalink($current_parent_id); ?>"><i class="fa fa-home" aria-hidden="true"></i> <?php echo get_the_title($current_parent_id); ?></a> <span class="metabox__main"><?php the_title(); ?></span></p>
      </div>
    <?php endif; ?>



    <!-- LINKS -->
    <?php
      $test_array = get_pages(array(
        'child_of'  => get_the_ID()
      ));
    ?>

    <?php if ($current_parent_id || $test_array): ?>
      <div class="page-links">
        <h2 class="page-links__title"><a href="<?php echo get_the_permalink($current_parent_id); ?>"><?php echo get_the_title($current_parent_id); ?></a></h2>
        <ul class="min-list">
        <?php
          if ($current_parent_id ) {
            $find_children_of = $current_parent_id;
          } else {
            $find_children_of = get_the_ID();
          }
          wp_list_pages(array(
            'title_li'      => NULL,
            'child_of'      => $find_children_of,
            'sort_column'   => 'menu_order'
          ));
        ?>
        </ul>
      </div><!-- class="page-links" -->
    <?php endif ?>


    <?php get_search_form(); ?>
  </div>
<?php endwhile ?>


<?php get_footer(); ?>







































