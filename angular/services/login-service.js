app.service("LoginService", function($http) {
	this.LOGIN_ENDPOINT = "../../php/api/authenticate/"; // TODO

	this.login = function(loginData) {
		return ($http.post(this.LOGIN_ENDPOINT, loginData)
			.then(function(reply) {
				return (reply.data);
			}));
	};
});
