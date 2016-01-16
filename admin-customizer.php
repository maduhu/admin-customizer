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

define('AC_BASENAME', plugin_basename(__FILE__));
define('AC_BASEFOLDER', plugin_basename(dirname(__FILE__)));
define('AC_FILENAME', str_replace(AC_BASEFOLDER . '/', '', plugin_basename(__FILE__)));

class AdminCustomizer
{

    private $version = '1.1.4';
    private $wpversion;
    private $hook_settings_page;
    private $defaults = array(
        'adns_admin_logo_url' => '',
        'adns_hide_admin_logo' => 1,
        'adns_hide_update_nagging_bar' => 1,
        'adns_howdy_replace' => 'Welcome,',
        'adns_hide_adminbar_for_nonadmin' => 1,
        'adns_hide_help_tab' => 1,
        'adns_rearrange_logout_menu' => 1,
        'adns_enable_logout_confirmation' => 1,
        'adns_hide_comments_menu_header' => 1,
        'adns_hide_updates_menu_header' => 1,
        'adns_login_logo_url' => '',
        'adns_login_background_color' => '',
        'adns_login_background_url' => '',
        'adns_hide_whole_footer' => 0,
        'adns_footer_version' => '',
        'adns_hide_footer_version' => 1,
        'adns_hide_footer_text' => 0,
        'adns_footer_text' => 'All Rights Reserved &copy;',
        'adns_footer_logo' => '',
        'adns_no_of_columns_available_in_dashboard' => 2,
        'remove_dashboard_widget_normal_core_dashboard_plugins' => 1,
        'remove_dashboard_widget_normal_core_dashboard_recent_comments' => 1,
        'remove_dashboard_widget_side_core_dashboard_primary' => 1,
        'remove_dashboard_widget_normal_core_dashboard_incoming_links' => 1,
        'remove_dashboard_widget_side_core_dashboard_secondary' => 1,
        'remove_dashboard_widget_side_core_dashboard_recent_drafts' => 1,
        'remove_dashboard_widget_side_core_dashboard_quick_press' => 1,
        'remove_dashboard_widget_normal_core_dashboard_activity' => 1,
        'remove_dashboard_widget_normal_core_dashboard_right_now' => 0,
        'adns_default_email_address_name' => '',
        'adns_default_email_address_email' => '',
        'adns_remove_contact_method_aim' => 1,
        'adns_remove_contact_method_yim' => 1,
        'adns_remove_contact_method_jabber' => 1,

        'adns_max_revision_count' => '',
        'adns_add_custom_dashboard_widget_onoff' => '',
        'adns_my_custom_dashboard_widget_content' => '',
        'adns_my_custom_dashboard_widget_title' => '',

        'adns_admin_theme' => '-1',
        'adns_login_theme' => '-1',
        'adns_custom_admin_theme_content' => '',
        'adns_custom_login_theme_content' => '',
    );
    private $options = array();

    protected $plugin_slug = 'admin-customizer';

    /* --------------------------------------------*
     * Constructor
     * -------------------------------------------- */

