<?php
/**
 * Admin Customizer WordPress Plugin
 *
 * @package   Admin_Customizer
 * @author    Nilambar Sharma<nilambar@outlook.com>
 * @license   GPL-2.0+
 * @link      http://nilambar.net
 * @copyright 2013 Nilambar Sharma
 *
 * @wordpress-plugin
 * Plugin Name:       Admin Customizer
 * Plugin URI:        http://www.nilambar.net/2013/11/admin-customizer-wordpress-plugin.html
 * Description:       This plugin allows you to customize the admin interface of your WordPress site.  Several options are available in a single plugin.
 * Version:           1.1.4
 * Author:            Nilambar Sharma
 * Author URI:        http://www.nilambar.net/
 * Text Domain:       admin-customizer
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Define.
define( 'ADMIN_CUSTOMIZER_PLUGIN_FILE', __FILE__ );
define( 'ADMIN_CUSTOMIZER_PLUGIN_BASENAME', plugin_basename( __FILE__ ) );
define( 'ADMIN_CUSTOMIZER_PLUGIN_URL', rtrim( plugin_dir_url( __FILE__ ), '/' ) );
define( 'ADMIN_CUSTOMIZER_PLUGIN_URI', rtrim( plugin_dir_path( __FILE__ ), '/' ) );

// Load files.
require_once 'npf-framework/init.php';
require_once 'inc/plugin-options.php';

/**
 * Main Class.
 */
class AdminCustomizer {

    /**
     * Plugin options.
     *
     * @var string
     * @since 2.0.0
     */
    private $options = array();

    /**
     * Constructor.
     *
     * @since 2.0.0
     */
    function __construct() {

        $this->options = adns_get_options();

        $this->init_hooks();

    }

    /**
     * Hook into actions and filters.
     *
     * @since 2.0.0
     * @access private
     */
    private function init_hooks() {
        // register_activation_hook( __FILE__, array( 'DemoBar_Install', 'install' ) );
        add_action( 'init', array( $this, 'init' ), 0 );

        // Add settings link in plugin listing.
        $plugin = plugin_basename( __FILE__ );
        add_filter( 'plugin_action_links_' . $plugin, array( $this, 'add_settings_link' ) );

    }
    /**
     * Plugin init.
     *
     * @since 2.0.0
     */
    function init() {
        // Load plugin text domain.
        load_plugin_textdomain( 'admin-customizer', false, basename( dirname( __FILE__ ) ) . '/languages' );
    }

    /**
     * Links in plugin listing.
     *
     * @since 2.0.0
     *
     * @param array $links Array of links.
     * @return array Modified array of links.
     */
    public function add_settings_link( $links ) {
        $url = add_query_arg( array(
            'page' => 'admin-customizer',
            ),
            admin_url( 'options-general.php' )
        );
        $settings_link = '<a href="' . esc_url( $url ) . '">' . __( 'Settings', 'admin-customizer' ) . '</a>';
        array_unshift( $links, $settings_link );
        return $links;
    }

}

$admin_customizer = new AdminCustomizer();
// nspre($admin_customizer);
