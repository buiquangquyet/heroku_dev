<?php
//about theme info
add_action( 'admin_menu', 'vw_lawyer_attorney_gettingstarted' );
function vw_lawyer_attorney_gettingstarted() {    	
	add_theme_page( esc_html__('About VW Lawyer Lite', 'vw-lawyer-attorney'), esc_html__('About VW Lawyer Lite', 'vw-lawyer-attorney'), 'edit_theme_options', 'vw_lawyer_attorney_guide', 'vw_lawyer_attorney_mostrar_guide');   
}

// Add a Custom CSS file to WP Admin Area
function vw_lawyer_attorney_admin_theme_style() {
   wp_enqueue_style( 'vw-lawyer-attorney-font', vw_lawyer_attorney_admin_font_url(), array() );
   wp_enqueue_style('custom-admin-style', get_template_directory_uri() . '/inc/getstart/getstart.css');
   wp_enqueue_script('tabs', get_template_directory_uri() . '/inc/getstart/js/tab.js');
}
add_action('admin_enqueue_scripts', 'vw_lawyer_attorney_admin_theme_style');

// Theme Font URL
function vw_lawyer_attorney_admin_font_url() {
	$font_url = '';
	$font_family = array();
	$font_family[] = 'Muli:300,400,600,700,800,900';

	$query_args = array(
		'family'	=> urlencode(implode('|',$font_family)),
	);
	$font_url = add_query_arg($query_args,'//fonts.googleapis.com/css');
	return $font_url;
}

