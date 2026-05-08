<?php // phpcs:ignore
/**
 * Template used for displaying archive pages
 *
 * @package SM/Views
 * @copyright Copyright (C) 2026 Jerry Purvis <jlpurvis1982@outlook.com>
 */

get_header(); ?>

<?php echo wpfc_get_partial( 'content-sermon-wrapper-start' ); ?>

<?php
echo wp_kses_post( render_wpfc_sorting() );

if ( have_posts() ) :

	echo apply_filters( 'archive-wpfc_sermon-before-sermons', '' );

	while ( have_posts() ) :
		the_post();
		wpfc_sermon_excerpt_v2(); // You can edit the content of this function in `partials/content-sermon-archive.php`.
	endwhile;

	echo apply_filters( 'archive-wpfc_sermon-after-sermons', '' );

	echo '<div class="sm-pagination ast-pagination">';
	sm_pagination();
	echo '</div>';
else :
	echo esc_html__( 'Sorry, but there aren\'t any posts matching your query.', 'sermon-manager-revival' );
endif;
?>

<?php echo wpfc_get_partial( 'content-sermon-wrapper-end' ); ?>

<?php
get_footer();
