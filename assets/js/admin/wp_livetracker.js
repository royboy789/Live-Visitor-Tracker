angular.module('wp_livetracker', ['firebase'] )
.directive('liveTracker', function() {
	return{
		restrict: 'E',
		scope: {},
		controller: function( $scope, $firebaseObject ) {
			var ref = new Firebase(livetracker_data.firebase_url + '/presence' );
			$scope.users_online = $firebaseObject(ref);
			
		},
		templateUrl: livetracker_data.admin_template + '/templates/livetracker.html'
	};
	
});