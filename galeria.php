<?php
/*
Template Name: Galeria
*/
	get_header();

	$galleryID = get_cat_ID('galeria');
	
	$categories = get_categories(
		array('parent' => $galleryID)
	);
	?>
	<style type="text/css">
		body{
			background: #f4f4f4;
		}
	</style>
	<script type="text/javascript">
		;( function( jQuery ) {
			jQuery( '.swipebox' ).swipebox({hideBarsDelay : 0});
		} )( jQuery );
	
		function closeCategory(id){
			// ÖSSZES BEZÁRÁSA
			jQuery(".galleryCategory").addClass("hidden");
			jQuery(".gallery_arrow").attr("src","<?php echo get_bloginfo('template_directory'); ?>/images/gallery_icons/arrow_down.png");
			
			var elementToControl = jQuery("#" + id);
			var elementArrow = jQuery("#arrow_" + id);
			
			elementToControl.removeClass('hidden');
			elementArrow.attr('src','<?php echo get_bloginfo('template_directory'); ?>/images/gallery_icons/arrow_up.png');
		}
	</script>
	<div id="content">
	<?php
	$hiddenCounter = 1;
	foreach($categories as $category){
	?>
		<div class="galleryCategoryTitle cPointer" onClick="closeCategory('gallery_<?php echo $category->cat_ID; ?>');">
			<span class="leftFloat"><?php echo $category->name; ?></span>
			<hr>
			<img id="arrow_gallery_<?php echo $category->cat_ID; ?>" class="gallery_arrow rightFloat" src="<?php echo get_bloginfo('template_directory'); ?>/images/gallery_icons/arrow_<?php if($hiddenCounter >= 2){echo 'down';}else{echo 'up';} ?>.png">
			<div class="clear"></div>
		</div>
		<div class="galleryCategory<?php if($hiddenCounter >= 2){echo ' hidden';} ?>" id="gallery_<?php echo $category->cat_ID; ?>">
			<?php
				$args = array('category'=>$category->cat_ID, 'posts_per_page'=>-1);
				$posts = get_posts($args);
				
				foreach($posts as $post){
			?>
				<a href="<?php echo wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'full')[0]; ?>" class="swipebox galleryItem" title="<?php echo $category->name; ?>">
					<img src="<?php echo wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'medium')[0]; ?>">
				</a>
			<?php 
				}
			?>
		</div>
	<?php
		$hiddenCounter++;
	}
	?>
	</div>
	<?php
	get_footer();
?>