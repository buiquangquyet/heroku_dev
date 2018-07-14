(function($) {
  "use strict";
	$(function() {

	$("#video_type").change(function () {
	$("#youtube_video").parent().parent().hide();
	$("#vimeo_video").parent().parent().hide();
	var selectlayout = $("#video_type option:selected").val(); 
	$("#video_embed").parent().parent().hide();
	switch(selectlayout)
	{
		case 'vimeo':
			$("#vimeo_video").parent().parent().show();
		break;
		case 'youtube':
			$("#youtube_video").parent().parent().show();
		break;
		case 'videoembed':
			$("#video_embed").parent().parent().show();
		break;
		
	}
}).change();
$('.rwmb-select').each(function(){
		 $(this).find('option:empty').remove();
	});
//Meta Page Optons
$("#select_page_options").change(function() {
	var select_options = $("#select_page_options option:selected").val(); 
	$('#slider').parent().parent().hide();
	$('.kaya_custom_title').hide();
	$('.kaya_custom_title_description').hide();
	$('.kaya_title_color').parent().parent().hide();
	$("#transitionStyle").parent().parent().hide();
	$("#Kaya_Sliders").parent().parent().hide();
	$("#slider_height").parent().parent().hide();
	$(".rtl_right").hide();
	$(".enable_slider_screen_height").hide();
	$("#bx_slider_width").parent().parent().hide();
	$("#Kaya_slider_autoplay").parent().parent().hide();
	$("#sudo_slider_type").parent().parent().hide();
	$("#Kaya_slider_height").parent().parent().hide();
	$("#Kaya_slider_transitions_speed").parent().parent().hide();
	$("#Kaya_slider_transitions").parent().parent().hide();
	$("#kaya_slidelink").parent().parent().hide();
	$("#kaya_slidecaption").parent().parent().hide();
	$("#page_video").parent().parent().hide();
	$("#Kaya_slider_top").parent().parent().hide();
	$("#bx_transitions").parent().parent().hide();
	$("#customslider_type").parent().parent().hide();
	$("#Single_Image_height").parent().parent().hide();
	$(".Single_Image_Upload").hide();
	$("#Single_Image_content").parent().parent().hide();
	$(".single_img_attachment").hide();
	$("#kaya_slide_caption").parent().parent().hide();
	$("#auto_play").parent().parent().hide();
	$("#page_video_text").parent().parent().hide();
	$("#Kaya_superslide_category").parent().parent().hide();
	$("#owl_slider_height").parent().parent().hide();
	$("#Single_slider_height").parent().parent().hide();
	$("#Single_Image_opacity").parent().parent().hide();
	$('.page_video_mute').parent().parent().hide();
	$('#video_header').parent().parent().hide();
	$(".kaya_portfolio_cat").hide();
	$(".Kaya_Slider_cat").hide();
	$("#Kaya_slider_post_type").parent().parent().hide();
	$("#Kaya_slider_easing").parent().parent().hide();
	$("#Kaya_slider_pause").parent().parent().hide();
	$("#adaptive_height").parent().parent().hide();
	$("#Kaya_slider_mode").parent().parent().hide();
	$("#kaya_slider_order").parent().parent().hide();
	
	$(".Kaya_fluid_portfolio_category").hide();
	$(".Kaya_fluid_slider_category").hide();
	$("#Kaya_fluid_slider_auto_play").parent().parent().hide();
	$("#kaya_fluid_slider_pf_order").parent().parent().hide();
	$("#Kaya_fluid_slider_limit").parent().parent().hide();
	$("#kaya_fluid_slider_post_type").parent().parent().hide();	
	$("#disable_arrow_navigation").parent().parent().hide();
	$("#disable_dots_pagination").parent().parent().hide();
	$("#Kaya_bx_slider_limit").parent().parent().hide();
	$("#disable_bx_slider_arrow_navigation").parent().parent().hide();
  	$("#disable_bx_slider_dots_pagination").parent().parent().hide();

	switch(select_options){
		case 'page_title_setion':
		$('#slider').parent().parent().hide();
			$('.kaya_custom_title').show();
			$('.kaya_custom_title_description').show();
			$('.page_bg_Image_Upload').parent().parent().show();
			$('.kaya_title_color').parent().parent().show();
			$('#video_header').parent().parent().hide();
			//$('#page_title_bg_color').parent().parent().show();
			//page_slider_options();
			break;

		case 'page_slider_setion' :
			$('#slider').parent().parent().show();
			page_slider_options();
			$('#video_header').parent().parent().hide();
			break;
		case 'video':
			$("#page_video").parent().parent().show();
			$("#page_video_text").parent().parent().show();
			$("#Single_slider_height").parent().parent().show();
			$('.page_video_mute').parent().parent().show();
			$('#video_header').parent().parent().hide();
			break;
		case 'singleimage':
			$("#Single_Image_height").parent().parent().show();
			$(".Single_Image_Upload").show();
			$("#Single_Image_content").parent().parent().show();
			$(".single_img_attachment").show();
			$("#Single_Image_opacity").parent().parent().show();
			$('#video_header').parent().parent().hide();
			break;
		case 'video_header':
			$('#video_header').parent().parent().show();		
		
			break;		
	}	

}).change();

// Meta BOxes
function page_slider_options(){

	$("#slider").change(function () {	
	var selectlayout = $("#slider option:selected").val(); 
	$("#transitionStyle").parent().parent().hide();
	$("#Kaya_Sliders").parent().parent().hide();
	$("#slider_height").parent().parent().hide();
	$(".rtl_right").hide();
	$(".enable_slider_screen_height").hide();
	$("#bx_slider_width").parent().parent().hide();
	$("#Kaya_slider_autoplay").parent().parent().hide();
	$("#sudo_slider_type").parent().parent().hide();
	$("#Kaya_slider_transitions_speed").parent().parent().hide();
	$("#Kaya_slider_height").parent().parent().hide();
	$("#Kaya_slider_transitions").parent().parent().hide();
	$("#kaya_slidelink").parent().parent().hide();
	$("#kaya_slidecaption").parent().parent().hide();
	$("#Kaya_slider_top").parent().parent().hide();
	$("#bx_transitions").parent().parent().hide();
	$("#customslider_type").parent().parent().hide();
	$("#kaya_slide_caption").parent().parent().hide();
	$("#auto_play").parent().parent().hide();
	$("#Kaya_superslide_category").parent().parent().hide();
	$("#owl_slider_height").parent().parent().hide();
	$("#Single_slider_height").parent().parent().hide();
	$(".kaya_portfolio_cat").hide();
	$(".Kaya_Slider_cat").hide();
	$("#Kaya_slider_post_type").parent().parent().hide();

	$("#Kaya_slider_easing").parent().parent().hide();
	$("#Kaya_slider_pause").parent().parent().hide();
	$("#adaptive_height").parent().parent().hide();
	$("#Kaya_slider_mode").parent().parent().hide();

	$(".Kaya_fluid_portfolio_category").hide();
	$(".Kaya_fluid_slider_category").hide();
	$("#Kaya_fluid_slider_auto_play").parent().parent().hide();
	$("#kaya_fluid_slider_pf_order").parent().parent().hide();
	$("#Kaya_fluid_slider_limit").parent().parent().hide();
	$("#kaya_fluid_slider_post_type").parent().parent().hide();	
	$("#Kaya_bx_slider_limit").parent().parent().hide();
	$("#disable_arrow_navigation").parent().parent().hide();
	$("#disable_dots_pagination").parent().parent().hide();
	$("#kaya_fluid_slider_post_type").parent().parent().hide();
	$("#kaya_slider_order").parent().parent().hide();
	$("#Kaya_bx_slider_limit").parent().parent().hide();
	$("#disable_bx_slider_arrow_navigation").parent().parent().hide();
	$("#disable_bx_slider_dots_pagination").parent().parent().hide();


	switch(selectlayout)
	{
	case 'fluidslider':
		fluid_slider_posttype();
		$("#Kaya_fluid_slider_auto_play").parent().parent().show();
		$("#kaya_fluid_slider_pf_order").parent().parent().show();
		$("#Kaya_fluid_slider_limit").parent().parent().show();
		$("#kaya_fluid_slider_post_type").parent().parent().show();
		$("#disable_arrow_navigation").parent().parent().show();
		$("#disable_dots_pagination").parent().parent().show();
		break;
	case 'bxslider':
		$("#Kaya_Sliders").parent().parent().show();
		$("#Kaya_slider_autoplay").parent().parent().show();
		$("#sudo_slider_type").parent().parent().show();
		$("#Kaya_slider_transitions_speed").parent().parent().show();
		$("#Kaya_slider_height").parent().parent().show();
		$(".rtl_right").show();
		$(".enable_slider_screen_height").show();
		$("#Kaya_slider_transitions").parent().parent().show();
		$("#kaya_slidelink").parent().parent().show();
		$("#kaya_slidecaption").parent().parent().show();
		$("#Kaya_slider_top").parent().parent().show();
		$("#Kaya_slider_post_type").parent().parent().show();
		$("#Kaya_slider_easing").parent().parent().show();
		$("#Kaya_slider_pause").parent().parent().show();
		$("#adaptive_height").parent().parent().show();
		$("#Kaya_slider_mode").parent().parent().show();
		$("#kaya_slider_order").parent().parent().show();
		$("#Kaya_bx_slider_limit").parent().parent().show();
		$("#disable_bx_slider_arrow_navigation").parent().parent().show();
		$("#disable_bx_slider_dots_pagination").parent().parent().show();
		page_slider_posttype();
		break;
	case 'customslider':
		$("#customslider_type").parent().parent().show();
		break;			
	
	}
}).change();

}
function fluid_slider_posttype(){
$("#kaya_fluid_slider_post_type").change(function () {	
	var selectlayout = $("#kaya_fluid_slider_post_type option:selected").val(); 
	$(".Kaya_fluid_portfolio_category").hide();
	$(".Kaya_fluid_slider_category").hide();

	switch(selectlayout)
	{
	case 'portfolio_category':
		$(".Kaya_fluid_portfolio_category").show();
		break;
	case 'slider_category':
		$(".Kaya_fluid_slider_category").show();
		break;
				
	
	}
}).change();
}

function page_slider_posttype(){
$("#Kaya_slider_post_type").change(function () {	
	var selectlayout = $("#Kaya_slider_post_type option:selected").val(); 
	$(".kaya_portfolio_cat").hide();
	$(".Kaya_Slider_cat").hide();

	switch(selectlayout)
	{
	case 'portfolio_category':
		$(".kaya_portfolio_cat").show();
		break;
	case 'slider_category':
		$(".Kaya_Slider_cat").show();
		break;
				
	
	}
}).change();
}
//page_slider_options();
    // Display only needed post meta boxes
    var Kaya_post_options = $('#post-formats-select input'),
        kaya_meta_link = $('#kaya_link_format'),
        kaya_pf_link = $('#post-format-link'),
        kaya_meta_gallery = $('#kaya_post_format_gallery'),
        kaya_pf_gallery = $('#post-format-gallery'),
        kaya_meta_video = $('#kaya_post_format_video'),
        kaya_pf_video = $('#post-format-video'),
        kaya_meta_audio = $('#kaya_audio_format'),
        kaya_pf_audio = $('#post-format-audio'),
        kaya_meta_quote = $('#kaya_quote_format_quote'),
        kaya_pf_quote = $('#post-format-quote');

    function kaya_hide_post_formates(){
        kaya_meta_link.css('display', 'none');
        kaya_meta_gallery.css('display', 'none');
        kaya_meta_video.css('display', 'none');
        kaya_meta_audio.css('display', 'none');
        kaya_meta_quote.css('display', 'none');
    }

    kaya_hide_post_formates();

    Kaya_post_options.on('change', function(){
        var that = $(this);
        kaya_hide_post_formates();
        if(that.val() === 'link'){
            kaya_meta_link.css('display', 'block');
        }else if(that.val() === 'gallery'){
            kaya_meta_gallery.css('display', 'block');
        }else if(that.val() === 'video'){
            kaya_meta_video.css('display', 'block');
        }else if(that.val() === 'audio'){
            kaya_meta_audio.css('display', 'block');
        }else if(that.val() === 'quote'){
            kaya_meta_quote.css('display', 'block');
        }
    });

    if(kaya_pf_link.is(':checked')) kaya_meta_link.css('display', 'block');
    if(kaya_pf_gallery.is(':checked')) kaya_meta_gallery.css('display', 'block');
    if(kaya_pf_video.is(':checked')) kaya_meta_video.css('display', 'block');
    if(kaya_pf_audio.is(':checked')) kaya_meta_audio.css('display', 'block');
    if(kaya_pf_quote.is(':checked')) kaya_meta_quote.css('display', 'block');
 // hide Portfolio Post Information
//$('#portfolio_slides').hide();
//$('#portfolio_info').hide();
});
})(jQuery);