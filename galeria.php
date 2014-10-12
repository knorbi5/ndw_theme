<?php
/*
Template Name: Galeria
*/
	get_header();
	
	$posts = get_posts();
?>
	<div class="galleryCategory">
		<?php foreach($posts as $post){ ?>
			<img class="galleryItem" src="<?php echo wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'medium')[0]; ?>">
		<?php } ?>
	</div>
<?php
	get_footer();
?>