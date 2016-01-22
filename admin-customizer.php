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
		add_action( 'init', array( $this, 'init' ), 0 );

		// Add settings link in plugin listing.
		$plugin = plugin_basename( __FILE__ );
		add_filter( 'plugin_action_links_' . $plugin, array( $this, 'add_settings_link' ) );

		// Admin logo URL.
		add_action( 'admin_head', array( $this, 'add_admin_logo' ) );
		add_action( 'admin_head', array( $this, 'rearrange_logout_menu' ) );
		add_action( 'admin_head', array( $this, 'custom_css' ) );
		add_action( 'login_head', array( $this, 'custom_login_css' ) );
		add_action( 'login_enqueue_scripts', array( $this, 'login_theme_loader' ) );
		// Hide admin default logo.
		add_action( 'wp_before_admin_bar_render', array( $this, 'hide_admin_logo' ) );

		// Admin bar My account customization.
		add_action( 'admin_bar_menu', array( $this, 'admin_bar_my_account_customization' ) );
		// Update footer version.
		add_filter( 'update_footer', array( $this, 'change_footer_version' ), 9999 );
		// Footer message.
		add_filter( 'admin_footer_text', array( $this, 'change_footer_text' ) );

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

	/**
	 * Admin admin logo.
	 *
	 * @since 1.0.0
	 */
	public function add_admin_logo() {

		if ( empty( $this->options['adns_admin_logo_url'] ) ) {
			return;
		}
		$url = $this->options['adns_admin_logo_url'];
		$alt_text = get_bloginfo( 'name', 'display' ) . ' ' . __( 'Admin', 'admin-customizer' );
		?>
        <script type="text/javascript">
            jQuery(document).ready(function($) {
                var image = $('<img/>', {
                    src: '<?php echo esc_url( $url ); ?>',
                    alt: '<?php echo esc_attr( $alt_text ); ?>',
                    style: 'padding-top:4px;height:25px'
                });
                var anchorlink = $('<a/>', {
                    href: '<?php echo esc_url( admin_url() ); ?>',
                    html: image,
                    title: '<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>'
                });
                jQuery('<li/>', {
                    html: anchorlink,
                    class: 'menupop'
                }).prependTo( '#wp-admin-bar-root-default' );
            });
        </script>
        <?php
	}

	/**
	 * Rearrange logout menu.
	 *
	 * @since 1.0.0
	 */
	public function rearrange_logout_menu() {

		if ( 1 !== absint( $this->options['adns_rearrange_logout_menu'] ) ) {
			return;
		}
		$sure_text = __( 'Are you sure?', 'admin-customizer' );
		?>
        <script type="text/javascript">
            jQuery(document).ready(function($) {
                var $logout = jQuery('#wp-admin-bar-user-actions li:eq(2)');
                jQuery('#wp-admin-bar-user-actions').remove();
                jQuery('#wp-admin-bar-my-account').removeClass('menupop');
                jQuery('#wp-admin-bar-my-account > a >img').remove();
                jQuery('#wp-admin-bar-my-account div.ab-sub-wrapper').remove();
                $logout.prependTo('#wp-admin-bar-top-secondary');
                <?php if ( 1 === absint( $this->options['adns_enable_logout_confirmation'] ) ) : ?>
                    $('#wp-admin-bar-logout a').click(function() {
                        var confirmation = confirm('<?php echo esc_html( $sure_text ); ?>');
                        if (confirmation) {
                            return true;
                        }
                        return false;
                    });
                <?php endif; ?>
            });
        </script>
        <?php
	}

	/**
	 * Hide default admin logo.
	 *
	 * @since 1.0.0
	 */
	public function hide_admin_logo() {
		global $wp_admin_bar;
		// Admin bar logo.
		if ( 1 === absint( $this->options['adns_hide_admin_logo'] ) ) {
			$wp_admin_bar->remove_menu( 'wp-logo' );
			$wp_admin_bar->remove_menu( 'view-site' );
		}
		// Comment popup.
		if ( 1 === absint( $this->options['adns_hide_comments_menu_header'] ) ) {
			$wp_admin_bar->remove_menu( 'comments' );
		}
		// Update notification.
		if ( 1 === absint( $this->options['adns_hide_updates_menu_header'] ) ) {
			$wp_admin_bar->remove_menu( 'updates' );
		}
	}

	/**
	 * Add the "My Account" item.
	 *
	 * @since 2.0.0
	 *
	 * @param WP_Admin_Bar $wp_admin_bar WP Admin Bar object.
	 */
	function admin_bar_my_account_customization( $wp_admin_bar ) {

		$user_id      = get_current_user_id();
		$current_user = wp_get_current_user();

		if ( ! $user_id ) {
			return;
		}

		$howdy = $current_user->display_name;
		if ( ! empty( $this->options['adns_howdy_replace'] ) ) {
			$howdy = esc_html( $this->options['adns_howdy_replace'] ) . ' ' . $howdy;
		}

		$wp_admin_bar->add_node( array(
			'id'    => 'my-account',
			'title' => $howdy,
		) );

	}

	/**
	 * Custom admin CSS.
	 *
	 * @since 2.0.0
	 */
	public function custom_css() {

		// Hide help tab.
		if ( 1 === absint( $this->options['adns_hide_help_tab'] ) ) {
			echo '<style type="text/css">#contextual-help-link-wrap { display: none !important; }</style>';
		}
		// Hide footer.
		if ( 1 === absint( $this->options['adns_hide_whole_footer'] ) ) {
			echo '<style type="text/css">#wpfooter { display:none!important; }</style>';
		}
		// Admin custom CSS.
		if ( 'CUSTOM' === esc_attr( $this->options['adns_admin_theme'] ) ) {
			if ( ! empty( $this->options['adns_custom_admin_theme_content'] ) ) {
				echo '<style>';
				echo $this->options['adns_custom_admin_theme_content'];
				echo '</style>';
			}
		}

	}

	/**
	 * Custom login CSS.
	 *
	 * @since 2.0.0
	 */
	public function custom_login_css() {

		// Login custom CSS.
		if ( 'CUSTOM' === esc_attr( $this->options['adns_login_theme'] ) ) {
			if ( ! empty( $this->options['adns_custom_login_theme_content'] ) ) {
				echo '<style>';
				echo $this->options['adns_custom_login_theme_content'];
				echo '</style>';
			}
		}

	}

	/**
	 * Change footer version content.
	 *
	 * @since 2.0.0
	 *
	 * @param string $output Footer content.
	 * @return string Modified footer content.
	 */
	public function change_footer_version( $output ) {

		$output = '';
		if ( 1 !== absint( $this->options['adns_hide_footer_version'] ) ) {
			$output .= wp_kses_post( $this->options['adns_footer_version'] );
		}
		return $output;
	}

	/**
	 * Change footer content.
	 *
	 * @since 2.0.0
	 *
	 * @param string $output Footer content.
	 * @return string Modified footer content.
	 */
	public function change_footer_text( $output ) {

		$output = '';
		if ( 1 === absint( $this->options['adns_hide_footer_text'] ) ) {
			return $output;
		}

		if ( ! empty( $this->options['adns_footer_logo'] ) ) {
			$output = '<img src="' . esc_url( $this->options['adns_footer_logo'] ) . '" alt="" class="adns-footer-logo" />';
		}
		$output .= wp_kses_post( $this->options['adns_footer_text'] );
		return $output;
	}

	/**
	 * Login theme loader.
	 *
	 * @since 2.0.0
	 */
	public function login_theme_loader() {
		$theme = strtolower( esc_attr( $this->options['adns_login_theme'] ) );
		wp_enqueue_style( 'adns-login-theme', plugins_url( "css/login-theme/$theme.css", __FILE__ ) );
	}
}

$admin_customizer = new AdminCustomizer();
