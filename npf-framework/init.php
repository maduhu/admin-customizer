<?php

require_once 'core.php';

// Include fields
foreach ( glob( plugin_dir_path( __FILE__ ). "fields/*.php" ) as $file ) {
    include_once $file;
}

// Include fields overridden
$override_folder = 'npf';
$plugin_folder = str_replace('npf-framework/', '', plugin_dir_path( __FILE__ ));
if (file_exists($plugin_folder.'/'.$override_folder)) {
	foreach ( glob( $plugin_folder.'/'.$override_folder . "/*.php" ) as $file ) {
	    include_once $file;
	}
}
