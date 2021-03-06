<?php
	date_default_timezone_set('Europe/Budapest');
	
	$dw = date("w");
	$tm = date("H:i");
	
	global $wpdb;
	
	$allClasses = $wpdb->get_results("SELECT * FROM wp_ndw_timetables WHERE isActive = 1 ORDER BY dayOfWeek ASC;");
?>
		<footer>
			<div class="footerClassInProgress_Container cPointer">
				<?php
					foreach($allClasses as $class){
						if($class->dayOfWeek == $dw){
							if(strtotime($class->startTime) <= strtotime($tm) && strtotime($class->endTime) >= strtotime($tm)){
				?>
								<div class="footerClassInProgress footerInProgress">Jelenleg <?php echo $class->teacherName; ?> tart képzést (<?php echo $class->startTime." - ".$class->endTime; ?>) - <?php echo get_post($class->locationID)->post_title; ?><img id="footerClassInProgressArrowUp" style="width: 12px; margin-left: 5px;" src="<?php echo get_bloginfo('template_directory'); ?>/images/arrow_up.png"><img id="footerClassInProgressArrowDown" class="hidden" style="width: 12px; margin-left: 5px;" src="<?php echo get_bloginfo('template_directory'); ?>/images/arrow_down.png"></div>
				<?php
								break;
							}
						}
					}
					
					$firstElement = false;
					
					foreach($allClasses as $class){
						if($class->dayOfWeek == $dw){
							if(strtotime($class->startTime) <= strtotime($tm) && strtotime($class->endTime) >= strtotime($tm)){
								if(!$firstElement){
									$firstElement = true;
								}else{
				?>
									<div class="footerClassInProgress footerClassInProgressHidden footerInProgress hidden">Jelenleg <?php echo $class->teacherName; ?> tart képzést (<?php echo $class->startTime." - ".$class->endTime; ?>) - <?php echo get_post($class->locationID)->post_title; ?></div>
				<?php
								}
							}else if(strtotime($class->startTime) > strtotime($tm)){
				?>
								<div class="footerClassInProgress footerNextClass hidden"><?php echo $class->teacherName; ?> órája következik (<?php echo $class->startTime." - ".$class->endTime; ?>) - <?php echo get_post($class->locationID)->post_title; ?></div>
				<?php
							}
						}
					}
				?>
			</div>
			<div id="footeritemsContainer">
				<div class="footeritem cPointer fselected"><img src="<?php echo get_bloginfo('template_directory'); ?>/images/icons/ndwyt.png" onClick="window.open('http://www.<?php echo get_option('ndwyt'); ?>','_blank');"></div>
				<div class="footeritem cPointer"><img src="<?php echo get_bloginfo('template_directory'); ?>/images/icons/ndwfb.png" onClick="window.open('http://www.<?php echo get_option('ndwfb'); ?>','_blank');"></div>
				<div class="footeritem cPointer"><img src="<?php echo get_bloginfo('template_directory'); ?>/images/icons/ndwphonenumber.png"></div>
				<div class="footeritem cPointer"><img src="<?php echo get_bloginfo('template_directory'); ?>/images/icons/ndwemail.png"></div>
			</div>
		</footer>
	</body>
</html>