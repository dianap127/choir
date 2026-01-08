<?php
// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

/**
 *	After theme Setup Hook
 */
function consulting_coach_theme_setup() {
	/**
	* Make child theme available for translation.
    * Translations can be filed in the /languages/ directory.
	*/
	load_child_theme_textdomain( 'consulting-coach', get_stylesheet_directory() . '/languages' );

}
add_action( 'after_setup_theme', 'consulting_coach_theme_setup', 100 );

function consulting_coach_customize_script(){

    $my_theme = wp_get_theme();
    $version  = $my_theme['Version'];
    wp_enqueue_script('consulting-coach-customize', get_stylesheet_directory_uri() . '/js/child-customize.js', array('jquery', 'customize-controls'), $version, true);

}
add_action('customize_controls_enqueue_scripts', 'consulting_coach_customize_script', 100 );

/**
 * Enqueue scripts and styles.
 */
function consulting_coach_scripts() {
	$my_theme = wp_get_theme();
	$version  = $my_theme['Version'];

    wp_enqueue_style( 'blossom-coach', get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'consulting-coach', get_stylesheet_directory_uri() . '/style.css', array( 'blossom-coach' ), $version );
    wp_enqueue_script( 'consulting-coach', get_stylesheet_directory_uri() . '/js/custom.js', array( 'jquery' ), $version, true );
}
add_action( 'wp_enqueue_scripts', 'consulting_coach_scripts', 10 );

