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
	} else {
		throw(new RuntimeException("method $method not allowed", 405));
	}
} catch(Exception $exception) {
	$reply->status = $exception->getCode();
	$reply->message = $exception->getMessage();
}

header("Content-type: application/json");
echo json_encode($reply);