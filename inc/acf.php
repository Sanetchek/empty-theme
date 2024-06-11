<?php

// Create Theme Options Page
if(function_exists('acf_add_options_page')) {
	acf_add_options_page(array(
		'page_title' 	=> 'emptytheme Settings',
		'menu_title'	=> 'emptytheme Settings',
		'menu_slug' 	=> 'emptytheme-general-settings',
    'position'    => 2,
		'capability'	=> 'edit_posts',
		'icon_url' => 'dashicons-admin-generic',
		'redirect'		=> false
	));
}
