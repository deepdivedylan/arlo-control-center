app.service("MeowService", function($http) {
	this.MEOW_ENDPOINT = "php/api/meow/";

	this.meow = function(meow) {
		return ($http.post(this.MEOW_ENDPOINT, meow)
			.then(function(reply) {
				return (reply);
			}));
	};

	this.getChannels = function() {
		return ($http.get(this.MEOW_ENDPOINT));
	};
});