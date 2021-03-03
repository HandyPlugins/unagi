<?php
/**
 * Core plugin functionality.
 *
 * @package Unagi
 */

namespace Unagi\Core;

use \WP_Error as WP_Error;

/**
 * Default setup routine
 *
 * @return void
 */
function setup() {
	$n = function ( $function ) {
		return __NAMESPACE__ . "\\$function";
	};

	add_action( 'init', $n( 'i18n' ) );
	add_action( 'init', $n( 'init' ) );

	do_action( 'unagi_loaded' );
}

/**
 * Registers the default textdomain.
 *
 * @return void
 */
function i18n() {
	$locale = apply_filters( 'plugin_locale', get_locale(), 'unagi' );
	load_textdomain( 'unagi', WP_LANG_DIR . '/unagi/unagi-' . $locale . '.mo' );
	load_plugin_textdomain( 'unagi', false, plugin_basename( UNAGI_PATH ) . '/languages/' );
}

/**
 * Initializes the plugin and fires an action other plugins can hook into.
 *
 * @return void
 */
function init() {
	do_action( 'unagi_init' );
}

