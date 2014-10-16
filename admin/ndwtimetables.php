<script type="text/javascript">
	function addNewSettingField(id){
		var randomId = Math.floor((Math.random() * 1000) + 1);
		jQuery("#tb_" + id).append("<tr id='tb_data_" + randomId + "' class='timetableData'><td class='teacherName'><input type='text' value=''></input></td><td class='startTime'><input type='text' value=''></input></td><td class='endTime'><input type='text' value=''></input></td><td class='dayOfWeek'><select><option value='1'>Hétfő</option><option value='2'>Kedd</option><option value='3'>Szerda</option><option value='4'>Csütörtök</option><option value='5'>Péntek</option><option value='6'>Szombat</option><option value='0'>Vasárnap</option></select></td><td class='style'><input type='text' value=''></input></td><td style='border: none;' onClick='deleteSettingField(" + randomId + ")'><img class='cPointer' style='width: 15px;' src='<?php echo get_bloginfo("template_directory"); ?>/images/admin_icons/minus.png'></td></tr>");
	}
	
	function deleteSettingField(id){
		jQuery("#tb_data_" + id).remove();
	}
	
	function saveTimetable(){
		jQuery("#saveTimetableBtn").html("Mentés folyamatban...");
		
		setTimeout(function(){
			jQuery.ajax({
				type: "POST",
				url: "<?php echo get_bloginfo('template_directory'); ?>/admin/interfaces/resetTimetable.php",
				async: false
			});
			
			jQuery(".timetableData").each(function(){
				var teacherNameParam = jQuery(this).children(".teacherName").children().val();
				var startTimeParam = jQuery(this).children(".startTime").children().val();
				var endTimeParam = jQuery(this).children(".endTime").children().val();
				var locationIDParam = jQuery(this).parent().parent().attr('data-locationId');
				var dayOfWeekParam = jQuery(this).children(".dayOfWeek").children().val();
				var styleParam = jQuery(this).children(".style").children().val();
				
				jQuery.ajax({
					type: "POST",
					url: "<?php echo get_bloginfo('template_directory'); ?>/admin/interfaces/saveTimetable.php",
					data:{
						locationID: locationIDParam,
						teacherName: teacherNameParam,
						startTime: startTimeParam,
						endTime: endTimeParam,
						dayOfWeek: dayOfWeekParam,
						style: styleParam
					},
					async: false
				});
			}).promise().done(function(){
				jQuery(".wrapper").before("<div id='ndw_status' class='updated' style='margin-left: 0;'><p>Órarendek mentve</p></div>");
				jQuery('html,body').scrollTop(0);
				
				function startStatusTiming(){
					setTimeout(function(){
						jQuery("#ndw_status").remove();
						jQuery("#saveTimetableBtn").html("Mentés");
					}, 2000);
				}
				startStatusTiming();
				//location.reload();
			});
		}, 500);
	}
</script>
<script type="text/javascript" src="<?php echo get_bloginfo('template_directory'); ?>/js/jquery-1.11.1.min.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo get_bloginfo('template_directory'); ?>/style.css">
<div class='wrapper'>
	<h2>Órarendek szerkesztése (BETA)</h2>
	<?php
		global $wpdb;
	
		$args = array(
		'posts_per_page'   => -1,
		'post_type'        => 'ndwlocations');
		
		$posts = get_posts($args);
		
		foreach($posts as $post){
		?>
			<h3><?php echo $post->post_title; ?></h3>
			<table id="tb_<?php echo $post->ID; ?>" data-locationId="<?php echo $post->ID; ?>" class="ndwTimetable">
				<tr>
					<th>Tanár neve</th>
					<th>Kezdés időpontja</th>
					<th>Befejezés időpontja</th>
					<th>Nap</th>
					<th>Stílus</th>
				</tr>
			<?php
				$results = $wpdb->get_results('SELECT * FROM wp_ndw_timetables WHERE locationID='.$post->ID.' AND isActive = 1 ORDER BY dayOfWeek');
				
				foreach($results as $result){
			?>
				<tr id="tb_data_<?php echo $result->id; ?>" class="timetableData">
					<td class="teacherName"><input type='text' value="<?php echo $result->teacherName; ?>"></input></td>
					<td class="startTime"><input type='text' value="<?php echo $result->startTime; ?>"></input></td>
					<td class="endTime"><input type='text' value="<?php echo $result->endTime; ?>"></input></td>
					<td class="dayOfWeek">
						<select>
							<option value="1" <?php if($result->dayOfWeek == 1){echo 'selected';}; ?>>Hétfő</option>
							<option value="2" <?php if($result->dayOfWeek == 2){echo 'selected';}; ?>>Kedd</option>
							<option value="3" <?php if($result->dayOfWeek == 3){echo 'selected';}; ?>>Szerda</option>
							<option value="4" <?php if($result->dayOfWeek == 4){echo 'selected';}; ?>>Csütörtök</option>
							<option value="5" <?php if($result->dayOfWeek == 5){echo 'selected';}; ?>>Péntek</option>
							<option value="6" <?php if($result->dayOfWeek == 6){echo 'selected';}; ?>>Szombat</option>
							<option value="7" <?php if($result->dayOfWeek == 0){echo 'selected';}; ?>>Vasárnap</option>
						</select>
					</td>
					<td class="style"><input type='text' value="<?php echo $result->style; ?>"></input></td>
					<td style="border: none;" onClick="deleteSettingField('<?php echo $result->id; ?>')"><img class="cPointer" style="width: 15px;" src="<?php echo get_bloginfo('template_directory'); ?>/images/admin_icons/minus.png"></td>
				</tr>
			<?php
				}
			?>
			</table>
			<img class="cPointer" style="width: 20px; padding: 8px;" onClick="addNewSettingField('<?php echo $post->ID; ?>');" src="<?php echo get_bloginfo('template_directory'); ?>/images/admin_icons/plus.png">
	<?php
		}
	?>
	<br>
	<button id="saveTimetableBtn" class="button-primary" onClick="saveTimetable();">Mentés</button>
</div>