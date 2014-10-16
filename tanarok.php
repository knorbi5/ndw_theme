<?php
/*
Template Name: Tanarok
*/
require_once('../../../wp-blog-header.php');
?>
	<script type="text/javascript">
		function viewTeacher(idToShow){
			// Előző törlése
			jQuery(".ndwTeacherAbout").each(function(){
				if(!jQuery(this).hasClass("hidden")){
					jQuery(this).addClass("hidden");
				}
			});
			
			jQuery("#about_" + idToShow).removeClass("hidden");
			jQuery("#ndwTeacherSelectedArrow").removeClass("hidden");
			
			var calculatedLeftPosition = (jQuery("#" + idToShow).position().left) + (jQuery("#" + idToShow).width()/2) - (jQuery("#ndwTeacherSelectedArrow").width()/2);
			calculatedLeftPosition = calculatedLeftPosition + "px";
			jQuery("#ndwTeacherSelectedArrow").css('left', calculatedLeftPosition);
		}
	</script>
	<div id="ndwTeachers_outer">
		<div id="ndwTeachers_container">
<?php
		
		$args = array(
		'posts_per_page'   => -1,
		'post_type'        => 'ndwteachers');

		$posts = get_posts($args);

		foreach($posts as $post){
?>
			<div id="<?php echo $post->ID; ?>" class="ndwTeacher cPointer" onClick="viewTeacher(<?php echo $post->ID; ?>)"><img src="<?php echo wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'medium')[0]; ?>"></div>
<?php
		}
?>
		</div>
	</div>
	<img id="ndwTeacherSelectedArrow" class="hidden" src="<?php echo get_bloginfo('template_directory'); ?>/images/arrow_up_medium.png">
	<div id="ndwTeacherAboutContainer">
<?php
		foreach($posts as $post){
?>
			<div id="about_<?php echo $post->ID; ?>" class="ndwTeacherAbout hidden">
				<img src="<?php echo wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'large')[0]; ?>">
				<p><?php echo $post->post_title; ?></p>
				<p><?php echo $post->post_content; ?></p>
			</div>
<?php
		}
?>
	</div>