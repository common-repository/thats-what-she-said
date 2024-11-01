<?php
/**
 * @package That's what she said
 * @version 1.0
 */
/*
Plugin Name: That's what she said
Plugin URI: http://wordpress.org/extend/plugins/thats-what-she-said/
Description: 	Simple mash-up of Matt Mullenwheg's original plugin Hello Dolly with Jessamin Smith's Talkbackbot featuring quotes by notable women.
Author: Marie-lynn Richard
Version: 1
Author URI: http://marie-lynn.org/
*/

function get_quotes() {
	/** These are quotes by notable women */
	
	$myfile = plugin_dir_path( __FILE__ )."/thats-what-she-said/quotes.txt";
	$quotes = file_get_contents($myfile);
	
	
	// Here we split it into lines
	$quotes = explode( "\n", $quotes );

	// And then randomly choose a line
	return wptexturize( $quotes[ mt_rand( 0, count( $quotes ) - 1 ) ] );
}

// This just echoes the chosen line, we'll position it later
function thats_what_she_said() {
	$chosen = get_quotes();
	echo "<p id='dolly'>$chosen</p>";
}

// Now we set that function up to execute when the admin_notices action is called
add_action( 'admin_notices', 'thats_what_she_said' );

// We need some CSS to position the paragraph
function thats_what_she_said_css() {
	// This makes sure that the positioning is also good for right-to-left languages
	$x = is_rtl() ? 'left' : 'right';

	echo "
	<style type='text/css'>
	#thats_what_she_said {
		float: $x;
		padding-$x: 15px;
		padding-top: 5px;		
		margin: 0;
		font-size: 11px;
	}
	</style>
	";
}

add_action( 'admin_head', 'thats_what_she_said_css' );

?>
