<?php
	require_once('../../../../../wp-blog-header.php');
	
	global $wpdb;
	
	$wpdb->update(
		'wp_ndw_timetables',
		array( 
			'isActive' => '0'
		), 
		array('isActive' => '1')
	);
?>