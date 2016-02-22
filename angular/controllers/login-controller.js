app.controller("LoginController", ["$scope", "$window", "LoginService", function($scope, $window, LoginService) {
	$scope.alerts = [];
	$scope.loginData = {};

	$scope.login = function(loginData, validated) {
		if(validated === true) {
			LoginService.login(loginData)
				.then(function(result) {
					if(result.data.status === 200) {
						$window.location.reload();
					} else {
						$scope.alerts[0] = {type: "danger", msg: result.data.message};
					}
				});
		}
	};
}]);
