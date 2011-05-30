<?php
# Change these variables if you need to !

#Variable (1) 
# Writable Dir, for ices & playlists
# ============
#$tempdir = "./temp";

# Stlye Sheet
# ===========
# Whats the url to the style sheet, type it perfectly as I'm just gonna echo this var !
#$StyleSheet = "./style.css";

# Ices Binary
# ===========
# If ices isn't installed in the default location, redirect the php with this var.
# $ices = "/usr/local/bin/ices";

# Ices Config
# ===========
#$stream_server="localhost";
#$stream_port="8000";
#$stream_protocol="http";
#$stream_name="php-ices generated stream";
#$stream_genre="php-ices - private";
#$stream_description="php-ices Music Stream";
#$stream_url="http://localhost";

# Ices stream source Password
# ===========================
# This CANNOT be Blank !
$stream_password="mysource1";

# DO NOT EDIT BELOW THIS LINE.
#################################################################
#################################################################

#  check $tempdir
if ( $tempdir == "" ) {
	$pwd = `pwd`;
	$pwd = trim($pwd);
	$tempdir = "$pwd/temp";
}

# Check $styleSheet
if ( $StyleSheet == "") {
	$StyleSheet = "./style.css";
}

# Check ... oh you get the idea ;-p
if ( $ices  == "") {
	$ices = "/usr/local/bin/ices";
}

# Ices Config Checks
if ( $stream_server == "" ) {
	$stream_server="localhost";
}

if ( $stream_port == "") {
	$stream_port="8000";
}

if ( $stream_protocol ==  "") {
	$stream_protocol="http";
}

if ( $stream_name == "" ) {
	$stream_name="php-ices generated stream";
}

if ( $stream_genre == "" ) {
	$stream_genre="php-ices - private";
}

if ( $stream_description == "" ) {
	$stream_description="php-ices Music Stream";
}

if ( $stream_url == "" ) {
	$stream_url="http://localhost";
}
?>