    /**
     * Initializes the plugin
     */
    function __construct()
    {

        //initialization
        global $wp_version;
        $this->wpversion = $wp_version;

        //
        $this->hook_settings_page = 'settings_page_'. $this->plugin_slug;

        // Load plugin text domain
        add_action('init', array($this, 'plugin_textdomain'));

        // Register admin styles and scripts
        add_action('admin_enqueue_scripts', array($this, 'register_admin_styles'));
        add_action('admin_enqueue_scripts', array($this, 'register_admin_scripts'));
        //
        // Register site styles and scripts
        add_action('wp_enqueue_scripts', array($this, 'register_plugin_styles'));
        add_action('wp_enqueue_scripts', array($this, 'register_plugin_scripts'));

        // Register hooks that are fired when the plugin is activated and deactivated.
        register_activation_hook(__FILE__, array($this, 'activate'));
        register_deactivation_hook(__FILE__, array($this, 'deactivate'));

        //register setting
        add_action( 'admin_init', array( $this, 'admin_customizer_register_settings' ) );

        //Add menu in sidebar
        add_action('admin_menu', array($this, 'admin_customizer_admin_menu'));


        //get current options
        $this->_getCurrentOptions();

        //call customizer Actions
        $this->_customizerActions();

        $plugin = plugin_basename(__FILE__);
        add_filter("plugin_action_links_$plugin", array($this, 'adns_plugin_add_settings_link'));

        if ($this->options['adns_max_revision_count'] && strlen($this->options['adns_max_revision_count']))
        {
            if (!defined('WP_POST_REVISIONS'))
            {
                define('WP_POST_REVISIONS', $this->options['adns_max_revision_count']);
            }
        }
        if ($this->options['adns_admin_theme'] && $this->options['adns_admin_theme'] != '-1'){
            if($this->options['adns_admin_theme'] != 'CUSTOM'){
                add_action('admin_enqueue_scripts', array($this, 'adns_admin_theme_loader') );
            }
            else{
                add_action('admin_head', array($this,'adns_custom_admin_theme_content_loader'));
            }
        }

        if ($this->options['adns_login_theme'] && $this->options['adns_login_theme'] != '-1'){
            if($this->options['adns_login_theme'] != 'CUSTOM'){
                add_action('login_enqueue_scripts', array($this, 'adns_login_theme_loader') );
            }
            else{
                add_action('login_head', array($this,'adns_custom_login_theme_content_loader'));
            }
        }
    }

    /**
     * Fired when the plugin is activated.
     */
    public function activate()
    {
        //Define activation functionality here
        $this->_setDefaultOptions();
    }

    /**
     * Fired when the plugin is deactivated.
     */
    public function deactivate()
    {
        //Define deactivation functionality here
        //$this->_removePluginOptions();
    }

    /**
     * Loads the plugin text domain for translation
     */
    public function plugin_textdomain()
    {
        load_plugin_textdomain($this->plugin_slug,  false, dirname(plugin_basename(__FILE__)) . '/languages');
    }

    /**
     * Registers and enqueues admin-specific styles.
     */
    public function register_admin_styles($hook)
    {

        if ($hook != $this->hook_settings_page)
        {
            return;
        }
        wp_enqueue_style($this->plugin_slug.'-admin-styles', plugins_url($this->plugin_slug.'/css/admin.css'));
    }

    /**
     * Registers and enqueues admin-specific JavaScript.
     */
    public function register_admin_scripts($hook)
    {

        if ($hook != $this->hook_settings_page)
        {
            return;
        }
        wp_enqueue_style('thickbox');
        wp_enqueue_script('media-upload');
        wp_enqueue_script('thickbox');

        wp_enqueue_style( 'wp-color-picker' );

        wp_enqueue_script('admin-customizer-admin-script-easytab', plugins_url('/js/jquery.easytabs.min.js', __FILE__ ), array('jquery'));
        wp_enqueue_script('admin-customizer-admin-script-hashchange', plugins_url('/js/jquery.hashchange.min.js', __FILE__ ), array('jquery','admin-customizer-admin-script-easytab'));
        wp_enqueue_script('admin-customizer-admin-script', plugins_url('/js/admin.js', __FILE__ ), array('jquery', 'wp-color-picker','admin-customizer-admin-script-hashchange'));
    }

    /**
     * Registers and enqueues plugin-specific styles.
     */
    public function register_plugin_styles()
    {
        //wp_enqueue_style($this->plugin_slug.'-plugin-styles', plugins_url($this->plugin_slug.'/css/display.css'));
    }

    /**
     * Registers and enqueues plugin-specific scripts.
     */
    public function register_plugin_scripts()
    {
        //wp_enqueue_script($this->plugin_slug.'-plugin-script', plugins_url($this->plugin_slug.'/js/display.js'), array('jquery'));
    }

