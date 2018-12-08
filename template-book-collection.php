<?php /* Template Name: Book Collection*/ ?>
<?php get_header(); ?>

<?php
  page_banner(array(
    'title'     => 'Books',
    'subtitle'  => 'test 123123',
  ));
?>

<div class="container container--narrow page-section">
  <?php
    $args = array(
      'post_type'   => 'book',
      'meta_key'    => 'collection',
      'meta_query'  => array(
        'relation'  => 'AND',
        array(
          'key'     => 'collection',
          'value'   => 'Argolla',
          'compare' => '='
        )
      )
    );
    $books = new WP_Query($args);
  ?>

  <div class="row row--equal-height">
    <?php while ($books->have_posts()) : $books->the_post(); ?>

    <div class="book book__box-medium">
      <div class="book__item">
        <h2 class="headline headline--medium headline--post-title headline--post-title-mag"><a href="#"><?php the_title(); ?></a></h2>
        <div class="metabox metabox--mag">
          <p>Subtitulo viene acá</p>
        </div>
        <div class="generic-content">
          <p></p>
          <p><a class="btn btn--blue btn--mag" href="#">Go to collection &raquo;</a></p>
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
