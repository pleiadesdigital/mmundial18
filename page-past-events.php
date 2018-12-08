<?php get_header(); ?>

<?php
  page_banner(array(
    'title'     => 'Past Events',
    'subtitle'  => 'A recap of our past events',
  ));
?>


<div class="container container--narrow page-section">
<?php
  $today = date('Ymd');
  $args = array(
    'paged'               => get_query_var('paged', 1),
    // 'posts_per_page'      => 1,
    'post_type'           => 'event',
    'meta_key'            => 'event_date',
    'orderby'             => 'meta_value_num',
    'order'               => 'ASC',
    'meta_query'          => array(
      array(
        'key'             => 'event_date',
        'compare'         => '<',
        'value'           => $today,
        'type'            => 'numeric'
      )
    )
  );
  $pastEvents = new WP_Query($args);
?>
<?php while($pastEvents->have_posts()) : $pastEvents->the_post(); ?>
	<?php get_template_part('template-parts/content', 'event'); ?>
<?php endwhile; ?>

  <!-- PAGINATION -->
  <?php
    echo paginate_links(array(
      'total'         => $pastEvents->max_num_pages,
      'prev_text'     => __('<< Previo'),
      'next_text'     => __('Siguiente >>'),
      'type'          => 'plain'
    )); ?>

</div>


<?php get_footer(); ?>

