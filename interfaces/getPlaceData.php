<?php
	require_once('../../../../wp-blog-header.php');
	
	global $wpdb;
	$locationID = $_POST['locationID'];
	$locationName = $_POST['locationName'];
	$selectedLocation = get_post($locationID);
	
	$classes = $wpdb->get_results('SELECT * FROM wp_ndw_timetables WHERE locationID='.$locationID.' AND isActive = 1 ORDER BY dayOfWeek');
	$days = [0=>"Vasárnap", 1=>"Hétfő", 2=>"Kedd", 3=>"Szerda", 4=>"Csütörtök", 5=>"Péntek", 6=>"Szombat"];
	
?>
	<div id="ndwSelectedLocation">
		<h3>NDW <?php echo $locationName; ?></h3>
		<iframe id="ndwSelectedLocationGMaps" src="<?php echo get_post_meta($locationID, 'ndwLocationGmaps')[0]; ?>" width="400" height="300" frameborder="0"></iframe>
		<div id="ndwTimetable">
			<div id="ndwTimetableDay">
<?php
				$actualDay = "";
				$dayContainerStarted = false;
				foreach($classes as $class){
					if($class->dayOfWeek != $actualDay){
						$actualDay = $class->dayOfWeek;
						
						if($dayContainerStarted){
?>
							</div>
<?php
						}else{
							$dayContainerStarted = true;
						}
?>
						<div class="ndwDayContainer">
						<div class="dayOfWeek"><?php echo $days[$class->dayOfWeek]; ?></div>
<?php
					}
?>
					<div class="ndwClass"><?php echo $class->teacherName." ".$class->startTime." - ".$class->endTime." ".$class->style; ?></div>
<?php
				}
?>
			</div>
		</div>
	</div>