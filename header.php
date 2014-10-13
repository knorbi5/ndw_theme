<!DOCTYPE html>
<html>
    <head>
        <meta charset="<?php bloginfo( 'charset' ); ?>" />
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <title><?php wp_title(); ?></title>
        <link rel="stylesheet" type="text/css" href="<?php echo get_bloginfo('template_directory'); ?>/style.css">
		<script type="text/javascript" src="<?php echo get_bloginfo('template_directory'); ?>/js/jquery-1.11.1.min.js"></script>
		<script type="text/javascript" src="<?php echo get_bloginfo('template_directory'); ?>/js/ndw.js"></script>
		<script type="text/javascript">
			/***** KIVÁLASZTOTT MENÜPONT *****/
				jQuery(document).ready(function(){
					jQuery(".<?php echo $pagename;  ?>").addClass('hselected');
				});
			/*********************************/
		</script>
    </head>
	<body>
		<div id="mainmenu">
			<img id="mainmenu_image" class="cPointer" src="<?php echo get_bloginfo('template_directory'); ?>/images/logo.jpg" onClick="location.href='<?php echo get_home_url(); ?>'">
			<div id="menuitemsContainer" class="cPointer">
				<div id="ndwTimeTableMenu" class="menuitem cPointer orarend" onClick="location.href='orarend'">ÓRAREND</div>
				<div id="ndwTeachersMenu" class="menuitem cPointer tanarok" onClick="location.href='tanarok'">TANÁROK</div>
				<div id="ndwGalleryMenu" class="menuitem cPointer galeria" onClick="location.href='galeria'">GALÉRIA</div>
				<div id="ndwLocationsMenu" class="menuitem cPointer">HELYSZÍNEK</div>
				<div id="ndwContactsMenu" class="menuitem cPointer">KAPCSOLAT</div>
			</div>
		</div>
		<div id="ndwcontacts" class="hidden">
			<img id="ndwArrow_up" src="<?php echo get_bloginfo('template_directory'); ?>/images/arrow_up.png">
			<?php
				$contacts = ['ndwphonenumber', 'ndwemail', 'ndwfb', 'ndwyt'];
				foreach($contacts as $contact){
					echo "<img class='ndwcontactsIcons' src='".get_bloginfo('template_directory')."/images/icons/".$contact.".png'>";
					echo get_option($contact)."<br>";
				}
			?>
			<iframe class="ndw_googlemaps" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d172572.57959586816!2d19.13030305000001!3d47.48121344999993!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4741c334d1d4cfc9%3A0x400c4290c1e1160!2sBudapest!5e0!3m2!1shu!2shu!4v1413231648595" width="300" height="200" frameborder="0" style="border:0"></iframe>
		</div>
		<div id="fadeState" class="hidden"></div>