<?php

#INCLUDEZ !
include("./config.php");
include("./lib/htmlstuff.php");

# fairly obvious what this is
$playlist = "$tempdir/playlist.txt";

if (!file_exists($playlist)) {
	$touch_playlist=`touch $playlist`;
	if (!file_exists($playlist)) {
		htmlhead();
		?>
<h1> ERROR: Write to <?php echo "$playlist"; ?> Failed </h1>
Please check <?php echo "$tempdir"; ?> is writeable
		<?php
		htmlfoot();
		exit;
	}
}

# Where do we submit stuff ?
$self=$_SERVER["PHP_SELF"];

# ok so we're happy.....

# Our Submissions.
$mpeg=$_POST['mpeg'];
$path=$_POST['path'];
$action=$_POST['action'];
$number=$_POST['number'];

# functions
##############################

function read_playlist_file() {
	 global $playlist,$playlist_contents;

        # Lets make sure we've got something to read ;-)
        if (file_exists($playlist)) {

                # Lets read the file into an array.
                $playlist_contents = file($playlist);
	}
}

function print_playlist() {

	global $playlist_contents;
	read_playlist_file();

       	# We need a counter to increment for the array. since each line is significant... ahh you'll see.
       	$counter = 0;
	?>
	<table border=1>
	<form enctype="multipart/form-data" action="<?php echo $self ; ?>" method="POST" >
	<tr>
	<td colspan=3>
	<input type=hidden name="action" value="deletefiles" >
	<input type="submit" value="Delete Selected Files">
	</td>
	</tr>
	<tr>
	<td colspan=2>Num</td><td>File Name</td>
	</tr>
	<?php
       	foreach ($playlist_contents as $line_num => $line) {
	?>
		<tr>
		<td>
		<?php $post_counter = $counter+1 ; //Need this to print numbers as 0 F*cks things ?>
		<input type="checkbox" name="number[]" value="<?php echo $post_counter; ?>" />
		</td>
		<td>
	<?php
		echo $post_counter;
	?>
		</td>
		<td>
	<?php
		echo $line;
	?>
		</td>
		</tr>
	<?php
		$counter++;
	}
	?>
	</form>
	<tr>
	<tr>
	<td colspan=3>
	<?php print_toolbar(); ?>
	</td>
	</tr>
	</form>
	<?php
}

function print_toolbar() {
	global $self;

	?>
	<table>
	<tr>
	<td>
	<A href="./ls.php"> Browser </A>
	</td>
	<td>
	<form enctype="multipart/form-data" action="<?php echo $self ; ?>" method="POST" >
        <input type=hidden name="action" value="clear_playlist" >
        <input type="submit" value="Clear Playlist">
        </form>
	</td>
	</tr>
	</table>
	<?php
}

# This bit actually runs :-)

# OK do we want to clear the playlist ?
if ($action == "clear_playlist" ) {
	if ($mpeg == "yes_im_sure" && $path =="[LINICKX]" ) {
		# OK, lets write an empty var... what do you think ?
		$handle = @fopen ("$playlist", 'w');
		# Write into the file ....
		@fwrite($handle, $linickx_empty_var);
		@fclose($handle);
		htmlhead();
		?>
		<h1>
		Playlist Cleared.
		<p>
		<A href="./ls.php"> Browser </A>
		</h1>
		<?php
		htmlfoot();
		exit;
	} else {
		htmlhead();
		?>
		<h2>You are about to clear the playlist</h2>
		<h1>Are You SURE ? </h1>
		<form enctype="multipart/form-data" action="<?php echo $self ; ?>" method="POST" >
        	<input type=hidden name="action" value="clear_playlist" >
		<input type=hidden name="mpeg" value="yes_im_sure" >
		<input type=hidden name="path" value="[LINICKX]" >
        	<input type="submit" value="YES I'm SURE">
        	</form>
		<?php
		backbutton();
		htmlfoot();
		exit;
	}
}

if ($action == "deletefiles" ) {
	# Lets Delete some files !
	# or at least some entries from the playlist :-D

	global $playlist_contents,$number,$playlist;
	read_playlist_file();
	foreach ($number as $file_num => $array_num) {
		$playlist_contents[($array_num-1)] = "delme";
	}

	foreach ($playlist_contents as $line_num => $current_track) {
			
		if ( $current_track != "delme") {
			# the orriginal play list array had some line feeds in, probably best to clean them else we'll have problems
			$line = trim($current_track);
			# ok, big var for writing, and ices needs line feeds , so lets add some ;-)
			$var_for_writing .= "$line\n";
			}
	}
	# Debuggering: echo "<pre>$var_for_writing</pre>";
	# OK, lets write some data :-)
	$handle = @fopen ("$playlist", 'w');
	
	# Write into the file ....
	@fwrite($handle, $var_for_writing);
	@fclose($handle);
		
	# Now if we drop out, we'll end up printing our new playlist !
}


# ok... adding or displaying ?
 
if ($mpeg == "" || $path == "" ) {
	htmlhead();
	print_playlist();
	htmlfoot();
} else {

	# Fix spaces for dir traversal
	$path = str_replace("\ ", " ", $path);

	$counter = 0;

	foreach ($mpeg as $files) {
		# Let's clean the string - just in case.
		$files = trim($files);
		# First we reverse the string
		$backwards_files = strrev($files);
		# Then we count the first 4 char
		$file_ext = substr($backwards_files, 0, 4);
		# if the file ext is .mp3 (backwards) ;-)
		if ( $file_ext == "3pm." ) {
			# then it's an mp3 we can use !
			$mp3s[$counter] = "$path$files";
			# just testing ;-)
			# echo "<br> $path$files";
			$counter++;
		}
	}
	
	if ( $mp3s[0] == "" ) {
		# oh dear the first entry in array mp3s is blank, can't have found any .mp3's then.
		htmlhead();
		echo "<h1>No mp3's recieved.</h1>";
		print_playlist();
		htmlfoot();
		exit;
	} else {
		# yay - music

		#read in the current playlist
		read_playlist_file();
		# merge current playlist with new one :-)
		$newplaylist = array_merge_recursive($playlist_contents, $mp3s);
		
		# sadly, we need to export our array to a single variable so that we can write it to a file.
		foreach ($newplaylist as $line_num => $line) {
			# the orriginal play list array had some line feeds in, probably best to clean them else we'll have problems
			$line = trim($line);
			# ok, big var for writing, and ices needs line feeds , so lets add some ;-)
			$var_for_writing .= "$line\n";
		}

		# OK, lets write some data :-)
		$handle = @fopen ("$playlist", 'w');
	
		# Write into the file ....
		@fwrite($handle, $var_for_writing);
		@fclose($handle);
		
		htmlhead();
		print_playlist();
		htmlfoot();
	}

}
?>
