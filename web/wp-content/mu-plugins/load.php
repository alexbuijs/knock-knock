<?php
/*
Plugin Name:  Knock Knock Loader
Plugin URI:   https://intranet.klopvaart.nl
Description:  Loader for must use plugins in subdirectories
Version:      0.1.0
Author:       Kasper Koman
License:      GPL-3.0-or-later
*/

/**
 * All files in the root of the mu-plugin folder get 
 * loaded automatically by Wordpress but not the files
 * inside folders, so we load them here
 */
require WPMU_PLUGIN_DIR . '/knock-knock-login-screen/knock-knock-login-screen.php';
