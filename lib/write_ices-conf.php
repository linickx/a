<?php

include("./config.php");

######################
# Constant Variables #
######################

# These variables have not been captured anywhere else & are required to write the config file.

$playlist="$tempdir/playlist.txt";
$randomize="0";
$base_dir=$tempdir;

####################

$ices_conf = '<?xml version="1.0"?>';
$ices_conf .='<ices:Configuration xmlns:ices="http://www.icecast.org/projects/ices">';
$ices_conf .= "
<Playlist>
				<File>$playlist</File>
				<Randomize>$randomize</Randomize>
				<Type>builtin</Type>
				<Module>ices</Module>
			        <Crossfade>5</Crossfade>
			</Playlist>
			<Execution>
				<Background>1</Background>
				<Verbose>0</Verbose>
				<Base_Directory>$base_dir</Base_Directory>
			</Execution>
  <Stream>
    <Server>
      <Hostname>$stream_server</Hostname>
      <Port>$stream_port</Port>
      <Password>$stream_password</Password>
      <Protocol>$stream_protocol</Protocol>
    </Server>

    <Mountpoint>/php-ices</Mountpoint>
    <Dumpfile>php-ices.dump</Dumpfile>
    <Name>$stream_name stream</Name>
    <Genre>$stream_genre genre</Genre>
    <Description>$stream_description description</Description>
    <URL>$stream_url</URL>
    <Public>0</Public>

    <Bitrate>128</Bitrate>
    <Reencode>0</Reencode>
    <Channels>2</Channels>
  </Stream>
</ices:Configuration>";

##############
# Write File #
##############

$config_file = "$tempdir/ices.conf";
$handle = @fopen ("$config_file", 'w');
@fwrite($handle, $ices_conf);
@fclose($handle);

#if (!file_exists($config_file) {
#	echo "$config_file was not written";
#}

?>