function consulting_coach_customize_register( $wp_customize ){

    /** Register customizer custom control */
	require_once get_stylesheet_directory() . '/custom-controls/radiobtn/class-radio-buttonset-control.php';

	$wp_customize->register_control_type( 'Consulting_Coach_Radio_Buttonset_Control' );

    /** Wheel of Life */
	if( blossom_coach_is_wheel_of_life_activated() ) $wp_customize->get_setting( 'wheeloflife_color' )->default = '#f2f2f2';

    $wp_customize->get_section('header_image')->panel                    = 'frontpage_settings';
    $wp_customize->get_section('header_image')->title                    = __('Banner Section', 'consulting-coach');
    $wp_customize->get_section('header_image')->priority                 = 10;
    $wp_customize->get_control('header_image')->active_callback          = 'blossom_coach_banner_ac';
    $wp_customize->get_control('header_video')->active_callback          = 'blossom_coach_banner_ac';
    $wp_customize->get_control('external_header_video')->active_callback = 'blossom_coach_banner_ac';
    $wp_customize->get_section('header_image')->description              = '';
    $wp_customize->get_setting('header_image')->transport                = 'refresh';
    $wp_customize->get_setting('header_video')->transport                = 'refresh';
    $wp_customize->get_setting('external_header_video')->transport       = 'refresh';

    $wp_customize->remove_control('primary_font');
    $wp_customize->remove_control('secondary_font');

	/** Move Background Image section to appearance panel */
    $wp_customize->get_section( 'colors' )->panel              = 'appearance_settings';
    $wp_customize->get_section( 'colors' )->priority           = 10;
    $wp_customize->get_section( 'background_image' )->panel    = 'appearance_settings';
    $wp_customize->get_section( 'background_image' )->priority = 15;

	/** Primary Font */
    $wp_customize->add_setting(
		'primary_font',
		array(
			'default'			=> 'Figtree',
			'sanitize_callback' => 'blossom_coach_sanitize_select'
		)
	);

	$wp_customize->add_control(
		new Blossom_Coach_Select_Control(
    		$wp_customize,
    		'primary_font',
    		array(
                'label'	      => __( 'Primary Font', 'consulting-coach' ),
                'description' => __( 'Primary font of the site.', 'consulting-coach' ),
    			'section'     => 'typography_settings',
    			'choices'     => blossom_coach_get_all_fonts(),	
                'priority'    => 5
     		)
		)
	);

	/** Secondary Font */
    $wp_customize->add_setting(
		'secondary_font',
		array(
			'default'			=> 'Rufina',
			'sanitize_callback' => 'blossom_coach_sanitize_select'
		)
	);

	$wp_customize->add_control(
		new Blossom_Coach_Select_Control(
    		$wp_customize,
    		'secondary_font',
    		array(
                'label'	      => __( 'Secondary Font', 'consulting-coach' ),
                'description' => __( 'Secondary font of the site.', 'consulting-coach' ),
    			'section'     => 'typography_settings',
    			'choices'     => blossom_coach_get_all_fonts(),
                'priority'    => 5	
     		)
		)
	);

	/** Primary Color*/
    $wp_customize->add_setting( 
        'primary_color', 
        array(
            'default'           => '#3a7f90',
            'sanitize_callback' => 'sanitize_hex_color',
            'transport'         => 'postMessage',
        ) 
    );

    $wp_customize->add_control( 
        new WP_Customize_Color_Control( 
            $wp_customize, 
            'primary_color', 
            array(
                'label'       => __( 'Primary Color', 'consulting-coach' ),
                'description' => __( 'Primary color of the theme.', 'consulting-coach' ),
                'section'     => 'colors',
                'priority'    => 5,
            )
        )
    );

    /** Secondary Color*/
    $wp_customize->add_setting( 
        'secondary_color', 
        array(
            'default'           => '#7da659',
            'sanitize_callback' => 'sanitize_hex_color',
            'transport'         => 'postMessage',
        ) 
    );

    $wp_customize->add_control( 
        new WP_Customize_Color_Control( 
            $wp_customize, 
            'secondary_color', 
            array(
                'label'       => __( 'Secondary Color', 'consulting-coach' ),
                'description' => __( 'Secondary color of the theme.', 'consulting-coach' ),
                'section'     => 'colors',
                'priority'    => 5,
            )
        )
    );

    /** Header Layout Settings */
    $wp_customize->add_section(
        'header_layout_settings',
        array(
            'title'    => __( 'Header Layout', 'consulting-coach' ),
            'priority' => 10,
            'panel'    => 'layout_settings',
        )
    );
    
    /** Page Sidebar layout */
    $wp_customize->add_setting( 
        'header_layout', 
        array(
            'default'           => 'nine',
            'sanitize_callback' => 'blossom_coach_sanitize_radio'
        ) 
    );
    
    $wp_customize->add_control(
		new Blossom_Coach_Radio_Image_Control(
			$wp_customize,
			'header_layout',
			array(
				'section'	  => 'header_layout_settings',
				'label'		  => __( 'Header Layout', 'consulting-coach' ),
				'description' => __( 'Choose the layout of the header for your site.', 'consulting-coach' ),
				'choices'	  => array(
                    'seven' => get_stylesheet_directory_uri() . '/images/seven.png',
                    'nine'  => get_stylesheet_directory_uri() . '/images/nine.png',
				)
			)
		)
	);

    $wp_customize->add_setting(
        'header_settings_text',
        array(
            'default' => '',
            'sanitize_callback' => 'wp_kses_post'
        )
    );

    $wp_customize->add_control(
        new Blossom_Coach_Note_Control(
            $wp_customize,
            'header_settings_text',
            array(
                'section'       => 'header_layout_settings',
                'description'   => sprintf(__('%1$sClick here%2$s to configure header layout settings', 'consulting-coach'), '<span class="text-inner-link header_settings_text">', '</span>'),
            )
        )
    );

    // Getting Started Button Label
	$wp_customize->add_setting(
        'header_getting_started_button',
        array(
            'default'           => '',
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage' 
        )
    );
    
    $wp_customize->add_control(
        'header_getting_started_button',
        array(
			'label'           => __( 'Header Getting Started Button', 'consulting-coach' ),
			'section'         => 'header_settings',
			'type'            => 'text'
		)
    );

    $wp_customize->selective_refresh->add_partial('header_getting_started_button', array(
		'selector'        => '.site-header .button-wrap .btn-1',
		'render_callback' => 'consulting_coach_get_getting_started_button',
	));

    $wp_customize->add_setting(
        'header_getting_started_url',
        array(
            'default'           => '',
            'sanitize_callback' => 'esc_url_raw', 
        )
    );
    
    $wp_customize->add_control(
        'header_getting_started_url',
        array(
			'label'           => __( 'Header Getting Started Link', 'consulting-coach' ),
			'section'         => 'header_settings',
			'type'            => 'url'
        )
    );

    /** Open header getting started url  in a new tab */
	 $wp_customize->add_setting( 
        'header_getting_started_url_new_tab', 
        array(
            'default'           => true,
            'sanitize_callback' => 'blossom_coach_sanitize_checkbox'
        ) 
    );
    
    $wp_customize->add_control(
        new Blossom_Coach_Toggle_Control( 
            $wp_customize,
            'header_getting_started_url_new_tab',
            array(
				'section'         => 'header_settings',
				'label'           => __( 'Open in new tab', 'consulting-coach' ),
				'description'     => __( 'Enable to open the link in a new tab.', 'consulting-coach' )
            )
        )
    );

    $wp_customize->add_setting(
        'header_layout_text',
        array(
            'default' => '',
            'sanitize_callback' => 'wp_kses_post'
        )
    );

    $wp_customize->add_control(
        new Blossom_Coach_Note_Control(
            $wp_customize,
            'header_layout_text',
            array(
                'section' => 'header_settings',
                'description' => sprintf(__('%1$sClick here%2$s to configure header layout settings', 'consulting-coach'), '<span class="text-inner-link header_layout_text">', '</span>'),
            )
        )
    );

    /** Banner Options */
    $wp_customize->add_setting(
		'ed_banner_section',
		array(
			'default'			=> 'static_banner',
			'sanitize_callback' => 'blossom_coach_sanitize_select'
		)
	);

	$wp_customize->add_control(
		new Blossom_Coach_Select_Control(
    		$wp_customize,
    		'ed_banner_section',
    		array(
                'label'	      => __( 'Banner Options', 'consulting-coach' ),
                'description' => __( 'Choose banner as static image/video or as a slider.', 'consulting-coach' ),
    			'section'     => 'header_image',
    			'choices'     => array(
					'no_banner'        => __( 'Disable Banner Section', 'consulting-coach' ),
					'static_nl_banner' => __( 'Static/Video Newsletter Banner', 'consulting-coach' ),
					'slider_banner'    => __( 'Banner as Slider', 'consulting-coach' ),
					'static_banner'    => __('Static/Video CTA Banner', 'consulting-coach')
                ),
                'priority' => 5	
     		)            
		)
	);

	/** Sub Title */
	$wp_customize->add_setting(
        'banner_text',
        array(
            'default'           => '',
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage'
        )
    );
    
    $wp_customize->add_control(
        'banner_text',
        array(
            'label'           => __( 'Subtitle', 'consulting-coach' ),
            'section'         => 'header_image',
            'type'            => 'text',
            'active_callback' => 'blossom_coach_banner_ac'
        )
    );

    $wp_customize->selective_refresh->add_partial( 'banner_text', array(
		'selector'        => '.site-banner .banner-caption .banner-wrap h5.subtitle',
		'render_callback' => 'consulting_coach_get_banner_sub_title',
    ) );

    /** Title */
	$wp_customize->add_setting(
		'banner_title',
		array(
			'default'           => '',
			'sanitize_callback' => 'sanitize_text_field',
			'transport'         => 'postMessage',
		)
	);

	$wp_customize->add_control(
		'banner_title',
		array(
			'label'           => __('Title', 'consulting-coach'),
			'section'         => 'header_image',
			'type'            => 'text',
			'active_callback' => 'blossom_coach_banner_ac',
		)
	);

	$wp_customize->selective_refresh->add_partial('banner_title', array(
		'selector'        => '.site-banner .banner-caption .banner-wrap .banner-title',
		'render_callback' => 'consulting_coach_get_banner_title',
	));

	/** Content */
	$wp_customize->add_setting(
		'banner_subtitle',
		array(
			'default'           => '',
			'sanitize_callback' => 'wp_kses_post',
			'transport'         => 'postMessage',
		)
	);

	$wp_customize->add_control(
		'banner_subtitle',
		array(
			'label'           => __('Description', 'consulting-coach'),
			'section'         => 'header_image',
			'type'            => 'textarea',
			'active_callback' => 'blossom_coach_banner_ac',
		)
	);

	$wp_customize->selective_refresh->add_partial('banner_subtitle', array(
		'selector'        => '.site-banner .banner-caption .banner-wrap .b-content',
		'render_callback' => 'consulting_coach_get_banner_content',
	));

	/** Banner Label */
	$wp_customize->add_setting(
		'banner_label',
		array(
			'default'           => '',
			'sanitize_callback' => 'sanitize_text_field',
			'transport'         => 'postMessage',
		)
	);

	$wp_customize->add_control(
		'banner_label',
		array(
			'label'           => __('Banner Label', 'consulting-coach'),
			'section'         => 'header_image',
			'type'            => 'text',
			'active_callback' => 'blossom_coach_banner_ac',
		)
	);

	$wp_customize->selective_refresh->add_partial('banner_label', array(
		'selector'        => '.site-banner .banner-caption .banner-wrap .banner-link',
		'render_callback' => 'consulting_coach_get_banner_label',
	));

	/** Banner Link */
	$wp_customize->add_setting(
		'banner_link',
		array(
			'default'           => '',
			'sanitize_callback' => 'esc_url_raw',
		)
	);

	$wp_customize->add_control(
		'banner_link',
		array(
			'label'           => __('Banner Link', 'consulting-coach'),
			'section'         => 'header_image',
			'type'            => 'text',
			'active_callback' => 'blossom_coach_banner_ac',
		)
	);

	$wp_customize->add_setting( 
        'banner_caption_layout', 
        array(
            'default'           => 'left',
            'sanitize_callback' => 'consulting_coach_sanitize_radio'
        ) 
    );
    
    $wp_customize->add_control(
        new Consulting_Coach_Radio_Buttonset_Control(
            $wp_customize,
            'banner_caption_layout',
            array(
                'section'     => 'header_image',
                'label'       => __( 'Banner Image Alignment', 'consulting-coach' ),
                'description' => __( 'Choose alignment for banner image.', 'consulting-coach' ),
                'choices'     => array(
                    'left'      => __( 'Left', 'consulting-coach' ),
                    'right'     => __( 'Right', 'consulting-coach' ),
                ),
                'active_callback' => 'blossom_coach_banner_ac' 
            )
        )
    );

    $wp_customize->add_setting(
        'banner_link_new_tab',
        array(
            'default'           => false,
            'sanitize_callback' => 'blossom_coach_sanitize_checkbox',
        )
    );
    
    $wp_customize->add_control(
        new Blossom_Coach_Toggle_Control( 
            $wp_customize,
            'banner_link_new_tab',
            array(
                'section'     => 'header_image',
                'label'       => __( 'Open Banner link in new tab', 'consulting-coach' ),
				'description' => __( 'Enable to open  banner link in new tab.', 'consulting-coach' ),
                'active_callback' => 'blossom_coach_banner_ac'
            )
        )
    );

}
add_action( 'customize_register', 'consulting_coach_customize_register', 40 );

