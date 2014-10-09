<?php
	add_theme_support('post-thumbnails');
	
	add_action('admin_menu', 'addContactPage');
	add_action('admin_init', 'addContactSettingsGroup');
	
	// ELÉRHETŐSÉGEK OLDAL
	function addContactPage(){
		add_menu_page("Elérhetőségek", "Elérhetőségek", "manage_options", "ndwcontact", "drawContactInputs");
	}
	
	function addContactSettingsGroup(){
		add_settings_section('contactSettings', '', 'drawContactSettingsGroup', 'ndwcontact');
		
		register_setting('contactSettings', 'ndwphonenumber');
		register_setting('contactSettings', 'ndwemail');
		register_setting('contactSettings', 'ndwfb');
		register_setting('contactSettings', 'ndwyt');
		register_setting('contactSettings', 'ndwaddress');
		
		add_settings_field('ndwphonenumber', 'Telefonszám', 'drawndwPhonenumberInput', 'ndwcontact', 'contactSettings');
		add_settings_field('ndwemail', 'E-mail cím', 'drawndwEmailInput', 'ndwcontact', 'contactSettings');
		add_settings_field('ndwfb', 'Facebook link', 'drawndwFacebookInput', 'ndwcontact', 'contactSettings');
		add_settings_field('ndwyt', 'Youtube link', 'drawndwYoutubeInput', 'ndwcontact', 'contactSettings');
		add_settings_field('ndwaddress', 'Cím', 'drawndwAddressInput', 'ndwcontact', 'contactSettings');
		
	}
	
	function drawContactInputs(){
		include_once("admin/ndwcontact.php");
		settings_fields('contactSettings');
		do_settings_sections('ndwcontact');
		submit_button('Mentés');
	}
	
	function drawContactSettingsGroup(){
		
	}
	
	function drawndwPhonenumberInput(){
		echo "<input name='ndwphonenumber' type='text' value=".get_option('ndwphonenumber').">";
	}
	function drawndwEmailInput(){
		echo "<input name='ndwemail' type='text' value=".get_option('ndwemail').">";
	}
	function drawndwFacebookInput(){
		echo "<input name='ndwfb' type='text' value=".get_option('ndwfb').">";
	}
	function drawndwYoutubeInput(){
		echo "<input name='ndwyt' type='text' value=".get_option('ndwyt').">";
	}
	function drawndwAddressInput(){
		echo "<input name='ndwaddress' type='text' value=".get_option('ndwaddress').">";
	}
	
	// HELYSZÍNEK

	add_action('init', 'create_post_type');
	function create_post_type() {
		register_post_type('ndwlocations',
			array(
			  'labels' => array(
				'name' => __('Helyszínek')
			  ),
			  'public' => true,
			  'has_archive' => true,
			)
		);
	}
	
	add_action('admin_menu', 'addPracticeSubmenu');

	function addPracticeSubmenu(){
		add_submenu_page('edit.php?post_type=ndwlocations', 'Órarend', 'Órarend', 'manage_options', 'ndwlocations', 'drawPracticePostSubmenu');
	}
	
	function drawPracticePostSubmenu(){
		echo "<div class='wrapper'><h2>Órarend szerkesztése</h2></div>";
	}
?>