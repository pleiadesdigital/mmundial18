<?php get_header(); ?>

<?php
  page_banner(array(
    'title'     => 'Books',
    'subtitle'  => 'tres colecciones de libros lorem ipsum',
  ));
?>

<div class="container container--narrow page-section">

  <div class="row row--equal-height">

      <div class="book book__box-medium">
        <div class="book__item">
          <h2 class="headline headline--medium headline--post-title headline--post-title-mag"><a href="#">Papeles de Antaño</a></h2>
          <div class="metabox metabox--mag">
            <p>Subtitulo viene acá</p>
          </div>
          <div class="generic-content">
            <p></p>
            <p><a class="btn btn--blue btn--mag" href="#">Go to collection &raquo;</a></p>
          </div>
        </div>
      </div>
      <div class="book book__box-medium">
        <div class="book__item">
          <h2 class="headline headline--medium headline--post-title headline--post-title-mag"><a href="#">Papeles de Ogaño</a></h2>
          <div class="metabox metabox--mag">
            <p>Subtitulo viene acá</p>
          </div>
          <div class="generic-content">
            <p></p>
            <p><a class="btn btn--blue btn--mag" href="#">Go to collection &raquo;</a></p>
          </div>
        </div>
      </div>
      <div class="book book__box-medium">
        <div class="book__item">
          <h2 class="headline headline--medium headline--post-title headline--post-title-mag"><a href="#">Papeles de Argolla</a></h2>
          <div class="metabox metabox--mag">
            <p>Subtitulo viene acá</p>
          </div>
          <div class="generic-content">
            <p></p>
            <p><a class="btn btn--blue btn--mag" href="#">Go to collection &raquo;</a></p>
          </div>
        </div>
      </div>

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