/**
 * Active Callback for Banner Slider
*/
function blossom_coach_banner_ac( $control ){
    $banner      = $control->manager->get_setting( 'ed_banner_section' )->value();
    $slider_type = $control->manager->get_setting( 'slider_type' )->value();
    $control_id  = $control->id;
    
    if ( $control_id == 'header_image' && ( $banner == 'static_nl_banner' || $banner == 'static_banner' ) ) return true;
    if ( $control_id == 'header_video' && ( $banner == 'static_nl_banner' || $banner == 'static_banner' ) ) return true;
    if ( $control_id == 'external_header_video' && ( $banner == 'static_nl_banner' || $banner == 'static_banner' ) ) return true;
    if ( $control_id == 'banner_newsletter' && $banner == 'static_nl_banner' ) return true;    
    if ( $control_id == 'slider_type' && $banner == 'slider_banner' ) return true;          
    if ( $control_id == 'slider_animation' && $banner == 'slider_banner' ) return true;    
    if ( $control_id == 'slider_cat' && $banner == 'slider_banner' && $slider_type == 'cat' ) return true;
    if ( $control_id == 'no_of_slides' && $banner == 'slider_banner' && $slider_type == 'latest_posts' ) return true;
    if ( $control_id == 'banner_title' && $banner == 'static_banner' ) return true;
    if ( $control_id == 'banner_subtitle' && $banner == 'static_banner' ) return true;
    if ( $control_id == 'banner_text' && $banner == 'static_banner' ) return true;
    if ( $control_id == 'banner_label' && $banner == 'static_banner' ) return true;
    if ( $control_id == 'banner_link' && $banner == 'static_banner' ) return true;
    if ( $control_id == 'banner_caption_layout' && $banner == 'static_banner' ) return true;
    if ( $control_id == 'banner_link_new_tab' && $banner == 'static_banner' ) return true;
    
    return false;
}

