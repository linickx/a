<?php

	/**
		
		It all starts here!
	
	*/

	require_once("setup.php"); // ready, setup, go!


	if (isset($_COOKIE['rxalert'])) { 
		
		require_once("../libs/dashboard.php");	// show logged in pages.

	} else {
	
		require_once("../libs/homepage.php"); // show anony-pages.

	}

?>