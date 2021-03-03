<?php
/**
 * Uninstall Unagi
 *
 * @package Unagi
 */

// Exit if accessed directly.
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	exit;
}

global $wpdb;

// clean-up user meta
$wpdb->query( "DELETE FROM $wpdb->usermeta WHERE meta_key ='unagi_notices';" );