function consulting_coach_sanitize_radio( $input, $setting ) {
	// Ensure input is a slug.
	$input = sanitize_key( $input );
	// Get list of choices from the control associated with the setting.
	$choices = $setting->manager->get_control( $setting->id )->choices;
	// If the input is a valid key, return it; otherwise, return the default.
	return ( array_key_exists( $input, $choices ) ? $input : $setting->default );
}

if( ! function_exists( 'consulting_coach_get_getting_started_button' ) ) :
/**
 * Header Getting Started Button
*/
function consulting_coach_get_getting_started_button(){
    return esc_html( get_theme_mod( 'header_getting_started_button' ) );
}
endif;

if( ! function_exists( 'consulting_coach_get_banner_sub_title' ) ) :
/**
 * Get Banner Sub Title
*/
function consulting_coach_get_banner_sub_title(){
    return esc_html( get_theme_mod( 'banner_text' ) );
}
endif;

if( ! function_exists( 'consulting_coach_get_banner_title' ) ) :
/**
 * Get Banner Title
*/
function consulting_coach_get_banner_title(){
    return esc_html( get_theme_mod( 'banner_title' ) );
}
endif;

if( ! function_exists( 'consulting_coach_get_banner_content' ) ) :
/**
 * Get Banner Content
*/
function consulting_coach_get_banner_content(){
    return wpautop( wp_kses_post( get_theme_mod( 'banner_subtitle' ) ) );
}
endif;

