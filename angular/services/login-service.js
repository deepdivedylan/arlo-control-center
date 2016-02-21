app.service("LoginService", function($http) {
	this.LOGIN_ENDPOINT = "php/api/login/";

	this.login = function(loginData) {
		return ($http.post(this.LOGIN_ENDPOINT, loginData)
			.then(function(reply) {
				console.log(reply);
				return (reply);
			}));
	};
});