    /* --------------------------------------------*
     * Core Functions
     * --------------------------------------------- */

    public function admin_customizer_admin_menu()
    {
        add_options_page('Admin Customizer', 'Admin Customizer', 'manage_options',$this->plugin_slug, array($this, 'admin_customizer_admin_settings_plugin_page'));
    }

    public function admin_customizer_register_settings()
    {
        register_setting($this->plugin_slug.'-options-group', 'adns_options', array($this, 'adns_validate_options'));
    }

    ////////////////////////////////////////////////////////////////////////////////////////////////////
    public function admin_customizer_admin_settings_plugin_page()
    {
        if (!current_user_can('manage_options'))
        {
            wp_die(__('You do not have sufficient permissions to access this page.'));
        }

        $options = $this->options;

        extract($options);
        require_once( ( plugin_dir_path(__FILE__) ) . '/views/admin.php');
    }

    public function adns_plugin_add_settings_link($links)
    {
        $settings_link = '<a href="options-general.php?page='.$this->plugin_slug.'">' . __("Settings", $this->plugin_slug) . '</a>';
        array_push($links, $settings_link);
        return $links;
    }

    //
    /* --------------------------------------------*
     * Extra Functions
     * --------------------------------------------- */

    //get default options and saves in options table
    private function _setDefaultOptions()
    {
        if( !get_option( 'adns_options' ) ) {
            update_option('adns_options', $this->defaults);
        }
    }

    //remove all options from database
    private function _removePluginOptions()
    {
        delete_option('adns_options');
    }

    //
    private function _getCurrentOptions()
    {

        $adns_options = get_option('adns_options', $this->defaults);
        $this->options = $adns_options;
    }

    //
    private function _customizerActions()
    {

        /*         * * HEADER STARTS ** */
        //admin logo url
        add_action('admin_head', array($this, 'add_admin_logo'));

        //replace howdy
        add_filter('admin_bar_menu', array($this, 'replace_howdy'), 25);
        //
        if ($this->options['adns_hide_admin_logo'] == 1)
        {
            add_action('wp_before_admin_bar_render', array($this, 'hide_admin_logo'));
        }
        //
        if ($this->options['adns_hide_comments_menu_header'] == 1)
        {
            add_action('wp_before_admin_bar_render', array($this, 'hide_comments_menu_header'));
        }
        //
        if ($this->options['adns_hide_updates_menu_header'] == 1)
        {
            add_action('wp_before_admin_bar_render', array($this, 'hide_updates_menu_header'));
        }
        //hide help tab
        if ($this->options['adns_hide_help_tab'] == 1)
        {
            add_action('admin_head', array($this, 'hide_help_tab'));
        }
        //
        if ($this->options['adns_rearrange_logout_menu'] == 1)
        {
            add_action('admin_head', array($this, 'rearrange_logout_menu'));
        }
        /*         * * HEADER ENDS ** */

        /*         * * LOGIN STARTS ** */
        if ($this->options['adns_login_logo_url'] != '')
        {
            add_action('login_head', array($this, 'replace_login_logo'));
            add_filter('login_headerurl', array($this, 'change_login_logo_url_link'));
            add_filter('login_headertitle', array($this, 'change_login_logo_url_title'));
        }
        add_action('login_head', array($this, 'adns_background_change_fn'));

        //
        /*         * * LOGIN ENDS ** */

        //
        //hide admin bar for non admin
        if ($this->options['adns_hide_adminbar_for_nonadmin'] == 1)
        {
            add_action('show_admin_bar', array($this, 'hide_adminbar_for_nonadmin'));
        }
        /*         * * FOOTER STARTS ** */
        if ($this->options['adns_hide_whole_footer'] == 1)
        {

            add_filter('admin_head', array($this, 'hide_whole_footer'));
        }
        else
        {
            //admin footer version
            add_filter('update_footer', array($this, 'change_footer_version'), 9999);
            //
            //admin footer message
            add_filter('admin_footer_text', array($this, 'change_footer_text'));
        }
        /*         * * FOOTER ENDS ** */

        /*         * * DASHBOARD STARTS ** */
        add_filter('screen_layout_columns', array($this, 'change_number_of_screen_columns_available'));
        //
        add_action('wp_dashboard_setup', array($this, 'remove_dashboard_widgets'));
        //
        if ($this->options['adns_add_custom_dashboard_widget_onoff'] == 1)
        {
            add_action('wp_dashboard_setup', array($this, 'add_custom_dashboard_widgets'));
        }
        add_action( 'admin_init', array($this, 'hide_update_nagging_bar' ) );
        /*         * * DASHBOARD ENDS ** */

        /*         * * OTHER STARTS ** */
        if ($this->options['adns_default_email_address_email'] != '')
        {
            add_filter('wp_mail_from', array($this, 'new_mail_from_email'));
        }
        if ($this->options['adns_default_email_address_name'] != '')
        {
            add_filter('wp_mail_from_name', array($this, 'new_mail_from_name'));
        }
        //
        add_filter('user_contactmethods', array($this, 'user_contactmethods_fn'));
        /*         * * OTHER ENDS ** */
    }

