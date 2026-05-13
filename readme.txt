# Sermon Manager Revival #
Contributors: wpforchurch, jasonmwestbrook, jlpurvis1982
Tags: church, sermon, sermons, preaching, podcasting
Requires at least: 6.0
Tested up to: 6.9
Requires PHP: 7.4
Stable tag: 2026.5.5
License: GPLv2  
License URI: https://www.gnu.org/licenses/gpl-2.0.html

Add audio and video sermons, manage speakers, series, and more to your church website.

## Description ##

### Sermon Manager Revival ###

Sermon Manager Revival is designed to help churches easily publish sermons online. Some of the features include:

* Add Speakers, Series, Topics, Books, and Service Types
* Attach images to sermons, series, speakers, and topics
* Attach MP3 files as well as PDF, DOC, PPT (or any other type!)
* Bible references integrated via Bib.ly for easy text viewing
* Completely integrated with WordPress search
* Embed video from popular providers such as Vimeo or YouTube
* Full-featured API for developers (check it out at `/wp-json/wp/v2/wpfc_sermon`)
* Full-featured iTunes podcasting support for all sermons, plus each sermon series, preachers, sermon topics, or book of the Bible!
* Import sermons from other WordPress plugins
* PHP 7.4+ compatible
* PHP 8.x ready — Sermon Manager Revival is compatible with the latest PHP versions
* Super flexible shortcode system
* Supports 3rd party plugins such as Yoast SEO, Jetpack, etc
* Quick and professional *free* and paid support
* Works with any theme and can be customized to display just the way you like. You’ll find the template files in the `/views` folder. You can copy these into the root of your theme folder and customize to suit your site’s design.

### One-Click Importing ###

Sermon Manager supports migration/importing from other popular sermon plugins, such as Sermon Browser and Series Engine.

This is a one click process and currently only supports migration/importing within existing WordPress installations.
Soon you will be able to migrate from those 3rd party plugins to Sermon Manager Revival on a separate server. (for example: moving to completely new website & WordPress installation)

### Popular Shortcodes ###

* `[sermons]` — This will list the 10 most recent sermons.
* `[sermons per_page="20"]` — This will list the 20 most recent sermons.
* `[sermon_images]` — This will list all sermon series and their associated image in a grid.
* `[list_podcasts]` — This will list available podcast services with nice large buttons.
* `[list_sermons]` — This will list all series or speakers in a simple unordered list.
* `[latest_series]` — This will display information about the latest sermon series, including the image, title (optional), and description (optional).
* `[sermon_sort_fields]` — Dropdown selections to quickly navigate to all sermons in a series or by a particular speaker.

