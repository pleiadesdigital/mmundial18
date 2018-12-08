<?php get_header(); ?>

<?php
  page_banner(array(
    'title'     => 'Search Results',
    'subtitle'  => 'You searched for &ldquo;' . esc_html(get_search_query(false)) . '&rdquo;',
  ));
?>

<div class="container container--narrow page-section">
<?php
  if (have_posts()) {
    while(have_posts()) : the_post();
      get_template_part('template-parts/content', get_post_type());
    endwhile;
    // PAGINATION
    echo paginate_links(array(
      'prev_text'     => __('<< Previo'),
      'next_text'     => __('Siguiente >>'),
      'type'          => 'plain'
    ));
  } else {
    echo '<h2 class="headline headline--small-plus">No results match that search.</h2>';
  }
  get_search_form();
  ?>

</div>

<?php get_footer(); ?>
