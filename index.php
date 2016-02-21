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

		<title>Arlo Control Center</title>
	</head>

	<body>
		<div class="jumbotron">
			<div class="container">
				<h1 class="text-center">Arlo Control Center <span>&block;</span></h1>
			</div>
		</div>

		<div class="container">
			<form class="form-horizontal" ng-controller="MeowController" ng-submit="meow(message, message.$valid);">
				<div class="form-group">
					<label class="control-label col-xs-2" for="channel">Channel*</label>
					<div class="col-xs-10">
						<select class="form-control" id="channel" name="channel">
							<option ng-repeat="channel in channels" value="{{channel}}" ng-model="message.channel"
									  ng-required="true">#{{channel}}
							</option>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-xs-2" for="message">Message*</label>
					<div class="col-xs-10">
						<textarea class="form-control" id="message" name="message" placeholder="Meow!" rows="5"
									 ng-model="message.message" ng-required="true"></textarea>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-xs-2" for="link">Link</label>
					<div class="col-xs-10">
						<input type="text" class="form-control" id="link" name="link"
								 placeholder="https://senator-arlo.bowtied.io/" ng-model="message.link" ng-required="false">
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-xs-2" for="link-title">Link Title</label>
					<div class="col-xs-10">
						<input type="text" class="form-control" id="link-title" name="link-title"
								 placeholder="Back Paws for Bernie!" ng-model="message.link-title" ng-required="false">
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
