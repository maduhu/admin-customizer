<?php

global $admin_customizer_default_options;


$admin_customizer_default_options = array(
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

    'adns_admin_theme' => 'CUSTOM',
    'adns_login_theme' => 'CUSTOM',
    'adns_custom_admin_theme_content' => '',
    'adns_custom_login_theme_content' => '',
);
$admin_customizer_settings = array(
    'page_title'  => __( 'Admin Customizer', 'admin-customizer' ),
    'menu_title'  => __( 'Admin Customizer', 'admin-customizer' ),
    'capability'  => 'administrator',
    'menu_slug'   => 'admin-customizer',
    'option_slug' => 'adns_options',

    'tabs' => array(
        'theme' => array(
            'id'          => 'theme',
            'title'       => __( 'Theme', 'admin-customizer' ),
            'sub_heading' => __( 'Theme settings', 'admin-customizer' ),
            'fields'      => array(
                'adns_admin_theme' => array(
                    'id'          => 'adns_admin_theme',
                    'title'       => __( 'Admin Theme', 'admin-customizer' ),
                    'description' => __( 'Choose Admin Theme', 'admin-customizer' ),
                    'type'        => 'select',
                    'default'     => $admin_customizer_default_options['adns_admin_theme'],
                    'choices'     => array(
                        '-1'     => __( 'Default', 'admin-customizer' ),
                        'CUSTOM' => __( 'Custom', 'admin-customizer' ),
                    ),
                ),
                'adns_custom_admin_theme_content' => array(
                    'id'          => 'adns_custom_admin_theme_content',
                    'title'       => __( 'Custom CSS for Admin', 'admin-customizer' ),
                    'description' => __( 'Enter CSS style code. You must chose Custom in Admin Theme option for this to be active.', 'admin-customizer' ),
                    'type'        => 'textarea',
                    'default'     => $admin_customizer_default_options['adns_custom_admin_theme_content'],
                ),
                'adns_login_theme' => array(
                    'id'          => 'adns_login_theme',
                    'title'       => __( 'Login Theme', 'admin-customizer' ),
                    'description' => __( 'Choose Login Theme', 'admin-customizer' ),
                    'type'        => 'select',
                    'default'     => '',
                    'choices'     => array(
                        '-1'     => __( 'Default', 'admin-customizer' ),
                        'CUSTOM' => __( 'Custom', 'admin-customizer' ),
                        'DARK'   => __( 'Dark Theme', 'admin-customizer' ),
                    ),
                ),
                'adns_custom_login_theme_content' => array(
                    'id'      => 'adns_custom_login_theme_content',
                    'title'   => __( 'Custom CSS for Login', 'admin-customizer' ),
                    'description' => __( 'Enter CSS style code. You must chose Custom in Login Theme option for this to be active.', 'admin-customizer' ),
                    'type'    => 'textarea',
                    'default' => '',
                ),
            ),

        ),
        'header' => array(
            'id'          => 'header',
            'title'       => __( 'Header', 'admin-customizer' ),
            'sub_heading' => __( 'Header settings', 'admin-customizer' ),
            'fields'      => array(
                'adns_hide_admin_logo' => array(
                    'id'          => 'adns_hide_admin_logo',
                    'title'       => __( 'Hide Default Admin Logo', 'admin-customizer' ),
                    'type'        => 'checkbox_simple',
                    'default'     => '',
                ),
                'adns_admin_logo_url' => array(
                    'id'          => 'adns_admin_logo_url',
                    'title'       => __( 'Admin Logo', 'admin-customizer' ),
                    'type'        => 'upload',
                    'default'     => '',
                ),
                'adns_hide_comments_menu_header' => array(
                    'id'          => 'adns_hide_comments_menu_header',
                    'title'       => __( 'Hide Comments Menu', 'admin-customizer' ),
                    'type'        => 'checkbox_simple',
                    'default'     => '',
                ),
                'adns_hide_updates_menu_header' => array(
                    'id'          => 'adns_hide_updates_menu_header',
                    'title'       => __( 'Hide Updates Menu', 'admin-customizer' ),
                    'type'        => 'checkbox_simple',
                    'default'     => '',
                ),
                'adns_howdy_replace' => array(
                    'id'          => 'adns_howdy_replace',
                    'title'       => __( 'Howdy Text', 'admin-customizer' ),
                    'type'        => 'text',
                    'default'     => '',
                ),
                'adns_hide_adminbar_for_nonadmin' => array(
                    'id'          => 'adns_hide_adminbar_for_nonadmin',
                    'title'       => __( 'Hide Adminbar for non-admin', 'admin-customizer' ),
                    'type'        => 'checkbox_simple',
                    'default'     => '',
                ),
                'adns_hide_help_tab' => array(
                    'id'          => 'adns_hide_help_tab',
                    'title'       => __( 'Hide Help Tab', 'admin-customizer' ),
                    'type'        => 'checkbox_simple',
                    'default'     => '',
                ),
                'adns_hide_update_nagging_bar' => array(
                    'id'          => 'adns_hide_update_nagging_bar',
                    'title'       => __( 'Hide Update Nagging Bar', 'admin-customizer' ),
                    'type'        => 'checkbox_simple',
                    'default'     => '',
                ),
                'adns_rearrange_logout_menu' => array(
                    'id'          => 'adns_rearrange_logout_menu',
                    'title'       => __( 'Rearrange Logout Menu', 'admin-customizer' ),
                    'type'        => 'checkbox_simple',
                    'default'     => '',
                ),
                'adns_enable_logout_confirmation' => array(
                    'id'          => 'adns_enable_logout_confirmation',
                    'title'       => __( 'Enable Logout Confirmation', 'admin-customizer' ),
                    'type'        => 'checkbox_simple',
                    'default'     => '',
                ),
            ),

        ),
        'dashboard' => array(
            'id'          => 'dashboard',
            'title'       => __( 'Dashboard', 'admin-customizer' ),
            'sub_heading' => __( 'Dashboard settings', 'admin-customizer' ),
            'fields'      => array(
                'adns_no_of_columns_available_in_dashboard' => array(
                    'id'          => 'adns_no_of_columns_available_in_dashboard',
                    'title'       => __( 'Dashboard Columns', 'admin-customizer' ),
                    'type'        => 'radio',
                    'choices'     => array(
                        1 => 1,
                        2 => 2,
                        3 => 3,
                        4 => 4,
                    ),
                ),
                'adns_hide_dashboard_widgets' => array(
                    'id'          => 'adns_hide_dashboard_widgets',
                    'title'       => __( 'Hide Dashboard Widgets', 'admin-customizer' ),
                    'description' => __( 'Check to Hide', 'admin-customizer' ),
                    'type'        => 'checkbox',
                    'choices'     => array(
                        'dashboard_right_now'   => __( 'At a Glance', 'admin-customizer' ),
                        'dashboard_quick_press' => __( 'Quick Draft', 'admin-customizer' ),
                        'dashboard_activity'    => __( 'Activity', 'admin-customizer' ),
                        'dashboard_primary'     => __( 'WordPress News', 'admin-customizer' ),
                    ),
                ),
                'adns_add_custom_dashboard_widget_onoff' => array(
                    'id'          => 'adns_add_custom_dashboard_widget_onoff',
                    'title'       => __( 'Custom Dashboard Widget', 'admin-customizer' ),
                    'type'        => 'checkbox_simple',
                ),
                'adns_my_custom_dashboard_widget_title' => array(
                    'id'          => 'adns_my_custom_dashboard_widget_title',
                    'title'       => __( 'Custom Dashboard Widget Title', 'admin-customizer' ),
                    'type'        => 'text',
                ),
                'adns_my_custom_dashboard_widget_content' => array(
                    'id'          => 'adns_my_custom_dashboard_widget_content',
                    'title'       => __( 'Custom Dashboard Widget Content', 'admin-customizer' ),
                    'type'        => 'wysiwyg',
                ),
            ),
        ),
        'footer' => array(
            'id'          => 'footer',
            'title'       => __( 'Footer', 'admin-customizer' ),
            'sub_heading' => __( 'Footer settings', 'admin-customizer' ),
            'fields'      => array(
                'adns_hide_whole_footer' => array(
                    'id'          => 'adns_hide_whole_footer',
                    'title'       => __( 'Hide Whole Footer', 'admin-customizer' ),
                    'type'        => 'checkbox_simple',
                ),
                'adns_hide_footer_text' => array(
                    'id'          => 'adns_hide_footer_text',
                    'title'       => __( 'Hide Footer Text', 'admin-customizer' ),
                    'type'        => 'checkbox_simple',
                ),
                'adns_footer_logo' => array(
                    'id'          => 'adns_footer_logo',
                    'title'       => __( 'Footer Logo', 'admin-customizer' ),
                    'type'        => 'upload',
                ),
                'adns_footer_text' => array(
                    'id'          => 'adns_footer_text',
                    'title'       => __( 'Footer Text', 'admin-customizer' ),
                    'type'        => 'text',
                ),
                'adns_hide_footer_version' => array(
                    'id'          => 'adns_hide_footer_version',
                    'title'       => __( 'Hide Footer Version', 'admin-customizer' ),
                    'type'        => 'checkbox_simple',
                ),
                'adns_footer_version' => array(
                    'id'          => 'adns_footer_version',
                    'title'       => __( 'Footer Version', 'admin-customizer' ),
                    'type'        => 'text',
                ),
            ),
        ),
        'login' => array(
            'id'          => 'login',
            'title'       => __( 'Login', 'admin-customizer' ),
            'sub_heading' => __( 'Login settings', 'admin-customizer' ),
            'fields'      => array(
                'adns_login_logo_url' => array(
                    'id'          => 'adns_login_logo_url',
                    'title'       => __( 'Login Logo', 'admin-customizer' ),
                    'type'        => 'upload',
                ),
                'adns_login_background_url' => array(
                    'id'          => 'adns_login_background_url',
                    'title'       => __( 'Background Image', 'admin-customizer' ),
                    'type'        => 'upload',
                ),
                'adns_login_background_color' => array(
                    'id'          => 'adns_login_background_color',
                    'title'       => __( 'Login Background color', 'admin-customizer' ),
                    'type'        => 'color',
                ),
            ),
        ),
        'other' => array(
            'id'          => 'other',
            'title'       => __( 'Other', 'admin-customizer' ),
            'sub_heading' => __( 'Other settings', 'admin-customizer' ),
            'fields'      => array(
                'adns_max_revision_count' => array(
                    'id'      => 'adns_max_revision_count',
                    'title'   => __( 'Number of Revisions', 'admin-customizer' ),
                    'type'    => 'select',
                    'choices' => array(
                        '-1' => __( 'Save All', 'admin-customizer' ),
                        '0'  => 0,
                        '1'  => 1,
                        '2'  => 2,
                        '3'  => 3,
                        '4'  => 4,
                        '5'  => 5,
                        '6'  => 6,
                        '7'  => 7,
                        '9'  => 9,
                        '10' => 10,
                    ),
                ),
                'adns_default_email_address_email' => array(
                    'id'          => 'adns_default_email_address_email',
                    'title'       => __( 'Default Email Address', 'admin-customizer' ),
                    'description' => __( 'Enter email address used by automatic email notifications.', 'admin-customizer' ),
                    'type'        => 'email',
                ),
                'adns_default_email_address_name' => array(
                    'id'          => 'adns_default_email_address_name',
                    'title'       => __( 'Default Name', 'admin-customizer' ),
                    'description' => __( 'Enter default name used by automatic email notifications.', 'admin-customizer' ),
                    'type'        => 'text',
                ),
            ),
        ),
    ),
);

// nspre($admin_customizer_settings);
$admin_customizer_settings_object = new NPF_Options( $admin_customizer_settings );
