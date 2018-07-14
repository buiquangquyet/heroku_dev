<?php require_once( '../../../../../wp-load.php' );
Header("Content-type: text/css");
 $kaya_options = get_option('kayapati');
// Default Body Image ?>
<?php if($kaya_options['boxed_layout']!='') {  ?>
	body{
	
	}
<?php } ?>
<?php  $Hideboxed_layoutShadow=$kaya_options['Hideboxed_layoutShadow']?$kaya_options['Hideboxed_layoutShadow']:"true";
if($Hideboxed_layoutShadow=="true"){ }else{
?>
#box_layout{
	
}
<?php } ?>

<?php // Portfolio Project Skill Color Settings
$portfolio_skills_odd_bgcolor=$kaya_options['portfolio_skills_odd_bgcolor']?$kaya_options['portfolio_skills_odd_bgcolor']:"";
$portfolio_skills_odd_text_color=$kaya_options['portfolio_skills_odd_text_color']?$kaya_options['portfolio_skills_odd_text_color']:"";
$portfolio_skills_even_bgcolor=$kaya_options['portfolio_skills_even_bgcolor']?$kaya_options['portfolio_skills_even_bgcolor']:"";
$portfolio_skills_even_text_color=$kaya_options['portfolio_skills_even_text_color']?$kaya_options['portfolio_skills_even_text_color']:"";
?>
.project_skills li:nth-child(odd) { 
	background:<?php echo $portfolio_skills_odd_bgcolor; ?>!important;
	color:<?php echo $portfolio_skills_odd_text_color; ?>!important;
}
.project_skills li:nth-child(even) { 
	background:<?php echo $portfolio_skills_even_bgcolor ?>!important;
	color:<?php echo $portfolio_skills_even_text_color; ?>!important; 
}
<?php // Side toggle color settings 
$kaya_sidebar_toggle_bg_color=$kaya_options['kaya_sidebar_toggle_bg_color']?$kaya_options['kaya_sidebar_toggle_bg_color']:"#333";
$kaya_sidebar_toggle_title_color=$kaya_options['kaya_sidebar_toggle_title_color']?$kaya_options['kaya_sidebar_toggle_title_color']:"#fff";
$kaya_sidebar_toggle_text_color=$kaya_options['kaya_sidebar_toggle_text_color']?$kaya_options['kaya_sidebar_toggle_text_color']:"#fff";
$kaya_sidebar_toggle_link_color=$kaya_options['kaya_sidebar_toggle_link_color']?$kaya_options['kaya_sidebar_toggle_link_color']:"#fff";
$kaya_sidebar_toggle_linkhover_color=$kaya_options['kaya_sidebar_toggle_linkhover_color']?$kaya_options['kaya_sidebar_toggle_linkhover_color']:"#fff";
?>
.cbp-spmenu h1, .cbp-spmenu h2, .cbp-spmenu h3,.cbp-spmenu h4, .cbp-spmenu h5, .cbp-spmenu h6 { 
	color:<?php echo $kaya_sidebar_toggle_title_color; ?>!important;
}
.cbp-spmenu p, .cbp-spmenu, ul.slide-panel-list li { 
	color:<?php echo $kaya_sidebar_toggle_text_color; ?>!important; 
}
.cbp-spmenu a { 
	color:<?php echo $kaya_sidebar_toggle_link_color; ?>!important; 
}
.cbp-spmenu a:hover { 
	color:<?php echo $kaya_sidebar_toggle_linkhover_color; ?>!important; 
}
.cbp-spmenu{
	background:<?php echo $kaya_sidebar_toggle_bg_color; ?>!important; 
}