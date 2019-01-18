<?php
if(!function_exists('kaya_tabs')){
	function kaya_tabs() {
	$labels = array(
		'name'				=> __('Tab Items','innova'),
		'singular_name'		=> __('Toggle Tabs','innova'),
		'add_new'			=> __('Add New Tab Post', 'innova'),
		'add_new_item'		=> __('Add New Tabs ','innova'),
		'edit_item'			=> __('Edit Tabs','innova'),
		'new_item'			=> __('New Tabs','innova'),
		'view_item'			=> __('View Tabs Item','innova'),
		'search_items'		=> __('Search Tabs','innova'),
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
		'rewrite' => array( 'slug' => 'tabs', 'with_front' => false ),
		'query_var'			=> false,	
		'menu_icon'			=> get_template_directory_uri() . '/lib/images/kaya_portfolios.png',  		
		'supports'			=> array('title', 'editor', '', '', '', 'page-attributes')
	); 
	register_post_type( 'tabs' , $args );
	//register_taxonomy_for_object_type('post_tag', 'tabs');
}

	register_taxonomy("toggletabs_category", 'tabs', array(
	'hierarchical'		=> true,
	'label'				=> 'Tabs Categories',
	'singular_label'	=> 'Toggle Tabs / Accordion Categories',
	'show_ui'			=> true,
	'query_var'			=> true,
	'rewrite'			=> false,
	'orderby' => 'name',
	)
);
	
add_action('init', 'kaya_tabs');
/*
function my_taxonomies_tabs() {
  $labels = array(
    'name'              => __( 'Tabs Categories', 'innova' ),
    'singular_name'     => __( 'Toggle Tabs / Accordion Categories', 'innova' ),
    'search_items'      => __( 'Search Tabs Categories' , 'innova' ),
    'all_items'         => __( 'All Tabs Categories' , 'innova' ),
    'parent_item'       => __( 'Parent Tabs Category' , 'innova' ),
    'parent_item_colon' => __( 'Parent Tabs Category:', 'innova' ),
    'edit_item'         => __( 'Edit Tabs Category', 'innova' ),
    'update_item'       => __( 'Update Tabs Category' , 'innova' ),
    'add_new_item'      => __( 'Add New Tabs Category' , 'innova' ),
    'new_item_name'     => __( 'New Tabs Category' , 'innova' ),
    'menu_name'         => __( 'Tabs Categories' , 'innova' ),
  );
  $args = array(
    'labels' => $labels,
    'hierarchical' => true,
  );
  register_taxonomy( 'toggletabs_category', 'tabs', $args );
}
add_action( 'init', 'my_taxonomies_tabs', 0 );
*/
function tabs_columns($columns) {
	$columns['toggletabs_category'] = __('Category','atp_admin');
    $columns['thumbnail'] =  __('Post Image','atp_admin');

    return $columns;
}

function kaya_manage_tabs_columns($name) {
    global $post;global $wp_query;
    switch ($name) {
	 case 'toggletabs_category':
               $terms = get_the_terms($post->ID, 'toggletabs_category');

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
        
    }
}
add_action('manage_posts_custom_column', 'kaya_manage_tabs_columns', 10, 2);
add_filter('manage_edit-tabs_columns', 'tabs_columns');
}
?>
