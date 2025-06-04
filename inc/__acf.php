<?php

// Create Theme Options Page
if(function_exists('acf_add_options_page')) {
	acf_add_options_page(array(
		'page_title' 	=> 'emptytheme Settings',
		'menu_title'	=> 'emptytheme Settings',
		'menu_slug' 	=> 'emptytheme-general-settings',
    'position'    => 2,
		'capability'	=> 'edit_posts',
		'icon_url' 		=> 'dashicons-admin-generic',
		'redirect'		=> true
	));

	// Header Subpage
	acf_add_options_page(array(
		'page_title' 	=> 'Header Settings',
		'menu_title'	=> 'Header',
		'menu_slug' 	=> 'emptytheme-header-settings',
		'capability'	=> 'edit_posts',
		'parent_slug'	=> 'emptytheme-general-settings',
		'redirect'		=> false
	));

	// Footer Subpage
	acf_add_options_page(array(
		'page_title' 	=> 'Footer Settings',
		'menu_title'	=> 'Footer',
		'menu_slug' 	=> 'emptytheme-footer-settings',
		'capability'	=> 'edit_posts',
		'parent_slug'	=> 'emptytheme-general-settings',
		'redirect'		=> false
	));
}
