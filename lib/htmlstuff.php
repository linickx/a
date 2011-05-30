<?php

include("./config.php");

# Where do we submit stuff ?
$self=$_SERVER["PHP_SELF"];

function htmlhead() {

	global $html_title, $StyleSheet;

?>
<!-- Written By [LINICKX], All the code was out of my brain, and _RIGHT_NOW_ I'm very happy and proud :oD -->
<html>
<head>
<link rel=stylesheet type="text/css" href="<?php echo "$StyleSheet"; ?>" >
<title> <?php echo $html_title; ?> </title>
</head>
<Body>

<?php
}

function htmlrefreshhead() {

	global $html_title, $StyleSheet, $self;

?>
<!-- Written By [LINICKX], All the code was out of my brain, and _RIGHT_NOW_ I'm very happy and proud :oD -->
<html>
<head>
<link rel=stylesheet type="text/css" href="<?php echo "$StyleSheet"; ?>" >
<title> <?php echo $html_title; ?> </title>
<META HTTP-EQUIV="refresh" CONTENT="10;URL=<?php echo $self ; ?>">
</head>
<Body>

<?php
}

function htmlfoot() {
	
?>

<!-- http://www.rootshell.be/~linickx -->

</body>
</html>


<?php
}

function backbutton() {

?>
<!-- Java Script Back Button -->
<a href="javascript:history.go(-1)" onMouseOver="self.status=document.referrer;return true">BACK</a>

<?php
}