if( ! function_exists( 'consulting_coach_get_banner_label' ) ) :
/**
 * Get Banner Label
*/
function consulting_coach_get_banner_label(){
    return esc_html( get_theme_mod( 'banner_label' ) );
}
endif;

/**
 * Getting Started Button 
*/
function blossom_coach_getting_started_button(){ 
    $header_getting_started_button  = get_theme_mod( 'header_getting_started_button' );
    $header_getting_started_url     = get_theme_mod( 'header_getting_started_url' );
    $new_tab                        = get_theme_mod( 'header_getting_started_url_new_tab', true );
    $target                         = $new_tab ? 'target=_blank' : '';
    if( $header_getting_started_button && $header_getting_started_url ) : ?>
        <div class="button-wrap">
            <a href="<?php echo esc_url( $header_getting_started_url ); ?>" class="btn-cta btn-1"<?php echo esc_attr( $target ); ?>><?php echo esc_html( $header_getting_started_button ); ?></a>
        </div>
    <?php
    endif;
}

/**
 * Function for mobile navigation menu
 */
function consulting_coach_mobile_menu(){ 
    $ed_cart   = get_theme_mod( 'ed_shopping_cart', true );
    $ed_search = get_theme_mod( 'ed_header_search', true ); 
    $phone     = get_theme_mod( 'phone' );
    $email     = get_theme_mod( 'email' );    
    ?>
    <div class="mobile-menu-wrapper">
        <div class="main-header" >
            <div class="wrapper">
                <?php blossom_coach_site_branding(); ?>
                <button type="button" class="toggle-button" data-toggle-target=".menu-modal" data-toggle-body-class="showing-menu-modal" aria-expanded="false" data-set-focus=".close-nav-toggle">
                    <span class="toggle-bar"></span>
                    <span class="toggle-bar"></span>
                    <span class="toggle-bar"></span>
                </button>
            </div><!-- .main-header -->
        </div>
        <div class="nav-slide-wrapper secondary-menu-list menu-modal cover-modal" data-modal-target-string=".menu-modal">
            <div class="header-t">
            <button class="close close-nav-toggle" data-toggle-target=".menu-modal" data-toggle-body-class="showing-menu-modal" aria-expanded="false" data-set-focus=".menu-modal"><span></span></button>
                <div class="wrapper mobile-menu" aria-label="<?php esc_attr_e( 'Mobile', 'consulting-coach' ); ?>">
                    <?php if( blossom_coach_social_links( false ) || $ed_search ){
                        echo '<div class="top-right">';
                        if( blossom_coach_social_links( false ) ){
                            echo '<div class="header-social">';
                            blossom_coach_social_links();
                            echo '</div><!-- .header-social -->';
                        }
                        if( $ed_search || ( blossom_coach_is_woocommerce_activated() && $ed_cart ) ){ 
                            if( $ed_search ) blossom_coach_header_search(); 
                            if( blossom_coach_is_woocommerce_activated() && $ed_cart ) blossom_coach_wc_cart_count();
                        }
                        echo '</div><!-- .top-right -->';
                    } ?>
                    <div class="menu-wrap">
                        <nav id="site-navigation" class="main-navigation" itemscope itemtype="https://schema.org/SiteNavigationElement"> 
                            <?php
                                wp_nav_menu( array(
                                    'theme_location' => 'primary',
                                    'menu_id'        => 'primary-menu',
                                    'menu_class'     => 'menu',
                                    'fallback_cb'    => 'blossom_coach_primary_menu_fallback',
                                ) );
                            ?>   
                        </nav><!-- #site-navigation -->                      
                    </div>
                    <div class = "wrap-right">
                        <?php blossom_coach_header_phone_email( $phone, $email ); 
                        blossom_coach_getting_started_button(); ?>
                    </div> 
                </div><!-- .wrapper -->   
                                     
            </div><!-- .header-t -->
        </div>      
    </div>
<?php }

