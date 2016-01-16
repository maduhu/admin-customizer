<?php
/**
 * Fired when the plugin is uninstalled.
 *
 * @package Admin_Customizer
 */

// If uninstall not called from WordPress, then exit.
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	exit;
}

// Define uninstall functionality here.
delete_option( 'adns_options' );
