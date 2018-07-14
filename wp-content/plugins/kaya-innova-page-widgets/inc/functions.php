<?php
global $innova_plugin_name;
if( !function_exists('kaya_short_content') ){
  function kaya_short_content($limit) {
      $content = explode(' ', get_the_content(), $limit);
      if (count($content)>=$limit) {
      array_pop($content);
      $content = implode(" ",$content).' ';
      } else {
      $content = implode(" ",$content);
      }   
      $content = preg_replace('/\[.+\]/','', $content);
      $content = apply_filters('get_the_content', $content);
      $content = str_replace(']]>', ']]&gt;', $content);
      return $content;
  }
}
if( !function_exists('kaya_explode_data') ){
  function kaya_explode_data($explode_string){
     $explode_string = nl2br($explode_string);
     $explode_string = str_replace('<br />', ",", $explode_string);
     return $explode_string;
  }
} 
if( !function_exists('kaya_widget_admin_color') ){
  function kaya_widget_admin_color(){ ?>
      <style type="text/css">
          .elelments_group {
              background-color: #f6f6f6;
              border: 1px solid #eee;
               margin-bottom: 30px;
              padding: 10px 20px;
          }
          p{
            line-height: 2;
          }
      </style>
  <?php }
  add_action('admin_head','kaya_widget_admin_color');
}
if( !function_exists('kaya_image_resize') ){
    function kaya_image_resize($url, $width, $height=0, $align='') {
      return mr_image_resize($url, $width, $height, true, $align, false);
    }
}
if( !function_exists('gilda_kaya_register_widgets') ){
  function gilda_kaya_register_widgets($widget_name, $widget_path, $class = false){
        global $kaya_register_widgets, $kaya_widgets_class, $innova_plugin_name;
        $kaya_register_widgets[$widget_name] = realpath( $widget_path );
        $widget_class_names = explode('_', str_replace('-', '_', ucfirst($widget_name)));
        $widget_class_names = array_map('ucfirst', $widget_class_names);
        $widget_class_name = implode('_',  $widget_class_names);    
        if ( empty( $class ) ) {
          $class = ucfirst($innova_plugin_name).'_' . str_replace( ' ', '', ucwords( str_replace('-', ' ', $widget_class_name) ) ) . '_Widget';
        }
        $kaya_widgets_class[] = $class;
  }
}
if( !function_exists('gilda_kaya_widgets_initilize') ){
  function gilda_kaya_widgets_initilize(){
        global $kaya_widgets_class;
        foreach ($kaya_widgets_class as $widget_class) {
          register_widget($widget_class);
        }
      }
  add_action('widgets_init', 'gilda_kaya_widgets_initilize');
}
if( !function_exists('gilda_kaya_builder_init') ){
  function gilda_kaya_builder_init( $widgets ) {
        global $kaya_widgets_class;
        foreach ($kaya_widgets_class as $widget_class) {
          $widgets[$widget_class]['groups'] = array( 'gilda_widgets' );
        }        
        return $widgets;
      }
  add_filter( 'siteorigin_panels_widgets', 'gilda_kaya_builder_init');
}
if( !function_exists('gilda_add_row_style_fields') ){
  function gilda_add_row_style_fields($fields) {
    global $innova_plugin_name;
    $fields['parallax'] = array(
      'name'        => __('Background Image Fixed', $innova_plugin_name),
      'type'        => 'checkbox',
      'group'       => 'design',
      'description' => __('If enabled, the background image will have a parallax effect.', 'siteorigin-panels'),
      'priority'    => 8,
    );
    return $fields;
  }
  add_filter( 'siteorigin_panels_row_style_fields', 'gilda_add_row_style_fields' );
}
if( !function_exists('gilda_add_row_style_attributes') ){
  function gilda_add_row_style_attributes( $attributes, $args ) {
      if( !empty( $args['parallax'] ) ) {
          array_push($attributes['class'], 'parallax');
      }
      return $attributes;
  }
  add_filter('siteorigin_panels_row_style_attributes', 'gilda_add_row_style_attributes', 10, 2);
}
if( !function_exists('gilda_add_new_widget_tab') ){
  function gilda_add_new_widget_tab($tabs) {
    global $innova_plugin_name;
      $tabs[] = array(
          'title' => __('Gilda  Widgets', $innova_plugin_name),
          'filter' => array(
           'groups' => array('gilda_widgets')
          )
      );
      return $tabs;
  }
  add_filter('siteorigin_panels_widget_dialog_tabs', 'gilda_add_new_widget_tab', 20);
}
?>