/**
 * Header Start
*/
function blossom_coach_header(){  
    $header_array = array( 'seven', 'nine' );
    $header       = get_theme_mod( 'header_layout', 'nine' );
    
    if( in_array( $header, $header_array ) ){            
        get_template_part( 'headers/' . $header );
    }   
	
}

/**
 * Returns Home Sections 
 */
function blossom_coach_get_home_sections(){
    $ed_banner = get_theme_mod('ed_banner_section', 'static_banner');
    $sections = array(
        'client'        => array('sidebar' => 'client'),
        'about'         => array('sidebar' => 'about'),
        'service'       => array('sidebar' => 'service'),
        'cta'           => array('sidebar' => 'cta'),
        'testimonial'   => array('sidebar' => 'testimonial'),
        'wheeloflife'   => array('wsection' => 'wheeloflife' ),
        'blog'          => array('bsection' => 'blog'),
        'simple-cta'    => array('sidebar' => 'simple-cta'),
        'contact'       => array('sidebar' => 'contact'),
    );

    $enabled_section = array();

    if ($ed_banner == 'static_nl_banner' || $ed_banner == 'slider_banner' || $ed_banner == 'static_banner') array_push($enabled_section, 'banner');

    foreach ($sections as $k => $v) {
        if (array_key_exists('sidebar', $v)) {
            if (is_active_sidebar($v['sidebar'])) array_push($enabled_section, $v['sidebar']);
        } else {
            if( array_key_exists( 'bsection', $v ) && get_theme_mod( 'ed_blog_section', true ) ) array_push( $enabled_section, $v['bsection'] );
            if( array_key_exists( 'wsection', $v ) && get_theme_mod( 'ed_wheeloflife_section', false ) ) array_push( $enabled_section, $v['wsection'] );
        }
    }

    return apply_filters('blossom_coach_home_sections', $enabled_section);
}

