<?php
if(!function_exists('kaya_testimonial_register')){
function kaya_testimonial_register() {
	$labels = array(
		'name'				=> __('Testimonial','innova'),
		'singular_name'		=> __('Testimonial','innova'),
		'add_new'			=> __('Add New Testimonial', 'innova'),
		'add_new_item'		=> __('Add New Testimonial','innova'),
		'edit_item'			=> __('Edit Testimonial','innova'),
		'new_item'			=> __('New Testimonial Item','innova'),
		'view_item'			=> __('View Testimonial Item','innova'),
		'search_items'		=> __('Search Testimonial','innova'),
		'not_found'			=> __('Nothing found','innova'),
		'not_found_in_trash'=> __('Nothing found in Trash','innova'),
		'parent_item_colon'	=> ''
	);
 
	$args = array(
		'labels'			=> $labels,
		'public'			=> true,
		'exclude_from_search'=> false,
		'show_ui'			=> true,
		'capability_type'	=> 'post',
		'hierarchical'		=> false,
		'rewrite' => array( 'slug' => 'testimonial', 'with_front' => false ),
		'query_var'			=> false,	
		'menu_icon'			=> get_template_directory_uri() . '/lib/images/kaya_portfolios.png',  		
		'supports'			=> array('title', '', '', 'thumbnail', '', '')
	); 
	register_post_type( 'testimonial' , $args );
	//register_taxonomy_for_object_type('post_tag', 'testimonial');
}
	register_taxonomy("testimonial_category", 'testimonial', array(
	'hierarchical'		=> true,
	'label'				=> 'Testimonial Categories',
	'singular_label'	=> 'Testimonial Categories',
	'show_ui'			=> true,
	'query_var'			=> true,
	'rewrite'			=> false,
	'orderby' => 'name',
	)
);
	
add_action('init', 'kaya_testimonial_register');
/*

function my_taxonomies_testimonial() {
  $labels = array(
    'name'              => __( 'testimonial Categories', 'innova' ),
    'singular_name'     => __( 'testimonial Categories', 'innova' ),
    'search_items'      => __( 'Search testimonial Categories' , 'innova' ),
    'all_items'         => __( 'All testimonial Categories' , 'innova' ),
    'parent_item'       => __( 'Parent testimonial Category' , 'innova' ),
    'parent_item_colon' => __( 'Parent testimonial Category:', 'innova' ),
    'edit_item'         => __( 'Edit testimonial Category', 'innova' ),
    'update_item'       => __( 'Update testimonial Category' , 'innova' ),
    'add_new_item'      => __( 'Add New testimonial Category' , 'innova' ),
    'new_item_name'     => __( 'New testimonial Category' , 'innova' ),
    'menu_name'         => __( 'testimonial Categories' , 'innova' ),
  );
  $args = array(
    'labels' => $labels,
    'hierarchical' => true,
  );
  register_taxonomy( 'testimonial_category', 'testimonial', $args );
}
add_action( 'init', 'my_taxonomies_testimonial', 0 );
*/

function testimonial_columns($columns) {
	$columns['testimonial_category'] = __('Testimonial Category','atp_admin');
    $columns['thumbnail'] =  __('Post Image','atp_admin');

    return $columns;
}

function kaya_manage_testimonial_columns($name) {
    global $post;global $wp_query;
    switch ($name) {
	 case 'testimonial_category':
               $terms = get_the_terms($post->ID, 'testimonial_category');

        //If the terms array contains items... (dupe of core)
        if ( !empty($terms) ) {
            //Loop through terms
            foreach ( $terms as $term ){
                //Add tax name & link to an array
                $post_terms[] = esc_html(sanitize_term_field('name', $term->name, $term->term_id, '', 'edit'));
            }
            //Spit out the array as CSV
            echo implode( ', ', $post_terms );
        } else {
            //Text to show if no terms attached for post & tax
            echo '<em>No terms</em>';
        }
				break;
        case 'thumbnail':
          
				//echo the_post_thumbnail(array(100,100));
				break;
       
    }
}
add_action('manage_posts_custom_column', 'kaya_manage_testimonial_columns', 10, 2);
add_filter('manage_edit-testimonial_columns', 'testimonial_columns');
} ?>