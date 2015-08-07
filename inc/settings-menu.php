<?php

class livetracker_menu {
	
	function __init() {
		
		add_action( 'admin_menu', array( $this, '__livetracker_register_menu' ) );
		add_action( 'admin_init', array( $this, '__livetracker_save_settings' ) );
		
	}
	
	function __livetracker_register_menu() {
		
		add_submenu_page(
			'index.php',
			'Live Track Users',
			'Live Track Users',
			'manage_options',
			'live-tracker',
			array( $this, '__livetracker_dashpage' )
		);
		
	}
	
	function __livetracker_save_settings() {
		
		if( isset( $_POST['__livetracker_firebase'] ) ) {
			
			$firebase_url = $_POST['__livetracker_firebase'];
			update_option( '__livetracker_firebase', $firebase_url );
			
		}
		
	}
	
	function __livetracker_dashpage() {
		
		$firebase_url = get_option( '__livetracker_firebase', false );
		
		echo '<h2>Live User Tracker</h2>';
		
		echo '<h3>Settings</h3>';
		echo '<form action="' . admin_url('index.php?page=live-tracker') . '" method="post">';
			echo '<table class="form-table">';
				echo '<tbody>';
					echo '<tr>';
						echo '<th><label for="firebase_url">Firebase APP URL</label></th>';
						echo '<td><input id="firebase_url" type="text" size="120" value="' . $firebase_url . '" name="__livetracker_firebase" placeholder="https://app.firebase.io" />';					
					echo '</tr>';
				echo '</tbody>';
			echo '</table>';
			echo '<input type="submit" class="button-primary" value="Save" />';
		echo '</form>';
		
		
		if( !$firebase_url ) {
			echo '<h3>Firebase account needed</h3>';
			echo '<p>You need to setup your firebase account before continuing, create a <strong>FREE</strong> account on <a href="https://www.firebase.com" target="_blank">Firebase.com</a></p>';	
			return;
		}
		
		echo '<h3>Users</h3>';
		echo '<table class="widefat">';
			echo '<thead>';
				echo '<tr>';
					echo '<th style="manage-column">User Name &amp; ID</th>';
					echo '<th style="manage-column">Current page</th>';
				echo '<tr>';
			echo '</thead>';
			echo '<tbody>';
				echo '<tr>';
					echo '<td><strong>Unknown User</strong></td><td>'.get_bloginfo('wpurl').'</td>';
				echo '</tr><tr>';
					echo '<td><strong>User 23 - Roy Sivan</strong></td><td>'.get_bloginfo('wpurl').'</td>';				
				echo '</tr>';
			echo '</tbody>';
		echo '</table>';
		
	}
}
	
	
?>