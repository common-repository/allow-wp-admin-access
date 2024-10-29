<?php
/**
 *
 * This plugin provides the ability to only allow "wp-admin" access from mention ip.
 *
 * @since             1.0.2
 * @package          Allow wp-admin access
 *
 * @wordpress-plugin
 * Plugin Name:       Allow wp-admin access
 * Plugin URI:        http://www.brainvire.com
 * Description:       This plugin provides the ability to only allow "wp-admin" access from mention ip.
 * Version:           1.0.2
 * Author:            brainvireinfo
 * Author URI:        http://www.brainvire.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

// Make sure we don't expose any info if called directly.
if ( ! function_exists( 'add_action' ) ) {
	echo 'Hi there!  I\'m just a plugin, not much I can do when called directly.';
	exit;
}

define( 'AWA_ADMINPAGE_URL', 'awa-wp-admin-option-page' );
define( 'AWA_CURRENT_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
require_once AWA_CURRENT_PLUGIN_DIR . 'class-allow-wp-admin-access-setup-action.php';

/**
 *Add link for settings
*/
add_filter( 'plugin_action_links', 'awpaa_admin_settings', 10, 4 );

/**
 * Add the Setting Links
 *
 * @since 1.0.2
 * @name awpaa_admin_settings
 * @param array  $actions actions.
 * @param string $plugin_file plugin file name.
 * @return $actions
 * @author Brainvire <https://www.brainvire.com/>
 * @link https://www.brainvire.com/
 */
function awpaa_admin_settings( $actions, $plugin_file ) {
	static $plugin;
	if ( ! isset( $plugin ) ) {
		$plugin = plugin_basename( __FILE__ );
	}
	if ( $plugin === $plugin_file ) {
		$settings = array();
		$settings['settings']         = '<a href="' . esc_url( admin_url( 'admin.php?page=awa-wp-admin-option-page' ) ) . '">' . esc_html__( 'Settings', 'disable-wp-user-login' ) . '</a>';
		$actions                      = array_merge( $settings, $actions );
	}
	return $actions;
}
