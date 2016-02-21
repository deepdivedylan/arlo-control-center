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

	$scope.meow = function(message, validated) {
		if(validated === true) {
			MeowService.meow(message)
				.then(function(result) {
					if(result.data.status === 200) {
						$scope.alerts[0] = {type: "success", msg: result.data.message};
					} else {
						$scope.alerts[0] = {type: "danger", msg: result.data.message};
					}
				});
		}
	};

	if($scope.channels.length === 0) {
		$scope.channels = $scope.getChannels();
	}
}]);
