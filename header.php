<!DOCTYPE html>
<html>
    <head>
        <meta charset="<?php bloginfo( 'charset' ); ?>" />
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <title><?php wp_title(); ?></title>
        <link rel="stylesheet" type="text/css" href="<?php echo get_bloginfo('template_directory'); ?>/style.css">
    </head>
	<body>
		<div id="mainmenu">
			<img id="mainmenu_image" class="cPointer" src="<?php echo get_bloginfo('template_directory'); ?>/images/logo.jpg">
			<div id="menuitemsContainer" class="cPointer">
				<div class="menuitem cPointer <!--hselected-->">ÓRAREND</div>
				<div class="menuitem cPointer">TANÁROK</div>
				<div class="menuitem cPointer">GALÉRIA</div>
				<div class="menuitem cPointer">HELYSZÍNEK</div>
				<div class="menuitem cPointer mactive">KAPCSOLAT</div>
			</div>
		</div>