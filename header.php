<!DOCTYPE html>
<html>
    <head>
        <meta charset="<?php bloginfo( 'charset' ); ?>" />
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <title><?php wp_title(); ?></title>
        <link rel="stylesheet" type="text/css" href="<?php echo get_bloginfo('template_directory'); ?>/style.css">
		<link rel="stylesheet" href="<?php echo get_bloginfo('template_directory'); ?>/extensions/swipebox/swipebox.min.css">
		<link rel="stylesheet" href="<?php echo get_bloginfo('template_directory'); ?>/extensions/mcustomscrollbar/jquery.mCustomScrollbar.css">
		<script type="text/javascript" src="<?php echo get_bloginfo('template_directory'); ?>/js/jquery-1.11.1.min.js"></script>
		<script type="text/javascript" src="<?php echo get_bloginfo('template_directory'); ?>/js/ndw.js"></script>
		<script src="<?php echo get_bloginfo('template_directory'); ?>/extensions/swipebox/jquery.swipebox.min.js"></script>
		<script src="<?php echo get_bloginfo('template_directory'); ?>/extensions/mcustomscrollbar/jquery.mCustomScrollbar.concat.min.js"></script>
		<script type="text/javascript">
			var openedBy = "";
		
			/***** KIVÁLASZTOTT MENÜPONT *****/
				<?php if($pagename){ ?>
					jQuery(document).ready(function(){
						jQuery(".<?php echo $pagename;  ?>").addClass('hselected');
					});
				<?php } ?>
				
				function indicatorHandler(mode, indicateClassName){
					var indicator = jQuery("#selectedInPageMenuIndicator");
					if(mode == "add"){
						var indicatorLeftPos = jQuery("." + indicateClassName).offset().left;
						var indicatorElementWidth = jQuery("." + indicateClassName).width();
						
						var indicatorCalculatedLeftPos = indicatorLeftPos + (indicatorElementWidth/2) - (indicator.width()/2);
						
						indicator.css("left", indicatorCalculatedLeftPos + "px");
						indicator.removeClass("hidden");
					}else if(mode == "remove"){
						indicator.addClass("hidden");
					}
				}
			/*********************************/
			function openMenuLayer(){
				jQuery("#menuLayer").removeClass("hidden");
			}
			
			function openMenu(destination){
				if(openedBy == destination){
					jQuery("#menuLayer").html("");
					jQuery("#menuLayer").addClass("hidden");
					indicatorHandler("remove");
					openedBy = ""
				}else{
					openedBy = destination;
				
					openMenuLayer();
					indicatorHandler("add", destination);
					
					jQuery.ajax({
						type: "POST",
						url: "<?php echo get_bloginfo('template_directory'); ?>/" + destination + ".php"
					}).done(function( msg ) {
						jQuery("#menuLayer").html(msg);
					});
				}
			}
		</script>
    </head>
	<body style="background-image: url('<?php echo get_bloginfo('template_directory'); ?>/images/backgrounds/wall.png'); background-size: 100%; background-repeat: no-repeat;">
		<div id="mainmenu">
			<img id="mainmenu_image" class="cPointer" src="<?php echo get_bloginfo('template_directory'); ?>/images/logo.jpg" onClick="location.href='<?php echo get_home_url(); ?>'">
			<img id="selectedInPageMenuIndicator" class="hidden" src="<?php echo get_bloginfo('template_directory'); ?>/images/selectedInPageMenu.png">

			<div id="menuitemsContainer" class="cPointer">
				<div id="ndwTimeTableMenu" class="menuitem cPointer orarend" onClick="openMenu('orarend')">HELYSZÍNEK & ÓRAREND</div>
				<div id="ndwTeachersMenu" class="menuitem cPointer tanarok" onClick="openMenu('tanarok')">TANÁROK</div>
				<!--<div id="ndwGalleryMenu" class="menuitem cPointer galeria" onClick="location.href='galeria'">GALÉRIA</div>-->
				<div id="ndwContactsMenu" class="menuitem cPointer">KAPCSOLAT</div>
			</div>
		</div>
		<div id="ndwcontacts" class="hidden" style="background: url('<?php echo get_bloginfo('template_directory'); ?>/images/backgrounds/transparent_grey.png') repeat;">
			<img id="ndwArrow_up" src="<?php echo get_bloginfo('template_directory'); ?>/images/arrow_up_transparent.png">
			<?php
				$contacts = ['ndwphonenumber', 'ndwemail', 'ndwfb', 'ndwyt'];
				foreach($contacts as $contact){
					echo "<img class='ndwcontactsIcons' src='".get_bloginfo('template_directory')."/images/icons/".$contact."_light.png'>";
					echo get_option($contact)."<br>";
				}
			?>
			<!--<iframe class="ndw_googlemaps" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2696.7968034746696!2d19.03324399999999!3d47.474389!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4741ddc9cd9f8873%3A0x60bf69fe24eaf0ba!2sKarolina+%C3%BAt+65%2C+Budapest%2C+1113!5e0!3m2!1shu!2shu!4v1413926494890" width="300" height="200" frameborder="0" style="border:0"></iframe>-->
		</div>
		<div id="fadeState" class="hidden"></div>
		<div id="menuLayer" class="hidden" style="background: url('<?php echo get_bloginfo('template_directory'); ?>/images/backgrounds/transparent_grey.png') repeat;"></div>