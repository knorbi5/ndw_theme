<?php
	require_once('../../../../../wp-blog-header.php');
	
	global $wpdb;
	
	$wpdb->insert(
		'wp_ndw_timetables',
		array(
			'teacherName' => $_POST['teacherName'],
			'startTime' => $_POST['startTime'],
			'endTime' => $_POST['endTime'],
			'dayOfWeek' => $_POST['dayOfWeek'],
			'locationID' => $_POST['locationID'],
			'style' => $_POST['style'],
			'isActive' => '1'
		)
	);
?>