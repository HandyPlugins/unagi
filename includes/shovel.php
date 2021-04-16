<?php
/**
 * Shovels the nags with the buffer and saves to user meta
 *
 * `Everyday I'm shoveling...`
 *
 * @package Unagi
 */

namespace Unagi\Shovel;

use const Unagi\Constants\USER_META_KEY;
use function Unagi\Utils\show_notifications_nicely;

// phpcs:disable WordPress.WhiteSpace.PrecisionAlignment.Found

/**
 * Setup routine
 */
function setup() {
	$n = function ( $function ) {
		return __NAMESPACE__ . "\\$function";
	};

	add_action( 'admin_notices', $n( 'start_shoveling' ), PHP_INT_MIN );
	add_action( 'admin_notices', $n( 'stop_shoveling' ), PHP_INT_MAX );
}

/**
 * Start buffering for the `admin_notices` hook
 */
function start_shoveling() {
	if ( ! is_shoveling() ) {
		return;
	}

	ob_start();
}

/**
 * Fetch/Process buffered data
 */
function stop_shoveling() {
	global $unagi_nags;

	if ( ! is_shoveling() ) {
		return;
	}

	$buffer = ob_get_clean();

	/**
	 * Don't remove script/styles if any
	 * Plugins always intend to do weird things!!1
	 * Such as injecting CSS/JS with admin notices :facepalm:
	 */
	preg_match_all( '@<(script|style)[^>]*?>.*?</\\1>@si', $buffer, $inline_output );

	if ( ! empty( $inline_output[0] ) ) {
		foreach ( $inline_output[0] as $inline_script ) {
			echo $inline_script;  // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		}
	}

	$unagi_nags = trim( preg_replace( '@<(script|style)[^>]*?>.*?</\\1>@si', '', $buffer ) );

	if ( ! show_notifications_nicely() ) {
		return;
	}

	$hash          = hash( 'sha256', $unagi_nags );
	$notifications = get_user_meta( get_current_user_id(), USER_META_KEY, true );

	if ( isset( $notifications['hash'] ) && $notifications['hash'] === $hash ) {
		return;
	}

	$content = ( isset( $notifications['content'] ) ? $notifications['content'] : '' );
	$diff    = str_replace( $content, '', $unagi_nags );

	/**
	 * Some plugins add can add notifications to particular pages only.
	 * Since the message does not always appear, it might not get displayed on the notifications screen.
	 *
	 * `Eg: akismet adds settings banner to plugins and comments page. Should we display it?`
	 *
	 * The diff won't be displayed by default. I think plugins needs to add a better "onboarding" experience
	 * if they need some input from the user.
	 */
	if ( $diff && apply_filters( 'unagi_show_diff', false ) ) {
		echo $diff; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}

	/**
	 * Update user meta only when the content changes
	 */
	update_user_meta(
		get_current_user_id(),
		USER_META_KEY,
		[
			'hash'    => $hash,
			'content' => $unagi_nags,
		]
	);
}

/**
 * Shovel this page?
 *
 * @return bool
 */
function is_shoveling() {
	$current_screen = get_current_screen();
	$is_shoveling   = true;

	/**
	 * Dirty way to make it work with WooCommerce setup wizard
	 * It is what it is!!!...
	 */
	if ( ! empty( $current_screen ) && false !== stripos( $current_screen->base, 'woocommerce' ) ) {
		$is_shoveling = false;
	}

	return (bool) apply_filters( 'unagi_is_shoveling', $is_shoveling );
}
