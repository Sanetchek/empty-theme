<?php

// Add custom fields to Site Identity Tab
function custom_theme_customizer( $wp_customize ) {
  // Modify the Site Identity section
  $wp_customize->get_section( 'title_tagline' )->title = __( 'Site Identity', 'custom-theme' );

  // Add an image field for Logo
  $wp_customize->add_setting( 'logo_setting', array(
      'default' => '',
  ) );

  $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'header_logo_control', array(
      'label' => __( 'Logo', 'custom-theme' ),
      'section' => 'title_tagline',
      'settings' => 'logo_setting',
  ) ) );
}
add_action( 'customize_register', 'custom_theme_customizer' );

// Show Logo on Front
function theme_logo() {
  // Get the logo setting value
  $header_logo = get_theme_mod( 'logo_setting', '' );
  $template = '';

  // Display the logo if it's set
  if ( $header_logo ) {
    $template .= '<a href="/" class="site-logo-link" rel="home" aria-current="page">';
    $template .= '<img src="' . esc_url( $header_logo ) . '" width="300" class="site-logo" alt="GeffenMedikal" decoding="async">';
    $template .= '</a>';
  }

  return $template;
}