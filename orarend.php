<?php
/*
Template Name: Tanarok
*/
	require_once('../../../wp-blog-header.php');
	
	$args = array(
	'posts_per_page'   => -1,
	'post_type'        => 'ndwlocations');
	
	$posts = get_posts($args);
	
	$ndwLocations = array();
	
	foreach($posts as $post){
		$ndwLocations[] = array($post->post_title, 0, 1, 2, 3, 4, 5, 6);
	}
	
	//print_r($ndwLocations);
?>