    public function new_mail_from_email($old)
    {
        return $this->options['adns_default_email_address_email'];
    }

    public function new_mail_from_name()
    {
        return $this->options['adns_default_email_address_name'];
    }

    public function user_contactmethods_fn($methods)
    {
        if ($this->options['adns_remove_contact_method_aim'] == 1)
        {
            unset($methods['aim']);
        }
        if ($this->options['adns_remove_contact_method_yim'] == 1)
        {
            unset($methods['yim']);
        }
        if ($this->options['adns_remove_contact_method_jabber'] == 1)
        {
            unset($methods['jabber']);
        }
        return $methods;
    }

    public function adns_validate_options($input)
    {
        //validation stuff here

        /*         * header* */
        if (!isset($input['adns_hide_admin_logo']))
            $input['adns_hide_admin_logo'] = 0;
        if (!isset($input['adns_hide_comments_menu_header']))
            $input['adns_hide_comments_menu_header'] = 0;
        if (!isset($input['adns_hide_updates_menu_header']))
            $input['adns_hide_updates_menu_header'] = 0;
        if (!isset($input['adns_hide_adminbar_for_nonadmin']))
            $input['adns_hide_adminbar_for_nonadmin'] = 0;
        if (!isset($input['adns_hide_help_tab']))
            $input['adns_hide_help_tab'] = 0;
        if (!isset($input['adns_hide_update_nagging_bar']))
            $input['adns_hide_update_nagging_bar'] = 0;
        if (!isset($input['adns_rearrange_logout_menu']))
            $input['adns_rearrange_logout_menu'] = 0;
        if (!isset($input['adns_enable_logout_confirmation']))
            $input['adns_enable_logout_confirmation'] = 0;
        /*         * footer* */
        if (!isset($input['adns_hide_whole_footer']))
            $input['adns_hide_whole_footer'] = 0;
        if (!isset($input['adns_hide_footer_text']))
            $input['adns_hide_footer_text'] = 0;
        if (!isset($input['adns_hide_footer_version']))
            $input['adns_hide_footer_version'] = 0;
        /*         * dashboard* */
        if (!isset($input['remove_dashboard_widget_normal_core_dashboard_plugins']))
            $input['remove_dashboard_widget_normal_core_dashboard_plugins'] = 0;
        if (!isset($input['remove_dashboard_widget_normal_core_dashboard_recent_comments']))
            $input['remove_dashboard_widget_normal_core_dashboard_recent_comments'] = 0;
        if (!isset($input['remove_dashboard_widget_side_core_dashboard_primary']))
            $input['remove_dashboard_widget_side_core_dashboard_primary'] = 0;
        if (!isset($input['remove_dashboard_widget_normal_core_dashboard_incoming_links']))
            $input['remove_dashboard_widget_normal_core_dashboard_incoming_links'] = 0;
        if (!isset($input['remove_dashboard_widget_normal_core_dashboard_right_now']))
            $input['remove_dashboard_widget_normal_core_dashboard_right_now'] = 0;
        if (!isset($input['remove_dashboard_widget_side_core_dashboard_secondary']))
            $input['remove_dashboard_widget_side_core_dashboard_secondary'] = 0;
        if (!isset($input['remove_dashboard_widget_side_core_dashboard_recent_drafts']))
            $input['remove_dashboard_widget_side_core_dashboard_recent_drafts'] = 0;
        if (!isset($input['remove_dashboard_widget_side_core_dashboard_quick_press']))
            $input['remove_dashboard_widget_side_core_dashboard_quick_press'] = 0;
        if (!isset($input['remove_dashboard_widget_normal_core_dashboard_activity']))
            $input['remove_dashboard_widget_normal_core_dashboard_activity'] = 0;
        if (!isset($input['adns_add_custom_dashboard_widget_onoff']))
            $input['adns_add_custom_dashboard_widget_onoff'] = 0;
        /*         * other* */
        if (!isset($input['adns_remove_contact_method_aim']))
            $input['adns_remove_contact_method_aim'] = 0;
        if (!isset($input['adns_remove_contact_method_yim']))
            $input['adns_remove_contact_method_yim'] = 0;
        if (!isset($input['adns_remove_contact_method_jabber']))
            $input['adns_remove_contact_method_jabber'] = 0;

        if (!isset($input['adns_enable_easy_admin_url']))
            $input['adns_enable_easy_admin_url'] = 0;




        /** data validation * */
        if (isset($input['adns_default_email_address_email']))
        {
            if (!is_email($input['adns_default_email_address_email']))
            {
                $input['adns_default_email_address_email'] = '';
            }
        }

        $input['adns_footer_logo']    = esc_url( $input['adns_footer_logo'] ) ;
        $input['adns_admin_logo_url'] = esc_url( $input['adns_admin_logo_url'] ) ;
        $input['adns_login_logo_url'] = esc_url( $input['adns_login_logo_url'] ) ;
        $input['adns_login_background_url']   = esc_url( $input['adns_login_background_url'] ) ;
        $input['adns_login_background_color'] = admin_customizer_sanitize_hex_color( $input['adns_login_background_color'] ) ;

        return $input;
    }

