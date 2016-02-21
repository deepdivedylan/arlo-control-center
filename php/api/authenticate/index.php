<?php
require_once(dirname(__DIR__, 2) . "/lib/xsrf.php");

// Tomcat endpoint to POST to
$ADJSON_ENDPOINT = "http://localhost:8080/adjson/aduser/";

// Red Alert! All officers to the bridge!
$BRIDGE = ["dmcdonald21", "rlewis37", "srexroad"];

//verify the xsrf challenge
if(session_status() !== PHP_SESSION_ACTIVE) {
	session_start();
}

//prepare an empty reply
$reply = new stdClass();
$reply->status = 200;
$reply->message = null;

try {
	//determine which HTTP method was used
	$method = array_key_exists("HTTP_X_HTTP_METHOD", $_SERVER) ? $_SERVER["HTTP_X_HTTP_METHOD"] : $_SERVER["REQUEST_METHOD"];

	if($method === "POST") {
		verifyXsrf();
		$requestContent = file_get_contents("php://input");
		$requestObject = json_decode($requestContent);

		// filter the username, but let the password be because filter_var() can change the password inadvertently
		$username = strtolower(filter_var($requestObject->username, FILTER_SANITIZE_STRING));
		$password = $requestObject->password;

		// if a non bridge officer attempts to login, get rid of them
		if(in_array($username, $BRIDGE) === false) {
			throw(new RuntimeException("Invalid username/password", 401));
		}

		// build the HTTP query and send it off to Tomcat
		$post = http_build_query(array("username" => $username, "password" => $password));
		$options = array(
			"http" => array(
				"method" => "POST",
				"header" => "Content-type: application/x-www-form-urlencoded",
				"content" => $post
			)
		);
		$context = stream_context_create($options);
		$jsonString = file_get_contents($ADJSON_ENDPOINT, false, $context);

		// convert the JSON reply to an object and interpret the results
		$tomcatReply = json_decode($jsonString);
		if($tomcatReply->status !== 200) {
			throw(new RuntimeException($tomcatReply->message, 401));
		}

		$loginTime = time();
		$fullName = $tomcatReply->firstName . " " . $tomcatReply->lastName;
		$username = $tomcatReply->username;
		$_SESSION["adUser"] = array("loginTime" => $loginTime, "fullName" => $fullName, "username" => $username);
		$reply->message = "Logged in as $fullName";
	} else {
		// set the cookie on a GET before throwing the exception
		if($method === "GET") {
			setXsrfCookie();
		}
		throw(new RuntimeException("method $method not allowed", 405));
	}
} catch(Exception $exception) {
	$reply->status = $exception->getCode();
	$reply->message = $exception->getMessage();
}

header("Content-type: application/json");
echo json_encode($reply);