//guidline for about theme
function vw_lawyer_attorney_mostrar_guide() { 
	//custom function about theme customizer
	$return = add_query_arg( array()) ;
	$theme = wp_get_theme( 'vw-lawyer-attorney' );
?>

<div class="wrapper-info">
    <div class="col-left">
    	<h2><?php esc_html_e( 'Welcome to VW Lawyer Theme', 'vw-lawyer-attorney' ); ?> <span class="version">Version: <?php echo esc_html($theme['Version']);?></span></h2>
    	<p><?php esc_html_e('All our WordPress themes are modern, minimalist, 100% responsive, seo-friendly,feature-rich, and multipurpose that best suit designers, bloggers and other professionals who are working in the creative fields.','vw-lawyer-attorney'); ?></p>
    </div>
    <div class="col-right">
    	<div class="logo">
			<img src="<?php echo esc_url(get_template_directory_uri()); ?>/inc/getstart/images/final-logo.png" alt="" />
		</div>
		<div class="update-now">
			<h4><?php esc_html_e('Buy VW Lawyer at 10% Discount','vw-lawyer-attorney'); ?></h4>
			<h4><?php esc_html_e('Use Coupon','vw-lawyer-attorney'); ?> ( <span><?php esc_html_e('vwten2018','vw-lawyer-attorney'); ?> </span> )</h4>
			<div class="info-link">
				<a href="<?php echo esc_url( VW_LAWYER_ATTORNEY_BUY_NOW ); ?>" target="_blank"> <?php esc_html_e( 'Upgrade to Pro', 'vw-lawyer-attorney' ); ?></a>
			</div>
		</div>
    </div>

    <div class="tab-sec">
		<div class="tab">
		  <button class="tablinks" onclick="openCity(event, 'tour_lite')"><?php esc_html_e( 'Getting Started', 'vw-lawyer-attorney' ); ?></button>		  
		  <button class="tablinks" onclick="openCity(event, 'tour_pro')"><?php esc_html_e( 'Get Premium', 'vw-lawyer-attorney' ); ?></button>
		  <button class="tablinks" onclick="openCity(event, 'free_pro')"><?php esc_html_e( 'Support', 'vw-lawyer-attorney' ); ?></button>
		</div>

		<!-- Tab content -->
		<div id="tour_lite" class="tabcontent open">
			<h3><?php esc_html_e( 'Lite Theme Information', 'vw-lawyer-attorney' ); ?></h3>
			<hr class="h3hr">
		  	<p><?php esc_html_e('VW Lawyer Attorney Theme is designed to be stylish and classy, This exclusive theme is developed especially for Lawyers, Legal Firms, Law Firm, Legal Advisers, Legal offices, law practices, civil law, legal help, legal institutions and Attorney websites. Our Lawyer WordPress theme makes the use of secure and clean codes, you can easily customize our theme as per your wishes. You can even add or remove anything that you may or may not like. Our Free WordPress theme is so feature-rich that you wouldnt feel like buying from someone else. With ample of personalization options, optimized codes, call to action button (CTA), beautiful banners, useful shortcodes, numerous styling options, it is the best professional WordPress theme to grab. You will get an interactive demo, responsive slider, quick page speed, display options, SEO friendly features, social media icons, and a bunch of other phenomenal features with this supreme theme. Furthermore, built on Bootstrap framework, the theme will ease the web development. It is user-friendly, and multipurpose theme which will fit perfectly for you. All your long research and time invested in finding the best themes end with us, as we bring you a theme like no other. Our Free Lawyer Attorney WordPress Theme is fresh, special and distinct in every aspect.','vw-lawyer-attorney'); ?></p>
		  	<div class="col-left-inner">
		  		<h4><?php esc_html_e( 'Theme Documentation', 'vw-lawyer-attorney' ); ?></h4>
				<p><?php esc_html_e( 'If you need any assistance regarding setting up and configuring the Theme, our documentation is there.', 'vw-lawyer-attorney' ); ?></p>
				<div class="info-link">
					<a href="<?php echo esc_url( VW_LAWYER_ATTORNEY_FREE_THEME_DOC ); ?>" target="_blank"> <?php esc_html_e( 'Documentation', 'vw-lawyer-attorney' ); ?></a>
				</div>
				<hr>
				<h4><?php esc_html_e('Theme Customizer', 'vw-lawyer-attorney'); ?></h4>
				<p> <?php esc_html_e('To begin customizing your website, start by clicking "Customize".', 'vw-lawyer-attorney'); ?></p>
				<div class="info-link">
					<a target="_blank" href="<?php echo esc_url( admin_url('customize.php') ); ?>"><?php esc_html_e('Customizing', 'vw-lawyer-attorney'); ?></a>
				</div>
				<hr>				
				<h4><?php esc_html_e('Having Trouble, Need Support?', 'vw-lawyer-attorney'); ?></h4>
				<p> <?php esc_html_e('Our dedicated team is well prepared to help you out in case of queries and doubts regarding our theme.', 'vw-lawyer-attorney'); ?></p>
				<div class="info-link">
					<a href="<?php echo esc_url( VW_LAWYER_ATTORNEY_SUPPORT ); ?>" target="_blank"><?php esc_html_e('Support Forum', 'vw-lawyer-attorney'); ?></a>
				</div>
				<hr>
				<h4><?php esc_html_e('Reviews & Testimonials', 'vw-lawyer-attorney'); ?></h4>
				<p> <?php esc_html_e('All the features and aspects of this WordPress Theme are phenomenal. I\'d recommend this theme to all.', 'vw-lawyer-attorney'); ?>  </p>
				<div class="info-link">
					<a href="<?php echo esc_url( VW_LAWYER_ATTORNEY_REVIEW ); ?>" target="_blank"><?php esc_html_e('Reviews', 'vw-lawyer-attorney'); ?></a>
				</div>
				<div class="link-customizer">
					<h3><?php esc_html_e( 'Link to customizer', 'vw-lawyer-attorney' ); ?></h3>
					<hr class="h3hr">
					<div class="first-row">
						<div class="row-box">
							<div class="row-box1">
								<span class="dashicons dashicons-format-image"></span><a href="<?php echo esc_url( admin_url('customize.php?autofocus[control]=custom_logo') ); ?>" target="_blank"><?php esc_html_e('Upload your logo','vw-lawyer-attorney'); ?></a>
							</div>
							<div class="row-box2">
								<span class="dashicons dashicons-admin-customizer"></span><a href="<?php echo esc_url( admin_url('customize.php?autofocus[section]=vw_lawyer_attorney_typography') ); ?>" target="_blank"><?php esc_html_e('Typography','vw-lawyer-attorney'); ?></a>
							</div>
						</div>
						<div class="row-box">
							<div class="row-box1">
								<span class="dashicons dashicons-images-alt"></span><a href="<?php echo esc_url( admin_url('customize.php?autofocus[section]=vw_lawyer_attorney_slidersettings') ); ?>" target="_blank"><?php esc_html_e('Slider Settings','vw-lawyer-attorney'); ?></a>
							</div>
							<div class="row-box2">
								<span class="dashicons dashicons-phone"></span><a href="<?php echo esc_url( admin_url('customize.php?autofocus[section]=vw_lawyer_attorney_contact') ); ?>" target="_blank"><?php esc_html_e('Contact Section','vw-lawyer-attorney'); ?></a>
							</div>
						</div>
						<div class="row-box">
							<div class="row-box1">
								<span class="dashicons dashicons-editor-table"></span><a href="<?php echo esc_url( admin_url('customize.php?autofocus[section]=vw_lawyer_attorney_about1') ); ?>" target="_blank"><?php esc_html_e('About Section','vw-lawyer-attorney'); ?></a>
							</div>
							<div class="row-box2">
								<span class="dashicons dashicons-editor-aligncenter"></span><a href="<?php echo esc_url( admin_url('customize.php?autofocus[section]=vw_lawyer_attorney_amenities_section') ); ?>" target="_blank"><?php esc_html_e('Why Choose us Section','vw-lawyer-attorney'); ?></a>
							</div>
						</div>
						<div class="row-box">
							<div class="row-box1">
								<span class="dashicons dashicons-welcome-write-blog"></span><a href="<?php echo esc_url( admin_url('customize.php?autofocus[section]=vw_lawyer_attorney_left_right') ); ?>" target="_blank"><?php esc_html_e('Blog Layout','vw-lawyer-attorney'); ?></a>
							</div>
							<div class="row-box2">
								<span class="dashicons dashicons-align-center"></span><a href="<?php echo esc_url( admin_url('customize.php?autofocus[section]=vw_lawyer_attorney_footer_section') ); ?>" target="_blank"><?php esc_html_e('Footer Text','vw-lawyer-attorney'); ?></a>
							</div>
						</div>
					</div>
				</div>
		  	</div>
			<div class="col-right-inner">
				<h3 class="page-template"><?php esc_html_e('How to set up Home Page Template','vw-lawyer-attorney'); ?></h3>
			  	<hr class="h3hr">
				<p><?php esc_html_e('Follow these instructions to setup Home page.','vw-lawyer-attorney'); ?></p>
                <ul>
                	<li><?php esc_html_e('1. Create a Page to set template:  Go to ','vw-lawyer-attorney'); ?>
                  	<b><?php esc_html_e('Dashboard &gt;&gt; Pages &gt;&gt; Add New Page','vw-lawyer-attorney'); ?></b>.
                  	<p><?php esc_html_e('Label it "home" or anything as you wish. Then select template "home-page" from template dropdown.','vw-lawyer-attorney'); ?></p></li>
                  	<img src="<?php echo esc_url(get_template_directory_uri()); ?>/inc/getstart/images/home-page-template.png" alt="" />
                  	<p></p><span class="strong"><?php esc_html_e('2. Set the front page:','vw-lawyer-attorney'); ?></span><?php esc_html_e(' Go to ','vw-lawyer-attorney'); ?>
				  	<b><?php esc_html_e(' Settings -&gt; Reading --&gt; Set the front page display static page to home page ','vw-lawyer-attorney'); ?></b></p>
                  	<img src="<?php echo esc_url(get_template_directory_uri()); ?>/inc/getstart/images/set-front-page.png" alt="" />
                  	<p><?php esc_html_e(' Once you are done with this, you can see all the demo content on front page. ','vw-lawyer-attorney'); ?></p>
                </ul>
		  	</div>
		</div>	

		<div id="tour_pro" class="tabcontent">
		  	<h3><?php esc_html_e( 'Premium Theme Information', 'vw-lawyer-attorney' ); ?></h3>
			<hr class="h3hr">
		    <div class="col-left-pro">
		    	<p><?php esc_html_e('This Lawyer WordPress Theme is skillfully built for lawyers, advocates, law agents, legal practitioners, legal consultancies, or any legal websites. This is one of the most finely made themes in the list of VW WordPress Themes that does justice with the kind of results expected from it. Our Lawyer WordPress Theme has a professional and considerate yet an easy-going design to allure the website visitors. It can showcase your services, expertise, professionalism, testimonials, and a lot of other essential information very effectively. A number of hours of effort and hard work have been given by our specialized team to bring out the best theme for you. Get this theme to flourish your business at just a fraction of the amount that it actually costs to establish your website. Earn the trust of millions in your commendable business with this theme now!','vw-lawyer-attorney'); ?></p>
		    	<div class="pro-links">
			    	<a href="<?php echo esc_url( VW_LAWYER_ATTORNEY_LIVE_DEMO ); ?>" target="_blank"><?php esc_html_e('Live Demo', 'vw-lawyer-attorney'); ?></a>
					<a href="<?php echo esc_url( VW_LAWYER_ATTORNEY_BUY_NOW ); ?>"><?php esc_html_e('Buy Pro', 'vw-lawyer-attorney'); ?></a>
					<a href="<?php echo esc_url( VW_LAWYER_ATTORNEY_PRO_DOC ); ?>" target="_blank"><?php esc_html_e('Pro Documentation', 'vw-lawyer-attorney'); ?></a>
				</div>
		    </div>
		    <div class="col-right-pro">
		    	<img src="<?php echo esc_url(get_template_directory_uri()); ?>/inc/getstart/images/Lawyer-Theme.png" alt="" />
		    </div>
		    <div class="featurebox">
			    <h3><?php esc_html_e( 'Theme Features', 'vw-lawyer-attorney' ); ?></h3>
				<hr class="h3hr">
				<div class="table-image">
					<table class="tablebox">
						<thead>
							<tr>
								<th></th>
								<th><?php esc_html_e('Free Themes', 'vw-lawyer-attorney'); ?></th>
								<th><?php esc_html_e('Premium Themes', 'vw-lawyer-attorney'); ?></th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td><?php esc_html_e('Theme Customization', 'vw-lawyer-attorney'); ?></td>
								<td class="table-img"><img src="<?php echo esc_url(get_template_directory_uri()); ?>/inc/getstart/images/right-arrow.png" alt="" /></td>
								<td class="table-img"><img src="<?php echo esc_url(get_template_directory_uri()); ?>/inc/getstart/images/right-arrow.png" alt="" /></td>
							</tr>
							<tr class="odd">
								<td><?php esc_html_e('Responsive Design', 'vw-lawyer-attorney'); ?></td>
								<td class="table-img"><img src="<?php echo esc_url(get_template_directory_uri()); ?>/inc/getstart/images/right-arrow.png" alt="" /></td>
								<td class="table-img"><img src="<?php echo esc_url(get_template_directory_uri()); ?>/inc/getstart/images/right-arrow.png" alt="" /></td>
							</tr>
							<tr>
								<td><?php esc_html_e('Logo Upload', 'vw-lawyer-attorney'); ?></td>
								<td class="table-img"><img src="<?php echo esc_url(get_template_directory_uri()); ?>/inc/getstart/images/right-arrow.png" alt="" /></td>
								<td class="table-img"><img src="<?php echo esc_url(get_template_directory_uri()); ?>/inc/getstart/images/right-arrow.png" alt="" /></td>
							</tr>
							<tr class="odd">
								<td><?php esc_html_e('Social Media Links', 'vw-lawyer-attorney'); ?></td>
								<td class="table-img"><img src="<?php echo esc_url(get_template_directory_uri()); ?>/inc/getstart/images/right-arrow.png" alt="" /></td>
								<td class="table-img"><img src="<?php echo esc_url(get_template_directory_uri()); ?>/inc/getstart/images/right-arrow.png" alt="" /></td>
							</tr>
							<tr>
								<td><?php esc_html_e('Slider Settings', 'vw-lawyer-attorney'); ?></td>
								<td class="table-img"><img src="<?php echo esc_url(get_template_directory_uri()); ?>/inc/getstart/images/right-arrow.png" alt="" /></td>
								<td class="table-img"><img src="<?php echo esc_url(get_template_directory_uri()); ?>/inc/getstart/images/right-arrow.png" alt="" /></td>
							</tr>
							<tr class="odd">
								<td><?php esc_html_e('Number of Slides', 'vw-lawyer-attorney'); ?></td>
								<td class="table-img"><?php esc_html_e('4', 'vw-lawyer-attorney'); ?></td>
								<td class="table-img"><?php esc_html_e('Unlimited', 'vw-lawyer-attorney'); ?></td>
							</tr>
							<tr>
								<td><?php esc_html_e('Template Pages', 'vw-lawyer-attorney'); ?></td>
								<td class="table-img"><?php esc_html_e('3', 'vw-lawyer-attorney'); ?></td>
								<td class="table-img"><?php esc_html_e('6', 'vw-lawyer-attorney'); ?></td>
							</tr>
							<tr class="odd">
								<td><?php esc_html_e('Home Page Template', 'vw-lawyer-attorney'); ?></td>
								<td class="table-img"><?php esc_html_e('1', 'vw-lawyer-attorney'); ?></td>
								<td class="table-img"><?php esc_html_e('1', 'vw-lawyer-attorney'); ?></td>
							</tr>
							<tr>
								<td><?php esc_html_e('Contact us Page Template', 'vw-lawyer-attorney'); ?></td>
								<td class="table-img">0</td>
								<td class="table-img"><?php esc_html_e('1', 'vw-lawyer-attorney'); ?></td>
							</tr>
							<tr class="odd">
								<td><?php esc_html_e('Blog Templates & Layout', 'vw-lawyer-attorney'); ?></td>
								<td class="table-img">0</td>
								<td class="table-img"><?php esc_html_e('3(Full width/Left/Right Sidebar)', 'vw-lawyer-attorney'); ?></td>
							</tr>
							<tr>
								<td><?php esc_html_e('Page Templates & Layout', 'vw-lawyer-attorney'); ?></td>
								<td class="table-img">0</td>
								<td class="table-img"><?php esc_html_e('2(Left/Right Sidebar)', 'vw-lawyer-attorney'); ?></td>
							</tr>
							<tr class="odd">
								<td><?php esc_html_e('Full Documentation', 'vw-lawyer-attorney'); ?></td>
								<td class="table-img"><img src="<?php echo esc_url(get_template_directory_uri()); ?>/inc/getstart/images/right-arrow.png" alt="" /></td>
								<td class="table-img"><img src="<?php echo esc_url(get_template_directory_uri()); ?>/inc/getstart/images/right-arrow.png" alt="" /></td>
							</tr>
							<tr>
								<td><?php esc_html_e('Latest WordPress Compatibility', 'vw-lawyer-attorney'); ?></td>
								<td class="table-img"><img src="<?php echo esc_url(get_template_directory_uri()); ?>/inc/getstart/images/right-arrow.png" alt="" /></td>
								<td class="table-img"><img src="<?php echo esc_url(get_template_directory_uri()); ?>/inc/getstart/images/right-arrow.png" alt="" /></td>
							</tr>
							<tr class="odd">
								<td><?php esc_html_e('Woo-Commerce Compatibility', 'vw-lawyer-attorney'); ?></td>
								<td class="table-img"><img src="<?php echo esc_url(get_template_directory_uri()); ?>/inc/getstart/images/right-arrow.png" alt="" /></td>
								<td class="table-img"><img src="<?php echo esc_url(get_template_directory_uri()); ?>/inc/getstart/images/right-arrow.png" alt="" /></td>
							</tr>
							<tr>
								<td><?php esc_html_e('Support 3rd Party Plugins', 'vw-lawyer-attorney'); ?></td>
								<td class="table-img"><img src="<?php echo esc_url(get_template_directory_uri()); ?>/inc/getstart/images/right-arrow.png" alt="" /></td>
								<td class="table-img"><img src="<?php echo esc_url(get_template_directory_uri()); ?>/inc/getstart/images/right-arrow.png" alt="" /></td>
							</tr>
							<tr class="odd">
								<td><?php esc_html_e('Secure and Optimized Code', 'vw-lawyer-attorney'); ?></td>
								<td class="table-img"><img src="<?php echo esc_url(get_template_directory_uri()); ?>/inc/getstart/images/right-arrow.png" alt="" /></td>
								<td class="table-img"><img src="<?php echo esc_url(get_template_directory_uri()); ?>/inc/getstart/images/right-arrow.png" alt="" /></td>
							</tr>
							<tr>
								<td><?php esc_html_e('Exclusive Functionalities', 'vw-lawyer-attorney'); ?></td>
								<td class="table-img"><img src="<?php echo esc_url(get_template_directory_uri()); ?>/inc/getstart/images/w-arrow.png" alt="" /></td>
								<td class="table-img"><img src="<?php echo esc_url(get_template_directory_uri()); ?>/inc/getstart/images/right-arrow.png" alt="" /></td>
							</tr>
							<tr class="odd">
								<td><?php esc_html_e('Section Enable / Disable', 'vw-lawyer-attorney'); ?></td>
								<td class="table-img"><img src="<?php echo esc_url(get_template_directory_uri()); ?>/inc/getstart/images/w-arrow.png" alt="" /></td>
								<td class="table-img"><img src="<?php echo esc_url(get_template_directory_uri()); ?>/inc/getstart/images/right-arrow.png" alt="" /></td>
							</tr>
							<tr>
								<td><?php esc_html_e('Section Google Font Choices', 'vw-lawyer-attorney'); ?></td>
								<td class="table-img"><img src="<?php echo esc_url(get_template_directory_uri()); ?>/inc/getstart/images/w-arrow.png" alt="" /></td>
								<td class="table-img"><img src="<?php echo esc_url(get_template_directory_uri()); ?>/inc/getstart/images/right-arrow.png" alt="" /></td>
							</tr>
							<tr class="odd">
								<td><?php esc_html_e('Gallery', 'vw-lawyer-attorney'); ?></td>
								<td class="table-img"><img src="<?php echo esc_url(get_template_directory_uri()); ?>/inc/getstart/images/w-arrow.png" alt="" /></td>
								<td class="table-img"><img src="<?php echo esc_url(get_template_directory_uri()); ?>/inc/getstart/images/right-arrow.png" alt="" /></td>
							</tr>
							<tr>
								<td><?php esc_html_e('Simple & Mega Menu Option', 'vw-lawyer-attorney'); ?></td>
								<td class="table-img"><img src="<?php echo esc_url(get_template_directory_uri()); ?>/inc/getstart/images/w-arrow.png" alt="" /></td>
								<td class="table-img"><img src="<?php echo esc_url(get_template_directory_uri()); ?>/inc/getstart/images/right-arrow.png" alt="" /></td>
							</tr>
							<tr class="odd">
								<td><?php esc_html_e('Support to add custom CSS / JS ', 'vw-lawyer-attorney'); ?></td>
								<td class="table-img"><img src="<?php echo esc_url(get_template_directory_uri()); ?>/inc/getstart/images/w-arrow.png" alt="" /></td>
								<td class="table-img"><img src="<?php echo esc_url(get_template_directory_uri()); ?>/inc/getstart/images/right-arrow.png" alt="" /></td>
							</tr>
							<tr>
								<td><?php esc_html_e('Shortcodes', 'vw-lawyer-attorney'); ?></td>
								<td class="table-img"><img src="<?php echo esc_url(get_template_directory_uri()); ?>/inc/getstart/images/w-arrow.png" alt="" /></td>
								<td class="table-img"><img src="<?php echo esc_url(get_template_directory_uri()); ?>/inc/getstart/images/right-arrow.png" alt="" /></td>
							</tr>
							<tr class="odd">
								<td><?php esc_html_e('Custom Background, Colors, Header, Logo & Menu', 'vw-lawyer-attorney'); ?></td>
								<td class="table-img"><img src="<?php echo esc_url(get_template_directory_uri()); ?>/inc/getstart/images/w-arrow.png" alt="" /></td>
								<td class="table-img"><img src="<?php echo esc_url(get_template_directory_uri()); ?>/inc/getstart/images/right-arrow.png" alt="" /></td>
							</tr>
							<tr>
								<td><?php esc_html_e('Premium Membership', 'vw-lawyer-attorney'); ?></td>
								<td class="table-img"><img src="<?php echo esc_url(get_template_directory_uri()); ?>/inc/getstart/images/w-arrow.png" alt="" /></td>
								<td class="table-img"><img src="<?php echo esc_url(get_template_directory_uri()); ?>/inc/getstart/images/right-arrow.png" alt="" /></td>
							</tr>
							<tr class="odd">
								<td><?php esc_html_e('Budget Friendly Value', 'vw-lawyer-attorney'); ?></td>
								<td class="table-img"><img src="<?php echo esc_url(get_template_directory_uri()); ?>/inc/getstart/images/w-arrow.png" alt="" /></td>
								<td class="table-img"><img src="<?php echo esc_url(get_template_directory_uri()); ?>/inc/getstart/images/right-arrow.png" alt="" /></td>
							</tr>
							<tr>
								<td><?php esc_html_e('Priority Error Fixing', 'vw-lawyer-attorney'); ?></td>
								<td class="table-img"><img src="<?php echo esc_url(get_template_directory_uri()); ?>/inc/getstart/images/w-arrow.png" alt="" /></td>
								<td class="table-img"><img src="<?php echo esc_url(get_template_directory_uri()); ?>/inc/getstart/images/right-arrow.png" alt="" /></td>
							</tr>
							<tr class="odd">
								<td><?php esc_html_e('Custom Feature Addition', 'vw-lawyer-attorney'); ?></td>
								<td class="table-img"><img src="<?php echo esc_url(get_template_directory_uri()); ?>/inc/getstart/images/w-arrow.png" alt="" /></td>
								<td class="table-img"><img src="<?php echo esc_url(get_template_directory_uri()); ?>/inc/getstart/images/right-arrow.png" alt="" /></td>
							</tr>
							<tr>
								<td><?php esc_html_e('All Access Theme Pass', 'vw-lawyer-attorney'); ?></td>
								<td class="table-img"><img src="<?php echo esc_url(get_template_directory_uri()); ?>/inc/getstart/images/w-arrow.png" alt="" /></td>
								<td class="table-img"><img src="<?php echo esc_url(get_template_directory_uri()); ?>/inc/getstart/images/right-arrow.png" alt="" /></td>
							</tr>
							<tr class="odd">
								<td><?php esc_html_e('Seamless Customer Support', 'vw-lawyer-attorney'); ?></td>
								<td class="table-img"><img src="<?php echo esc_url(get_template_directory_uri()); ?>/inc/getstart/images/w-arrow.png" alt="" /></td>
								<td class="table-img"><img src="<?php echo esc_url(get_template_directory_uri()); ?>/inc/getstart/images/right-arrow.png" alt="" /></td>
							</tr>
							<tr>
								<td></td>
								<td class="table-img"></td>
								<td class="update-link"><a href="<?php echo esc_url( VW_LAWYER_ATTORNEY_BUY_NOW ); ?>" target="_blank"><?php esc_html_e('Upgrade to Pro', 'vw-lawyer-attorney'); ?></a></td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>

		<div id="free_pro" class="tabcontent">
		  	<div class="col-3">
		  		<h4><span class="dashicons dashicons-star-filled"></span><?php esc_html_e('Pro Version', 'vw-lawyer-attorney'); ?></h4>
				<p> <?php esc_html_e('To gain access to extra theme options and more interesting features, upgrade to pro version.', 'vw-lawyer-attorney'); ?></p>
				<div class="info-link">
					<a href="<?php echo esc_url( VW_LAWYER_ATTORNEY_BUY_NOW ); ?>" target="_blank"><?php esc_html_e('Get Pro', 'vw-lawyer-attorney'); ?></a>
				</div>
		  	</div>
		  	<div class="col-3">
		  		<h4><span class="dashicons dashicons-cart"></span><?php esc_html_e('Pre-purchase Queries', 'vw-lawyer-attorney'); ?></h4>
				<p> <?php esc_html_e('If you have any pre-sale query, we are prepared to resolve it.', 'vw-lawyer-attorney'); ?></p>
				<div class="info-link">
					<a href="<?php echo esc_url( VW_LAWYER_ATTORNEY_CONTACT ); ?>" target="_blank"><?php esc_html_e('Question', 'vw-lawyer-attorney'); ?></a>
				</div>
		  	</div>
		  	<div class="col-3">
		  		<h4><span class="dashicons dashicons-admin-customizer"></span><?php esc_html_e('Child Theme', 'vw-lawyer-attorney'); ?></h4>
				<p> <?php esc_html_e('For theme file customizations, make modifications in the child theme and not in the main theme file.', 'vw-lawyer-attorney'); ?></p>
				<div class="info-link">
					<a href="<?php echo esc_url( VW_LAWYER_ATTORNEY_CHILD_THEME ); ?>" target="_blank"><?php esc_html_e('About Child Theme', 'vw-lawyer-attorney'); ?></a>
				</div>
		  	</div>
		  	<div class="col-3">
		  		<h4><span class="dashicons dashicons-admin-comments"></span><?php esc_html_e('Frequently Asked Questions', 'vw-lawyer-attorney'); ?></h4>
				<p> <?php esc_html_e('We have gathered top most, frequently asked questions and answered them for your easy understanding. We will list down more as we get new challenging queries. Check back often.', 'vw-lawyer-attorney'); ?></p>
				<div class="info-link">
					<a href="<?php echo esc_url( VW_LAWYER_ATTORNEY_FAQ ); ?>" target="_blank"><?php esc_html_e('View FAQ','vw-lawyer-attorney'); ?></a>
				</div>
		  	</div>
		  	<div class="col-3">
		  		<h4><span class="dashicons dashicons-sos"></span><?php esc_html_e('Post-purchase Queries', 'vw-lawyer-attorney'); ?></h4>
				<p> <?php esc_html_e('If you have any queries after purchase, you can contact us. We are eveready to help you out.', 'vw-lawyer-attorney'); ?></p>
				<div class="info-link">
					<a href="<?php echo esc_url( VW_LAWYER_ATTORNEY_SUPPORT ); ?>" target="_blank"><?php esc_html_e('Contact Us', 'vw-lawyer-attorney'); ?></a>
				</div>
		  	</div>
		  	<div class="col-3">
		  		<h4><span class="dashicons dashicons-media-text"></span><?php esc_html_e('Theme Demo Content', 'vw-lawyer-attorney'); ?></h4>
				<p> <?php esc_html_e('We are providing the demo content file within the theme folder.  You will require an importer plugin to import the demo content.', 'vw-lawyer-attorney'); ?></p>
				<div class="info-link">
					<a href="<?php echo esc_url( VW_LAWYER_ATTORNEY_DEMO_DATA ); ?>" target="_blank"><?php esc_html_e('Demo Content', 'vw-lawyer-attorney'); ?></a>
				</div>
		  	</div>
		</div>
	</div>
</div>
<?php } ?>