<?php


#####################################
# THIS IS NOT PART OF APPLICATION   #
#####################################


# This file was used to handle ls.php

# i needed to make sure what ls.php was passing was usable :-)

# this code has been kept for education purposes - mine mainly !

$array=$_POST;
$mpeg=$array['mpeg'];

$path=$_POST['path'];

echo "<h1>Path: $path</h1>";
print_r ($array);

print_r ($mpeg);

echo "<p>array:<br>";
var_dump($array);
echo "<p>";
echo "mpeg:<br>";
var_dump($mpeg);

echo "<h4>";
echo $mpeg[1];
echo "</h4>";

foreach ($mpeg as $files) {
	echo "<h2>$files</h2>";
	echo "<h2>$path</h2>";

	# Fix spaces for dir traversal
	$files = str_replace(" ", "\ ", $files);

	$test = `tail $path$files`;

	echo "<p>$path$files<p>";
	echo "<pre> $test </pre>";
}


?>
