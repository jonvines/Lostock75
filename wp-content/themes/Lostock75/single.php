<?php
/**
 * The Template for displaying all single posts
 *
 * Please see /external/starkers-utilities.php for info on Starkers_Utilities::get_template_parts()
 *
 * @package 	WordPress
 * @subpackage 	Starkers
 * @since 		Starkers 4.0
 */
?>
<?php Starkers_Utilities::get_template_parts( array( 'parts/shared/html-header', 'parts/shared/header' ) ); ?>

<div id="feedback" class="widget-container" role="complementary">
		<div class="widget-area">
			<?php dynamic_sidebar( 'comments-sidebar-1' ); ?>
		</div><!-- .widget-area -->
</div>  
<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

<article role="main">

	<h2><?php the_title(); ?></h2>
	<time datetime="<?php the_time( 'Y-m-d' ); ?>" pubdate><?php the_date(); ?> <?php the_time(); ?></time> <?php comments_popup_link('Leave a Comment', '1 Comment', '% Comments'); ?>
	<?php the_content(); ?>			

	<?php comments_template( '', true ); ?>

</article>
<?php endwhile; ?>

<?php Starkers_Utilities::get_template_parts( array( 'parts/shared/sidebar-main', 'parts/shared/footer','parts/shared/html-footer' ) ); ?>