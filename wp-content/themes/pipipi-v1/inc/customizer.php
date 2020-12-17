<?php
/**
 * pipipi-v1 Theme Customizer
 *
 * @package pipipi-v1
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function pipipi_v1_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial(
			'blogname',
			array(
				'selector'        => '.site-title a',
				'render_callback' => 'pipipi_v1_customize_partial_blogname',
			)
		);
		$wp_customize->selective_refresh->add_partial(
			'blogdescription',
			array(
				'selector'        => '.site-description',
				'render_callback' => 'pipipi_v1_customize_partial_blogdescription',
			)
		);
	}

	$wp_customize->add_section(
		'pipipi_settings',
		array(
    	'title'      => __( 'PIPIPI Settings', 'pipipi-v1' ),
    	'priority'   => 30,
		)
	);

	$wp_customize->add_setting( 'floating_logo' , array(
    'transport' => 'refresh',
	) );

	$wp_customize->add_control( new WP_Customize_Media_Control( $wp_customize, 'floating_logo', array(
		'label'      => __( 'Floating Logo', 'pipipi-v1' ),
		'section'    => 'pipipi_settings',
		'settings'   => 'floating_logo',
		'mime_type' => 'image',
	) ) );
}
add_action( 'customize_register', 'pipipi_v1_customize_register' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function pipipi_v1_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function pipipi_v1_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function pipipi_v1_customize_preview_js() {
	wp_enqueue_script( 'pipipi-v1-customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), _S_VERSION, true );
}
add_action( 'customize_preview_init', 'pipipi_v1_customize_preview_js' );
