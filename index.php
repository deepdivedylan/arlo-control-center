<!DOCTYPE html>
<html ng-app="ArloControlCenter">

	<head>
		<script data-require="angular.js@1" data-semver="1.5.0-rc.0"
				  src="//code.angularjs.org/1.5.0-rc.0/angular.js"></script>
		<script data-require="ui-bootstrap@*" data-semver="1.1.1"
				  src="//cdnjs.cloudflare.com/ajax/libs/angular-ui-bootstrap/1.1.2/ui-bootstrap-tpls.min.js"></script>

		<link data-require="bootstrap-css@*" data-semver="3.3.6" rel="stylesheet"
				href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.css"/>
		<link rel="stylesheet" href="css/style.css"/>
		<script src="angular/app.js"></script>
		<script src="angular/controllers/login-controller.js"></script>
		<script src="angular/controllers/meow-controller.js"></script>
		<script src="angular/services/login-service.js"></script>
		<script src="angular/services/meow-service.js"></script>
	</head>

	<body>
		<div class="jumbotron">
			<div class="container">
				<h1 class="text-center">Arlo Control Center <span>&block;</span></h1>
			</div>
		</div>

		<div class="container">
			<form class="form-horizontal" ng-controller="MeowController">
				<div class="form-group">
					<label class="control-label col-xs-2" for="channel">Channel</label>
					<div class="col-xs-10">
						<select class="form-control" id="channel" name="channel">
							<option ng-repeat="channel in channels" value="{{channel}}">#{{channel}}</option>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-xs-2" for="message">Message</label>
					<div class="col-xs-10">
						<textarea class="form-control" id="message" name="message" placeholder="Meow!" rows="5"></textarea>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label sr-only" for="message">Message</label>
					<div class="col-xs-10 col-xs-offset-2">
						<button type="submit" class="btn">Engage!</button>
					</div>
				</div>
			</form>
		</div>
	</body>

</html>