<?php
/**
 * Notifications page
 *
 * @package Unagi
 */

namespace Unagi\Notifications;

use const Unagi\Constants\USER_META_KEY;
use function Unagi\Utils\required_capability;
use function Unagi\Utils\show_notifications_nicely;
use \DOMDocument as DOMDocument;
use \DOMXPath as DOMXPath;

/**
 * Setup routine
 */
function setup() {
	$n = function ( $function ) {
		return __NAMESPACE__ . "\\$function";
	};

	add_action( 'admin_menu', $n( 'add_notification_page' ) );
}

/**
 * Add notification page under the dashboard
 */
function add_notification_page() {

	$menu_title = esc_html__( 'Notifications', 'unagi' );

	/**
	 * Don't need to display count if we are not showing the output in the nice way
	 */
	if ( show_notifications_nicely() ) {
		$notification_info = prepare_notification_info();
		if ( $notification_info['count'] > 0 ) {
			$menu_title .= sprintf( '<span class="update-plugins"><span class="update-count">%d</span></span>', absint( $notification_info['count'] ) );
		}
	}

	add_dashboard_page(
		esc_html__( 'Notifications', 'unagi' ),
		$menu_title,
		required_capability(),
		'notification',
		__NAMESPACE__ . '\notification_screen'
	);
}

/**
 * Notification page
 */
function notification_screen() {
	global $unagi_nags;

	$output = $unagi_nags;

	if ( show_notifications_nicely() ) {
		$notification_info = prepare_notification_info();

		$output = $notification_info['content'];

	}

	if ( empty( $output ) ) {
		$output = sprintf(
			'<div class="notice notice-success"><p>%s</p></div>',
			esc_html__( 'Woohoo! There aren\'t any notifications for you.', 'unagi' )
		);
	}

	$output = apply_filters( 'unagi_notification_output', $output );

	?>
	<div class="wrap">
		<h1><?php esc_html_e( 'Notifications', 'unagi' ); ?></h1>
		<div id="unagi-notification-center">
			<?php echo $output; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
		</div>
	</div>
	<?php
}

/**
 * Prepare notification info by parsing buffered output
 *
 * @return array
 * @since 0.1.0
 */
function prepare_notification_info() {
	$notification = get_user_meta( get_current_user_id(), USER_META_KEY, true );

	$notification_content = ( isset( $notification['content'] ) ? $notification['content'] : '' );

	if ( function_exists( 'mb_encode_numericentity' ) ) {
		$convmap              = array( 0x80, 0x10ffff, 0, 0xffffff ); // Range of characters to convert
		$notification_content = mb_encode_numericentity( $notification_content, $convmap, 'UTF-8' );
	}

	if ( empty( $notification_content ) ) {
		return [
			'count'   => 0,
			'content' => '',
		];
	}

	$doc = new DOMDocument( '1.0', 'UTF-8' );
	libxml_use_internal_errors( true );
	$doc->loadHTML( $notification_content );
	$xpath = new DOMXPath( $doc );

	/**
	 * Don't care if the notices don't respect default "notice" classes.
	 * But adding a filter just in case someone else needed
	 *
	 * @since 0.1.0
	 */
	$expression = apply_filters( 'unagi_xpath_expression', "//*[contains(@class, 'notice ') or contains(@class, ' notice') ]" );
	$nodes      = $xpath->query( $expression ); // notification nodes

	$collector = new DOMDocument( '1.0', 'UTF-8' );

	$count = (int) $nodes->length;

	foreach ( $nodes as $node ) {
		$collector->appendChild( $collector->importNode( $node, true ) );
	}

	$content = trim( $collector->saveHTML() );

	return [
		'count'   => $count,
		'content' => $content,
	];
}