    //
    function my_custom_dashboard_widget_content_function()
    {
        $default_content = '<div style="text-align:center;">
                                    <h2>Welcome</h2>
                                    <p>to</p>
                                    <h4>ADMINISTRATION AREA</h4>
                                    </div>';
        $my_custom_dashboard_content = ($this->options['adns_my_custom_dashboard_widget_content'] == '') ? $default_content : $this->options['adns_my_custom_dashboard_widget_content'];
        echo $my_custom_dashboard_content;
    }

    function add_custom_dashboard_widgets()
    {

        $my_custom_dashboard_title = ($this->options['adns_my_custom_dashboard_widget_title'] == '') ? 'Welcome' : $this->options['adns_my_custom_dashboard_widget_title'];
        wp_add_dashboard_widget('my_custom_dashboard_widget', $my_custom_dashboard_title, array($this, 'my_custom_dashboard_widget_content_function'));
    }

    public function add_admin_logo()
    {
        //header logo ko laagi
        $url = esc_url($this->options['adns_admin_logo_url']);
        if ($url == '')
            return;
        ?>
        <script type="text/javascript">
            jQuery(document).ready(function($) {
                var image = $('<img/>', {
                    src: '<?php echo $url; ?>',
                    alt: '<?php echo get_bloginfo('name') . ' Admin'; ?>',
                    style: 'padding-top:3px'
                });
                var anchorlink = $('<a/>', {
                    href: '<?php echo admin_url(); ?>',
                    html: image,
                    title: '<?php echo get_bloginfo('name'); ?>'
                });
                jQuery('<li/>', {
                    html: anchorlink,
                    class: 'menupop'
                }).prependTo('#wp-admin-bar-root-default');
            });
        </script>
        <?php
    }

