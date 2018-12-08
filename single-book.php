<?php get_header(); ?>

<?php while(have_posts()) : the_post(); ?>

<?php page_banner(); ?>

	<div class="container container--narrow page-section">
		<div class="metabox metabox--position-up metabox--with-home-link">
		  <p><a class="metabox__blog-home-link" href="<?php echo get_post_type_archive_link('program'); ?>"><i class="fa fa-book" aria-hidden="true"></i>&nbsp;&nbsp;All Books</a> <span class="metabox__main"><?php the_title(); ?></span></p>
		</div>

		<!-- GENERIC CONTENT -->
		<div class="generic-content"><?php the_field('main_body_content'); ?></div>

		  <?php
  	    $args = array(
  	      'posts_per_page'      => -1,
  	      'post_type'           => 'book',
  	      'orderby'             => 'title',
  	      'order'               => 'ASC',
  	      'meta_query'          => array(
  	        array(
  	        	'key'							=> 'related_programs',
  	        	'compare'					=> 'LIKE',
  	        	'value'						=> '"' . get_the_ID() . '"'
  	        )
  	      )
  	    );
  	    $relatedProfessors = new WP_Query($args);
		  	?>
		  	<?php if ($relatedProfessors->have_posts( )) : ?>
		  	  <hr class="section-break">
		  	  <h2 class="headline headline--medium"><?php echo get_the_title(); ?> Professor(s)</h2>
		  	  <ul class="professor-cards">
		  	  <?php while ($relatedProfessors->have_posts()) : $relatedProfessors->the_post(); ?>
						<li class="professor-card__list-item">
							<a class="professor-card" href="<?php the_permalink(); ?>">
								<img class="professor-card__image" src="<?php the_post_thumbnail_url('professor-landscape'); ?>">
								<span class="professor-card__name"><?php the_title(); ?></span>
							</a>
						</li>
		  		<?php endwhile; ?>
		  		</ul>
		  	<?php endif;

		  	wp_reset_postdata();

		    $today = date('Ymd');
		    $args = array(
		      'posts_per_page'      => 2,
		      'post_type'           => 'event',
		      'meta_key'            => 'event_date',
		      'orderby'             => 'meta_value_num',
		      'order'               => 'ASC',
		      'meta_query'          => array(
		        array(
		          'key'             => 'event_date',
		          'compare'         => '>=',
		          'value'           => $today,
		          'type'            => 'numeric'
		        ),
		        array(
		        	'key'							=> 'related_programs',
		        	'compare'					=> 'LIKE',
		        	'value'						=> '"' . get_the_ID() . '"'
		        )
		      )
		    );
		    $homepageEvents = new WP_Query($args);
		  ?>
		<?php if ($homepageEvents->have_posts( )) : ?>
		  <hr class="section-break">
		  <h2 class="headline headline--medium">Upcoming <?php echo get_the_title(); ?> Events</h2>
		  <?php while ($homepageEvents->have_posts()) : $homepageEvents->the_post(); ?>
		  <?php get_template_part('template-parts/content', 'event'); ?>
			<?php endwhile; ?>
		<?php endif; wp_reset_postdata(); ?>

    <!-- CAMPUSES RELATIONSHIPS -->
    <?php
      $relatedCampus = get_field('related_campus');
      if ($relatedCampus) : ?>
        <hr class="section-break">
        <h2 class="headline headline--medium"><?php echo get_the_title(); ?> program is available at: </h2>
        <ul class="min-list link-list">
        <?php foreach ($relatedCampus as $campus) : ?>
          <li><a href="<?php echo get_the_permalink($campus); ?>"><?php echo get_the_title($campus); ?></a></li>
        <?php endforeach; ?>
        </ul>
      <?php endif; wp_reset_postdata(); ?>

	</div><!-- class="container container--narrow page-section" -->

<?php endwhile; ?>


<?php get_footer(); ?>
