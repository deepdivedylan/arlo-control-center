<?php
if(session_status() !== PHP_SESSION_ACTIVE) {
	session_start();
}
?>
<!DOCTYPE html>
<html ng-app="ArloControlCenter">

	<head>
		<script src="//code.angularjs.org/1.5.0/angular.js"></script>
		<script src="//cdnjs.cloudflare.com/ajax/libs/angular-ui-bootstrap/1.1.2/ui-bootstrap-tpls.min.js"></script>

		<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.css"/>
		<link rel="stylesheet" href="css/style.css"/>
		<script src="angular/app.js"></script>
		<script src="angular/services/login-service.js"></script>
		<script src="angular/services/meow-service.js"></script>
		<script src="angular/controllers/login-controller.js"></script>
		<script src="angular/controllers/meow-controller.js"></script>

		<title>Arlo Control Center</title>
	</head>

	<body>
		<?php if(empty($_SESSION["adUser"]) === true) {?>
		<main class="container">
			<h1>Login</h1>
			<form name="loginForm" class="form-horizontal" novalidate ng-controller="LoginController" ng-submit="login(loginData, loginForm.$valid);">
				<div class="form-group">
					<label class="control-label col-xs-2" for="username">Username</label>
					<div class="col-xs-10">
						<input type="text" class="form-control" id="username" name="username"
							placeholder="myCNM Username" ng-model="loginData.username" ng-required="true">
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-xs-2" for="password">Password</label>
					<div class="col-xs-10">
						<input type="password" class="form-control" id="password" name="password"
							   placeholder="myCNM Password" ng-model="loginData.password" ng-required="true">
					</div>
				</div>
				<div class="form-group">
					<div class="col-xs-10 col-xs-offset-2">
						<button type="submit" class="btn">Engage!</button>
						<button type="reset" class="btn" ng-click="reset();">Abandon Ship!</button>
					</div>
				</div>
			</form>
		</main>
		<?php } else { ?>
		<div class="jumbotron">
			<div class="container">
				<h1 class="text-center">Arlo Control Center <span>&block;</span></h1>
			</div>
		</div>

		<main class="container">
			<form name="meowForm" class="form-horizontal" novalidate ng-controller="MeowController" ng-submit="meow(messageData, meowForm.$valid);">
				<div class="form-group">
					<label class="control-label col-xs-2" for="channel">Channel*</label>
					<div class="col-xs-10">
						<select class="form-control" id="channel" name="channel" ng-model="messageData.channel">
							<option value="">&mdash;Open A Channel&mdash;</option>
							<option ng-repeat="channel in channels" value="{{channel}}"
									  ng-required="true">#{{channel}}
							</option>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-xs-2" for="message">Message*</label>
					<div class="col-xs-10">
						<textarea class="form-control" id="message" name="message" placeholder="Meow!" rows="5"
									 ng-model="messageData.message" ng-required="true"></textarea>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-xs-2" for="link">Link</label>
					<div class="col-xs-10">
						<input type="text" class="form-control" id="link" name="link"
								 placeholder="https://senator-arlo.bowtied.io/" ng-model="messageData.link" ng-required="false">
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-xs-2" for="linkTitle">Link Title</label>
					<div class="col-xs-10">
						<input type="text" class="form-control" id="linkTitle" name="linkTitle"
								 placeholder="Back Paws for Bernie!" ng-model="messageData.linkTitle" ng-required="false">
					</div>
				</div>
				<div class="form-group">
					<label class="control-label sr-only" for="message">Message</label>
					<div class="col-xs-10 col-xs-offset-2">
						<button type="submit" class="btn">Engage!</button>
						<button type="reset" class="btn" ng-click="reset();">Abandon Ship!</button>
					</div>
				</div>
			</form>
		</main>
		<?php } ?>
	</body>
</html>