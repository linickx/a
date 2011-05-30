<?php

#INCLUDEZ !
include("./config.php");
include("./lib/htmlstuff.php");

$self=$_SERVER["PHP_SELF"];
?>
<div align=center>
<form enctype="multipart/form-data" action="<?php echo "$self"; ?>" method="POST" >
Path: <input type="text" name="path">
<input type="submit" value="Refresh"> 
</form>
</div>
<?php

# OK... How are we called _GET or _POST

if ( $_GET['path'] != "" ) {
	$wewozgot = true;
}

if ( $_POST['path'] != "" ) {
	$wewozpost = true;
}

if ( $wewozgot) { 
	$path=$_GET['path'];
} elseif ( $wewozpost) {
	$path=$_POST['path'];
} else {
	$path="./";
}


#function backbutton() {

?>
<!-- Java Script Back Button -->
<!-- a href="javascript:history.go(-1)" onMouseOver="self.status=document.referrer;return true">BACK</a -->

<?php
#}
if ( $path == "" ) {
	$path ="./";
}

#Clean up path
$path = trim($path);

#Check for trailing slashes
$pathlength = strlen($path);
$pathlength = $pathlength - 1;
$lastchar = substr("$path", $pathlength, 1);

if ( $lastchar != "/") {
	$path = "$path/";
}

if (is_dir($path)) {
htmlhead();
backbutton();
?>
<form enctype="multipart/form-data" action="./playlist.php" method="POST" >
<ul>
<?php
   if ($dh = opendir($path)) {
       while (($file = readdir($dh)) !== false) {
		$firstchar = substr($file,0,1);
		if ( $firstchar !== "." ) {
			?><li><?php
			if (is_dir("$path$file")) {
				?>
				<A href="<?php echo "$self?path=$path$file/" ;?>">[<?php echo $file; ?>]</A>
			<?php
			} else {
			?>
				<input type="checkbox" name="mpeg[]" value="<?php echo $file;?>" />
				<A href="<?php echo "$path$file"; ?>"><?php echo $file ;?></A><br>
			<?php
			}
			?></li><?php
		}
       }
       closedir($dh);
   }
?>
</ul>
<?php
}
?>
<input type=hidden name="path" value="<?php echo "$path"; ?>" />
<input type="submit" value="Submit">
<?php
htmlfoot();
?>
