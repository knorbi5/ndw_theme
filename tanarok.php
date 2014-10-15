<?php
/*
Template Name: Tanarok
*/
	get_header();
?>
	<div id="ndwTeachers_outer">
		<div id="ndwTeachers_container">
<?php
		
		$args = array(
		'posts_per_page'   => -1,
		'post_type'        => 'ndwteachers');

		$posts = get_posts($args);

		foreach($posts as $post){
?>
			<div class="ndwTeacher cPointer"><img src="<?php echo wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'thumbnail')[0]; ?>"></div>
<?php
		}
?>
		</div>
	</div>
	<div id="content">
	</div>
<?php
		
	get_footer();
?>