<?php
if ( ! defined( 'ABSPATH' ) ) exit;
/**
 * To edit this file, please copy the contents of this file to one of these locations:
 * - `/wp-content/themes/<your_theme>/partials/content-sermon-single.php`
 * - `/wp-content/themes/<your_theme>/template-parts/content-sermon-single.php`
 * - `/wp-content/themes/<your_theme>/content-sermon-single.php`
 *
 * That will ensure that your changes are not deleted on plugin update.
 *
 * Sometimes, we need to edit this file to add new features or to fix some bugs, and when we do so, we will modify the
 * changelog in this header comment.
 *
 * @package SermonManager\Views\Partials
 *
 * @since   2.13.0 - added
 * @since   2.15.0 - fix audio URL edge case
 * @copyright Copyright (C) 2026 Jerry Purvis <jlpurvis1982@outlook.com>
 */

global $post;
?>
<?php if ( ! \SermonManager::getOption( 'theme_compatibility' ) ) : ?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php endif; ?>
	<div class="wpfc-sermon-single-inner">
		<?php if ( get_sermon_image_url() && ! \SermonManager::getOption( 'disable_image_single' ) ) : ?>
			<div class="wpfc-sermon-single-image">
				<img class="wpfc-sermon-single-image-img" alt="<?php the_title(); ?>"
						src="<?php echo esc_url( get_sermon_image_url() ); ?>">
			</div>
		<?php endif; ?>
		<div class="wpfc-sermon-single-main">
			<div class="wpfc-sermon-single-header">
				<div class="wpfc-sermon-single-meta-item wpfc-sermon-single-meta-date">
					<?php if ( 'date' === SermonManager::getOption( 'archive_orderby' ) ) : ?>
						<?php the_date(); ?>
					<?php else : ?>
						<?php echo SM_Dates::get(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
					<?php endif; ?>
				</div>
				<?php if ( ! \SermonManager::getOption( 'theme_compatibility' ) ) : ?>
					<h2 class="wpfc-sermon-single-title"><?php the_title(); ?></h2>
				<?php endif; ?>
				<div class="wpfc-sermon-single-meta">
					<?php if ( has_term( '', 'wpfc_preacher', $post->ID ) ) : ?>
						<div class="wpfc-sermon-single-meta-item wpfc-sermon-single-meta-preacher <?php echo \SermonManager::getOption( 'preacher_label', '' ) ? 'custom-label' : ''; ?>">
							<span class="wpfc-sermon-single-meta-prefix"><?php echo sm_get_taxonomy_field( 'wpfc_preacher', 'singular_name' ) . ':'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
							<span class="wpfc-sermon-single-meta-text"><?php the_terms( $post->ID, 'wpfc_preacher' ); ?></span>
						</div>
					<?php endif; ?>
					<?php if ( has_term( '', 'wpfc_sermon_series', $post->ID ) ) : ?>
						<div class="wpfc-sermon-single-meta-item wpfc-sermon-single-meta-series">
							<span class="wpfc-sermon-single-meta-prefix">
								<?php echo esc_html__( 'Series', 'sermon-manager-revival' ); ?>:</span>
							<span class="wpfc-sermon-single-meta-text"><?php the_terms( $post->ID, 'wpfc_sermon_series' ); ?></span>
						</div>
					<?php endif; ?>
					<?php if ( get_post_meta( $post->ID, 'bible_passage', true ) ) : ?>
						<div class="wpfc-sermon-single-meta-item wpfc-sermon-single-meta-passage">
							<span class="wpfc-sermon-single-meta-prefix">
								<?php echo esc_html__( 'Passage', 'sermon-manager-revival' ); ?>:</span>
							<span class="wpfc-sermon-single-meta-text"><?php wpfc_sermon_meta( 'bible_passage' ); ?></span>
						</div>
					<?php endif; ?>
					<?php if ( has_term( '', 'wpfc_service_type', $post->ID ) ) : ?>
						<div class="wpfc-sermon-single-meta-item wpfc-sermon-single-meta-service">
							<span class="wpfc-sermon-single-meta-prefix">
								<?php echo sm_get_taxonomy_field( 'wpfc_service_type', 'singular_name' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>:</span>
							<span class="wpfc-sermon-single-meta-text"><?php the_terms( $post->ID, 'wpfc_service_type' ); ?></span>
						</div>
					<?php endif; ?>
				</div>
			</div>

			<div class="wpfc-sermon-single-media">
				<?php if ( get_wpfc_sermon_meta( 'sermon_video_link' ) ) : ?>
					<div class="wpfc-sermon-single-video wpfc-sermon-single-video-link">
						<?php echo wpfc_render_video( get_wpfc_sermon_meta( 'sermon_video_link' ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
					</div>
				<?php endif; ?>
				<?php if ( get_wpfc_sermon_meta( 'sermon_video' ) ) : ?>
					<div class="wpfc-sermon-single-video wpfc-sermon-single-video-embed">
						<?php echo do_shortcode( get_wpfc_sermon_meta( 'sermon_video' ) ); ?>
					</div>
				<?php endif; ?>

				<?php if ( get_wpfc_sermon_meta( 'sermon_audio' ) || get_wpfc_sermon_meta( 'sermon_audio_id' ) ) : ?>
					<?php
					$sermon_audio_id     = get_wpfc_sermon_meta( 'sermon_audio_id' );
					$sermon_audio_url_wp = $sermon_audio_id ? wp_get_attachment_url( intval( $sermon_audio_id ) ) : false;
					$sermon_audio_url    = $sermon_audio_id && $sermon_audio_url_wp ? $sermon_audio_url_wp : get_wpfc_sermon_meta( 'sermon_audio' );
					?>
					<div class="wpfc-sermon-single-audio player-<?php echo esc_attr( strtolower( \SermonManager::getOption( 'player', 'plyr' ) ) ); ?>">
						<?php echo wpfc_render_audio( $sermon_audio_url ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
						<a class="wpfc-sermon-single-audio-download"
								href="<?php echo esc_url( $sermon_audio_url ); ?>"
								download="<?php echo esc_attr( basename( $sermon_audio_url ) ); ?>"
								title="<?php echo esc_attr__( 'Download Audio File', 'sermon-manager-revival' ); ?>">
							<svg fill="#000000" height="24" viewBox="0 0 24 24" width="24"
									xmlns="http://www.w3.org/2000/svg">
								<path d="M0 0h24v24H0z" fill="none"></path>
								<path d="M19.35 10.04C18.67 6.59 15.64 4 12 4 9.11 4 6.6 5.64 5.35 8.04 2.34 8.36 0 10.91 0 14c0 3.31 2.69 6 6 6h13c2.76 0 5-2.24 5-5 0-2.64-2.05-4.78-4.65-4.96zM17 13l-5 5-5-5h3V9h4v4h3z"></path>
							</svg>
						</a>
					</div>
					<?php $spotify_url = get_wpfc_sermon_meta( 'sermon_spotify_link' ); // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound ?>
					<?php if ( $spotify_url ) : ?>
						<div class="wpfc-sermon-single-spotify-wrap">
							<a class="wpfc-sermon-single-spotify-link"
									href="<?php echo esc_url( $spotify_url ); ?>"
									target="_blank"
									rel="noopener noreferrer"
									title="<?php echo esc_attr__( 'Listen on Spotify', 'sermon-manager-revival' ); ?>">
								<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" aria-hidden="true" focusable="false">
									<path fill="#ffffff" d="M12 0C5.4 0 0 5.4 0 12s5.4 12 12 12 12-5.4 12-12S18.66 0 12 0zm5.521 17.34c-.24.359-.66.48-1.021.24-2.82-1.74-6.36-2.101-10.561-1.141-.418.122-.779-.179-.899-.539-.12-.421.18-.78.54-.9 4.56-1.021 8.52-.6 11.64 1.32.42.18.479.659.301 1.02zm1.44-3.3c-.301.42-.841.6-1.262.3-3.239-1.98-8.159-2.58-11.939-1.38-.479.12-1.02-.12-1.14-.6-.12-.48.12-1.021.6-1.141C9.6 9.9 15 10.561 18.72 12.84c.361.181.54.78.241 1.2zm.12-3.36C15.24 8.4 8.82 8.16 5.16 9.301c-.6.179-1.2-.181-1.38-.721-.18-.601.18-1.2.72-1.381 4.26-1.26 11.28-1.02 15.721 1.621.539.3.719 1.02.419 1.56-.299.421-1.02.599-1.559.3z"/>
								</svg>
								<?php echo esc_html__( 'Listen on Spotify', 'sermon-manager-revival' ); ?>
							</a>
						</div>
					<?php endif; ?>
					<?php $apple_podcasts_url = get_wpfc_sermon_meta( 'sermon_apple_podcasts_link' ); // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound ?>
					<?php if ( $apple_podcasts_url ) : ?>
						<div class="wpfc-sermon-single-apple-podcasts-wrap">
							<a class="wpfc-sermon-single-apple-podcasts-link"
									href="<?php echo esc_url( $apple_podcasts_url ); ?>"
									target="_blank"
									rel="noopener noreferrer"
									title="<?php echo esc_attr__( 'Listen on Apple Podcasts', 'sermon-manager-revival' ); ?>">
								<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" aria-hidden="true" focusable="false">
									<path fill="#ffffff" d="M12 2a3 3 0 013 3v6a3 3 0 01-6 0V5a3 3 0 013-3zm0 14a7 7 0 007-7h2a9 9 0 01-8 8.945V20h-2v-2.055A9 9 0 013 9h2a7 7 0 007 7zm0-9a1 1 0 011 1v3a1 1 0 01-2 0V8a1 1 0 011-1z"/>
								</svg>
								<?php echo esc_html__( 'Listen on Apple Podcasts', 'sermon-manager-revival' ); ?>
							</a>
						</div>
					<?php endif; ?>
				<?php endif; ?>
			</div>

			<div class="wpfc-sermon-single-description"><?php wpfc_sermon_description(); ?></div>
			<?php if ( get_wpfc_sermon_meta( 'sermon_notes' ) || get_wpfc_sermon_meta( 'sermon_bulletin' ) ) : ?>
				<div class="wpfc-sermon-single-attachments"><?php echo wpfc_sermon_attachments(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></div>
			<?php endif; ?>
			<?php if ( has_term( '', 'wpfc_sermon_topics', $post->ID ) ) : ?>
				<div class="wpfc-sermon-single-topics">
					<span class="wpfc-sermon-single-topics-prefix">
						<?php echo esc_html__( 'Topics', 'sermon-manager-revival' ); ?>:</span>
					<span class="wpfc-sermon-single-topics-text"><?php the_terms( $post->ID, 'wpfc_sermon_topics' ); ?></span>
				</div>
			<?php endif; ?>

			<?php if ( ! \SermonManager::getOption( 'theme_compatibility' ) ) : ?>
				<?php
				$previous_sermon = sm_get_previous_sermon(); // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
				$next_sermon     = sm_get_next_sermon(); // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
				if ( $previous_sermon || $next_sermon ) :
					?>
					<div class="wpfc-sermon-single-navigation">
						<?php
						$previous_attr = apply_filters( 'previous_posts_link_attributes', 'class="previous-sermon"' ); // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound, WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedHooknameFound
						$next_attr     = apply_filters( 'next_posts_link_attributes', 'class="next-sermon"' ); // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound, WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedHooknameFound
						if ( null !== $previous_sermon ) :
							?>
							<a href="<?php echo esc_url( get_the_permalink( $previous_sermon ) ); ?>" <?php echo $previous_attr; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>><?php echo esc_html( preg_replace( '/&([^#])(?![a-z]{1,8};)/i', '&#038;$1', '&laquo; ' . get_the_title( $previous_sermon ) ) ); ?></a>
						<?php else : ?>
							<div></div>
						<?php endif; ?>
						<?php if ( null !== $next_sermon ) : ?>
							<a href="<?php echo esc_url( get_the_permalink( $next_sermon ) ); ?>" <?php echo $next_attr; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>><?php echo esc_html( preg_replace( '/&([^#])(?![a-z]{1,8};)/i', '&#038;$1', get_the_title( $next_sermon ) . ' &raquo;' ) ); ?></a>
						<?php else : ?>
							<div></div>
						<?php endif; ?>
					</div>
				<?php endif; ?>
			<?php endif; ?>
		</div>
		<?php
		if ( 'Divi' === get_option( 'template' ) && function_exists( 'et_get_option' ) ) {
			if ( ( comments_open() || get_comments_number() ) && 'on' == et_get_option( 'divi_show_postcomments', 'on' ) ) {
				comments_template( '', true );
			}
		}
		?>
	</div>
	<?php if ( ! \SermonManager::getOption( 'theme_compatibility' ) ) : ?>
</article>
<?php endif; ?>
