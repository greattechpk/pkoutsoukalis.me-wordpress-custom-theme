<?php
/**
 * Understrap Theme Customizer
 *
 * @package understrap
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
if ( ! function_exists( 'understrap_customize_register' ) ) {
	/**
	 * Register basic customizer support.
	 *
	 * @param object $wp_customize Customizer reference.
	 */
	function understrap_customize_register( $wp_customize ) {
		$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
		$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
		$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
	}
}
add_action( 'customize_register', 'understrap_customize_register' );

if ( ! function_exists( 'understrap_theme_customize_register' ) ) {
	/**
	 * Register individual settings through customizer's API.
	 *
	 * @param WP_Customize_Manager $wp_customize Customizer reference.
	 */
	function understrap_theme_customize_register( $wp_customize ) {

		// Theme layout settings.
		$wp_customize->add_section(
			'understrap_theme_layout_options',
			array(
				'title'       => __( 'Theme Layout Settings', 'understrap' ),
				'capability'  => 'edit_theme_options',
				'description' => __( 'Container width and sidebar defaults', 'understrap' ),
				'priority'    => 160,
			)
		);
		
		/**
		 * Select sanitization function
		 *
		 * @param string               $input   Slug to sanitize.
		 * @param WP_Customize_Setting $setting Setting instance.
		 * @return string Sanitized slug if it is a valid choice; otherwise, the setting default.
		 */
		function understrap_theme_slug_sanitize_select( $input, $setting ) {

			// Ensure input is a slug (lowercase alphanumeric characters, dashes and underscores are allowed only).
			$input = sanitize_key( $input );

			// Get the list of possible select options.
			$choices = $setting->manager->get_control( $setting->id )->choices;

				// If the input is a valid key, return it; otherwise, return the default.
				return ( array_key_exists( $input, $choices ) ? $input : $setting->default );

		}

		$wp_customize->add_setting(
			'understrap_container_type',
			array(
				'default'           => 'container',
				'type'              => 'theme_mod',
				'sanitize_callback' => 'understrap_theme_slug_sanitize_select',
				'capability'        => 'edit_theme_options',
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'understrap_container_type',
				array(
					'label'       => __( 'Container Width', 'understrap' ),
					'description' => __( 'Choose between Bootstrap\'s container and container-fluid', 'understrap' ),
					'section'     => 'understrap_theme_layout_options',
					'settings'    => 'understrap_container_type',
					'type'        => 'select',
					'choices'     => array(
						'container'       => __( 'Fixed width container', 'understrap' ),
						'container-fluid' => __( 'Full width container', 'understrap' ),
					),
					'priority'    => '10',
				)
			)
		);

		$wp_customize->add_setting(
			'understrap_sidebar_position',
			array(
				'default'           => 'right',
				'type'              => 'theme_mod',
				'sanitize_callback' => 'sanitize_text_field',
				'capability'        => 'edit_theme_options',
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'understrap_sidebar_position',
				array(
					'label'             => __( 'Sidebar Positioning', 'understrap' ),
					'description'       => __(
						'Set sidebar\'s default position. Can either be: right, left, both or none. Note: this can be overridden on individual pages.',
						'understrap'
					),
					'section'           => 'understrap_theme_layout_options',
					'settings'          => 'understrap_sidebar_position',
					'type'              => 'select',
					'sanitize_callback' => 'understrap_theme_slug_sanitize_select',
					'choices'           => array(
						'right' => __( 'Right sidebar', 'understrap' ),
						'left'  => __( 'Left sidebar', 'understrap' ),
						'both'  => __( 'Left & Right sidebars', 'understrap' ),
						'none'  => __( 'No sidebar', 'understrap' ),
					),
					'priority'          => '20',
				)
			)
		);
	}
} // endif function_exists( 'understrap_theme_customize_register' ).
function understrap_customizer_register($wp_customize){
	//adding a font panel
	//font panel
	$wp_customize->add_panel('font_panel', array(
		'title'=>__('Font Customization', 'understrap'),
		'description'=>__('Change Font Styles/Sizes and Colors'),
	));

	//h1 section
	$wp_customize->add_section('h1_section', array(
		'title'=> __('h1', 'understrap'),
		'description' => 'Modify h1 tag type/family/color',
		'panel'=> 'font_panel'
	));
	
	$wp_customize->add_setting('h1_color', array('default'=> '#000',));
	$wp_customize->add_setting('h1_size', array('default'=> '',));
	$wp_customize->add_setting('h1_line_height', array('default'=> '',));
	$wp_customize->add_setting('h1_font_family', array('default'=> '\'Roboto\', sans-serif'));
	
	$wp_customize->add_control('h1_font_family',array(
		'label'=>'Font family',
		'description'=>'only effects this tag',
		'section'=> 'h1_section',
		'type'=>'select',
		'choices'=> array(
			'\'Roboto\', sans-serif' => __('Roboto'),
			'\'Roboto Condensed\', sans-serif' => __('Roboto Condensed'),
			'\'Lato\', sans-serif' => __('Lato'),
			'\'Open Sans Condensed\', sans-serif' => __('Open Sans Condensed'),
			'\'Titillium Web\', sans-serif' => __('Titillium Web')			
		),
		'settings'=>'h1_font_family'
	));

	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'h1_color', array(
		'label'=>__('Edit H1 Color','understrap'),
		'section' => 'h1_section',
		'settings' => 'h1_color'
		) ));
	
	$wp_customize->add_control('h1_size_control',array(
		'label'=>'Edit H1 Font Size',
		'description'=>'Size is in EMs',
		'section' => 'h1_section',
		'type'=>'number',
		'settings'=>'h1_size'
	));
	$wp_customize->add_control('h1_line_height',array(
		'label'=>'Line Height',
		'description'=>'line height in px',
		'section' => 'h1_section',
		'type'=>'number',
		'settings' => 'h1_line_height'
	));

	// end h1 section

	//h2 section
	$wp_customize->add_section('h2_section', array(
		'title'=> __('h2', 'understrap'),
		'description' => 'Modify h2 tag type/family/color',
		'panel'=> 'font_panel'
	));
	
	$wp_customize->add_setting('h2_color', array('default'=> '#000',));
	$wp_customize->add_setting('h2_size', array('default'=> '',));
	$wp_customize->add_setting('h2_line_height', array('default'=> '',));
	$wp_customize->add_setting('h2_font_family', array('default'=> '\'Roboto\', sans-serif'));
	
	$wp_customize->add_control('h2_font_family',array(
		'label'=>'Font family',
		'description'=>'only effects this tag',
		'section'=> 'h2_section',
		'type'=>'select',
		'choices'=> array(
			'\'Roboto\', sans-serif' => __('Roboto'),
			'\'Roboto Condensed\', sans-serif' => __('Roboto Condensed'),
			'\'Lato\', sans-serif' => __('Lato'),
			'\'Open Sans Condensed\', sans-serif' => __('Open Sans Condensed'),
			'\'Titillium Web\', sans-serif' => __('Titillium Web')			
		),
		'settings'=>'h2_font_family'
	));

	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'h2_color', array(
		'label'=>__('Edit h2 Color','understrap'),
		'section' => 'h2_section',
		'settings' => 'h2_color'
		) ));
	
	$wp_customize->add_control('h2_size_control',array(
		'label'=>'Edit h2 Font Size',
		'description'=>'Size is in EMs',
		'section' => 'h2_section',
		'type'=>'number',
		'settings'=>'h2_size'
	));
	$wp_customize->add_control('h2_line_height',array(
		'label'=>'Line Height',
		'description'=>'line height in px',
		'section' => 'h2_section',
		'type'=>'number',
		'settings' => 'h2_line_height'
	));
	// end h2 section

	//h3 section
	$wp_customize->add_section('h3_section', array(
		'title'=> __('h3', 'understrap'),
		'description' => 'Modify h3 tag type/family/color',
		'panel'=> 'font_panel'
	));
	
	$wp_customize->add_setting('h3_color', array('default'=> '#000',));
	$wp_customize->add_setting('h3_size', array('default'=> '',));
	$wp_customize->add_setting('h3_line_height', array('default'=> '',));
	$wp_customize->add_setting('h3_font_family', array('default'=> '\'Roboto\', sans-serif'));
	
	$wp_customize->add_control('h3_font_family',array(
		'label'=>'Font family',
		'description'=>'only effects this tag',
		'section'=> 'h3_section',
		'type'=>'select',
		'choices'=> array(
			'\'Roboto\', sans-serif' => __('Roboto'),
			'\'Roboto Condensed\', sans-serif' => __('Roboto Condensed'),
			'\'Lato\', sans-serif' => __('Lato'),
			'\'Open Sans Condensed\', sans-serif' => __('Open Sans Condensed'),
			'\'Titillium Web\', sans-serif' => __('Titillium Web')			
		),
		'settings'=>'h3_font_family'
	));

	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'h3_color', array(
		'label'=>__('Edit h3 Color','understrap'),
		'section' => 'h3_section',
		'settings' => 'h3_color'
		) ));
	
	$wp_customize->add_control('h3_size_control',array(
		'label'=>'Edit h3 Font Size',
		'description'=>'Size is in EMs',
		'section' => 'h3_section',
		'type'=>'number',
		'settings'=>'h3_size'
	));
	$wp_customize->add_control('h3_line_height',array(
		'label'=>'Line Height',
		'description'=>'line height in px',
		'section' => 'h3_section',
		'type'=>'number',
		'settings' => 'h3_line_height'
	));
	// end h3 section

	//h4 section
	$wp_customize->add_section('h4_section', array(
		'title'=> __('h4', 'understrap'),
		'description' => 'Modify h4 tag type/family/color',
		'panel'=> 'font_panel'
	));
	
	$wp_customize->add_setting('h4_color', array('default'=> '#000',));
	$wp_customize->add_setting('h4_size', array('default'=> '',));
	$wp_customize->add_setting('h4_line_height', array('default'=> '',));
	$wp_customize->add_setting('h4_font_family', array('default'=> '\'Roboto\', sans-serif'));
	
	$wp_customize->add_control('h4_font_family',array(
		'label'=>'Font family',
		'description'=>'only effects this tag',
		'section'=> 'h4_section',
		'type'=>'select',
		'choices'=> array(
			'\'Roboto\', sans-serif' => __('Roboto'),
			'\'Roboto Condensed\', sans-serif' => __('Roboto Condensed'),
			'\'Lato\', sans-serif' => __('Lato'),
			'\'Open Sans Condensed\', sans-serif' => __('Open Sans Condensed'),
			'\'Titillium Web\', sans-serif' => __('Titillium Web')			
		),
		'settings'=>'h4_font_family'
	));

	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'h4_color', array(
		'label'=>__('Edit h4 Color','understrap'),
		'section' => 'h4_section',
		'settings' => 'h4_color'
		) ));
	
	$wp_customize->add_control('h4_size_control',array(
		'label'=>'Edit h4 Font Size',
		'description'=>'Size is in EMs',
		'section' => 'h4_section',
		'type'=>'number',
		'settings'=>'h4_size'
	));
	$wp_customize->add_control('h4_line_height',array(
		'label'=>'Line Height',
		'description'=>'line height in px',
		'section' => 'h4_section',
		'type'=>'number',
		'settings' => 'h4_line_height'
	));
	// end h4 section

	//h5 section
	$wp_customize->add_section('h5_section', array(
		'title'=> __('h5', 'understrap'),
		'description' => 'Modify h5 tag type/family/color',
		'panel'=> 'font_panel'
	));
	
	$wp_customize->add_setting('h5_color', array('default'=> '#000',));
	$wp_customize->add_setting('h5_size', array('default'=> '',));
	$wp_customize->add_setting('h5_line_height', array('default'=> '',));
	$wp_customize->add_setting('h5_font_family', array('default'=> '\'Roboto\', sans-serif'));
	
	$wp_customize->add_control('h5_font_family',array(
		'label'=>'Font family',
		'description'=>'only effects this tag',
		'section'=> 'h5_section',
		'type'=>'select',
		'choices'=> array(
			'\'Roboto\', sans-serif' => __('Roboto'),
			'\'Roboto Condensed\', sans-serif' => __('Roboto Condensed'),
			'\'Lato\', sans-serif' => __('Lato'),
			'\'Open Sans Condensed\', sans-serif' => __('Open Sans Condensed'),
			'\'Titillium Web\', sans-serif' => __('Titillium Web')			
		),
		'settings'=>'h5_font_family'
	));

	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'h5_color', array(
		'label'=>__('Edit h5 Color','understrap'),
		'section' => 'h5_section',
		'settings' => 'h5_color'
		) ));
	
	$wp_customize->add_control('h5_size_control',array(
		'label'=>'Edit h5 Font Size',
		'description'=>'Size is in EMs',
		'section' => 'h5_section',
		'type'=>'number',
		'settings'=>'h5_size'
	));
	$wp_customize->add_control('h5_line_height',array(
		'label'=>'Line Height',
		'description'=>'line height in px',
		'section' => 'h5_section',
		'type'=>'number',
		'settings' => 'h5_line_height'
	));
	// end h5 section

	//h6 section
	$wp_customize->add_section('h6_section', array(
		'title'=> __('h6', 'understrap'),
		'description' => 'Modify h6 tag type/family/color',
		'panel'=> 'font_panel'
	));
	
	$wp_customize->add_setting('h6_color', array('default'=> '#000',));
	$wp_customize->add_setting('h6_size', array('default'=> '',));
	$wp_customize->add_setting('h6_line_height', array('default'=> '',));
	$wp_customize->add_setting('h6_font_family', array('default'=> '\'Roboto\', sans-serif'));
	
	$wp_customize->add_control('h6_font_family',array(
		'label'=>'Font family',
		'description'=>'only effects this tag',
		'section'=> 'h6_section',
		'type'=>'select',
		'choices'=> array(
			'\'Roboto\', sans-serif' => __('Roboto'),
			'\'Roboto Condensed\', sans-serif' => __('Roboto Condensed'),
			'\'Lato\', sans-serif' => __('Lato'),
			'\'Open Sans Condensed\', sans-serif' => __('Open Sans Condensed'),
			'\'Titillium Web\', sans-serif' => __('Titillium Web')			
		),
		'settings'=>'h6_font_family'
	));

	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'h6_color', array(
		'label'=>__('Edit h6 Color','understrap'),
		'section' => 'h6_section',
		'settings' => 'h6_color'
		) ));
	
	$wp_customize->add_control('h6_size_control',array(
		'label'=>'Edit h6 Font Size',
		'description'=>'Size is in EMs',
		'section' => 'h6_section',
		'type'=>'number',
		'settings'=>'h6_size'
	));
	$wp_customize->add_control('h6_line_height',array(
		'label'=>'Line Height',
		'description'=>'line height in px',
		'section' => 'h6_section',
		'type'=>'number',
		'settings' => 'h6_line_height'
	));
	// end h6 section

	//p section
	$wp_customize->add_section('p_section', array(
		'title'=> __('p', 'understrap'),
		'description' => 'Modify p tag type/family/color',
		'panel'=> 'font_panel'
	));
	
	$wp_customize->add_setting('p_color', array('default'=> '#000',));
	$wp_customize->add_setting('p_size', array('default'=> '',));
	$wp_customize->add_setting('p_line_height', array('default'=> '',));
	$wp_customize->add_setting('p_font_family', array('default'=> '\'Roboto\', sans-serif'));
	
	$wp_customize->add_control('p_font_family',array(
		'label'=>'Font family',
		'description'=>'only effects this tag',
		'section'=> 'p_section',
		'type'=>'select',
		'choices'=> array(
			'\'Roboto\', sans-serif' => __('Roboto'),
			'\'Roboto Condensed\', sans-serif' => __('Roboto Condensed'),
			'\'Lato\', sans-serif' => __('Lato'),
			'\'Open Sans Condensed\', sans-serif' => __('Open Sans Condensed'),
			'\'Titillium Web\', sans-serif' => __('Titillium Web')			
		),
		'settings'=>'p_font_family'
	));

	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'p_color', array(
		'label'=>__('Edit p Color','understrap'),
		'section' => 'p_section',
		'settings' => 'p_color'
		) ));
	
	$wp_customize->add_control('p_size_control',array(
		'label'=>'Edit p Font Size',
		'description'=>'Size is in EMs',
		'section' => 'p_section',
		'type'=>'number',
		'settings'=>'p_size'
	));
	$wp_customize->add_control('p_line_height',array(
		'label'=>'Line Height',
		'description'=>'line height in px',
		'section' => 'p_section',
		'type'=>'number',
		'settings' => 'p_line_height'
	));
	// end p section
		

		//Colors Of Skeleton
	$wp_customize->add_section('understrap_colors', array(
		'title'=> __('Colors of Objects', 'understrap'),
		'description' => 'Modify theme colors'
	));
			$wp_customize->add_setting('background_color', array(
				'default'=> '#fff',
			));
			$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'background_color', array(
				'label'=> __('Edit Background Color','understrap'),
				'section' => 'understrap_colors',
				'settings' => 'background_color'
				) ));
				
			$wp_customize->add_setting('bg-primary', array(
				'default'=> '#000',
			));
			
				$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'bg-primary', array(
					'label'=>__('Edit Navbar Color','understrap'),
					'section' => 'understrap_colors',
					'settings' => 'bg-primary'
					) ));
				//end colors of skeleton
				
				}