    public function hide_adminbar_for_nonadmin()
    {
        if (current_user_can('manage_options'))
            return TRUE;
        else
            return FALSE;
    }

    public function replace_login_logo()
    {
        echo '<style type="text/css">
              div#login h1 a { background-image:url(' . $this->options['adns_login_logo_url'] . ') !important;
                    background-size: auto auto !important;width: auto !important;}
            </style>';
    }

    public function adns_background_change_fn()
    {
        echo '<style type="text/css">';
        if ($this->options['adns_login_background_url'] != ''){
            echo 'body.login { background : url(' . $this->options['adns_login_background_url'] . ') no-repeat scroll center top !important; }' ;
        }
        if ($this->options['adns_login_background_color'] != ''){
            echo 'body.login {background-color:'  . $this->options['adns_login_background_color'] . '!important;} ';
        }
        echo '</style>';

    }

    public function change_login_logo_url_link()
    {
        return get_bloginfo('url');
    }

    public function change_login_logo_url_title()
    {
        return get_bloginfo('name');
    }

    public function hide_update_nagging_bar(){
        if ($this->options['adns_hide_update_nagging_bar'] == 1){
          remove_action( 'admin_notices', 'update_nag', 3 );
          remove_action( 'network_admin_notices', 'update_nag', 3 );
        }
    }

    public function rearrange_logout_menu()
    {
        ?>
        <script type="text/javascript">
            jQuery(document).ready(function($) {
                var $logout = jQuery('#wp-admin-bar-user-actions li:eq(2)');
                jQuery('#wp-admin-bar-user-actions').remove();
                jQuery('#wp-admin-bar-my-account').removeClass('menupop');
                jQuery('#wp-admin-bar-my-account > a >img').remove();
                jQuery('#wp-admin-bar-my-account div.ab-sub-wrapper').remove();
                $logout.prependTo('#wp-admin-bar-top-secondary');
                <?php if (1 == $this->options['adns_enable_logout_confirmation'] ): ?>
                    $('#wp-admin-bar-logout a').click(function() {
                        var confirmation = confirm('Are you sure?');
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

    public function hide_admin_logo()
    {
        global $wp_admin_bar;
        $wp_admin_bar->remove_menu('wp-logo');
        $wp_admin_bar->remove_menu('view-site');
    }

    public function hide_comments_menu_header()
    {
        global $wp_admin_bar;
        $wp_admin_bar->remove_menu('comments');
    }

    public function hide_updates_menu_header()
        {
            global $wp_admin_bar;
            $wp_admin_bar->remove_menu('updates');
        }

    public function hide_help_tab()
    {
        echo '<style type="text/css">
            #contextual-help-link-wrap { display: none !important; }
          </style>';
    }

    public function replace_howdy($wp_admin_bar)
    {
        $my_account = $wp_admin_bar->get_node('my-account');
        $newtitle = str_replace('Howdy,', $this->options['adns_howdy_replace'], $my_account->title);
        $wp_admin_bar->add_node(array(
            'id' => 'my-account',
            'title' => $newtitle,
        ));
    }

    public function hide_whole_footer()
    {
        echo '<style type="text/css">
					#wpfooter { display:none!important; }
				</style>';
    }

    public function change_footer_version()
    {
        $output = '';
        if ( $this->options['adns_hide_footer_version'] != 1 ) {
            $output .= $this->options['adns_footer_version'];
        }
        return $output;
    }

    public function change_footer_text()
    {
        $output ='';
        if ( $this->options['adns_hide_footer_text'] == 1 ) {
            return $output;
        }

        if( !empty( $this->options['adns_footer_logo'] ) ){
            $output = '<img src="'.$this->options['adns_footer_logo'].'" alt="">';
        }
        $output .=  $this->options['adns_footer_text'];
        return $output;
    }

    public function change_number_of_screen_columns_available($columns)
    {
        $columns['dashboard'] = $this->options['adns_no_of_columns_available_in_dashboard'];
        return $columns;
    }

    public function adns_admin_theme_loader(){
        $theme = strtolower($this->options['adns_admin_theme']);
        wp_enqueue_style('adns-admin-theme', plugins_url("css/admin-theme/$theme.css", __FILE__));
    }

    public function adns_custom_admin_theme_content_loader(){
        echo '<style>';
        echo $this->options['adns_custom_admin_theme_content'];
        echo '</style>';
        return;
    }

    public function adns_custom_login_theme_content_loader(){
        echo '<style>';
        echo $this->options['adns_custom_login_theme_content'];
        echo '</style>';
        return;
    }

    public function adns_login_theme_loader(){
        $theme = strtolower($this->options['adns_login_theme']);
        wp_enqueue_style('adns-login-theme', plugins_url("css/login-theme/$theme.css", __FILE__));
    }

    public function remove_dashboard_widgets($columns)
    {

        global $wp_meta_boxes;

        if ($this->options['remove_dashboard_widget_normal_core_dashboard_plugins'] == 1)
        {
            $this->remove_dashboard_widget('dashboard_plugins', 'normal');
        }
        if ($this->options['remove_dashboard_widget_normal_core_dashboard_recent_comments'] == 1)
        {
            $this->remove_dashboard_widget('dashboard_recent_comments', 'normal');
        }
        if ($this->options['remove_dashboard_widget_side_core_dashboard_primary'] == 1)
        {
            $this->remove_dashboard_widget('dashboard_primary', 'side');
        }
        if ($this->options['remove_dashboard_widget_normal_core_dashboard_incoming_links'] == 1)
        {
            $this->remove_dashboard_widget('dashboard_incoming_links', 'normal');
        }
        if ($this->options['remove_dashboard_widget_normal_core_dashboard_right_now'] == 1)
        {
            $this->remove_dashboard_widget('dashboard_right_now', 'normal');
        }
        if ($this->options['remove_dashboard_widget_side_core_dashboard_secondary'] == 1)
        {
            $this->remove_dashboard_widget('dashboard_secondary', 'side');
        }
        if ($this->options['remove_dashboard_widget_side_core_dashboard_recent_drafts'] == 1)
        {
            $this->remove_dashboard_widget('dashboard_recent_drafts', 'side');
        }
        if ($this->options['remove_dashboard_widget_side_core_dashboard_quick_press'] == 1)
        {
            $this->remove_dashboard_widget('dashboard_quick_press', 'side');
        }
        if ($this->options['remove_dashboard_widget_normal_core_dashboard_activity'] == 1)
        {
            $this->remove_dashboard_widget('dashboard_activity', 'normal');
        }

    }

    private function remove_dashboard_widget($widget, $side)
    {
        if (!($side == 'side' || $side == 'normal' ))
        {
            return;
        }
        global $wp_meta_boxes;
        remove_meta_box($widget, 'dashboard', $side);
    }

}

// end class
// Create instance of plugin
$admin_customizer = new AdminCustomizer();


// Helper functions
function admin_customizer_sanitize_hex_color( $color ) {
    if ( '' === $color )
        return '';

    // 3 or 6 hex digits, or the empty string.
    if ( preg_match('|^#([A-Fa-f0-9]{3}){1,2}$|', $color ) )
        return $color;

    return null;
}
