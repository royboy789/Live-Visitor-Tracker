<?php

class livetracker_enqueue {
	
	function __init() {
		
		add_action( 'admin_enqueue_scripts', array( $this, '__livetracker_admin_scripts' ) );
		add_action( 'wp_enqueue_scripts', array( $this, '__livetracker_public_scripts' ) );
		
	}
	
	function __livetracker_admin_scripts() {

		wp_enqueue_script( 'angular-core', '//ajax.googleapis.com/ajax/libs/angularjs/1.3.15/angular.min.js', array( 'jquery' ), '1.3.15', true );
		wp_enqueue_script( 'firebase', '//cdn.firebase.com/js/client/2.0.4/firebase.js', array('angular-core'), livetracker_version, true );
		wp_enqueue_script( 'ngFire', livetracker_plugin_url . 'build/js/angularfire.min.js', array( 'firebase' ), livetracker_version, true );
		wp_enqueue_script( 'livetracker_admin', livetracker_plugin_url . 'build/js/admin/wp_livetracker_admin.js', array( 'ngfire' ), livetracker_version, false );
		//wp_enqueue_script( 'livetracker_admin', livetracker_plugin_url . 'assets/js/admin/wp_livetracker.js', array( 'ngFire' ), livetracker_version, true );
		
		
		$localized_obj = array(
			'admin_template' => livetracker_plugin_url,
		);
		if( get_option( '__livetracker_firebase' ) ) {
			$localized_obj['firebase_url'] = get_option( '__livetracker_firebase' );
		}
				
		wp_localize_script(
			'livetracker_admin',
			'livetracker_data',
			$localized_obj
		);
		
		
	}
	
	function __livetracker_public_scripts() {
		
		wp_enqueue_script( 'firebase', '//cdn.firebase.com/js/client/2.0.4/firebase.js', array('jquery'), livetracker_version, true );
		//wp_enqueue_script( 'angularfire', livetracker_plugin_url . 'build/js/angularfire.min.js', array( 'firebase' ), livetracker_version, true );
		wp_enqueue_script( 'livetracker_public', livetracker_plugin_url . 'build/js/public/wp_livetracker_public.js', array( 'firebase' ), livetracker_version, true );
		//wp_enqueue_script( 'livetracker_public', livetracker_plugin_url . 'assets/js/public/wp_livetracker.js', array( 'firebase' ), livetracker_version, true );
		
		$localized_obj = array();
		
		// GET CURRENT USER
		$current_user = wp_get_current_user();
		
		if( $current_user->ID ) {
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
		
		if( get_option( '__livetracker_firebase' ) ) {
			$localized_obj['firebase_url'] = get_option( '__livetracker_firebase' );
		}
		
		$request = wp_remote_get('http://www.telize.com/geoip');
		if( !is_wp_error( $request ) ){
			$localized_obj['location'] = json_decode( $request['body'] );	
		} else {
			$localized_obj['location'] = false;
			$localized_obj['location_error'] = $request->get_error_message();
		}
		
		wp_localize_script(
			'livetracker_public',
			'livetracker_data',
			$localized_obj
		);
		
	}
	
}
	
	
?>