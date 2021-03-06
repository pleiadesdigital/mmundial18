<?php get_header(); ?>

<?php while(have_posts()) : the_post(); ?>

<?php
	page_banner(array(
		'photo' => get_theme_file_uri('images/magazine-cover.jpg')
	));
?>

	<div class="container container--narrow page-section">

		<div class="metabox metabox--position-up metabox--with-home-link">
		  <p><a class="metabox__blog-home-link" href="<?php echo get_post_type_archive_link('magazine'); ?>"><i class="fa fa-ravelry" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;All Magazines</a> <span class="metabox__main"> Posted by <?php the_author_posts_link(); ?> on <?php the_time('M j, Y'); ?> in <?php echo get_the_category_list('|'); ?></span></p>
		</div>

		<!-- GENERIC CONTENT -->
		<div class="generic-content">
			<?php the_content(); ?>
		</div>

	</div>

<?php endwhile; ?>



<?php get_footer(); ?>

