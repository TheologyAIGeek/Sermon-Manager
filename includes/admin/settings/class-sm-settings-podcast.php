<?php
/**
 * Podcast settings page.
 *
 * @package SM/Core/Admin/Settings
 * @copyright Copyright (C) 2026 Jerry Purvis <jlpurvis1982@outlook.com>
 */

defined( 'ABSPATH' ) or die;

/**
 * Initialize settings
 */
class SM_Settings_Podcast extends SM_Settings_Page { // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedClassFound
	/**
	 * SM_Settings_Podcast constructor.
	 */
	public function __construct() {
		$this->id    = 'podcast';
		$this->label = __( 'Podcast', 'sermon-manager-revival' );
		add_action( 'sm_settings_podcast_settings_after', array( $this, 'after' ) );

		parent::__construct();
	}

	/**
	 * Get settings array.
	 *
	 * @return array
	 */
	public function get_settings() {
		$settings = apply_filters( 'sm_podcast_settings', array( // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedHooknameFound
			array(
				'title' => __( 'Podcast Settings', 'sermon-manager-revival' ),
				'type'  => 'title',
				'desc'  => '',
				'id'    => 'podcast_settings',
			),
			array(
				'title'       => __( 'Title', 'sermon-manager-revival' ),
				'type'        => 'text',
				'id'          => 'title',
				'placeholder' => get_bloginfo( 'name' ),
			),
			array(
				'title'       => __( 'Description', 'sermon-manager-revival' ),
				'type'        => 'text',
				'id'          => 'description',
				'placeholder' => get_bloginfo( 'description' ),
			),
			array(
				'title'       => __( 'Website Link', 'sermon-manager-revival' ),
				'type'        => 'text',
				'id'          => 'website_link',
				'placeholder' => home_url(),
			),
			array(
				'title'       => __( 'Language', 'sermon-manager-revival' ),
				'type'        => 'text',
				'id'          => 'language',
				'placeholder' => get_bloginfo( 'language' ),
			),
			array(
				'title'       => __( 'Copyright', 'sermon-manager-revival' ),
				'type'        => 'text',
				'id'          => 'copyright',
				// translators: %s: blog name.
				'placeholder' => wp_sprintf( __( 'Copyright &copy; %s', 'sermon-manager-revival' ), get_bloginfo( 'name' ) ),
				// translators: %s: copyright symbol HTML entity (&copy;).
				'desc'        => wp_sprintf( esc_html__( 'Tip: Use %s to generate a copyright symbol.', 'sermon-manager-revival' ), '<code>' . htmlspecialchars( '&copy;' ) . '</code>' ),
			),
			array(
				'title'       => __( 'Webmaster Name', 'sermon-manager-revival' ),
				'type'        => 'text',
				'id'          => 'webmaster_name',
				'placeholder' => __( 'e.g. Your Name', 'sermon-manager-revival' ),
			),
			array(
				'title'       => __( 'Webmaster Email', 'sermon-manager-revival' ),
				'type'        => 'email',
				'id'          => 'webmaster_email',
				'placeholder' => __( 'e.g. Your Email', 'sermon-manager-revival' ),
			),
			array(
				'title'       => __( 'Author', 'sermon-manager-revival' ),
				'type'        => 'text',
				'id'          => 'itunes_author',
				'placeholder' => __( 'e.g. Primary Speaker or Church Name', 'sermon-manager-revival' ),
				'desc'        => __( 'Displays as the &ldquo;Artist&rdquo; in Apple Podcasts and other directories.', 'sermon-manager-revival' ),
			),
			array(
				'title'       => __( 'Subtitle', 'sermon-manager-revival' ),
				'type'        => 'text',
				'id'          => 'itunes_subtitle',
				// translators: %s: blog name.
				'placeholder' => wp_sprintf( __( 'e.g. Preaching and teaching audio from %s', 'sermon-manager-revival' ), get_bloginfo( 'name' ) ),
				'desc'        => __( 'Your subtitle should briefly tell the listener what they can expect to hear.', 'sermon-manager-revival' ),
			),
			array(
				'title'       => __( 'Summary', 'sermon-manager-revival' ),
				'type'        => 'text',
				'id'          => 'itunes_summary',
				// translators: %s: blog name.
				'placeholder' => wp_sprintf( __( 'e.g. Weekly teaching audio brought to you by %s in City, State.', 'sermon-manager-revival' ), get_bloginfo( 'name' ) ),
				'desc'        => __( 'Keep your Podcast Summary short, sweet and informative. Be sure to include a brief statement about your mission and in what region your audio content originates.', 'sermon-manager-revival' ),
			),
			array(
				'title'       => __( 'Owner Name', 'sermon-manager-revival' ),
				'type'        => 'text',
				'id'          => 'itunes_owner_name',
				'placeholder' => get_bloginfo( 'name' ),
				'desc'        => __( 'This should typically be the name of your Church.', 'sermon-manager-revival' ),
			),
			array(
				'title'       => __( 'Owner Email', 'sermon-manager-revival' ),
				'type'        => 'text',
				'id'          => 'itunes_owner_email',
				'placeholder' => __( 'e.g. Your Email', 'sermon-manager-revival' ),
				'desc'        => __( 'Use an email address that you don&rsquo;t mind being made public. If someone wants to contact you regarding your Podcast this is the address they will use.', 'sermon-manager-revival' ),
			),
			array(
				'title' => __( 'Cover Image', 'sermon-manager-revival' ),
				'type'  => 'image',
				'id'    => 'itunes_cover_image',
				'desc'  => __( 'Square cover artwork for your podcast. Must be between 1,400&times;1,400 px and 3,000&times;3,000 px. Required by Apple Podcasts and Spotify.', 'sermon-manager-revival' ),
			),
			array(
				'title'   => __( 'Sub Category', 'sermon-manager-revival' ),
				'type'    => 'select',
				'id'      => 'itunes_sub_category',
				'options' => array(
					'0' => __( 'Sub Category', 'sermon-manager-revival' ),
					'1' => __( 'Buddhism', 'sermon-manager-revival' ),
					'2' => __( 'Christianity', 'sermon-manager-revival' ),
					'3' => __( 'Hinduism', 'sermon-manager-revival' ),
					'4' => __( 'Islam', 'sermon-manager-revival' ),
					'5' => __( 'Judaism', 'sermon-manager-revival' ),
					'6' => __( 'Other', 'sermon-manager-revival' ),
					'7' => __( 'Spirituality', 'sermon-manager-revival' ),
				),
			),
			array(
				'title'    => __( 'PodTrac Tracking', 'sermon-manager-revival' ),
				'type'     => 'checkbox',
				'id'       => 'podtrac',
				'desc'     => __( 'Route audio URLs through PodTrac for download analytics.', 'sermon-manager-revival' ),
				// translators: %s: <a href="https://analytics.podtrac.com">analytics.podtrac.com</a>.
				'desc_tip' => wp_sprintf( __( 'For more info on PodTrac or to sign up for an account, visit %s', 'sermon-manager-revival' ), '<a href="https://analytics.podtrac.com" target="_blank" rel="noopener noreferrer">analytics.podtrac.com</a>' ),
				'default'  => 'no',
			),
			array(
				'title'    => __( 'HTML in description', 'sermon-manager-revival' ),
				'type'     => 'checkbox',
				'id'       => 'enable_podcast_html_description',
				'desc'     => __( 'Allow HTML markup in podcast description fields. Uncheck if descriptions look messy in podcast apps.', 'sermon-manager-revival' ),
				'desc_tip' => __( 'Recommended: leave unchecked. Uncheck if the feed does not validate.', 'sermon-manager-revival' ),
				'default'  => 'no',
			),
			array(
				'title'    => __( 'Redirect', 'sermon-manager-revival' ),
				'type'     => 'checkbox',
				'id'       => 'enable_podcast_redirection',
				'desc'     => __( 'Redirect podcast subscribers from an old feed URL to this one.', 'sermon-manager-revival' ),
				'desc_tip' => __( 'Useful when migrating from another podcast host. You can use relative or absolute URLs.', 'sermon-manager-revival' ),
			),
			array(
				'title' => __( 'Old URL', 'sermon-manager-revival' ),
				'type'  => 'text',
				'id'    => 'podcast_redirection_old_url',
			),
			array(
				'title' => __( 'New URL', 'sermon-manager-revival' ),
				'type'  => 'text',
				'id'    => 'podcast_redirection_new_url',
			),
			array(
				'title'       => __( 'Number of episodes per feed page', 'sermon-manager-revival' ),
				'type'        => 'number',
				'id'          => 'podcasts_per_page',
				'placeholder' => get_option( 'posts_per_rss' ),
			),
			array(
				'title'       => __( 'Country of Origin', 'sermon-manager-revival' ),
				'type'        => 'text',
				'id'          => 'spotify_country',
				'placeholder' => 'US',
				'desc'        => __( 'Two-letter ISO country code for the <code>&lt;spotify:countryOfOrigin&gt;</code> feed tag (e.g. US, GB, CA).', 'sermon-manager-revival' ),
			),
			array(
				'title'    => __( 'Sermon Image', 'sermon-manager-revival' ),
				'type'     => 'checkbox',
				'id'       => 'podcast_sermon_image_series',
				'desc'     => __( 'Fallback to series image if sermon does not have its own image.', 'sermon-manager-revival' ),
				'desc_tip' => __( 'Default disabled.', 'sermon-manager-revival' ),
				'default'  => 'no',
			),

			array(
				'title' => __( 'Directory Links', 'sermon-manager-revival' ),
				'type'  => 'title',
				'desc'  => __( 'Paste the URL for each platform where your podcast is listed. These power the <code>[list_podcasts]</code> shortcode. Leave a field blank to hide that platform.', 'sermon-manager-revival' ),
				'id'    => 'podcast_directory_urls',
			),
			array(
				'title'       => __( 'Apple Podcasts URL', 'sermon-manager-revival' ),
				'type'        => 'text',
				'id'          => 'podcast_url_itunes',
				'placeholder' => 'https://podcasts.apple.com/us/podcast/your-podcast/id123456789',
				'desc'        => __( 'Your Apple Podcasts show URL. Shortcode key: <code>itunes</code>.', 'sermon-manager-revival' ),
				'desc_tip'    => __( 'Leave empty to disable.', 'sermon-manager-revival' ),
			),
			array(
				'title'       => __( 'Spotify Podcast URL', 'sermon-manager-revival' ),
				'type'        => 'text',
				'id'          => 'podcast_url_spotify',
				'placeholder' => 'https://open.spotify.com/show/…',
				'desc'        => __( 'Your Spotify show URL. Shortcode key: <code>spotify</code>.', 'sermon-manager-revival' ),
				'desc_tip'    => __( 'Leave empty to disable.', 'sermon-manager-revival' ),
			),
			array(
				'title'       => __( 'Overcast URL', 'sermon-manager-revival' ),
				'type'        => 'text',
				'id'          => 'podcast_url_overcast',
				'placeholder' => 'https://overcast.fm/itunes…',
				'desc'        => __( 'Your Overcast show URL. Shortcode key: <code>overcast</code>.', 'sermon-manager-revival' ),
				'desc_tip'    => __( 'Leave empty to disable.', 'sermon-manager-revival' ),
			),

			array(
				'type' => 'sectionend',
				'id'   => 'podcast_settings',
			),
		) );

		return apply_filters( 'sm_get_settings_' . $this->id, $settings ); // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedHooknameFound
	}