For more information on each of these shortcodes please visit the [GitHub repository](https://github.com/TheologyAIGeek/Sermon-Manager).

### Contributing ###

Bug reports and pull requests are welcome via [GitHub](https://github.com/TheologyAIGeek/Sermon-Manager).

Please read the [contributing guidelines](https://github.com/TheologyAIGeek/Sermon-Manager/blob/dev/.github/CONTRIBUTING.md) before submitting.

## Installation ##

Installation is simple:

1. Just use the “Add New” button in Plugin section of your WordPress blog’s Control panel. To find the plugin there, search for `Sermon Manager Revival`
2. Activate the plugin
3. Add a sermon through the Dashboard
4. To display the sermons on the frontend of your site, just visit the `http://yourdomain.com/sermons` if you have pretty permalinks enabled or `http://yourdomain.com/?post_type=wpfc_sermon` if not. Or you can use the shortcode `[sermons]` in any page.

## Frequently Asked Questions ##

### How do I display sermons on the frontend? ###

Visit the `http://yourdomain.com/sermons` if you have pretty permalinks enabled or `http://yourdomain.com/?post_type=wpfc_sermon` if not. Or you can use the shortcode `[sermons]` in any page or post.

### How do I create a menu link? ###

Go to Appearance → Menus. In the “Custom Links” box add `http://yourdomain.com/?post_type=wpfc_sermon` as the URL and `Sermons` as the label and click “Add to Menu”.

### Have a suggestion? ###

Open an issue on [GitHub](https://github.com/TheologyAIGeek/Sermon-Manager/issues) — we welcome feedback and ideas.

## Changelog ##
### 2026.5.5 ###
* Feature: Modernize podcast feature — remove dead integrations, add Spotify and Podcasting 2.0 support
* Remove: FeedBurner references from podcast settings (service is dead)
* Remove: Android subscription URL field (subscribeonandroid.com is shut down)
* Remove: HTTP-only enforcement on enclosure URLs (outdated RSS 2.0 spec clause; all modern directories require HTTPS)
* Remove: HTTP stripping from audio and cover image URLs in feed output
* Remove: Dead Sermon Manager Pro category branch from feed template
* Fix: Update PodTrac redirect prefix from HTTP to HTTPS (https://dts.podtrac.com/redirect.mp3/)
* Fix: Update all iTunes branding to Apple Podcasts throughout settings labels and descriptions
* Fix: Update cover image description with correct Apple Podcasts and Spotify size requirements
* Fix: Update Feed Validator link from dead feedvalidator.org to podcastpage.io/podcast-validator
* Fix: Replace dead Apple iTunes submission links with Apple Podcasts Connect and Spotify for Podcasters
* Add: podcast and spotify XML namespaces to RSS feed element
* Add: podcast:guid channel element (stable UUID auto-generated on first use, per Podcasting 2.0 spec)
* Add: spotify:countryOfOrigin channel element (configurable ISO country code, defaults to US)
* Add: Country of Origin setting field in Podcast Settings
* Add: Spotify Podcast URL field in Directory Links settings section
* Add: Spotify subscribe button to [list_podcasts] shortcode (Spotify green, replaces android as default)
* Add: Submit to Podcast Directories section in settings with links for Apple Podcasts Connect, Spotify for Podcasters, Amazon Music, and iHeartRadio
* Change: Reorganize podcast settings into logical sections (feed settings + directory links)
* Change: Default [list_podcasts] include changed from itunes/android/overcast to itunes/spotify/overcast

### 2026.5.4 ###
* Fix: Resolve all remaining WordPress Plugin Check violations — zero errors across full plugin scan
* Fix: Add proper WP output escaping (wp_kses_post, esc_html, wp_kses) to podcast feed and sermon wrapper templates replacing phpcs:ignore annotations that Plugin Check does not honor
* Fix: Escape $custom_enclosure XML element with wp_kses() using an explicit enclosure-tag allowlist (wp_kses_post would strip non-HTML elements)
* Fix: Strip byte order mark (BOM) from views/wpfc-podcast-feed.php (Generic.Files.ByteOrderMark)
* Fix: Add phpcs:ignore annotations for PrefixAllGlobals false positives across 20+ files (sm_, SM_, wpfc_ prefixes are valid but not recognised by PHPCS without a ruleset)
* Fix: Add NonceVerification phpcs:ignore to admin settings handler read-only GET checks
* Fix: Add UnescapedDBParameter phpcs:ignore to export class raw SQL query
* Fix: Broaden post__not_in sniff ignore to WordPressVIPMinimum.Performance.WPQueryParams in shortcodes class
* Fix: Add missing NonPrefixedFunctionFound ignore to process_wysiwyg_output() in sm-template-functions.php
* New: Add optional Spotify Episode Link URL field to the Sermon Files metabox on the sermon edit screen
* New: Display a branded Listen on Spotify button (dark pill with Spotify logo, turns green on hover) below the audio player on the sermon single page when a Spotify link is provided; outputs nothing when the field is left blank

### 2026.5.3 ###
* Fix: Escape output in sermons.php — phpcs:ignore on inline JS printf(), wrap wp_sprintf() in wp_kses_post()
* Fix: Add ABSPATH direct file access protection to all view templates
* Fix: Exclude .distignore, phpcs.xml.dist, and phpunit.xml.dist from release ZIP
* Fix: Update "Tested up to" to WordPress 6.9 in plugin header and readme
* Fix: Trim readme.txt tags to the required maximum of 5

### 2026.5.2 ###
* Security: Add $wpdb->prepare() placeholders to all raw SQL queries (SQL injection prevention)
* Security: Add output escaping (esc_html, esc_attr, esc_url, wp_kses_post) throughout admin and frontend views
* Security: Add nonce verification and current_user_can() checks to all form-handling functions
* Security: Replace unserialize(base64_decode()) with is_serialized() + maybe_unserialize() (object injection prevention)
* Security: Add wp_die() in place of die() with proper escaping in settings handler
* Security: Sanitize all $_GET, $_POST, and $_REQUEST inputs with sanitize_text_field(wp_unslash()) or absint()
* Fix: Replace deprecated utf8_encode() with mb_convert_encoding() (PHP 8.2 compatibility)
* Fix: Replace deprecated wp_get_http() with wp_remote_get() + WP_Filesystem
* Fix: Replace date() with wp_date() throughout for timezone-safe output
* Fix: Change printf() to sprintf() in deprecated functions to prevent premature output
* Fix: Wrap render_wpfc_sorting() output with wp_kses_post() in all archive and taxonomy views
* Fix: Escape $additional_classes with esc_attr() in sermon wrapper template
* Fix: Replace strip_tags() with sanitize_text_field() for widget title sanitization
* Fix: Sanitize sermon date input and add nonce check in dates save handler
* Fix: Replace file_get_contents(__FILE__) version parsing with get_file_data() for efficiency
* Fix: Remove dead PHP 4 __autoload compatibility block (removed in PHP 8.0)
* Fix: Gate SM_Roles::init() behind version check to prevent redundant add_cap() calls on every page load
* Fix: Add callback whitelist guard in background updater before call_user_func()
* Fix: Add missing text domain to translated strings in admin post types
* Fix: Replace _e() with esc_html_e() throughout import/export admin view
* Dev: Convert all var property declarations to public (PHP 4 syntax removal)
* Dev: Refactor goto statements into standard if/else control flow

### 2026.5.1 ###
* Fork: Project forked and maintained by Jerry Purvis <jlpurvis1982@outlook.com>
* New: Add GPLv2 @copyright headers for Jerry Purvis to all first-party PHP files
* Change: Update plugin Author, Author URI, and Plugin URI to reflect new maintainer and GitHub repo
* Change: Adopt calendar versioning scheme (YYYY.M.N) starting at 2026.5.1
* Change: Remove all Premium Support and Sermon Manager Pro references from plugin row meta and settings sidebar
* Change: Update settings sidebar FAQ and support links to GitHub repo and issues
* Change: Update CONTRIBUTING.md — replace old repo links, update security email, strike through Translations section pending future update
* Change: Update readme.txt — add new contributor, remove donate link, remove outdated support/pro/WP for Church sections, point links to GitHub
* Fix: "after" parameter not working in "[sermons]" shortcode
* Fix: Improve [latest_series] shortcode

### 2.15.15 ###
* Fix: RSS feed not working

### 2.15.14 ###
* New: Add compatibility for "Pro" theme
* New: Add a setting to change default sermon ordering (in "Display" tab)
* Fix: Date filtering in shortcode
* Fix: Improve [latest_series] shortcode
* Fix: Service Type filter in backend not working when slug is different from default
* Dev: Add conditional fields in settings
* Dev: Add dynamic option retrieval in settings
* Dev: Fix select field in settings returning error when only one option is defined for it

### 2.15.13 ###
* New: Dutch translation (thanks @LeonCB!)
* New: Add support for Dunamis theme
* New: Add support for TwentyNineteen
* New: Add support for ExodosWP
* Change: Add WordPress author metabox
* Fix: Service Type not saving in quick edit

### 2.15.12 ###
* Fix: Fatal error when saving a sermon
* Fix: Podcast buttons shortcode has unnecessary left margin (thanks @macbookandrew!)

### 2.15.11 ###
* New: Add support for "The7" theme
* Change: Add "sermon" order to [sermon_images] shortcode. It will order the series by newest sermon
* Fix: Improve the speed of post saving on websites with many sermons
* Dev: Fix terms not having sermon date set

### 2.15.10 ###
* Change: Add "include" and "exclude" parameters to the shortcode
* Change: Add an option to force loading plugin views
* Fix: Edge case PHP bug in feed with taxonomy
* Fix: Notice when using shortcode

### 2.15.9 ###
* New: Add support for Hueman and Hueman Pro themes
* New: Add support for NativeChurch theme
* New: Add support for Betheme theme
* Change: Add NIV to verse Bible version
* Change: Replace series subtitle with short description in the feed
* Change: Add "action" parameter to filtering shortcode. Possible options: "none" (default), "home", "site".
* Change: Update Plyr to 3.4.7
* Fix: Notice in settings after saving a field
* Fix: Filtering arguments not working in the sermons shortcode
* Fix: Filtering not hiding

### 2.15.8 ###
* Dev: Add callable select options (pass function name as string)
* Dev: Add a way to pass custom values to settings

### 2.15.7 ###
* Fix: PHP warning when archive output is used wrongly
* Fix: Podcast items may be sorted the wrong way

### 2.15.6 ###
* Change: Disable autocomplete for date preached, since it obstructed the view on mobile
* Fix: Comments not appearing on Divi
* Fix: All podcast images are invalid

### 2.15.5 ###
* Change: Disable check for PHP output buffering

### 2.15.4 ###
* Fix: Output Buffering detected as disabled when set to 0

### 2.15.3 ###
* New: Add option to disable "views" count for editors and admins
* New: Add option to enable sermon series image fallback in the feed
* Fix: Podcast shortcode SVG icons not working in Firefox
* Fix: Getting 404 on filtering
* Fix: Sermon Manager errors out when output buffering is disabled

### 2.15.2 ###
* Change: Add Maranatha theme support
* Change: Add Saved theme support
* Change: Add Brandon theme support
* Change: Remove default default image
* Fix: Plyr not loading when Cloudflare is used
* Fix: Sermon image not showing up
* Fix: image_size argument not working in shortcode

### 2.15.1 ###
* Fix: Multi-term filter for feeds not working

### 2.15.0 ###
* New: Add ability to override Sermon Manager's CSS by putting "sermon.css" file in theme (thanks @zSeriesGuy)
* New: Add default image during installation (thanks @zSeriesGuy)
* New: Add setting for showing and hiding the filter (shortcode and archive, thanks @zSeriesGuy)
* New: Add setting for default image (thanks @zSeriesGuy)
* Change: Update Plyr to 3.4.3
* Change: Re-organized the settings, with more descriptive options
* Fix: Fix importing from Sermon Browser stopping after first sermon
* Fix: Audio file length and size not being automatically filled
* Fix: Taxonomy archive sermons ordered by date preached
* Fix: "sermon" argument not working in shortcode
* Fix: Database errors on Import/Export screen on some hosts
* Fix: Pause button not showing up when file is being played
* Fix: "Upload Image" button not working in Podcast settings
* Fix: Audio file sometime not being correct
* Fix: Add more theme support for pagination
* Fix: Image selector in settings now showing up
* Fix: Filter not working correctly in shortcode (thanks @zSeriesGuy)
* Fix: Plyr not having border
* Dev: Update function for getting sermon image to return fallback with any option

### 2.14.0 ###
* New: Finally add support for Sermon Browser bible verses
* Change: Adjust width of Title column in admin
* Change: Organize "Debug" (now "Advanced") settings
* Change: Make filters' width shorter
* Fix: Taxonomy feed URLs not picked up by Sermon Manager
* Fix: Allow deleted imported sermons to be re-imported

Note: The rest of the changelog is in changelog.txt