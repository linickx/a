<?php

#INCLUDEZ !
include("./config.php");
include("./lib/htmlstuff.php");

# Some "hard" variables;
$ices_pid_file="/tmp/ices.pid";

# Where do we submit stuff ?
$self=$_SERVER["PHP_SELF"];

# 1st lets make sure that ices has been configured !

if ( $stream_password == "" ) {
	# No Stream password, we boned !
	htmlhead();
	?>
	<h1> No Stream Password has been Set ! </h1>
	<b>Please look at the config file</b> <br>
	Line 30 has a variable: $stream_password <br>
	Please set this to the same password you would in ices.conf
	<?php
	htmlfoot();
        exit;
        }

# Next let's see if ices binary exists

if (!file_exists($ices)) {
	# No Ices to run, definatley Boned !
	htmlhead();
        ?>
	<h1> Can't Find Ices Binary ! </h1>
	<b>Please look at the config file</b> <br>
	<?php echo $ices; ?> Doesn't Exist !
	<?php
	htmlfoot();
	exit;
}

# Ok so we have a config & a Binary...

# do we have a playlist to load ?

$playlist = "$tempdir/playlist.txt";

if (!file_exists($playlist)) {
	# No Playlist !
	if (!$htmlheadset) {
		htmlhead();
	}
	?>
	<h1> No Playlist loaded: (File Doesn't Exist) </h1>
	<?php
	htmlfoot();
        exit;
}

# if we do have a playlist file... is it blank ?
if (file_exists($playlist)) {

        # Lets read the file into an array.
        $lines = file($playlist);
	if ( $lines[0] == "" ) {
		echo "<br test";
		# do the same as above
		 htmlhead();
       		?>
       		<h1> No Playlist loaded: (File Empty)  </h1>
       		<?php
       		htmlfoot();
       		exit;
	}
			
}


############################################################
# Ok if we have a playlist We have something to do - yay ! #
############################################################

# we're gonna need a form for the controls,

# Lets have a function to print the controls form !
function printcontrols() {
	global $self;
	?>
<table border=1>
<tr>
<td>
<form enctype="multipart/form-data" action="<?php echo "$self"; ?>" method="POST" >
<input type=hidden name="action" value="PLAY">
<input type="submit" value="PLAY">
</form>
</td>
<td>
<form enctype="multipart/form-data" action="<?php echo "$self"; ?>" method="POST" >
<input type=hidden name="action" value="SKIP">
<input type="submit" value="SKIP->">
</form>
</td>
<td>
<form enctype="multipart/form-data" action="<?php echo "$self"; ?>" method="POST" >
<input type=hidden name="action" value="KILL">
<input type="submit" value="STOP">
</form>
</td>
</table>
	<?php

}

###########################
# Ices control functions. #
###########################

function ices_check() {
	global $ices_running, $ices_pid_file;
	if (!file_exists("$ices_pid_file")) {
        	# ices is not running
        	$ices_running=false;
	} else {
        	$ices_running=true;
	}
}

function ices_play() {
	include("./lib/write_ices-conf.php");
	$play_ices = `$ices -B -c $tempdir/ices.conf`;
}

function ices_skip() {
	global $ices_pid_file;
	if (file_exists($ices_pid_file)) {
                $ices_pid = file_get_contents($ices_pid_file );
        }
        $kill_ices = `kill -usr1 $ices_pid`;

}

function ices_kill() {
	global $ices_pid_file;
	if (file_exists($ices_pid_file)) {
                $ices_pid = file_get_contents($ices_pid_file );
        }
	$kill_ices = `kill -int $ices_pid`;
	$rm_ices_pid_file = `rm $ices_pid_file`;

}

###################################
# What have we been asked to do ? #
###################################

$action=$_POST["action"];

if ( $action == "PLAY" ) {
	ices_play();
}

if ( $action == "SKIP" ) {
	ices_skip();
}

if ( $action == "KILL") {
	ices_kill();
}

#ELSE PLAYER !!!


##########
# PLAYER #
##########

ices_check();

if (!$ices_running) {
	?><h1> ices NOT running </h1>
	<?php
}

htmlrefreshhead();

include("./lib/read_cue.php");
if (file_exists($cuefile)) {
	?><ul><?php
echo "<li>filename: $filename </li><li>filesize: $filesize </li><li>bitrate: $bitrate </li><li>song length: $songlenght </li><li>Percentage player: $percentageplayed </li><li>playlist index: $playlistindex </li><li>id3 artist: $id3artist </li><li>id3 title: $id3title </li>";
	?></ul><?php
	}

printcontrols();
htmlfoot();
?>
