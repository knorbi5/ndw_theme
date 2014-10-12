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
				$contacts = ['ndwphonenumber', 'ndwemail', 'ndwfb', 'ndwyt', 'ndwaddress'];
				foreach($contacts as $contact){
					echo "<img src='".get_bloginfo('template_directory')."/images/icons/".$contact.".png'>";
					echo get_option($contact)."<br>";
				}
			?>
		</div>
		<div id="fadeState" class="hidden"></div>