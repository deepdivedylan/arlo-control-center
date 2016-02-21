app.controller("LoginController", ["$scope", "LoginService", function($scope, LoginService) {
	$scope.alerts = [];

	$scope.login = function(loginData, validated) {
		if(validated === true) {
			LoginService.login(loginData)
				.then(function(result) {
					if(result.data.status === 200) {
						$scope.alerts[0] = {type: "success", msg: result.data.message};
					} else {
						$scope.alerts[0] = {type: "danger", msg: result.data.message};
					}
				});
		}
	};
}]);
