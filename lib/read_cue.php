<?php

$cuefile = "/tmp/ices.cue";

# Lets make sure we've got something to read ;-)
if (file_exists($cuefile)) {

	# Lets read the file into an array.
	$lines = file($cuefile);

	# We need a counter to increment for the array. since each line is significant... ahh you'll see.
	$counter = 0;

	foreach ($lines as $line_num => $line) {
	
		if ( $counter == "0" ) {
			$filename = trim($line);
		} elseif ( $counter == "1") {
			$filesize = trim($line);
		} elseif ( $counter == "2") {
			$bitrate = trim($line);
		} elseif ( $counter == "3") {
			$songlenght = trim($line);
		} elseif ( $counter == "4") {
			$percentageplayed = trim($line);
		} elseif ( $counter == "5" ) {
			$playlistindex = trim($line);
		} elseif ( $counter == "6" ) {
			$id3artist = trim($line);
		} elseif ( $counter == "7" ) {
			$id3title = trim($line);
		} else {
			# we don't need anything else !
			$counter++;
		}
	
		# increment counter !
		$counter++;
	}
}
?>
