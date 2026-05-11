<?php
if ( ! defined( 'ABSPATH' ) ) exit;
/**
 * To edit this file, please copy the contents of this file to one of these locations:
 * - `/wp-content/themes/<your_theme>/partials/content-sermon-filtering.php`
 * - `/wp-content/themes/<your_theme>/template-parts/content-sermon-filtering.php`
 * - `/wp-content/themes/<your_theme>/content-sermon-filtering.php`
 *
 * That will ensure that your changes are not deleted on plugin update.
 *
 * Sometimes, we need to edit this file to add new features or to fix some bugs, and when we do so, we will modify the
 * changelog in this header comment.
 *
 * @package SermonManager\Views\Partials
 *
 * @since   2.13.0 - added
 * @since   2.15.2 - fixed filtering 404 error
 * @copyright Copyright (C) 2026 Jerry Purvis <jlpurvis1982@outlook.com>
 */

global $post;

$_partial_args = ! empty( $GLOBALS['wpfc_partial_args'] ) ? $GLOBALS['wpfc_partial_args'] : array(); // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound

foreach ( array( 'action', 'filters', 'visibility_mapping', 'args' ) as $_required_key ) { // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	if ( ! isset( $_partial_args[ $_required_key ] ) ) {
		echo '<p><b>Sermon Manager Revival</b>: Partial "<i>' . esc_html( str_replace( '.php', '', basename( __FILE__ ) ) ) . '</i>" loaded incorrectly.</p>';

		return;
	}
}

$action             = $_partial_args['action'];
$filters            = $_partial_args['filters']; // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
$visibility_mapping = $_partial_args['visibility_mapping']; // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
$args               = $_partial_args['args']; // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound

?>
<div id="<?php echo esc_attr( $args['id'] ); ?>" class="<?php echo esc_attr( $args['classes'] ); ?>">
	<?php foreach ( $filters as $filter ) : // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound ?>
		<?php if ( isset( $visibility_mapping[ $filter['taxonomy'] ] ) && in_array( $args[ $visibility_mapping[ $filter['taxonomy'] ] ], array(
			'yes',
			'hide',
			1,
			'1',
			true,
		), true ) ) : ?>
			<?php continue; ?>
		<?php endif; ?>

		<?php if ( ( ! empty( $args[ $filter['taxonomy'] ] ) && 'none' !== $args['visibility'] ) || empty( $args[ $filter['taxonomy'] ] ) ) : ?>
			<div class="<?php echo esc_attr( $filter['className'] ); ?>" style="display: inline-block">
				<form action="<?php echo esc_url( $args['action'] ); ?>" method="get">
					<select name="<?php echo esc_attr( $filter['taxonomy'] ); ?>"
							title="<?php echo esc_attr( $filter['title'] ); ?>"
							id="<?php echo esc_attr( $filter['taxonomy'] ); ?>"
							onchange="if(this.options[this.selectedIndex].value !== ''){return this.form.submit()}else{window.location = window.location.href.split('?')[0];}"
							autocomplete="off"
						<?php echo ! empty( $args[ $filter['taxonomy'] ] ) && 'disable' === $args['visibility'] ? 'disabled' : ''; ?>>
						<option value=""><?php echo esc_html( $filter['title'] ); ?></option>
						<?php echo wpfc_get_term_dropdown( $filter['taxonomy'], ! empty( $args[ $filter['taxonomy'] ] ) ? $args[ $filter['taxonomy'] ] : '' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
					</select>
					<?php $series = explode( ',', $args['series_filter'] ); // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound ?>
					<?php if ( isset( $args['series_filter'] ) && '' !== $args['series_filter'] && $series ) : ?>
						<?php if ( $series > 1 ) : ?>
							<?php foreach ( $series as $item ) : // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound ?>
								<input type="hidden" name="wpfc_sermon_series[]"
										value="<?php echo esc_attr( trim( $item ) ); ?>">
							<?php endforeach; ?>
						<?php else : ?>
							<input type="hidden" name="wpfc_sermon_series"
									value="<?php echo esc_attr( $series[0] ); ?>">
						<?php endif; ?>
					<?php endif; ?>
					<?php $service_types = explode( ',', $args['service_type_filter'] ); // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound ?>
					<?php if ( isset( $args['service_type_filter'] ) && '' !== $args['service_type_filter'] && $service_types ) : ?>
						<?php if ( $service_types > 1 ) : ?>
							<?php foreach ( $service_types as $service_type ) : // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound ?>
								<input type="hidden" name="wpfc_service_type[]"
										value="<?php echo esc_attr( trim( $service_type ) ); ?>">
							<?php endforeach; ?>
						<?php else : ?>
							<input type="hidden" name="wpfc_service_type"
									value="<?php echo esc_attr( $service_types[0] ); ?>">
						<?php endif; ?>
					<?php endif; ?>
					<noscript>
						<div><input type="submit" value="Submit"/></div>
					</noscript>
				</form>
			</div>
		<?php endif; ?>
	<?php endforeach; ?>
</div>
