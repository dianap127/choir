<?php
/**
 * Header Nine
 *
 * @package Blossom_Coach_Pro
 */

$ed_cart       = get_theme_mod( 'ed_shopping_cart', true ); 
$ed_search     = get_theme_mod( 'ed_header_search', false );
$phone         = get_theme_mod( 'phone' );
$email         = get_theme_mod( 'email' );
?>

<header id="masthead" class="site-header header-lay9" itemscope itemtype="https://schema.org/WPHeader">
	<div class="header-t desktop">
		<div class="wrapper">
			<?php 
                if( blossom_coach_social_links( false ) ) {
                	blossom_coach_social_links( true, true );
                }else{
                	echo '<div class="header-social"></div>';
                }
                
				if( $phone || $email ) blossom_coach_header_phone_email( $phone, $email ); ?>
				<div class="top-right">	
					<?php if( $ed_search || ( blossom_coach_is_woocommerce_activated() && $ed_cart ) ){
						if( $ed_search ) blossom_coach_header_search(); 
						if( blossom_coach_is_woocommerce_activated() && $ed_cart ) blossom_coach_wc_cart_count();
					} ?>
				</div>	
		</div>
	</div> <!-- .header-t -->
	<div class="main-header desktop">
		<?php blossom_coach_site_branding(); ?>
		<div class="wrapper">
			<div class="menu-wrap">
				<?php blossom_coach_primary_nagivation(); ?>
				<?php blossom_coach_getting_started_button( true ); ?>
			</div>
		</div>
	</div><!-- .main-header -->

	<?php consulting_coach_mobile_menu(); ?>              

</header><!-- .site-header -->