<?php
/**
 * Utilities
 *
 * @package Unagi
 */

namespace Unagi\Utils;

/**
 * Determine displaying notifications nicely vs directly
 * When we show them "nicely" we parse the buffer and count notifications node from the dom
 * And we keep the count
 *
 * @return mixed|void
 * @since 0.1.0
 */
function show_notifications_nicely() {
	return apply_filters( 'unagi_show_notifications_nicely', true );
}

/**
 * Min. required capability to use this plugin
 *
 * @return mixed|void
 * @since 0.1.0
 */
function required_capability() {
	return apply_filters( 'unagi_required_capability', 'edit_posts' );
}
