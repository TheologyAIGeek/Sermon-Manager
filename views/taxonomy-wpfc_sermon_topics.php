<?php // phpcs:ignore
/**
 * Template used for displaying taxonomy archive pages
 *
 * @package SM/Views
 * @copyright Copyright (C) 2026 Jerry Purvis <jlpurvis1982@outlook.com>
 */

get_header();
?>

<?php echo wpfc_get_partial( 'content-sermon-wrapper-start' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>

<?php
echo wp_kses_post( render_wpfc_sorting() );

if ( have_posts() ) :

	echo apply_filters( 'taxonomy-wpfc_sermon_topics-before-sermons', '' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

	while ( have_posts() ) :
		the_post();
		wpfc_sermon_excerpt_v2();
	endwhile;

	echo apply_filters( 'taxonomy-wpfc_sermon_topics-after-sermons', '' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

	echo '<div class="sm-pagination ast-pagination">';
	sm_pagination();
	echo '</div>';
else :
	echo esc_html__( 'Sorry, but there are no posts matching your query.', 'sermon-manager-revival' );
endif;
?>

<?php echo wpfc_get_partial( 'content-sermon-wrapper-end' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>

<?php
get_footer();
