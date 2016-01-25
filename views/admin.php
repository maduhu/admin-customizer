<div class="wrap">
    <h2><?php echo esc_html( get_admin_page_title() ); ?></h2>

    <div id="poststuff">

        <div id="post-body" class="metabox-holder columns-2">

            <!-- main content -->
            <div id="post-body-content">
                <form name="form1" method="post" action="options.php">
                    <?php settings_fields('admin-customizer-options-group'); ?>

                    <div id="tab-container" class="tab-container">
                         <h2 class="nav-tab-wrapper etabs">
                           <span class="tab"><a href="#adnstab-theme" class="nav-tab"><?php _e("Theme", 'admin-customizer'); ?></a></span>
                           <span class="tab"><a href="#adnstab-header" class="nav-tab"><?php _e("Header", 'admin-customizer'); ?></a></span>
                           <span class="tab"><a href="#adnstab-dashboard" class="nav-tab"><?php _e("Dashboard", 'admin-customizer'); ?></a></span>
                           <span class="tab"><a href="#adnstab-footer" class="nav-tab"><?php _e("Footer", 'admin-customizer'); ?></a></span>
                           <span class="tab"><a href="#adnstab-login" class="nav-tab"><?php _e("Login", 'admin-customizer'); ?></a></span>
                           <span class="tab"><a href="#adnstab-other" class="nav-tab"><?php _e("Other", 'admin-customizer'); ?></a></span>
                        </h2>
                        <div class="panel-container">
                            <div id="adnstab-theme">
                                <h2> <?php _e("Theme settings", $this->plugin_slug); ?> </h2>
                                <table class="form-table">
                                    <tbody>
                                        <tr valign="top">
                                            <th scope="row"><label for="adns_admin_theme">
                                                    <?php _e("Admin Theme", $this->plugin_slug); ?>
                                                </label><p class="description"><?php _e("Choose admin theme", $this->plugin_slug); ?></p></th>
                                            <td>
                                                <select name="adns_options[adns_admin_theme]" id="adns_admin_theme">
                                                    <option value="-1" <?php selected($adns_admin_theme, '-1'); ?>><?php _e("Default", $this->plugin_slug); ?></option>
                                                    <option value="CUSTOM" <?php selected($adns_admin_theme, 'CUSTOM'); ?>><?php _e("Custom", $this->plugin_slug); ?></option>
                                                </select>
                                                </td>
                                        </tr>
                                        <tr valign="top">
                                            <th scope="row"><label for="adns_login_theme">
                                                    <?php _e("Login Theme", $this->plugin_slug); ?>
                                                </label><p class="description"><?php _e("Choose admin theme", $this->plugin_slug); ?></p></th>
                                            <td>
                                                <select name="adns_options[adns_login_theme]" id="adns_login_theme">
                                                    <option value="-1" <?php selected($adns_login_theme, '-1'); ?>><?php _e("Default", $this->plugin_slug); ?></option>
                                                    <option value="CUSTOM" <?php selected($adns_login_theme, 'CUSTOM'); ?>><?php _e("Custom", $this->plugin_slug); ?></option>
                                                    <option value="DARK" <?php selected($adns_login_theme, 'DARK'); ?>><?php _e("Dark Theme", $this->plugin_slug); ?></option>
                                                </select>
                                                </td>
                                        </tr>
                                        <tr valign="top">
                                            <th scope="row"><label for="adns_custom_admin_theme_content">
                                                    <?php _e("Enter CSS style code for Admin", $this->plugin_slug); ?>
                                                </label><p class="description"><?php _e("Enter CSS style code. You must chose 'Custom' in Admin Theme option for this to be active.", $this->plugin_slug); ?></p></th>
                                            <td>
                                                <textarea id="adns_custom_admin_theme_content" name="adns_options[adns_custom_admin_theme_content]" class="large-text code" rows="10"><?php echo $adns_custom_admin_theme_content; ?></textarea>
                                                </td>
                                        </tr>
                                        <tr valign="top">
                                            <th scope="row"><label for="adns_custom_login_theme_content">
                                                    <?php _e("Enter CSS style code for Login Page", $this->plugin_slug); ?>
                                                </label><p class="description"><?php _e("Enter CSS style code. You must chose 'Custom' in Login Theme option for this to be active.", $this->plugin_slug); ?></p></th>
                                            <td>
                                                <textarea id="adns_custom_login_theme_content" name="adns_options[adns_custom_login_theme_content]" class="large-text code" rows="10"><?php echo $adns_custom_login_theme_content; ?></textarea>
                                                </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div id="adnstab-header">
                                <h2> <?php _e("Header settings", $this->plugin_slug); ?> </h2>
                                <table class="form-table">
                                                        <tbody>
                                                            <tr valign="top">
                                                                <th scope="row"><label for="adns_hide_admin_logo">
                                                                        <?php _e("Hide Default Admin logo", $this->plugin_slug); ?>
                                                                    </label></th>
                                                                <td><label for="adns_hide_admin_logo">

                                                                        <input type="checkbox" value="1" id="adns_hide_admin_logo" name="adns_options[adns_hide_admin_logo]" <?php checked($adns_hide_admin_logo, 1); ?>>
                                                                        <?php _e("Hide", $this->plugin_slug); ?>
                                                                    </label></td>
                                                            </tr>


                                                            <tr valign="top">
                                                                <th scope="row"><label for="adns_admin_logo_url">
                                                                        <?php _e("Admin logo URL", $this->plugin_slug); ?>
                                                                    </label><p class="description">
                                                                        <?php _e("Enter full URL for admin logo image starting with <strong>http://</strong>. Image size 20px X 20px.", $this->plugin_slug); ?>
                                                                    </p></th>
                                                                <td><input type="text" class="regular-text code img" value="<?php echo $adns_admin_logo_url; ?>" id="adns_admin_logo_url" name="adns_options[adns_admin_logo_url]" /> <input type="button" class="adns-select-img button" value="<?php _e('Upload', $this->plugin_slug); ?>" />
                                                                    </td>
                                                            </tr>

                                                            <tr valign="top">
                                                                <th scope="row"><label for="adns_hide_comments_menu_header">
                                                                        <?php _e("Hide Comments Menu", $this->plugin_slug); ?>
                                                                    </label></th>
                                                                <td><label for="adns_hide_comments_menu_header">
                                                                        <input type="checkbox" value="1" id="adns_hide_comments_menu_header" name="adns_options[adns_hide_comments_menu_header]" <?php checked($adns_hide_comments_menu_header, 1); ?>>
                                                                        <?php _e("Hide", $this->plugin_slug); ?>
                                                                    </label></td>
                                                            </tr>
                                                             <tr valign="top">
                                                                <th scope="row"><label for="adns_hide_updates_menu_header">
                                                                        <?php _e("Hide Updates Menu", $this->plugin_slug); ?>
                                                                    </label></th>
                                                                <td><label for="adns_hide_updates_menu_header">
                                                                        <input type="checkbox" value="1" id="adns_hide_updates_menu_header" name="adns_options[adns_hide_updates_menu_header]" <?php checked($adns_hide_updates_menu_header, 1); ?>>
                                                                        <?php _e("Hide", $this->plugin_slug); ?>
                                                                    </label></td>
                                                            </tr>
                                                            <tr valign="top">
                                                                <th scope="row"><label for="adns_howdy_replace">
                                                                        <?php _e("Replace Howdy", $this->plugin_slug); ?>
                                                                    </label><p class="description"><?php echo sprintf(__("Enter text to replace %sHowdy%s.",$this->plugin_slug),'<strong>','</strong>'  ); ?></p></th>
                                                                <td><input type="text" class="regular-text code" value="<?php echo esc_attr_e($adns_howdy_replace); ?>" id="adns_howdy_replace" name="adns_options[adns_howdy_replace]">
                                                                    </td>
                                                            </tr>
                                                            <tr valign="top">
                                                                <th scope="row"><label for="adns_hide_adminbar_for_nonadmin">
                                                                        <?php _e("Hide Adminbar for non-admin", $this->plugin_slug); ?>
                                                                    </label></th>
                                                                <td><label for="adns_hide_adminbar_for_nonadmin">
                                                                        <input type="checkbox" value="1" id="adns_hide_adminbar_for_nonadmin" name="adns_options[adns_hide_adminbar_for_nonadmin]" <?php checked($adns_hide_adminbar_for_nonadmin, 1); ?>>
                                                                        <?php _e("Hide", $this->plugin_slug); ?>
                                                                    </label></td>
                                                            </tr>
                                                            <tr valign="top">
                                                                <th scope="row"><label for="adns_hide_help_tab">
                                                                        <?php _e("Hide Help Tab", $this->plugin_slug); ?>
                                                                    </label></th>
                                                                <td><label for="adns_hide_help_tab">

                                                                        <input type="checkbox" value="1" id="adns_hide_help_tab" name="adns_options[adns_hide_help_tab]" <?php checked($adns_hide_help_tab, 1); ?>>
                                                                        <?php _e("Hide", $this->plugin_slug); ?>
                                                                    </label></td>
                                                            </tr>
                                                            <tr valign="top">
                                                                <th scope="row"><label for="adns_hide_update_nagging_bar">
                                                                        <?php _e("Hide Update Nagging Bar", $this->plugin_slug); ?>
                                                                    </label></th>
                                                                <td><label for="adns_hide_update_nagging_bar">

                                                                        <input type="checkbox" value="1" id="adns_hide_update_nagging_bar" name="adns_options[adns_hide_update_nagging_bar]" <?php checked($adns_hide_update_nagging_bar, 1); ?>>
                                                                        <?php _e("Hide", $this->plugin_slug); ?>
                                                                    </label></td>
                                                            </tr>
                                                            <tr valign="top">
                                                                <th scope="row"><label for="adns_rearrange_logout_menu">
                                                                        <?php _e("Rearrange Logout menu", $this->plugin_slug); ?>
                                                                    </label></th>
                                                                <td><label for="adns_rearrange_logout_menu">

                                                                        <input type="checkbox" value="1" id="adns_rearrange_logout_menu" name="adns_options[adns_rearrange_logout_menu]" <?php checked($adns_rearrange_logout_menu, 1); ?>>
                                                                        <?php _e("Rearrange", $this->plugin_slug); ?>
                                                                    </label></td>
                                                            </tr>
                                                            <tr valign="top">
                                                                <th scope="row"><label for="adns_rearrange_logout_menu">
                                                                        <?php _e("Enable Logout confirmation", $this->plugin_slug); ?>
                                                                    </label></th>
                                                                <td><label for="adns_enable_logout_confirmation">

                                                                        <input type="checkbox" value="1" id="adns_enable_logout_confirmation" name="adns_options[adns_enable_logout_confirmation]" <?php checked($adns_enable_logout_confirmation, 1); ?>>
                                                                        <?php _e("Enable", $this->plugin_slug); ?>
                                                                    </label></td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                            </div>
                            <div id="adnstab-dashboard">
                                <h2> <?php _e("Dashboard settings", $this->plugin_slug); ?> </h2>
                                <table class="form-table">
                                                        <tbody>
                                                            <tr valign="top">
                                                                <th scope="row"><label for="adns_no_of_columns_available_in_dashboard">
                                                                        <?php _e("No. of Columns in Dashboard", $this->plugin_slug); ?>
                                                                    </label></th>
                                                                <td><label>
                                                                        <input type="radio" value="1" name="adns_options[adns_no_of_columns_available_in_dashboard]" <?php checked($adns_no_of_columns_available_in_dashboard, 1); ?>>
                                                                        <?php _e("1", $this->plugin_slug); ?>
                                                                    </label>
                                                                    <label>
                                                                        <input type="radio"  value="2" name="adns_options[adns_no_of_columns_available_in_dashboard]" <?php checked($adns_no_of_columns_available_in_dashboard, 2); ?>>
                                                                        <?php _e("2", $this->plugin_slug); ?>
                                                                    </label>
                                                                    <label>
                                                                        <input type="radio" value="3" name="adns_options[adns_no_of_columns_available_in_dashboard]" <?php checked($adns_no_of_columns_available_in_dashboard, 3); ?>>
                                                                        <?php _e("3", $this->plugin_slug); ?>
                                                                    </label>
                                                                    <label>
                                                                        <input type="radio" value="4" name="adns_options[adns_no_of_columns_available_in_dashboard]" <?php checked($adns_no_of_columns_available_in_dashboard, 4); ?>>
                                                                        <?php _e("4", $this->plugin_slug); ?>
                                                                    </label></td>
                                                            </tr>
                                                            <tr valign="top">
                                                                <th scope="row"><label>
                                                                        <?php _e("Hide Dashboard Widgets", $this->plugin_slug); ?>
                                                                    </label><p class="description"><?php _e("Check to hide widgets.", $this->plugin_slug); ?></p></th>
                                                                <td><p>
                                                                        <label for="remove_dashboard_widget_normal_core_dashboard_plugins">

                                                                            <input type="checkbox" value="1" id="remove_dashboard_widget_normal_core_dashboard_plugins" name="adns_options[remove_dashboard_widget_normal_core_dashboard_plugins]" <?php checked($remove_dashboard_widget_normal_core_dashboard_plugins, 1); ?>>
                                                                            <?php _e("Plugins widget", $this->plugin_slug); ?>
                                                                        </label>
                                                                    </p>
                                                                    <p>
                                                                        <label for="remove_dashboard_widget_normal_core_dashboard_recent_comments">

                                                                            <input type="checkbox" value="1" id="remove_dashboard_widget_normal_core_dashboard_recent_comments" name="adns_options[remove_dashboard_widget_normal_core_dashboard_recent_comments]" <?php checked($remove_dashboard_widget_normal_core_dashboard_recent_comments, 1); ?>>
                                                                            <?php _e("Recent Comments", $this->plugin_slug); ?>
                                                                        </label>
                                                                    </p>
                                                                    <p>
                                                                        <label for="remove_dashboard_widget_side_core_dashboard_primary">

                                                                            <input type="checkbox" value="1" id="remove_dashboard_widget_side_core_dashboard_primary" name="adns_options[remove_dashboard_widget_side_core_dashboard_primary]" <?php checked($remove_dashboard_widget_side_core_dashboard_primary, 1); ?>>
                                                                            <?php _e("Primary widget", $this->plugin_slug); ?>
                                                                        </label>
                                                                    </p>
                                                                    <p>
                                                                        <label for="remove_dashboard_widget_normal_core_dashboard_incoming_links">

                                                                            <input type="checkbox" value="1" id="remove_dashboard_widget_normal_core_dashboard_incoming_links" name="adns_options[remove_dashboard_widget_normal_core_dashboard_incoming_links]" <?php checked($remove_dashboard_widget_normal_core_dashboard_incoming_links, 1); ?>>
                                                                            <?php _e("Incoming Links", $this->plugin_slug); ?>
                                                                        </label>
                                                                    </p>
                                                                    <p>
                                                                        <label for="remove_dashboard_widget_normal_core_dashboard_right_now">

                                                                            <input type="checkbox" value="1" id="remove_dashboard_widget_normal_core_dashboard_right_now" name="adns_options[remove_dashboard_widget_normal_core_dashboard_right_now]" <?php checked($remove_dashboard_widget_normal_core_dashboard_right_now, 1); ?>>
                                                                            <?php _e("Right now widget", $this->plugin_slug); ?>
                                                                        </label>
                                                                    </p>
                                                                    <p>
                                                                        <label for="remove_dashboard_widget_side_core_dashboard_secondary">

                                                                            <input type="checkbox" value="1" id="remove_dashboard_widget_side_core_dashboard_secondary" name="adns_options[remove_dashboard_widget_side_core_dashboard_secondary]" <?php checked($remove_dashboard_widget_side_core_dashboard_secondary, 1); ?>>
                                                                            <?php _e("Secondary widget", $this->plugin_slug); ?>
                                                                        </label>
                                                                    </p>
                                                                    <p>
                                                                        <label for="remove_dashboard_widget_side_core_dashboard_recent_drafts">

                                                                            <input type="checkbox" value="1" id="remove_dashboard_widget_side_core_dashboard_recent_drafts" name="adns_options[remove_dashboard_widget_side_core_dashboard_recent_drafts]" <?php checked($remove_dashboard_widget_side_core_dashboard_recent_drafts, 1); ?>>
                                                                            <?php _e("Recent Drafts", $this->plugin_slug); ?>
                                                                        </label>
                                                                    </p>
                                                                    <p>
                                                                        <label for="remove_dashboard_widget_side_core_dashboard_quick_press">

                                                                            <input type="checkbox" value="1" id="remove_dashboard_widget_side_core_dashboard_quick_press" name="adns_options[remove_dashboard_widget_side_core_dashboard_quick_press]" <?php checked($remove_dashboard_widget_side_core_dashboard_quick_press, 1); ?>>
                                                                            <?php _e("Quick Press", $this->plugin_slug); ?>
                                                                        </label>
                                                                    </p>
                                                                    <p>
                                                                        <label for="remove_dashboard_widget_normal_core_dashboard_activity">

                                                                            <input type="checkbox" value="1" id="remove_dashboard_widget_normal_core_dashboard_activity" name="adns_options[remove_dashboard_widget_normal_core_dashboard_activity]" <?php checked($remove_dashboard_widget_normal_core_dashboard_activity, 1); ?>>
                                                                            <?php _e("Activity", $this->plugin_slug); ?>
                                                                        </label>
                                                                    </p>
                                                                    </td>
                                                            </tr>
                                                            <tr valign="top">
                                                                <th scope="row"><label for="adns_add_custom_dashboard_widget_onoff">
                                                                        <?php _e("Add custom dashboard widget", $this->plugin_slug); ?>
                                                                    </label></th>
                                                                <td><label for="adns_add_custom_dashboard_widget_onoff">

                                                                        <input type="checkbox" value="1" id="adns_add_custom_dashboard_widget_onoff" name="adns_options[adns_add_custom_dashboard_widget_onoff]" <?php checked($adns_add_custom_dashboard_widget_onoff, 1); ?>>
                                                                        <?php _e("Enable", $this->plugin_slug); ?>
                                                                    </label></td>
                                                            </tr>
                                                            <tr valign="top">
                                                                <th scope="row"><label for="adns_my_custom_dashboard_widget_title">
                                                                        <?php _e("Custom Dashboard Widget Title", $this->plugin_slug); ?>
                                                                    </label><p class="description"><?php _e("Enter custom dashboard widget title.", $this->plugin_slug); ?></p></th>
                                                                <td><input type="text" class="regular-text code" value="<?php echo $adns_my_custom_dashboard_widget_title; ?>" id="adns_my_custom_dashboard_widget_title" name="adns_options[adns_my_custom_dashboard_widget_title]">
                                                                    </td>
                                                            </tr>
                                                            <tr valign="top">
                                                                <th scope="row"><label for="adns_my_custom_dashboard_widget_content">
                                                                        <?php _e("Custom Dashboard Widget Content", $this->plugin_slug); ?>
                                                                    </label><p class="description"><?php _e("Enter custom dashboard widget content in html.", $this->plugin_slug); ?></p></th>
                                                                <td>
                                                                    <textarea id="adns_my_custom_dashboard_widget_content" name="adns_options[adns_my_custom_dashboard_widget_content]" class="large-text code" rows="10"><?php echo $adns_my_custom_dashboard_widget_content; ?></textarea>
                                                                    </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                            </div>
                            <div id="adnstab-footer">
                                <h2> <?php _e("Footer settings", $this->plugin_slug); ?> </h2>
                                <table class="form-table">
                                                        <tbody>
                                                            <tr valign="top">
                                                                <th scope="row"><label for="adns_hide_whole_footer">
                                                                        <?php _e("Hide Whole Footer", $this->plugin_slug); ?>
                                                                    </label></th>
                                                                <td><label for="adns_hide_whole_footer">

                                                                        <input type="checkbox" value="1" id="adns_hide_whole_footer" name="adns_options[adns_hide_whole_footer]" <?php checked($adns_hide_whole_footer, 1); ?>>
                                                                        <?php _e("Hide", $this->plugin_slug); ?>
                                                                    </label></td>
                                                            </tr>
                                                            <tr valign="top">
                                                                <th scope="row"><label for="adns_hide_footer_text">
                                                                        <?php _e("Hide Footer Text", $this->plugin_slug); ?>
                                                                    </label></th>
                                                                <td><label for="adns_hide_footer_text">

                                                                        <input type="checkbox" value="1" id="adns_hide_footer_text" name="adns_options[adns_hide_footer_text]" <?php checked($adns_hide_footer_text, 1); ?>>
                                                                        <?php _e("Hide", $this->plugin_slug); ?>
                                                                    </label></td>
                                                            </tr>
                                                            <tr valign="top">
                                                                <th scope="row"><label for="adns_footer_logo">
                                                                        <?php _e("Footer Logo URL", $this->plugin_slug); ?>
                                                                    </label><p class="description">
                                                                        <?php _e("Enter full URL for logo image starting with <strong>http://</strong>. Image size 30px X 30px.", $this->plugin_slug); ?>
                                                                    </p></th>
                                                                <td><input type="text" class="regular-text code img" value="<?php echo $adns_footer_logo; ?>" id="adns_footer_logo" name="adns_options[adns_footer_logo]" /> <input type="button" class="adns-select-img button" value="<?php _e('Upload', $this->plugin_slug); ?>" />
                                                                    </td>
                                                            </tr>
                                                            <tr valign="top">
                                                                <th scope="row"><label for="adns_footer_text">
                                                                        <?php _e("Footer Text", $this->plugin_slug); ?>
                                                                    </label><p class="description"><?php _e("Enter Footer Text.", $this->plugin_slug); ?></p></th>
                                                                <td><input type="text" class="regular-text code" value="<?php echo esc_attr_e($adns_footer_text); ?>" id="adns_footer_text" name="adns_options[adns_footer_text]">
                                                                    </td>
                                                            </tr>
                                                            <tr valign="top">
                                                                <th scope="row"><label for="adns_hide_footer_version">
                                                                        <?php _e("Hide Footer Version", $this->plugin_slug); ?>
                                                                    </label></th>
                                                                <td><label for="adns_hide_footer_version">

                                                                        <input type="checkbox" value="1" id="adns_hide_footer_version" name="adns_options[adns_hide_footer_version]" <?php checked($adns_hide_footer_version, 1); ?>>
                                                                        <?php _e("Hide", $this->plugin_slug); ?>
                                                                    </label></td>
                                                            </tr>
                                                            <tr valign="top">
                                                                <th scope="row"><label for="adns_footer_version">
                                                                        <?php _e("Footer Version", $this->plugin_slug); ?>
                                                                    </label><p class="description"><?php _e("Enter Footer Version.", $this->plugin_slug); ?></p></th>
                                                                <td><input type="text" class="regular-text code" value="<?php echo esc_attr_e($adns_footer_version); ?>" id="adns_footer_version" name="adns_options[adns_footer_version]">
                                                                    </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                            </div>
                            <div id="adnstab-login">
                                <h2> <?php _e("Login settings", $this->plugin_slug); ?> </h2>
                                <table class="form-table">
                                                        <tbody>
                                                            <tr valign="top">
                                                                <th scope="row"><label for="adns_login_logo_url">
                                                                        <?php _e("Login logo URL", $this->plugin_slug); ?>
                                                                    </label><p class="description"><?php _e("Enter full URL for login logo image starting with <strong>http://</strong>. Image dimension - 274px X 63px", $this->plugin_slug); ?></p></th>
                                                                <td><input type="text" class="regular-text code img" value="<?php echo $adns_login_logo_url; ?>" id="adns_login_logo_url" name="adns_options[adns_login_logo_url]" /> <input type="button" class="adns-select-img button" value="<?php _e('Upload', $this->plugin_slug); ?>" />
                                                                    </td>
                                                            </tr>
                                                            <tr valign="top">
                                                                <th scope="row"><label for="adns_login_background_url">
                                                                        <?php _e("Login background image URL", $this->plugin_slug); ?>
                                                                    </label><p class="description"><?php _e("Enter full URL for login logo image starting with <strong>http://</strong>", $this->plugin_slug); ?></p></th>
                                                                <td><input type="text" class="regular-text code img" value="<?php echo $adns_login_background_url; ?>" id="adns_login_background_url" name="adns_options[adns_login_background_url]" /> <input type="button" class="adns-select-img button" value="<?php _e('Upload', $this->plugin_slug); ?>" />
                                                                    </td>
                                                            </tr>
                                                            <tr valign="top">
                                                                <th scope="row"><label for="adns_login_background_color">
                                                                        <?php _e("Login background color", $this->plugin_slug); ?>
                                                                    </label><p class="description"><?php _e("Choose Login background color", $this->plugin_slug); ?></p></th>
                                                                <td><input type="text" class="adns-select-color" value="<?php echo $adns_login_background_color; ?>" id="adns_login_background_color" name="adns_options[adns_login_background_color]" />
                                                                    </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                            </div>
                            <div id="adnstab-other">
                                <h2> <?php _e("Other settings", $this->plugin_slug); ?> </h2>
                                <table class="form-table">
                        <tbody>
                            <tr valign="top">
                                <th scope="row"><label for="adns_max_revision_count">
                                        <?php _e("Number of revisions", $this->plugin_slug); ?>
                                    </label><p class="description"><?php _e("Limit the number of revisions in posts and pages. [Note: This could be overridden by template.]", $this->plugin_slug); ?></p></th>
                                <td>
                                    <select name="adns_options[adns_max_revision_count]" id="adns_max_revision_count">
                                        <option value=""><?php _e("Save all", $this->plugin_slug); ?></option>
                                        <?php for ($i = 0; $i <= 10; $i++): ?>
                                            <option value="<?php echo $i; ?>" <?php selected($adns_max_revision_count, $i); ?>><?php echo $i; ?></option>
                                        <?php endfor; ?>
                                    </select>
                                    </td>
                            </tr>
                            <tr valign="top">
                                <th scope="row"><label for="adns_default_email_address_email">
                                        <?php _e("Default email address", $this->plugin_slug); ?>
                                    </label><p class="description"><?php _e("Enter email address used by automatic email notifications.", $this->plugin_slug); ?></p></th>
                                <td><input type="text" class="regular-text code" value="<?php echo $adns_default_email_address_email; ?>" id="adns_default_email_address_email" name="adns_options[adns_default_email_address_email]">
                                    </td>
                            </tr>
                            <tr valign="top">
                                <th scope="row"><label for="adns_default_email_address_name">
                                        <?php _e("Default name", $this->plugin_slug); ?>
                                    </label><p class="description"><?php _e("Enter default name used by automatic email notifications.", $this->plugin_slug); ?></p></th>
                                <td><input type="text" class="regular-text code" value="<?php echo $adns_default_email_address_name; ?>" id="adns_default_email_address_name" name="adns_options[adns_default_email_address_name]">
                                    </td>
                            </tr>
                            <tr valign="top">
                                <th scope="row"><label>
                                        <?php _e("Remove Default Contact Methods", $this->plugin_slug); ?>
                                    </label><p class="description"><?php _e("Check to remove contact methods.", $this->plugin_slug); ?></p></th>
                                <td>
                                    <p>
                                        <label for="adns_remove_contact_method_aim">

                                            <input type="checkbox" value="1" id="adns_remove_contact_method_aim" name="adns_options[adns_remove_contact_method_aim]" <?php checked($adns_remove_contact_method_aim, 1); ?>>
                                            <?php _e("AIM", $this->plugin_slug); ?>
                                        </label>
                                    </p>
                                    <p>
                                        <label for="adns_remove_contact_method_yim">

                                            <input type="checkbox" value="1" id="adns_remove_contact_method_yim" name="adns_options[adns_remove_contact_method_yim]" <?php checked($adns_remove_contact_method_yim, 1); ?>>
                                            <?php _e("Yahoo IM", $this->plugin_slug); ?>
                                        </label>
                                    </p>
                                    <p>
                                        <label for="adns_remove_contact_method_jabber">

                                            <input type="checkbox" value="1" id="adns_remove_contact_method_jabber" name="adns_options[adns_remove_contact_method_jabber]" <?php checked($adns_remove_contact_method_jabber, 1); ?>>
                                            <?php _e("Jabber/Google Talk", $this->plugin_slug); ?>
                                        </label>
                                    </p>
                                    </td>
                            </tr>
                        </tbody>
                    </table>
                            </div>
                        </div>
                    </div>
                    <?php submit_button(__('Save Changes', 'admin-customizer')); ?>

                </form>



            </div> <!-- post-body-content -->

            <!-- sidebar -->
            <div id="postbox-container-1" class="postbox-container">

            <?php require_once('admin-right.php'); ?>

            </div> <!-- #postbox-container-1 .postbox-container -->

        </div> <!-- #post-body .metabox-holder .columns-2 -->

        <br class="clear">
    </div> <!-- #poststuff -->


</div> <!-- end wrap -->
