<?php
/**
 * Template part for displaying header layout.
 * 
 * @author themepiko
 */
$prefix = 'wooxon_';
$menu_width =  get_post_meta(get_the_ID(), $prefix . 'manu_width',true);
if (!isset($menu_width) || $menu_width == '-1' || $menu_width == '') {
    $menu_width = isset( $GLOBALS['wooxon']['full_width_menu'] ) ? $GLOBALS['wooxon']['full_width_menu'] : 'container';
}
$topbar =  get_post_meta(get_the_ID(), $prefix . 'enable_top_bar',true);
if (!isset($topbar) || $topbar == '-1' || $topbar == 0) {
   $topbar = wooxon_get_option_data('enable_top_bar', false); 
}

$button_action = wooxon_get_option_data('menu_button_actions', '1'); 

?>
<div class="header-wrapper">
	<header id="header" class="site-header sticky-menu-header">
		<?php if($topbar){ wooxon_get_topbar(); } ?>
		<div class="header-main">
                    <div class="<?php echo esc_attr($menu_width); ?>">
			<div class="row">
				<div class="col-md-12 columns">                                    
                                    <div class="header-left">
                                        <?php wooxon_get_brand_logo(); ?>
                                    </div>
                                    <div class="header-right">
                                        <div id="header-search-form" class="dn" data-togole="hidden"><?php wooxon_get_template('search-form/search','form');?></div>
                                        <div class="main-menu-wrap">
                                            <div id="main-menu">
                                                <?php wooxon_get_sticky_logo();?>
                                                <?php wooxon_get_main_menu();?>
                                                <div class="header-actions">
                                                <?php wooxon_get_header_action_info();?>
                                                <?php wooxon_get_header_action();?>                                                
                                                </div>
                                            </div>
                                        </div>
                                    </div>
				</div>
                        </div>                        
                    </div>                    
		</div>
                <div class="header-bottom search-form">
                    <div class="<?php echo esc_attr($menu_width); ?>">
                        <div class="row">
                            <div class="col-lg-3 col-xl-3"><?php wooxon_get_menu_category_wrap();?></div>
                            <div class="col-lg-6 col-xl-7"><?php wooxon_get_template('search-form/search','form');?></div>
                            <div class="col-lg-3 col-xl-2"><div class="header-actions"> <?php if($button_action == 2){ wooxon_get_header_action_two(); }else{wooxon_get_header_action(); } ;?></div></div>
                        </div>                    
                    </div>
                </div>
	</header>
</div>