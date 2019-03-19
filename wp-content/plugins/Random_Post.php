<?php
/*
Plugin Name: Random_post
Plugin URI: http://thachpham.com
Description: Thực hành tạo widget item.
Author: Quyetbq
Version: 1.0
Author URI: http://google.com
*/

class Random_Post extends WP_Widget
{


//    /**
//     * Random_Post constructor.
//     */
//    function __construct(){
//        parent::__construct(
//            'random_post',
//            'Bài ngẫu nhiên',
//            array( 'description'=>'Widget hiển thị bài viết ngẫu nhiên')
//        );
//    }

    /**
     * Translation labels.
     *
     * @since 4.8.0
     * @var array
     */
    public $l10n = array(
        'add_to_widget' => '',
        'replace_media' => '',
        'edit_media' => '',
        'media_library_state_multi' => '',
        'media_library_state_single' => '',
        'missing_attachment' => '',
        'no_media_selected' => '',
        'add_media' => '',
    );
    protected $registered = false;

    function Random_Post()
    {
        $tpwidget_options = array(
            'classname' => 'Random_Post_widget_class', //ID của widget
            'description' => 'Mô tả của widget random'
        );
        $this->WP_Widget('Random_Post_widget_class', 'Random Post', $tpwidget_options);
    }


    /**
     * @param array $instance
     */
    function form($instance)
    {
        $default = array(
            'title' => 'Tiêu đề Widget',
            'post_number' => 10,
            'image'=>''
        );
//        $instance = wp_parse_args((array)$instance, $default);

        $instance_schema = $this->get_instance_schema();
        $instance = wp_array_slice_assoc(
            wp_parse_args( (array) $instance, wp_list_pluck( $instance_schema, 'default' ) ),
            array_keys( $instance_schema )
        );
        
        $title = esc_attr($instance['title']);
        $post_number = esc_attr($instance['post_number']);
        echo '<p>Nhập tiêu đề <input type="text" class="widefat" name="' . $this->get_field_name('title') . '" value="' . $title . '"> </p>';
        echo '<p>Số lượng bài viết ngẫu nhiên <input type="number" class="widefat" name="' . $this->get_field_name('post_number') . '" max="30" value="' . $post_number . '"> </p>';



        foreach ( $instance as $name => $value ) {
            echo "<input
                    type=\"hidden\"
                    data-property=\"<?php echo esc_attr( $name ); ?>\"
                    class=\"media-widget-instance-property\"
                    name=\"<?php echo esc_attr( $this->get_field_name( $name ) ); ?>\"
                    id=\"<?php echo esc_attr( $this->get_field_id( $name ) ); // Needed specifically by wpWidgets.appendTitle(). ?>\"
                    value=\"<?php echo esc_attr( is_array( $value ) ? join( ',', $value ) : strval( $value ) ); ?>\"
            />";
        }



    }

    function update($new_instance, $old_instance)
    {
        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['post_number'] = strip_tags($new_instance['post_number']);
        return $instance;
    }

//    function widget( $args, $instance ) {
//        extract($args);
//
//    }

    function widget($args, $instance)
    {
        extract($args);
        $title = apply_filters('widget_title', $instance['title']);
        $post_number = $instance['post_number'];

        echo $before_widget;
        echo $before_title . $title . $after_title;
        //$random_query = new WP_Query('posts_per_page=' . $post_number . '&orderby=rand');

        $args = array(
            'posts_per_page' => $post_number,
            'tax_query' => array(
                'relation' => 'AND',
                array(
                    'post_status'    => 'publish',
                    'post_type'      => 'product',



                ),
//                array(
//                    'taxonomy' => 'product_cat',
//                    'field' => 'slug',
//                    'terms' => 'category-slug2'
//                )
            ),
            'post_type' => 'product',
            'orderby' => 'title',
        );
        $random_query = new WP_Query( $args );


        if($random_query->have_posts()):
            echo "<ol>";
            while ($random_query->have_posts()) :
                $random_query->the_post(); ?>

                <li><?php the_id(); ?> - <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></li>

            <?php endwhile;
            echo "</ol>";
        endif;
        echo $after_widget;

    }


    /**
     * Render the media on the frontend.
     *
     * @since 4.8.0
     *
     * @param array $instance Widget instance props.
     * @return string
     */
    public function render_media($instance)
    {
        // TODO: Implement render_media() method.
    }

    /**
     * @return array|mixed|void
     */
    public function get_instance_schema() {
        $schema = array(
            'attachment_id' => array(
                'type' => 'integer',
                'default' => 0,
                'minimum' => 0,
                'description' => __( 'Attachment post ID' ),
                'media_prop' => 'id',
            ),
            'url' => array(
                'type' => 'string',
                'default' => '',
                'format' => 'uri',
                'description' => __( 'URL to the media file' ),
            ),
            'title' => array(
                'type' => 'string',
                'default' => '',
                'sanitize_callback' => 'sanitize_text_field',
                'description' => __( 'Title for the widget' ),
                'should_preview_update' => false,
            ),
        );

        /**
         * Filters the media widget instance schema to add additional properties.
         *
         * @since 4.9.0
         *
         * @param array           $schema Instance schema.
         * @param WP_Widget_Media $this   Widget object.
         */
        $schema = apply_filters( "widget_{$this->id_base}_instance_schema", $schema, $this );

        return $schema;
    }
}
add_action( 'widgets_init', 'create_randompost_widget' );
function create_randompost_widget() {
    register_widget('Random_Post');
}