function understrap_css_customizer(){
	?>
	<style type='text/css'>
	.bg-primary{background-color: <?php echo get_theme_mod('bg-primary');?>!important;}
	h1{
		color:<?php echo get_theme_mod('h1_color');?>!important;
		font-family:<?php echo get_theme_mod('h1_font_family');?>;
		font-size:<?php echo get_theme_mod('h1_size');?>em;
		line-height:<?php echo get_theme_mod('h1_line_height');?>px;
	}
	h2{
		color:<?php echo get_theme_mod('h2_color');?>!important;
		font-family:<?php echo get_theme_mod('h2_font_family');?>;
		font-size:<?php echo get_theme_mod('h2_size');?>em;
		line-height:<?php echo get_theme_mod('h2_line_height');?>px;
	}
	h3{
		color:<?php echo get_theme_mod('h3_color');?>!important;
		font-family:<?php echo get_theme_mod('h3_font_family');?>;
		font-size:<?php echo get_theme_mod('h3_size');?>em;
		line-height:<?php echo get_theme_mod('h3_line_height');?>px;
	}
	h4{
		color:<?php echo get_theme_mod('h4_color');?>!important;
		font-family:<?php echo get_theme_mod('h4_font_family');?>;
		font-size:<?php echo get_theme_mod('h4_size');?>em;
		line-height:<?php echo get_theme_mod('h4_line_height');?>px;
	}
	h5{
		color:<?php echo get_theme_mod('h5_color');?>!important;
		font-family:<?php echo get_theme_mod('h5_font_family');?>;
		font-size:<?php echo get_theme_mod('h5_size');?>em;
		line-height:<?php echo get_theme_mod('h5_line_height');?>px;
	}
	h6{
		color:<?php echo get_theme_mod('h6_color');?>!important;
		font-family:<?php echo get_theme_mod('h6_font_family');?>;
		font-size:<?php echo get_theme_mod('h6_size');?>em;
		line-height:<?php echo get_theme_mod('h6_line_height');?>px;
	}
	p{
		color:<?php echo get_theme_mod('p_color');?>!important;
		font-family:<?php echo get_theme_mod('p_font_family');?>;
		font-size:<?php echo get_theme_mod('p_size');?>em;
		line-height:<?php echo get_theme_mod('p_line_height');?>px;
	}


	</style>
	<?php
}
add_action('wp_head', 'understrap_css_customizer');
add_action('customize_register', 'understrap_customizer_register');
add_action( 'customize_register', 'understrap_theme_customize_register' );



/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
if ( ! function_exists( 'understrap_customize_preview_js' ) ) {
	/**
	 * Setup JS integration for live previewing.
	 */
	function understrap_customize_preview_js() {
		wp_enqueue_script(
			'understrap_customizer',
			get_template_directory_uri() . '/js/customizer.js',
			array( 'customize-preview' ),
			'20130508',
			true
		);
	}
}
add_action( 'customize_preview_init', 'understrap_customize_preview_js' );
