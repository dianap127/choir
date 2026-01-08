<?php
/**
 * Active Callback
 * 
 * @package Blossom_Coach
*/

if( ! function_exists( 'blossom_coach_banner_ac' ) ) :
/**
 * Active Callback for Banner Slider
*/
function blossom_coach_banner_ac( $control ){
    $banner      = $control->manager->get_setting( 'ed_banner_section' )->value();
    $slider_type = $control->manager->get_setting( 'slider_type' )->value();
    $control_id  = $control->id;
    
    if ( $control_id == 'header_image' && $banner == 'static_nl_banner' ) return true;
    if ( $control_id == 'header_video' && $banner == 'static_nl_banner' ) return true;
    if ( $control_id == 'external_header_video' && $banner == 'static_nl_banner' ) return true;
    if ( $control_id == 'banner_newsletter' && $banner == 'static_nl_banner' ) return true;
    if ( $control_id == 'header_image_mobile' && $banner == 'static_nl_banner' ) return true;
    if ( $control_id == 'banner_nl_note' && $banner == 'static_nl_banner' ) return true;
    
    
    if ( $control_id == 'slider_type' && $banner == 'slider_banner' ) return true;          
    if ( $control_id == 'slider_animation' && $banner == 'slider_banner' ) return true;
    
    if ( $control_id == 'slider_cat' && $banner == 'slider_banner' && $slider_type == 'cat' ) return true;
    if ( $control_id == 'no_of_slides' && $banner == 'slider_banner' && $slider_type == 'latest_posts' ) return true;
    
    return false;
}
endif;

if( ! function_exists( 'blossom_coach_blog_view_all_ac' ) ) :
/**
 * Active Callback for Blog View All Button
*/
function blossom_coach_blog_view_all_ac(){
    $blog = get_option( 'page_for_posts' );
    if( $blog ) return true;
    
    return false; 
}
endif;

if( ! function_exists( 'blossom_coach_breadcrumbs' ) ) :
/**
 * Active Callback for Breadcrumb.
*/
function blossom_coach_breadcrumbs(){
    $breadcrumb = get_theme_mod( 'ed_breadcrumb' , true );

    if( $breadcrumb ) return true;
    
    return false; 
}
endif;

if( ! function_exists( 'blossom_coach_wheeloflife_ac' ) ) :
/**
 * Active Callback for Wheel of Life.
*/
function blossom_coach_wheeloflife_ac( $control ){
    $ed_wheeloflife = get_theme_mod( 'ed_wheeloflife_section' , false );
    $ed_tab         = $control->manager->get_setting( 'wheel_of_life_tab' )->value();
    $control_id     = $control->id;
    
    if ( $ed_wheeloflife && $control_id == 'wol_section_title'  ) return true;
    if ( $ed_wheeloflife && $control_id == 'wol_section_content'  ) return true;
    if ( $ed_wheeloflife && $control_id == 'wheeloflife_img'  ) return true;
    if ( $ed_wheeloflife && $control_id == 'wheel_of_life_tab'  ) return true;
    if ( $ed_wheeloflife && $control_id == 'wheeloflife_cp_text' && $ed_tab == 'coach' ) return true;
    if ( $ed_wheeloflife && $control_id == 'wheeloflife_url_cp' && $ed_tab == 'coach' ) return true;
    if ( $ed_wheeloflife && $control_id == 'wheeloflife_text_cp' && $ed_tab == 'coach' ) return true;
    if ( $ed_wheeloflife && $control_id == 'wol_activate_note' && $ed_tab == 'wol' ) return true;
    if ( $ed_wheeloflife && $control_id == 'wheeloflife_text' && $ed_tab == 'wol' ) return true;
    if ( $ed_wheeloflife && $control_id == 'wheeloflife_shortcode' && $ed_tab == 'wol' ) return true;
    if ( $ed_wheeloflife && $control_id == 'wheeloflife_learn_text' && $ed_tab == 'wol' ) return true;
    if ( $ed_wheeloflife && $control_id == 'wheeloflife_color' && $ed_tab == 'wol' ) return true;
    
    return false; 
}
endif;

/**
 * Active Callback for local fonts
*/
function blossom_coach_ed_localgoogle_fonts(){
    $ed_localgoogle_fonts = get_theme_mod( 'ed_localgoogle_fonts' , false );

    if( $ed_localgoogle_fonts ) return true;
    
    return false; 
}

/**
 * Active Callback for Instagram.
*/
function blossom_coach_ed_instagram($control){
    
    $ed_instagram = get_theme_mod( 'ed_instagram', false );
    $control_id     = $control->id;

    if ( $control_id == 'instagram_shortcode' && $ed_instagram ) return true;

    return false;
}
