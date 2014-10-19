<?php
	add_theme_support('post-thumbnails');
	
	add_action('admin_menu', 'addContactPage');
	add_action('admin_init', 'addContactSettingsGroup');
	
	// ELÉRHETŐSÉGEK OLDAL
	function addContactPage(){
		add_menu_page("Elérhetőségek", "Elérhetőségek", "manage_options", "ndwcontact", "drawContactInputs");
	}
	
	function addContactSettingsGroup(){
		add_settings_section('contactSettings', 'NDW elérhetőségek', 'drawContactSettingsGroup', 'ndwcontact');
		
		add_settings_field('ndwphonenumber', 'Telefonszám', 'drawndwPhonenumberInput', 'ndwcontact', 'contactSettings');
		add_settings_field('ndwemail', 'E-mail cím', 'drawndwEmailInput', 'ndwcontact', 'contactSettings');
		add_settings_field('ndwfb', 'Facebook link', 'drawndwFacebookInput', 'ndwcontact', 'contactSettings');
		add_settings_field('ndwyt', 'Youtube link', 'drawndwYoutubeInput', 'ndwcontact', 'contactSettings');
		add_settings_field('ndwaddress', 'Cím', 'drawndwAddressInput', 'ndwcontact', 'contactSettings');
		
		register_setting('ndwcontact', 'ndwphonenumber');
		register_setting('ndwcontact', 'ndwemail');
		register_setting('ndwcontact', 'ndwfb');
		register_setting('ndwcontact', 'ndwyt');
		register_setting('ndwcontact', 'ndwaddress');
		
	}
	
	function drawContactInputs(){
		include_once("admin/ndwcontact.php");
		echo '<form method="POST" action="options.php">';
		
		settings_fields('ndwcontact');
		do_settings_sections('ndwcontact');
		submit_button('Mentés');
		
		echo '</form>';
	}
	
	function drawContactSettingsGroup(){
		echo '<p>A láblécben, illetve a kapcsolat menüpontban megjelenő adatok beállítása</p>';
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
	
	// YOUTUBE LINK
	
	add_action('admin_init', 'addYoutubeLinkField');
	
	function addYoutubeLinkField(){
		add_meta_box(
			'ndwYoutubeLink',
			'Youtube videó link',
			'drawNdwYoutubeLinkField',
			'post',
			'normal',
			'default'
		);
	}
	
	function drawNdwYoutubeLinkField($post){
		echo '<input type="text" class="regular-text" name="ndwYoutubeLink" value="'.get_post_meta($post->ID, 'ndwYoutubeLink')[0].'"></input>';
	}
	
	function saveNdwYoutubeLinkField($post_id) {
		update_post_meta($post_id, 'ndwYoutubeLink', $_POST['ndwYoutubeLink']);
	}
	add_action('save_post', 'saveNdwYoutubeLinkField' );
	
	// HELYSZÍNEK

	add_action('init', 'create_locations_post_type');
	function create_locations_post_type(){
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
	
	add_action('admin_menu', 'addLocationsSubmenu');

	function addLocationsSubmenu(){
		add_submenu_page('edit.php?post_type=ndwlocations', 'Órarendek', 'Órarendek', 'manage_options', 'ndwlocations', 'drawLocationsSettings');
	}
	
	function drawLocationsSettings(){
		include_once('admin/ndwtimetables.php');
	}
	
	/* Helyszínek post típus meta mező */
	
	add_action('admin_init', 'addGoogleMapsField');
	
	function addGoogleMapsField(){
		add_meta_box(
			'ndwLocationMapsPos',
			'Google Maps link',
			'drawNdwLocationMapsPos',
			'ndwlocations',
			'normal',
			'default'
		);
	}
	
	function drawNdwLocationMapsPos($post){
		echo '<input type="text" class="regular-text" name="ndwLocationMapsPos" value="'.get_post_meta($post->ID, 'ndwLocationGmaps')[0].'"></input>';
	}
	
	function saveNdwLocationMaps($post_id) {
		update_post_meta($post_id, 'ndwLocationGmaps', $_POST['ndwLocationMapsPos']);
	}
	add_action( 'save_post', 'saveNdwLocationMaps' );
	
	// TANÁROK

	add_action('init', 'create_teachers_post_type');
	function create_teachers_post_type(){
		register_post_type('ndwteachers',
			array(
			  'labels' => array(
				'name' => __('Tanárok')
			  ),
			  'public' => true,
			  'has_archive' => true,
			  'supports' => array('title', 'editor', 'thumbnail')
			)
		);
	}
?>