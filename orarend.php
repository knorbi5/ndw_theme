<?php
/*
Template Name: Tanarok
*/
	require_once('../../../wp-blog-header.php');
	
	$args = array(
	'posts_per_page'   => -1,
	'post_type'        => 'ndwlocations');
	
	$locations = get_posts($args);
?>
	<script type="text/javascript">
		function getDataForLocation(lID, lName){
			jQuery.ajax({
				type: "POST",
				url: "<?php echo get_bloginfo('template_directory'); ?>/interfaces/getPlaceData.php",
				data: {
					locationID: lID,
					locationName: lName
				}
			}).done(function( msg ) {
				jQuery("#ndwSelectedLocationContainer").removeClass("hidden");
				jQuery("#ndwSelectedLocationContainer").html(msg);
			});
		}
	</script>
	
	<div class="ndwLocationsOuter">
		<div class="ndwLocationsContainer">
<?php
			foreach($locations as $location){
?>
				<div class="ndwlocation cPointer" onClick="getDataForLocation('<?php echo $location->ID; ?>', '<?php echo $location->post_title; ?>')"><?php echo $location->post_title; ?></div>
<?php
			}
?>
		</div>
	</div>
	<div id="ndwSelectedLocationContainer" class="hidden">
	</div>