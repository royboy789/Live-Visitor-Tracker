<?php
/**
 * Plugin Name: Live Visitor Tracker
 * Plugin URI: https://github.com/royboy789/Live-Visitor-Tracker
 * Description: Live Visitor tracker allows you to see who is on your website and what page they are on. LIVE.
 * Version: 1.0
 * Author: Roy Sivan
 * Text Domain: live_visitor_tracker
 * Author URI: http://www.roysivan.com
 * License: GPL2
 * GitHub Plugin URI: https://github.com/royboy789/wp-api-social-login
 * GitHub Branch: master
*/

define( 'livetracker_version', '1.0' );
define( 'livetracker_plugin_url', plugin_dir_url( __FILE__ ) );


require_once 'inc/plugin-enqueue.php';
require_once 'inc/settings-menu.php';


class live_tracker {
	
	function __init() {
		
		$livetracker_scripts = new livetracker_enqueue();
		$livetracker_scripts->__init();
		
		$livetracker_menu = new livetracker_menu();
		$livetracker_menu->__init();
		
	}
	
}

$liveTracker = new live_tracker();
$liveTracker->__init();



?>