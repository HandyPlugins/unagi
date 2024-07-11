<?php
/**
 * Plugin Name:       Unagi
 * Plugin URI:        https://github.com/HandyPlugins/unagi
 * Description:       Unagi clean-up your WordPress notices from the dashboard and show them under the "Notifications" pages.
 * Version:           0.2.1
 * Requires at least: 5.0
 * Requires PHP:      5.6
 * Author:            HandyPlugins
 * Author URI:        https://handyplugins.co/
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       unagi
 * Domain Path:       /languages
 *
 * @package           Unagi
 */

namespace Unagi;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

// Useful global constants.
define( 'UNAGI_VERSION', '0.2.1' );
define( 'UNAGI_URL', plugin_dir_url( __FILE__ ) );
define( 'UNAGI_PATH', plugin_dir_path( __FILE__ ) );
define( 'UNAGI_INC', UNAGI_PATH . 'includes/' );

// Include files.
require_once UNAGI_INC . 'constants.php';
require_once UNAGI_INC . 'utils.php';
require_once UNAGI_INC . 'core.php';
require_once UNAGI_INC . 'shovel.php';
require_once UNAGI_INC . 'notifications.php';

// Require Composer autoloader if it exists.
if ( file_exists( UNAGI_PATH . 'vendor/autoload.php' ) ) {
	require_once UNAGI_PATH . 'vendor/autoload.php';
}

add_action( 'plugins_loaded', __NAMESPACE__ . '\unagi_run' );

/**
 * Get prepared! U(N) - NAG - I
 *
 * @see  https://giphy.com/gifs/friends-tv-ubpB6XcvpYMF2
 * @link https://www.urbandictionary.com/define.php?term=Unagi
 */
function unagi_run() {
	if ( ! current_user_can( Utils\required_capability() ) ) {
		return;
	}
	// Bootstrap.
	Core\setup();
	Shovel\setup();
	Notifications\setup();
}

