<?php

/**

	Secrets and Config.

	This is an example, change the settings below and save as "config.php"
	
*/
	// mySQL Config
	
	// OpenShift Variables (openshift.redhat.com)
	// $db_host = $_ENV['OPENSHIFT_DB_HOST'];
	// $db_user = $_ENV['OPENSHIFT_DB_USERNAME'];
	// $db_pass = $_ENV['OPENSHIFT_DB_PASSWORD'];
	// $db_name = $_ENV['OPENSHIFT_APP_NAME'];
	// $db_port = $_ENV['OPENSHIFT_DB_PORT'];

	$db_host = "localhost";
	$db_user = "root";
	$db_pass = "password";
	$db_name = "database";
	$db_port = "3306";

	// register at http://twitter.com/oauth_clients and fill these two 
	define("TWITTER_CONSUMER_KEY", "key");
	define("TWITTER_CONSUMER_SECRET", "secret");

	// Secret Key for Cookie CheckSum
	define("SALT", "mysecretsalt"); // <-- CHANGE ME :)

	// What is our URL ?
	// $www = "http://" . $_SERVER["HTTP_HOST"];
	$www = "http://www.example.com";

?>