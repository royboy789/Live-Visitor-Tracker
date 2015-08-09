(function($) {
	
	if( !livetracker_data.firebase_url ) {
		return;
	}
	
	var user_id = Math.floor((Math.random() * 1500) + 1000),
	user_username = 0,
	is_user = false;
	
	if( Boolean( livetracker_data.user ) ) {
		is_user: true;
		user_id = livetracker_data.user_id;
		user_username = livetracker_data.user_username;
	}
	
	if( Boolean( livetracker_data.location ) ) {
		var user_location = livetracker_data.location.country;
	} else {
		var user_location = false;
	}
	
	var current_loc = location.href;
	if( livetracker_data.post_id ) {
		current_page = livetracker_data.post_id
	}
	
	var amOnline = new Firebase( livetracker_data.firebase_url + '/.info/connected' );
	var userRef = new Firebase( livetracker_data.firebase_url + '/presence/' + user_id );
	userRef.set({
		online: true,
		user: Boolean( livetracker_data.user ),
		user_id: parseInt( user_id ),
		user_username: user_username,
		viewing: current_loc,
		browser: $.browser,
		geo_location: user_location,
	});
	amOnline.on('value', function(snapshot) {
		if (snapshot.val()) {
			userRef.onDisconnect().remove();
		}
	});
})(jQuery);