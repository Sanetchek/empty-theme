<?php

/**
 * Add social media settings to the Customizer
 *
 * @param WP_Customize_Manager $wp_customize The Customizer object.
 */
function social_theme_customizer( $wp_customize ) {
  $wp_customize->add_section( 'social_media_section', array(
    'title' => __( 'Social Media Links', 'emptytheme' ),
    'priority' => 30,
  ) );

  // Whatsup Field
  $wp_customize->add_setting( 'whatsup_url_setting', array(
      'default' => '',
  ) );

  $wp_customize->add_control( 'whatsup_url_control', array(
      'label' => __( 'Whatsup URL', 'emptytheme' ),
      'section' => 'social_media_section',
      'settings' => 'whatsup_url_setting',
      'type' => 'url',
  ) );

  // Telegram Field
  $wp_customize->add_setting( 'telegram_url_setting', array(
      'default' => '',
  ) );

  $wp_customize->add_control( 'telegram_url_control', array(
      'label' => __( 'Telegram URL', 'emptytheme' ),
      'section' => 'social_media_section',
      'settings' => 'telegram_url_setting',
      'type' => 'url',
  ) );

  // LinkedIn Field
  $wp_customize->add_setting( 'linkedin_url_setting', array(
      'default' => '',
  ) );

  $wp_customize->add_control( 'linkedin_url_control', array(
      'label' => __( 'LinkedIn URL', 'emptytheme' ),
      'section' => 'social_media_section',
      'settings' => 'linkedin_url_setting',
      'type' => 'url',
  ) );
}
add_action( 'customize_register', 'social_theme_customizer' );

/**
 * Add copyrights settings to the Customizer
 *
 * @param WP_Customize_Manager $wp_customize The Customizer object.
 */
function copyrights_theme_customizer( $wp_customize ) {
  $wp_customize->add_section( 'copyrights_section', array(
    'title' => __( 'Copyrights', 'emptytheme' ),
    'priority' => 100,
  ) );

  // Copyrights Field
  $wp_customize->add_setting( 'copyrights_text_setting', array(
      'default' => '',
  ) );

  $wp_customize->add_control( 'copyrights_text_control', array(
      'label' => __( 'Copyrights Text', 'emptytheme' ),
      'section' => 'copyrights_section',
      'settings' => 'copyrights_text_setting',
      'type' => 'url',
  ) );
}
add_action( 'customize_register', 'copyrights_theme_customizer' );
