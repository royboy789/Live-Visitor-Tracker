<?php

class livetracker_enqueue {
	
	function __init() {
		
		add_action( 'admin_enqueue_scripts', array( $this, '__livetracker_admin_scripts' ) );
		add_action( 'wp_enqueue_scripts', array( $this, '__livetracker_public_scripts' ) );
		
	}
	
	function __livetracker_admin_scripts() {
		
		wp_enqueue_script( 'livetracker_admin', livetracker_plugin_url . '/build/js/admin/wp_livetracker_admin.js', array( 'jquery' ), livetracker_version, false );
		wp_enqueue_script( 'angularfire', livetracker_plugin_url . '/build/js/angularfire.min.js', array( 'jquery' ), livetracker_version, false );
		
	}
	
	function __livetracker_public_scripts() {
		
		wp_enqueue_script( 'livetracker_public', livetracker_plugin_url . '/build/js/admin/wp_livetracker_public.js', array( 'jquery' ), livetracker_version, false );
		wp_enqueue_script( 'angularfire', livetracker_plugin_url . '/build/js/angularfire.min.js', array( 'jquery' ), livetracker_version, false );
		
		$localized_obj = array();
		
		// GET CURRENT USER
		$current_user = wp_get_current_user();
		if( $current_user ) {
			$localized_obj['user'] = true;
			$localized_obj['user_id'] = $current_user->ID;
			$localized_obj['user_username'] = $current_user->user_login;
		} else {
			$localized_obj['user'] = false;
		}
		
		// GET CURRENT POST
		global $post;
		if( $post->ID ){
			$localized_obj['post_id'] = $post->ID;
		}
		
		wp_localize_script(
			'livetracker_public',
			'livetracker_data',
			$localized_obj
		);
		
	}
	
}
	
	
?>