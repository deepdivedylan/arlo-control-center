app.controller("MeowController", ["$scope", "MeowService", function($scope, MeowService) {
	$scope.channels = [];
	$scope.messageData = {};
	$scope.alerts = [];

	$scope.getChannels = function() {
		MeowService.getChannels()
			.then(function(result) {
				$scope.channels = result.data.data;
			});
	};

	$scope.meow = function(messageData, validated) {
		if(validated === true) {
			MeowService.meow(messageData)
				.then(function(result) {
					if(result.data.status === 200) {
						$scope.alerts[0] = {type: "success", msg: result.data.message};
						$scope.reset();
					} else {
						$scope.alerts[0] = {type: "danger", msg: result.data.message};
					}
				});
		}
	};

	$scope.reset = function() {
		$scope.messageData = {};
	};

	if($scope.channels.length === 0) {
		$scope.channels = $scope.getChannels();
	}
}]);
