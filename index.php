<?php

#INCLUDEZ !
include("./config.php");
include("./lib/htmlstuff.php");

# The first thing to do is make sure we have a direcory to write to:

$tempfile = "$tempdir/.writeable";
$handle = @fopen ("$tempfile", 'w');
$test_text="ok";

# Write "ok" into the file ....
@fwrite($handle, $test_text);
@fclose($handle);

if (file_exists($tempfile)) {
		$filecontents = file_get_contents($tempfile );
	}
	
	if (!$filecontents == "ok" ) {
		# Oh Dear write failed, better tell the user.
		htmlhead();
		?>
<h1> Error no Writeable Directory !! <br> Please Make <?php echo "$tempdir"; ?> is Writeable for your Webserver.</h1>
	<?php
	htmlfoot();
        exit;
	}

?>

<html>
<head>
<title> PHP-ices - ices control from your web browser !</title>
</head>
<frameset rows="35%,*" frameborder=0>
		<frame scrolling=no src="player.php">
		<frame src="playlist.php" name=main>
	</frameset>
</frameset>
<noframes>
eh ? no frames your broswer is old !!!
</noframes>
</html>
<?php

?>