/**
 * Footer Bottom
 */
function blossom_coach_footer_bottom(){ ?>
    <div class="bottom-footer">
		<div class="wrapper">
			<div class="copyright">            
            <?php
            blossom_coach_get_footer_copyright();
            echo esc_html__(' Consulting Coach | Developed By ', 'consulting-coach');
            echo '<a href="' . esc_url('https://blossomthemes.com/') . '" rel="nofollow" target="_blank">' . esc_html__('Blossom Themes', 'consulting-coach') . '</a>.';
            printf(esc_html__(' Powered by %s', 'consulting-coach'), '<a href="' . esc_url(__('https://wordpress.org/', 'consulting-coach')) . '" target="_blank">WordPress</a>.');
            if (function_exists('the_privacy_policy_link')) {
                the_privacy_policy_link();
            }
            ?>               
            </div>
		</div><!-- .wrapper -->
	</div><!-- .bottom-footer -->
    <?php

}

function blossom_coach_fonts_url(){
    $fonts_url = '';
    
    $primary_font       = get_theme_mod( 'primary_font', 'Figtree' );
    $ig_primary_font    = blossom_coach_is_google_font( $primary_font );    
    $secondary_font     = get_theme_mod( 'secondary_font', 'Rufina' );
    $ig_secondary_font  = blossom_coach_is_google_font( $secondary_font );    
    $site_title_font    = get_theme_mod( 'site_title_font', array( 'font-family'=>'Nunito', 'variant'=>'700' ) );
    $ig_site_title_font = blossom_coach_is_google_font( $site_title_font['font-family'] );
        
    /* Translators: If there are characters in your language that are not
    * supported by respective fonts, translate this to 'off'. Do not translate
    * into your own language.
    */
    $primary    = _x( 'on', 'Primary Font: on or off', 'consulting-coach' );
    $secondary  = _x( 'on', 'Secondary Font: on or off', 'consulting-coach' );
    $site_title = _x( 'on', 'Site Title Font: on or off', 'consulting-coach' );
    
    if ( 'off' !== $primary || 'off' !== $secondary || 'off' !== $site_title ) {
        
        $font_families = array();
     
        if ( 'off' !== $primary && $ig_primary_font ) {
            $primary_variant = blossom_coach_check_varient( $primary_font, 'regular', true );
            if( $primary_variant ){
                $primary_var = ':' . $primary_variant;
            }else{
                $primary_var = '';    
            }            
            $font_families[] = $primary_font . $primary_var;
        }
         
        if ( 'off' !== $secondary && $ig_secondary_font ) {
            $secondary_variant = blossom_coach_check_varient( $secondary_font, 'regular', true );
            if( $secondary_variant ){
                $secondary_var = ':' . $secondary_variant;    
            }else{
                $secondary_var = '';
            }
            $font_families[] = $secondary_font . $secondary_var;
        }
        
        if ( 'off' !== $site_title && $ig_site_title_font ) {
            
            if( ! empty( $site_title_font['variant'] ) ){
                $site_title_var = ':' . blossom_coach_check_varient( $site_title_font['font-family'], $site_title_font['variant'] );    
            }else{
                $site_title_var = '';
            }
            $font_families[] = $site_title_font['font-family'] . $site_title_var;
        }
        
        $font_families = array_diff( array_unique( $font_families ), array('') );
        
        $query_args = array(
            'family' => urlencode( implode( '|', $font_families ) ),            
        );
        
        $fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
    }
    
    if( get_theme_mod( 'ed_localgoogle_fonts', false ) ) {
        $fonts_url = blossom_coach_get_webfont_url( add_query_arg( $query_args, 'https://fonts.googleapis.com/css' ) );
    }
     
    return esc_url_raw( $fonts_url );
}

