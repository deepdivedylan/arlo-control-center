app.controller("MeowController", ["$scope", "MeowService", function($scope, MeowService) {
	$scope.channels = [];
	$scope.message = {};
	$scope.alerts = [];

	$scope.getChannels = function() {
		MeowService.getChannels()
			.then(function(result) {
				$scope.channels = result.data.data;
			});
	};

	$scope.meow = function(channel, message) {
		// TODO
	};
}]);
