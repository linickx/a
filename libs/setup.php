<?php

/**

	Setup Script, load up database, create tables and load up any libraries all scripts need..
	
*/


	if (file_exists('./config.php')) {
		require_once('./config.php'); 
	} else {
	 	die('404: Config Not Found.');
	}

	// Load up Libraries

	include_once "../libs/ez_sql_core.php";
	include_once "../libs/ez_sql_mysql.php";

	include_once "../libs/myfunctions.php";

	// MySQL Connection

	$mysql_server =  $db_host . ":" . $db_port;     // server details
	$db = new ezSQL_mysql($db_user,$db_pass,$db_name,$mysql_server); // Username , password , DB
	$debug = false; // no debug by default.

	// Table Checking...

	$my_tables = $db->get_results("SHOW TABLES LIKE '%user%'",ARRAY_N); // query db for user table

	if (!$my_tables) { // We have no tables, better create some....

		$db->query("CREATE TABLE IF NOT EXISTS user (id int(50) NOT NULL auto_increment, tw_at varchar(100), tw_sec varchar(100),KEY id (id)) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=4954 ;");

		$my_tables = $db->get_results("SHOW TABLES",ARRAY_N);

		if ($my_tables) {
 			echo "<h2>Table created</h2>";
 			$debug = true;

		} else {
			die("Euston, We have a problem.... failed to create user table");
		}
	}

	if ($debug) {
		$db->debug(); // show tables
	}



?>