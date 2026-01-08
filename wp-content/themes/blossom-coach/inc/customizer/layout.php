<?php
/**
 * Blossom Coach Layout Settings
 *
 * @package Blossom_Coach
 */

function blossom_coach_customize_register_layout( $wp_customize ) {
	
    /** Layout Settings */
    $wp_customize->add_panel(
        'layout_settings',
        array(
            'title'    => __( 'Layout Settings', 'blossom-coach' ),
            'priority' => 55,
        )
    );
    
    /** Blog Layout */
    $wp_customize->add_section(
        'blog_layout',
        array(
            'title'    => __( 'Blog Layout', 'blossom-coach' ),
            'panel'    => 'layout_settings',
            'priority' => 15,
        )
    );
    
    /** Blog Page layout */
    $wp_customize->add_setting( 
        'blog_page_layout', 
        array(
            'default'           => 'grid',
            'sanitize_callback' => 'blossom_coach_sanitize_radio'
        ) 
    );
    
    $wp_customize->add_control(
		new Blossom_Coach_Radio_Image_Control(
			$wp_customize,
			'blog_page_layout',
			array(
				'section'	  => 'blog_layout',
				'label'		  => __( 'Blog Page Layout', 'blossom-coach' ),
				'description' => __( 'This is the layout for blog index page.', 'blossom-coach' ),
				'choices'	  => array(					
                    'grid'    => esc_url( get_template_directory_uri() . '/images/grid.jpg' ),
                    'listing' => esc_url( get_template_directory_uri() . '/images/listing.jpg' ),
                    'classic' => esc_url( get_template_directory_uri() . '/images/classic.jpg' ),
				)
			)
		)
	);
    
    /** General Sidebar Layout */
    $wp_customize->add_section(
        'general_layout',
        array(
            'title'    => __( 'General Sidebar Layout', 'blossom-coach' ),
            'panel'    => 'layout_settings',
            'priority' => 20,
        )
    );
    
    /** Page Sidebar layout */
    $wp_customize->add_setting( 
        'page_sidebar_layout', 
        array(
            'default'           => 'right-sidebar',
            'sanitize_callback' => 'blossom_coach_sanitize_radio'
        ) 
    );
    
    $wp_customize->add_control(
		new Blossom_Coach_Radio_Image_Control(
			$wp_customize,
			'page_sidebar_layout',
			array(
				'section'	  => 'general_layout',
				'label'		  => __( 'Page Sidebar Layout', 'blossom-coach' ),
				'description' => __( 'This is the general sidebar layout for pages. You can override the sidebar layout for individual page in respective page.', 'blossom-coach' ),
				'choices'	  => array(
					'no-sidebar'    => esc_url( get_template_directory_uri() . '/images/1c.jpg' ),
                    'centered'      => esc_url( get_template_directory_uri() . '/images/1cc.jpg' ),
					'left-sidebar'  => esc_url( get_template_directory_uri() . '/images/2cl.jpg' ),
                    'right-sidebar' => esc_url( get_template_directory_uri() . '/images/2cr.jpg' ),
				)
			)
		)
	);
    
    /** Post Sidebar layout */
    $wp_customize->add_setting( 
        'post_sidebar_layout', 
        array(
            'default'           => 'right-sidebar',
            'sanitize_callback' => 'blossom_coach_sanitize_radio'
        ) 
    );
    
    $wp_customize->add_control(
		new Blossom_Coach_Radio_Image_Control(
			$wp_customize,
			'post_sidebar_layout',
			array(
				'section'	  => 'general_layout',
				'label'		  => __( 'Post Sidebar Layout', 'blossom-coach' ),
				'description' => __( 'This is the general sidebar layout for posts. You can override the sidebar layout for individual post in respective post.', 'blossom-coach' ),
				'choices'	  => array(
					'no-sidebar'    => esc_url( get_template_directory_uri() . '/images/1c.jpg' ),
                    'centered'      => esc_url( get_template_directory_uri() . '/images/1cc.jpg' ),
					'left-sidebar'  => esc_url( get_template_directory_uri() . '/images/2cl.jpg' ),
                    'right-sidebar' => esc_url( get_template_directory_uri() . '/images/2cr.jpg' ),
				)
			)
		)
	);
    
    /** Default Sidebar layout */
    $wp_customize->add_setting( 
        'layout_style', 
        array(
            'default'           => 'right-sidebar',
            'sanitize_callback' => 'blossom_coach_sanitize_radio'
        ) 
    );
    
    $wp_customize->add_control(
		new Blossom_Coach_Radio_Image_Control(
			$wp_customize,
			'layout_style',
			array(
				'section'	  => 'general_layout',
				'label'		  => __( 'Default Sidebar Layout', 'blossom-coach' ),
				'description' => __( 'This is the general sidebar layout for whole site.', 'blossom-coach' ),
				'choices'	  => array(
					'no-sidebar'    => esc_url( get_template_directory_uri() . '/images/1c.jpg' ),
                    'left-sidebar'  => esc_url( get_template_directory_uri() . '/images/2cl.jpg' ),
                    'right-sidebar' => esc_url( get_template_directory_uri() . '/images/2cr.jpg' ),
				)
			)
		)
	);

    /** Header Layout Section */
    
    $wp_customize->add_section(
        'header_layout_settings',
        array(
            'title'    => __( 'Header Layout', 'blossom-coach' ),
            'panel'    => 'layout_settings',
            'priority' => 10,
        )
    );

    /** Note */
    $wp_customize->add_setting(
        'header_layout_img_text',
        array(
            'default'           => '',
            'sanitize_callback' => 'wp_kses_post',
        )
    );
    
    $wp_customize->add_control(
        new Blossom_Coach_Note_Control( 
            $wp_customize,
            'header_layout_img_text',
            array(
                'section'     => 'header_layout_settings',
                'priority'    => 50,
                'description' => sprintf( __( '%1$sThis feature is available in Pro version.%2$s %3$sUpgrade to Pro%4$s ', 'blossom-coach' ),'<div class="featured-pro"><span>', '</span>', '<a href="https://blossomthemes.com/wordpress-themes/blossom-coach-pro/?utm_source=blossom_coach&utm_medium=customizer&utm_campaign=upgrade_to_pro" target="_blank">', '</a></div>' ),
            )
        )
    );

   
    $wp_customize->add_setting( 
        'header_layout_settings', 
        array(
            'default'           => 'one',
            'sanitize_callback' => 'blossom_coach_sanitize_radio',
        ) 
    );
    
    $wp_customize->add_control(
        new Blossom_Coach_Radio_Image_Control(
            $wp_customize,
            'header_layout_settings',
            array(
                'section'  => 'header_layout_settings',
                'priority' => 50,
                'choices'  => array(
                    'one' => get_template_directory_uri() . '/images/header-layout.png',
                ),
            )
        )
    );

    /** Single Post Section */
    
    $wp_customize->add_section(
        'single_post_image_section',
        array(
            'title'    => __( 'Single Post Layout', 'blossom-coach' ),
            'panel'    => 'layout_settings',
            'priority' => 11,
        )
    );

    /** Note */
    $wp_customize->add_setting(
        'single_post_text',
        array(
            'default'           => '',
            'sanitize_callback' => 'wp_kses_post' 
        )
    );
    
    $wp_customize->add_control(
        new Blossom_Coach_Note_Control( 
            $wp_customize,
            'single_post_text',
            array(
                'section'     => 'single_post_image_section',
                'description' => sprintf( __( '%1$sThis feature is available in Pro version.%2$s %3$sUpgrade to Pro%4$s ', 'blossom-coach' ),'<div class="featured-pro"><span>', '</span>', '<a href="https://blossomthemes.com/wordpress-themes/blossom-coach-pro/?utm_source=blossom_coach&utm_medium=customizer&utm_campaign=upgrade_to_pro" target="_blank">', '</a></div>' ),
            )
        )
    );

   
    $wp_customize->add_setting( 
        'single_post_settings', 
        array(
            'default'           => 'one',
            'sanitize_callback' => 'blossom_coach_sanitize_radio'
        ) 
    );
    
    $wp_customize->add_control(
        new Blossom_Coach_Radio_Image_Control(
            $wp_customize,
            'single_post_settings',
            array(
                'section'     => 'single_post_image_section',
                'choices'     => array(
                    'one'       => get_template_directory_uri() . '/images/single-layout.png',
                ),
            )
        )
    );

    /** Single Page Section */
    
    $wp_customize->add_section(
        'single_page_image_section',
        array(
            'title'    => __( 'Single Page Layout', 'blossom-coach' ),
            'panel'    => 'layout_settings',
            'priority' => 12,
        )
    );

    /** Note */
    $wp_customize->add_setting(
        'single_page_text',
        array(
            'default'           => '',
            'sanitize_callback' => 'wp_kses_post' 
        )
    );
    
    $wp_customize->add_control(
        new Blossom_Coach_Note_Control( 
            $wp_customize,
            'single_page_text',
            array(
                'section'     => 'single_page_image_section',
                'description' => sprintf( __( '%1$sThis feature is available in Pro version.%2$s %3$sUpgrade to Pro%4$s ', 'blossom-coach' ),'<div class="featured-pro"><span>', '</span>', '<a href="https://blossomthemes.com/wordpress-themes/blossom-coach-pro/?utm_source=blossom_coach&utm_medium=customizer&utm_campaign=upgrade_to_pro" target="_blank">', '</a></div>' ),
            )
        )
    );

   
    $wp_customize->add_setting( 
        'single_page_settings', 
        array(
            'default'           => 'one',
            'sanitize_callback' => 'blossom_coach_sanitize_radio'
        ) 
    );
    
    $wp_customize->add_control(
        new Blossom_Coach_Radio_Image_Control(
            $wp_customize,
            'single_page_settings',
            array(
                'section'     => 'single_page_image_section',
                'choices'     => array(
                    'one'       => get_template_directory_uri() . '/images/single-page-layout.png',
                ),
            )
        )
    );

    /** CTA static Banner Layout */
    
    $wp_customize->add_section(
        'cta_image_section',
        array(
            'title'    => __( 'CTA static Banner Layout', 'blossom-coach' ),
            'panel'    => 'layout_settings',
            'priority' => 13,
        )
    );

    /** Note */
    $wp_customize->add_setting(
        'cta_text',
        array(
            'default'           => '',
            'sanitize_callback' => 'wp_kses_post' 
        )
    );
    
    $wp_customize->add_control(
        new Blossom_Coach_Note_Control( 
            $wp_customize,
            'cta_text',
            array(
                'section'     => 'cta_image_section',
                'description' => sprintf( __( '%1$sThis feature is available in Pro version.%2$s %3$sUpgrade to Pro%4$s ', 'blossom-coach' ),'<div class="featured-pro"><span>', '</span>', '<a href="https://blossomthemes.com/wordpress-themes/blossom-coach-pro/?utm_source=blossom_coach&utm_medium=customizer&utm_campaign=upgrade_to_pro" target="_blank">', '</a></div>' ),
            )
        )
    );

   
    $wp_customize->add_setting( 
        'cta_settings', 
        array(
            'default'           => 'one',
            'sanitize_callback' => 'blossom_coach_sanitize_radio'
        ) 
    );
    
    $wp_customize->add_control(
        new Blossom_Coach_Radio_Image_Control(
            $wp_customize,
            'cta_settings',
            array(
                'section'     => 'cta_image_section',
                'choices'     => array(
                    'one'       => get_template_directory_uri() . '/images/cta-banner-layout.png',
                ),
            )
        )
    );

    /** Static Newsletter/Appointment Layout */
    
    $wp_customize->add_section(
        'static_image_section',
        array(
            'title'    => __( 'Static Newsletter/Appointment Layout', 'blossom-coach' ),
            'panel'    => 'layout_settings',
            'priority' => 13,
        )
    );

    /** Note */
    $wp_customize->add_setting(
        'static_text',
        array(
            'default'           => '',
            'sanitize_callback' => 'wp_kses_post' 
        )
    );
    
    $wp_customize->add_control(
        new Blossom_Coach_Note_Control( 
            $wp_customize,
            'static_text',
            array(
                'section'     => 'static_image_section',
                'description' => sprintf( __( '%1$sThis feature is available in Pro version.%2$s %3$sUpgrade to Pro%4$s ', 'blossom-coach' ),'<div class="featured-pro"><span>', '</span>', '<a href="https://blossomthemes.com/wordpress-themes/blossom-coach-pro/?utm_source=blossom_coach&utm_medium=customizer&utm_campaign=upgrade_to_pro" target="_blank">', '</a></div>' ),
            )
        )
    );

   
    $wp_customize->add_setting( 
        'static_settings', 
        array(
            'default'           => 'one',
            'sanitize_callback' => 'blossom_coach_sanitize_radio'
        ) 
    );
    
    $wp_customize->add_control(
        new Blossom_Coach_Radio_Image_Control(
            $wp_customize,
            'static_settings',
            array(
                'section'     => 'static_image_section',
                'choices'     => array(
                    'one'       => get_template_directory_uri() . '/images/static-newsletter.png',
                ),
            )
        )
    );

    /** Pagination Settings */
    
    $wp_customize->add_section(
        'pagination_image_section',
        array(
            'title'    => __( 'Pagination Settings', 'blossom-coach' ),
            'panel'    => 'layout_settings',
            'priority' => 25,
        )
    );

    /** Note */
    $wp_customize->add_setting(
        'pagination_text',
        array(
            'default'           => '',
            'sanitize_callback' => 'wp_kses_post' 
        )
    );
    
    $wp_customize->add_control(
        new Blossom_Coach_Note_Control( 
            $wp_customize,
            'pagination_text',
            array(
                'section'     => 'pagination_image_section',
                'description' => sprintf( __( '%1$sThis feature is available in Pro version.%2$s %3$sUpgrade to Pro%4$s ', 'blossom-coach' ),'<div class="featured-pro"><span>', '</span>', '<a href="https://blossomthemes.com/wordpress-themes/blossom-coach-pro/?utm_source=blossom_coach&utm_medium=customizer&utm_campaign=upgrade_to_pro" target="_blank">', '</a></div>' ),
            )
        )
    );

   
    $wp_customize->add_setting( 
        'pagination_settings', 
        array(
            'default'           => 'one',
            'sanitize_callback' => 'blossom_coach_sanitize_radio'
        ) 
    );
    
    $wp_customize->add_control(
        new Blossom_Coach_Radio_Image_Control(
            $wp_customize,
            'pagination_settings',
            array(
                'section'     => 'pagination_image_section',
                'choices'     => array(
                    'one'       => get_template_directory_uri() . '/images/pagination.png',
                ),
            )
        )
    );
    
}
add_action( 'customize_register', 'blossom_coach_customize_register_layout' );