	/**
	 * Additional HTML after the settings form.
	 */
	public function after() {
		$feed_url = get_site_url( null, '?feed=rss2&post_type=wpfc_sermon', 'https' );
		?>
		<div class="sm-podcast-info">
			<h3><?php esc_html_e( 'Your Podcast Feed URL', 'sermon-manager-revival' ); ?></h3>
			<p>
				<label for="sm_feed_url"><?php esc_html_e( 'Copy and submit this URL to podcast directories:', 'sermon-manager-revival' ); ?></label><br>
				<input type="text" readonly id="sm_feed_url"
						value="<?php echo esc_attr( $feed_url ); ?>"
						style="width:100%;max-width:600px;margin-top:4px;">
			</p>
			<p>
				<?php
				// translators: %s: Podcast Validator link.
				echo wp_sprintf(
					esc_html__( 'Validate your feed with %s before submitting to directories.', 'sermon-manager-revival' ),
					'<a href="' . esc_url( 'https://podcastpage.io/podcast-validator/?url=' . rawurlencode( $feed_url ) ) . '" target="_blank" rel="noopener noreferrer">' . esc_html__( 'Podcast Validator', 'sermon-manager-revival' ) . '</a>'
				); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
				?>
			</p>

			<h3><?php esc_html_e( 'Submit to Podcast Directories', 'sermon-manager-revival' ); ?></h3>
			<ul>
				<li>
					<strong><?php esc_html_e( 'Apple Podcasts', 'sermon-manager-revival' ); ?></strong> &mdash;
					<a href="https://podcastsconnect.apple.com/" target="_blank" rel="noopener noreferrer"><?php esc_html_e( 'Apple Podcasts Connect', 'sermon-manager-revival' ); ?></a>
				</li>
				<li>
					<strong><?php esc_html_e( 'Spotify', 'sermon-manager-revival' ); ?></strong> &mdash;
					<a href="https://podcasters.spotify.com/" target="_blank" rel="noopener noreferrer"><?php esc_html_e( 'Spotify for Podcasters', 'sermon-manager-revival' ); ?></a>
				</li>
				<li>
					<strong><?php esc_html_e( 'Amazon Music', 'sermon-manager-revival' ); ?></strong> &mdash;
					<a href="https://podcasters.amazon.com/" target="_blank" rel="noopener noreferrer"><?php esc_html_e( 'Amazon Music for Podcasters', 'sermon-manager-revival' ); ?></a>
				</li>
				<li>
					<strong><?php esc_html_e( 'iHeartRadio', 'sermon-manager-revival' ); ?></strong> &mdash;
					<a href="https://www.iheart.com/content/submit-your-podcast/" target="_blank" rel="noopener noreferrer"><?php esc_html_e( 'iHeartRadio Podcast Submission', 'sermon-manager-revival' ); ?></a>
				</li>
			</ul>
		</div>
		<?php
	}
}

return new SM_Settings_Podcast();
