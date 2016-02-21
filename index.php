<!DOCTYPE html>
<html>

	<head>
		<script data-require="angular.js@1" data-semver="1.5.0-rc.0"
				  src="//code.angularjs.org/1.5.0-rc.0/angular.js"></script>
		<script data-require="ui-bootstrap@*" data-semver="1.1.1"
				  src="//cdn.rawgit.com/angular-ui/bootstrap/gh-pages/ui-bootstrap-1.1.1.js"></script>
		<link data-require="bootstrap-css@*" data-semver="3.3.6" rel="stylesheet"
				href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.css"/>
		<link rel="stylesheet" href="css/style.css"/>
		<!--		<script src="script.js"></script>-->
	</head>

	<body>
		<div class="jumbotron">
			<div class="container">
				<h1 class="text-center">Arlo Control Center <span>&block;</span></h1>
			</div>
		</div>

		<div class="container">
			<form class="form-horizontal" action="#">
				<div class="form-group">
					<label class="control-label col-xs-2" for="channel">Channel</label>
					<div class="col-xs-10">
						<select class="form-control" id="channel" name="channel">
							<option value="">Please Select</option>
							<option value="bridge">#bridge</option>
							<option value="cnmstemuluscenter">#cnmstemuluscenter</option>
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