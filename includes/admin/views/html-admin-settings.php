<?php
/**
 * Admin View: Settings
 *
 * @package SM/Core/Admin/Settings
 * @copyright Copyright (C) 2026 Jerry Purvis <jlpurvis1982@outlook.com>
 */

defined( 'ABSPATH' ) or die;

$current_tab = empty( $current_tab ) ? 'general' : $current_tab; // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
?>
<div class="wrap sm sm_settings_<?php echo esc_attr( $current_tab ); ?>">
	<div class="intro">
		<h1 class="wp-heading-inline"><?php esc_html_e( 'Sermon Manager Revival Settings', 'sermon-manager-revival' ); ?></h1>
	</div>
	<?php SM_Admin_Settings::show_messages(); ?>
	<div class="settings-main">
		<div class="settings-content">
			<form method="<?php echo esc_attr( apply_filters( 'sm_settings_form_method_tab_' . $current_tab, 'post' ) ); // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedHooknameFound ?>"
					id="mainform" action="" enctype="multipart/form-data">
				<nav class="nav-tab-wrapper sm-nav-tab-wrapper">
					<?php
					foreach ( $tabs as $name => $label ) { // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
						echo '<a href="' . esc_url( admin_url( 'edit.php?post_type=wpfc_sermon&page=sm-settings&tab=' . sanitize_key( $name ) ) ) . '" class="nav-tab ' . ( $current_tab == $name ? 'nav-tab-active' : '' ) . '">' . esc_html( $label ) . '</a>';
					}
					do_action( 'sm_settings_tabs' ); // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedHooknameFound
					?>
				</nav>
				<div class="inside">
					<h1 class="screen-reader-text"><?php echo esc_html( $tabs[ $current_tab ] ); ?></h1>
					<?php
					do_action( 'sm_sections_' . $current_tab ); // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedHooknameFound
					do_action( 'sm_settings_' . $current_tab ); // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedHooknameFound
					?>
					<p class="submit">
						<?php if ( empty( $GLOBALS['hide_save_button'] ) ) : ?>
							<input name="save" class="button-primary sm-save-button" type="submit"
									value="<?php esc_attr_e( 'Save changes', 'sermon-manager-revival' ); ?>"/>
						<?php endif; ?>
						<?php wp_nonce_field( 'sm-settings' ); ?>
					</p>
				</div>
			</form>
		</div>
		<div class="settings-side">
			<div class="postbox sm-box">
				<h3><span><?php esc_html_e( 'Need Some Help?', 'sermon-manager-revival' ); ?></span>
				</h3>
				<div class="inside">
					<div style="text-align:center">
						<a href="https://wordpress.org/support/plugin/sermon-manager-revival"
								target="_blank" class="button-secondary">
							<?php esc_html_e( 'Free&nbsp;Support', 'sermon-manager-revival' ); ?></a>&nbsp;
						<a href="https://github.com/TheologyAIGeek/Sermon-Manager/issues"
								target="_blank" class="button-primary">
							<?php esc_html_e( 'GitHub&nbsp;Issues', 'sermon-manager-revival' ); ?></a>
					</div>
				</div>
			</div>
			<div class="postbox sm-box">
				<h3>
					<span><?php esc_html_e( 'Frequently Asked Questions', 'sermon-manager-revival' ); ?></span>
				</h3>
				<div class="inside">
					<ol>
						<li>
							<a href="https://github.com/TheologyAIGeek/Sermon-Manager/wiki"
									title="" target="_blank">Getting Started with Sermon Manager Revival</a></li>
						<li>
							<a href="https://github.com/TheologyAIGeek/Sermon-Manager/wiki"
									title="Sermon Manager Revival Shortcodes" target="_blank">
								Sermon Manager Revival Shortcodes</a></li>
						<li>
							<a href="https://github.com/TheologyAIGeek/Sermon-Manager/issues"
									title="Troubleshooting Sermon Manager Revival" target="_blank">
								Troubleshooting Sermon Manager Revival</a></li>
					</ol>
					<div class="text-align:center;font-size:0.85em;padding:0.4rem 0 0">
						<?php // translators: %s GitHub URL. ?>
						<span><?php echo wp_sprintf( esc_html__( 'Find out more on our %s', 'sermon-manager-revival' ), '<a href="https://github.com/TheologyAIGeek/Sermon-Manager" title="GitHub" target="_blank">' . esc_html__( 'GitHub repository', 'sermon-manager-revival' ) . '</a>' ); ?></span>
					</div>
				</div>
			</div>

			<div class="postbox sm-box">
				<h3>
					<span><?php esc_html_e( 'Lets Make It Even Better!', 'sermon-manager-revival' ); ?></span>
				</h3>
				<div class="inside">
					<p><?php esc_html_e( 'If you have ideas on how to make Sermon Manager Revival better, let us know!', 'sermon-manager-revival' ); ?></p>
					<div style="text-align:center">
						<a href="https://feedback.userreport.com/05ff651b-670e-4eb7-a734-9a201cd22906/"
								target="_blank"
								class="button-secondary"><?php esc_html_e( 'Submit&nbsp;Your&nbsp;Idea', 'sermon-manager-revival' ); ?></a>
					</div>
				</div>
			</div>
		   <?php  
			echo wp_kses_post( apply_filters( 'settings_page_sidebar_extra_boxs', '' ) ); // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedHooknameFound
			?>
		</div>
	</div>
</div>
