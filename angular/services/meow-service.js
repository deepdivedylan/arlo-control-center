app.service("MeowService", function($http) {
	this.MEOW_ENDPOINT = "";

	this.meow = function(meow) {
		return ($http.post(this.MEOW_ENDPOINT, meow)
			.then(function(reply) {
				return (reply.data);
			}));
	};

	this.getChannels = function() {
		return ($http.get(MEOW_ENDPOINT));
	};
});
