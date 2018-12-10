<?php get_header(); ?>

<?php
  page_banner(array(
    'title'     => 'La Mariposa Mundial',
    'subtitle'  => 'revista de literatura',
    'photo'     => get_theme_file_uri('images/magazine-cover.jpg')
  ));
?>

<div class="container container--narrow page-section">

  <div class="row row--equal-height">
    <?php while(have_posts()) : the_post(); ?>
      <div class="mag mag__box-medium">
        <div class="mag__item">
          <?php the_post_thumbnail('large', ['class' => 'img__magazine']); ?>
          <h2 class="headline headline--medium headline--post-title headline--post-title-mag"><a href="<?php the_permalink(); ?>"><?php // the_title(); ?></a></h2>
          <!-- <div class="metabox metabox--mag"> -->
            <!-- <p>Posted by <?php //the_author_posts_link(); ?> on <?php //the_time('M j, Y'); ?></p> -->
            <!-- <p>[Última Sude]</p> -->
          <!-- </div> -->
          <div class="generic-content">
            <?php //the_excerpt(); ?>
            <!-- <p>En esta Última Sude hay redes, circuitos, flujos, no un centro. Habrá que repetir: «reverberar en las aguas simples del Titikaka». Reverberar y producir cohesión. ¿O a qué lado del charco pertenecen el Culeus o el Pez? La pasión y el pensamiento no son polos opuestos, la potencia creadora y la acción mucho menos. Cunan, Bandera Roja, Argos, Chirapu, Inti, Kuntur, Dum Dum, Tempestad. [...]</p> -->
            <p><a class="btn btn--beigeNew btn--mag" href="<?php the_permalink(); ?>">Open magazine &raquo;</a></p>
          </div>
        </div>
      </div>
    <?php endwhile; ?>
  </div><!-- class="row row--equal-height" -->

  <!-- PAGINATION -->
  <div class="pagination-links">
  <?php
    echo paginate_links(array(
      'prev_text'     => __('<< Previo'),
      'next_text'     => __('Siguiente >>'),
      'type'          => 'plain'
    ));
  ?>
  </div>


</div>


<?php get_footer(); ?>
