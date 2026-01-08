<?php
$ed_cart       = get_theme_mod( 'ed_shopping_cart', true ); 
$ed_search     = get_theme_mod( 'ed_header_search', false );
$phone         = get_theme_mod( 'phone' );
$email         = get_theme_mod( 'email' );
?>
<header id="masthead" class="site-header header-lay7" itemscope itemtype="https://schema.org/WPHeader">
    <div class="main-header desktop">
        <div class="wrapper">
            <?php blossom_coach_site_branding(); ?>
            <div class = "wrap-right">
                <?php if( $phone || $email ) blossom_coach_header_phone_email( $phone, $email ); 
                blossom_coach_getting_started_button(); ?>
            </div>
        </div>
    </div><!-- .main-header -->
    <div class="header-t desktop">
        <div class="wrapper">
            <div class="menu-wrap">
                <?php blossom_coach_primary_nagivation(); ?>                        
            </div>
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
        </div><!-- .wrapper -->            				 
    </div><!-- .header-t --> 
    <?php consulting_coach_mobile_menu(); ?>			
</header><!-- .site-header -->