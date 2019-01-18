(function($) {
  "use strict";
  $(function() {

 var group = $('#customize-control-kaya_logo_type input');
    $('#customize-control-upload_logo').css('display','none');
    $('#customize-control-text_logo').css('display','none');
    $('#customize-control-text_logo_font_size').css('display','none');
    $('#customize-control-text_logo_font_color').css('display','none');
   //var group = $('#customize-control-x_stack input');
 var text_logo_type   = $('#customize-control-kaya_logo_type input[value="text_logo"]');
 var img_logo_type   = $('#customize-control-kaya_logo_type input[value="img_logo"]');
      if(text_logo_type.is(":checked")){
            $('#customize-control-text_logo').css('display','block');
            $('#customize-control-text_logo_font_size').css('display','block');
            $('#customize-control-text_logo_font_color').css('display','block');
           //alert('text');
        }
        else if(img_logo_type.is(":checked")){
           $('#customize-control-upload_logo').css('display','block');
            //alert('img');
        } 
        else {
           //$('#customize-control-upload_logo').css('display','none');
       }  
  group.change( function() {
    if ($(this).val() == 'text_logo') {
            $('#customize-control-text_logo').css('display','block');
            $('#customize-control-text_logo_font_size').css('display','block');
            $('#customize-control-text_logo_font_color').css('display','block');
            $('#customize-control-upload_logo').css('display','none');
           //alert('text');
    }else if ($(this).val() == 'img_logo') {
         $('#customize-control-upload_logo').css('display','block');
         $('#customize-control-text_logo').css('display','none');
         $('#customize-control-text_logo_font_size').css('display','none');
         $('#customize-control-text_logo_font_color').css('display','none');
            //alert('img');
          }
  });

  // On change
     $('.kaya-radio-img').click(function() {
    $('.kaya-radio-img-selected').removeClass('kaya-radio-img-selected');
    $(this).addClass('kaya-radio-img-selected').children('input[@type="radio"]').prop('checked', true);
   });
// boxed bg type
function boxed_layout_background_type(){
$('#customize-control-select_boxed_bg_type select').change(function(){
  $('#customize-control-boxed_layout_bg_color').hide().addClass('customize-control-options-remove');
  $('#customize-control-background_image').hide().addClass('customize-control-options-remove');
  $('#customize-control-background_image1').hide().addClass('customize-control-options-remove');
   $('#customize-control-boxed_backgroundbg_repeat').hide().addClass('customize-control-options-remove');
  var body_bg_type = $('#customize-control-select_boxed_bg_type  select option:selected').val();
  switch( body_bg_type ){
    case 'bg_type_color':
       $('#customize-control-boxed_layout_bg_color').show().removeClass('customize-control-options-remove');
      break;
      case 'bg_type_image':
  $('#customize-control-background_image1').show().removeClass('customize-control-options-remove');
   $('#customize-control-boxed_backgroundbg_repeat').show().removeClass('customize-control-options-remove');
      break;
    case 'default':
      break;    
  }
}).change();
}
// category page sidebar
  //on change
  $('#customize-control-pf_page_sidebar input').change(function(){
    $('#customize-control-pf_category_page_sidebar').hide().addClass('customize-control-options-remove');
  var select_val = $('#customize-control-pf_page_sidebar input:checked').val();
  if( select_val == 'two_third' ){
    $('#customize-control-pf_category_page_sidebar').show().removeClass('customize-control-options-remove');
    
      }
  if( select_val == 'two_third_last' ){
    $('#customize-control-pf_category_page_sidebar').show().removeClass('customize-control-options-remove');
    
      }
  }).change();
// Theme layout mode
$('#customize-control-kaya_layout_class select').change(function(){
  $('#customize-control-select_boxed_bg_type').hide().addClass('customize-control-options-remove');
  $('#customize-control-boxed_layout_bg_color').hide().addClass('customize-control-options-remove');
  $('#customize-control-background_image').hide().addClass('customize-control-options-remove');
  $('#customize-control-background_image1').hide().addClass('customize-control-options-remove');
   $('#customize-control-boxed_backgroundbg_repeat').hide().addClass('customize-control-options-remove');
    $('#customize-control-box_layout_margin_top').hide().addClass('customize-control-options-remove');
  var layout_mode = $('#customize-control-kaya_layout_class  select option:selected').val();
  switch( layout_mode ){
    case 'box_layout':
       $('#customize-control-select_boxed_bg_type').show().removeClass('customize-control-options-remove');
        $('#customize-control-boxed_layout_bg_color').show().removeClass('customize-control-options-remove');
  $('#customize-control-background_image').show().removeClass('customize-control-options-remove');
  $('#customize-control-background_image1').show().removeClass('customize-control-options-remove');
   $('#customize-control-boxed_backgroundbg_repeat').show().removeClass('customize-control-options-remove');
    $('#customize-control-box_layout_margin_top').show().removeClass('customize-control-options-remove');
    boxed_layout_background_type();
      break;
    case 'default':
      break;    
  }
}).change();
//footer bg type
//page title bar
$('#customize-control-select_Header_bg_type select').change(function(){
  $('#customize-control-bg_image').hide().addClass('customize-control-options-remove');
  $('#customize-control-backgroundbg_repeat').hide().addClass('customize-control-options-remove');
  $('#customize-control-header_bg_color').hide().addClass('customize-control-options-remove');
  var header_bg_type = $('#customize-control-select_Header_bg_type  select option:selected').val();
  switch( header_bg_type ){
    case 'bg_type_color':
       $('#customize-control-header_bg_color').show().removeClass('customize-control-options-remove');
      break;
      case 'bg_type_image':
      $('#customize-control-bg_image').show().removeClass('customize-control-options-remove');
  $('#customize-control-backgroundbg_repeat').show().removeClass('customize-control-options-remove');
      break;
    case 'default':
      break;    
  }
}).change();
//page title bar
$('#customize-control-select_pagetitle_bar_bg_type select').change(function(){
  $('#customize-control-page_title_bar').hide().addClass('customize-control-options-remove');
  $('#customize-control-page_title_bar_bg_repeat').hide().addClass('customize-control-options-remove');
  $('#customize-control-page_title_bg_color').hide().addClass('customize-control-options-remove');
  var page_tilte_bg_type = $('#customize-control-select_pagetitle_bar_bg_type  select option:selected').val();
  switch( page_tilte_bg_type ){
    case 'bg_type_color':
       $('#customize-control-page_title_bg_color').show().removeClass('customize-control-options-remove');
      break;
      case 'bg_type_image':
      $('#customize-control-page_title_bar').show().removeClass('customize-control-options-remove');
  $('#customize-control-page_title_bar_bg_repeat').show().removeClass('customize-control-options-remove');
      break;
    case 'default':
      break;    
  }
}).change();
//page middle content
$('#customize-control-select_middle_content_bg_type select').change(function(){
  $('#customize-control-page_content_bg').hide().addClass('customize-control-options-remove');
  $('#customize-control-page_content_bg_repeat').hide().addClass('customize-control-options-remove');
  $('#customize-control-page_bg_color').hide().addClass('customize-control-options-remove');
  var page_middle_content_bg_type = $('#customize-control-select_middle_content_bg_type  select option:selected').val();
  switch( page_middle_content_bg_type ){
    case 'bg_type_color':
       $('#customize-control-page_bg_color').show().removeClass('customize-control-options-remove');
      break;
      case 'bg_type_image':
      $('#customize-control-page_content_bg').show().removeClass('customize-control-options-remove');
  $('#customize-control-page_content_bg_repeat').show().removeClass('customize-control-options-remove');
      break;
    case 'default':
      break;    
  }
}).change();
//main footer
function footer_bg_type(){
$('#customize-control-select_footer_bg_type select').change(function(){
  $('#customize-control-footer').hide().addClass('customize-control-options-remove');
  $('#customize-control-footerbg_repeat').hide().addClass('customize-control-options-remove');
  $('#customize-control-footer_bg_color').hide().addClass('customize-control-options-remove');
  var middlecontent_bg_type = $('#customize-control-select_footer_bg_type  select option:selected').val();
  switch( middlecontent_bg_type ){
    case 'bg_type_color':
       $('#customize-control-footer_bg_color').show().removeClass('customize-control-options-remove');
      break;
      case 'bg_type_image':
      $('#customize-control-footer').show().removeClass('customize-control-options-remove');
  $('#customize-control-footerbg_repeat').show().removeClass('customize-control-options-remove');
      break;
    case 'default':
      break;    
  }
}).change();
}
/*most footer*/
$('#customize-control-main_footer_disable').change(function(){
   $('#customize-control-select_footer_type').show().removeClass('customize-control-options-remove');
  $('#customize-control-footer_page_id').show().removeClass('customize-control-options-remove');
  $('#customize-control-page_based_footer_video').show().removeClass('customize-control-options-remove');
  $('#customize-control-main_footer_columns').show().removeClass('customize-control-options-remove');
  $('#customize-control-widget_based_footer_video').show().removeClass('customize-control-options-remove');
  $('#customize-control-select_footer_bg_type').show().removeClass('customize-control-options-remove');
  $('#customize-control-footer').show().removeClass('customize-control-options-remove');
  $('#customize-control-footerbg_repeat').show().removeClass('customize-control-options-remove');
  $('#customize-control-footer_bg_color').show().removeClass('customize-control-options-remove');
  $('#customize-control-footer_title_color').show().removeClass('customize-control-options-remove');
  $('#customize-control-footer_text_color').show().removeClass('customize-control-options-remove');
  $('#customize-control-footer_link_color').show().removeClass('customize-control-options-remove');
   $('#customize-control-footer_link_hover_color').show().removeClass('customize-control-options-remove');
   footer_bg_type();
   select_main_footer_type();
  var select_footer_val = $('#customize-control-main_footer_disable input').is(':checked');
  if( select_footer_val ){
    $('#customize-control-select_footer_type').hide().addClass('customize-control-options-remove');
 $('#customize-control-footer_page_id').hide().addClass('customize-control-options-remove');
 $('#customize-control-widget_based_footer_video').hide().addClass('customize-control-options-remove');
 $('#customize-control-page_based_footer_video').hide().addClass('customize-control-options-remove');
  $('#customize-control-main_footer_columns').hide().addClass('customize-control-options-remove');
  $('#customize-control-select_footer_bg_type').hide().addClass('customize-control-options-remove');
  $('#customize-control-footer').hide().addClass('customize-control-options-remove');
  $('#customize-control-footerbg_repeat').hide().addClass('customize-control-options-remove');
  $('#customize-control-footer_bg_color').hide().addClass('customize-control-options-remove');
  $('#customize-control-footer_title_color').hide().addClass('customize-control-options-remove');
  $('#customize-control-footer_text_color').hide().addClass('customize-control-options-remove');
  $('#customize-control-footer_link_color').hide().addClass('customize-control-options-remove');
   $('#customize-control-footer_link_hover_color').hide().addClass('customize-control-options-remove');
      }
  else{

  }
  }).change();
// select footer
function select_main_footer_type(){
$('#customize-control-select_footer_type select').change(function(){
 $('#customize-control-footer_page_id').hide().addClass('customize-control-options-remove');
 $('#customize-control-widget_based_footer_video').hide().addClass('customize-control-options-remove');
 $('#customize-control-page_based_footer_video').hide().addClass('customize-control-options-remove');
  $('#customize-control-main_footer_columns').hide().addClass('customize-control-options-remove');
  $('#customize-control-select_footer_bg_type').hide().addClass('customize-control-options-remove');
  $('#customize-control-footer').hide().addClass('customize-control-options-remove');
  $('#customize-control-footerbg_repeat').hide().addClass('customize-control-options-remove');
  $('#customize-control-footer_bg_color').hide().addClass('customize-control-options-remove');
  $('#customize-control-footer_title_color').hide().addClass('customize-control-options-remove');
  $('#customize-control-footer_text_color').hide().addClass('customize-control-options-remove');
  $('#customize-control-footer_link_color').hide().addClass('customize-control-options-remove');
   $('#customize-control-footer_link_hover_color').hide().addClass('customize-control-options-remove');
  var main_footer_type = $('#customize-control-select_footer_type  select option:selected').val();
  switch( main_footer_type ){
    case 'page_based_footer':
     $('#customize-control-footer_page_id').show().removeClass('customize-control-options-remove');
      $('#customize-control-page_based_footer_video').show().removeClass('customize-control-options-remove');
      break;
      case 'widget_based_footer':
  $('#customize-control-main_footer_columns').show().removeClass('customize-control-options-remove');
  $('#customize-control-widget_based_footer_video').show().removeClass('customize-control-options-remove');
  $('#customize-control-select_footer_bg_type').show().removeClass('customize-control-options-remove');
  $('#customize-control-footer').show().removeClass('customize-control-options-remove');
  $('#customize-control-footerbg_repeat').show().removeClass('customize-control-options-remove');
  $('#customize-control-footer_bg_color').show().removeClass('customize-control-options-remove');
  $('#customize-control-footer_title_color').show().removeClass('customize-control-options-remove');
  $('#customize-control-footer_text_color').show().removeClass('customize-control-options-remove');
  $('#customize-control-footer_link_color').show().removeClass('customize-control-options-remove');
   $('#customize-control-footer_link_hover_color').show().removeClass('customize-control-options-remove');
   footer_bg_type();
      break;
    case 'default':
      break;    
  }
}).change();
}
//end 
/*Header top bar section*/
$('#customize-control-enable_top_header input').change(function(){
  $('#customize-control-select_top_header_background_type').hide().addClass('customize-control-options-remove');
  $('#customize-control-header_top_left_section').hide().addClass('customize-control-options-remove');
  $('#customize-control-top_bar_left_content_info').hide().addClass('customize-control-options-remove');
  $('#customize-control-top_bar_right_content').hide().addClass('customize-control-options-remove');
  $('#customize-control-disable_user_information').hide().addClass('customize-control-options-remove');
   $('#customize-control-top_bg_image').hide().addClass('customize-control-options-remove');
    $('#customize-control-top_bar_bg_repeat').hide().addClass('customize-control-options-remove');
    $('#customize-control-top_bar_bg_color').hide().addClass('customize-control-options-remove');
  var select_val = $('#customize-control-enable_top_header input').is(':checked');
  if( select_val ){
    $('#customize-control-select_top_header_background_type').show().removeClass('customize-control-options-remove');
    $('#customize-control-header_top_left_section').show().removeClass('customize-control-options-remove');
    $('#customize-control-top_bar_left_content_info').show().removeClass('customize-control-options-remove');
    $('#customize-control-top_bar_right_content').show().removeClass('customize-control-options-remove');
    $('#customize-control-disable_user_information').show().removeClass('customize-control-options-remove');
     $('#customize-control-top_bar_bg_color').show().removeClass('customize-control-options-remove');
      $('#customize-control-top_bg_image').show().removeClass('customize-control-options-remove');
        $('#customize-control-top_bar_bg_repeat').show().removeClass('customize-control-options-remove');
        top_header_bg_type();
      }
 
  }).change();
// Top Header
function top_header_bg_type(){
  $('#customize-control-select_top_header_background_type select').change(function(){
    $('#customize-control-top_bg_image').hide().addClass('customize-control-options-remove');
    $('#customize-control-top_bar_bg_repeat').hide().addClass('customize-control-options-remove');
    $('#customize-control-top_bar_bg_color').hide().addClass('customize-control-options-remove');
    var footer_bg_type = $('#customize-control-select_top_header_background_type select option:selected').val();
    switch( footer_bg_type ){
      case 'bg_type_color':
        $('#customize-control-top_bar_bg_color').show().removeClass('customize-control-options-remove');
        break;
      case 'bg_type_image':
        $('#customize-control-top_bg_image').show().removeClass('customize-control-options-remove');
        $('#customize-control-top_bar_bg_repeat').show().removeClass('customize-control-options-remove');
        break;
      case 'default':
        break;    
    }
  }).change();
}
/*disable bottom footer*/
$('#customize-control-most_footer_disable').change(function(){
  $('#customize-control-footer_col2_section').show().removeClass('customize-control-options-remove');
  $('#customize-control-footer_col3_section').show().removeClass('customize-control-options-remove');
  $('#customize-control-footer_bottom_text_color').show().removeClass('customize-control-options-remove');
  $('#customize-control-footer_bottom_link_color').show().removeClass('customize-control-options-remove');
  $('#customize-control-footer_bottom_link_hover_color').show().removeClass('customize-control-options-remove');
  var select_footer_val = $('#customize-control-most_footer_disable input').is(':checked');
  if( select_footer_val ){
   $('#customize-control-footer_col2_section').hide().addClass('customize-control-options-remove');
  $('#customize-control-footer_col3_section').hide().addClass('customize-control-options-remove');
  $('#customize-control-footer_bottom_text_color').hide().addClass('customize-control-options-remove');
  $('#customize-control-footer_bottom_link_color').hide().addClass('customize-control-options-remove');
  $('#customize-control-footer_bottom_link_hover_color').hide().addClass('customize-control-options-remove');
      }
  else{

  }
  }).change();
});
})(jQuery);
//end