<?php
/*
 * Plugin Name: DFM Wordpress Helpers
 * Plugin URI:  https://github.com/dfmedia/dfm-php-debugger
 * Description: This plugin will turn on a collection of PHP debugging
 * Version:     0.2
 * Author:      Kevin Graves
 * License:     GPL2
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 */

// don't allow direct access to this file
if ( ! defined( 'ABSPATH' ) ) {
        die( 'Goodbye' );
}

/**
 * Enable Kilt debuggger helper for pretty variable debugging
 *
 * Example Usage: <?php Kint::dump( $var-to-dump ); ?>
*/
$THIS_PATH = plugin_dir_path( __FILE__ );
require_once( $THIS_PATH . '/kint/Kint.class.php' );
Kint::$theme = 'solarized';


/**
 * Fix Photon CDN Urls for local Dev
 *
 * Photon will try to use your local dev URL to fetch images from, this
 *  code will replace the local dev url with production.
*/
function cdn_local_dev_url_replace ( $cdn_domain, $image_url ) {
	$replaced_image_url = str_replace("twincities.local", "twincities.com", $image_url);
	$full_url = $cdn_domain.$image_url;

	return $full_url;

}
add_filter( 'jetpack_photon_domain', 'cdn_local_dev_url_replace', 10, 2);