/**
 * convert hex to rgb
 * @link https://bavotasan.com/2011/convert-hex-color-to-rgb-using-php/
 */
function consulting_coach_hex2rgb($hex){
    $hex = str_replace("#", "", $hex);

    if (strlen($hex) == 3) {
        $r = hexdec(substr($hex, 0, 1) . substr($hex, 0, 1));
        $g = hexdec(substr($hex, 1, 1) . substr($hex, 1, 1));
        $b = hexdec(substr($hex, 2, 1) . substr($hex, 2, 1));
    } else {
        $r = hexdec(substr($hex, 0, 2));
        $g = hexdec(substr($hex, 2, 2));
        $b = hexdec(substr($hex, 4, 2));
    }
    $rgb = array($r, $g, $b);
   //return implode(",", $rgb); // returns the rgb values separated by commas
    return $rgb; // returns an array with the rgb values
}

function blossom_coach_dynamic_css(){

	$primary_font         = get_theme_mod('primary_font', 'Figtree');
	$primary_fonts        = blossom_coach_get_fonts($primary_font, 'regular');
	$secondary_font       = get_theme_mod('secondary_font', 'Rufina');
	$secondary_fonts      = blossom_coach_get_fonts($secondary_font, 'regular');
	
	$site_title_font      = get_theme_mod('site_title_font', array('font-family' => 'Nunito', 'variant' => '700'));
	$site_title_fonts     = blossom_coach_get_fonts($site_title_font['font-family'], $site_title_font['variant']);
	$site_title_font_size = get_theme_mod('site_title_font_size', 45);
	
    $primary_color     = get_theme_mod( 'primary_color', '#3a7f90' );
    $secondary_color   = get_theme_mod( 'secondary_color', '#7da659' );
    $logo_width        = get_theme_mod( 'logo_width', 60 );
    $wheeloflife_color = get_theme_mod( 'wheeloflife_color', '#f2f2f2' );

    $custom_css = '';
    $custom_css .= '
    
    :root {
        --primary-font: ' . esc_html( $primary_fonts['font'] ) . ';
        --secondary-font: ' . esc_html( $secondary_fonts['font'] ) . ';
        --primary-color: ' . blossom_coach_sanitize_hex_color( $primary_color ) . ';
        --secondary-color: ' .  blossom_coach_sanitize_hex_color( $secondary_color ) . ';
    }
    
    .site-title, 
    .site-title-wrap .site-title{
        font-size   : ' . absint($site_title_font_size) . 'px;
        font-family : ' . esc_html($site_title_fonts['font']) . ';
        font-weight : ' . esc_html($site_title_fonts['weight']) . ';
        font-style  : ' . esc_html($site_title_fonts['style']) . ';
    }

    section#wheeloflife_section {
        background-color: ' . blossom_coach_sanitize_hex_color( $wheeloflife_color ) . ';
    }

    .custom-logo-link img{
        width    : ' . absint( $logo_width ) . 'px;
        max-width: ' . 100 .'%;
    }';

    wp_add_inline_style('consulting-coach', $custom_css);
}