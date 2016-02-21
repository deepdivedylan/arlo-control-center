<?php
require_once(dirname(__DIR__, 2) . "/lib/xsrf.php");
require_once("/etc/apache2/capstone-mysql/encrypted-config.php");

//verify the xsrf challenge
if(session_status() !== PHP_SESSION_ACTIVE) {
	session_start();
}

//prepare an empty reply
$reply = new stdClass();
$reply->status = 200;
$reply->message = null;

try {
	// read the encrypted config
	$config = readConfig("/etc/apache2/capstone-mysql/arlo-control-center.ini");

	//determine which HTTP method was used
	$method = array_key_exists("HTTP_X_HTTP_METHOD", $_SERVER) ? $_SERVER["HTTP_X_HTTP_METHOD"] : $_SERVER["REQUEST_METHOD"];

	// grab the available channels
	$channels = json_decode($config["channels"]);

	// build an array of all channels on a GET
	if($method === "GET") {
		setXsrfCookie();
		$reply->data = array_keys(get_object_vars($channels));
		unset($reply->message);
	} else if($method === "POST") {
		verifyXsrf();
		$requestContent = file_get_contents("php://input");
		$requestObject = json_decode($requestContent);

		// if they're not logged in, buzz off!
		if(empty($_SESSION["adUser"]) === true || (time() - $_SESSION["adUser"]["loginTime"]) > 3600) {
			throw(new RuntimeException("not logged in", 401));
		}

		// if they're logged in, update their login time
		$_SESSION["adUser"]["loginTime"] = time();

		// sanitize inputs
		if(in_array($requestObject->channel, array_keys(get_object_vars($channels))) === false) {
			throw(new RuntimeException("no valid channel selected", 418));
		}
		$message = filter_var($requestObject->message, FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_FLAG_NO_ENCODE_QUOTES);

		// post the actual message
		$post = http_build_query(["payload" => json_encode(["text" => $message])]);
		$options = [
			"http" => [
				"method" => "POST",
				"header" => "Content-type: application/x-www-form-urlencoded",
				"content" => $post
			]
		];
		$context = stream_context_create($options);
		$url = $channels->{$requestObject->channel};
		$reply->message = file_get_contents($url, false, $context);
	} else {
		throw(new RuntimeException("method $method not allowed", 405));
	}
} catch(Exception $exception) {
	$reply->status = $exception->getCode();
	$reply->message = $exception->getMessage();
}

header("Content-type: application/json");
echo json_encode($reply);