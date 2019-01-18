<?php
/**
 * Created by PhpStorm.
 * User: quangquyet
 * Date: 18/01/2019
 * Time: 15:52
 */
/*
Plugin Name: Test Widget<br />
Plugin URI: https://thachpham.com<br />
Description: Thực hành tạo widget item.<br />
Author: Thach Pham<br />
Version: 1.0<br />
Author URI: http://google.com<br />
*/
class WC_Widget_Tests extends WC_Widget {

    /**
     * Constructor.
     */
    public function __construct() {
        $this->widget_cssclass    = 'woocommerce widget_Tests';
        $this->widget_description = __( "A list of your store's Tests.", 'woocommerce' );
        $this->widget_id          = 'woocommerce_Tests';
        $this->widget_name        = __( 'tests', 'woocommerce' );
        $this->settings           = array(
            'title'       => array(
                'type'  => 'text',
                'std'   => __( 'Tests', 'woocommerce' ),
                'label' => __( 'Title', 'woocommerce' ),
            ),
            'number'      => array(
                'type'  => 'number',
                'step'  => 1,
                'min'   => 1,
                'max'   => '',
                'std'   => 5,
                'label' => __( 'Number of Tests to show', 'woocommerce' ),
            ),
            'show'        => array(
                'type'    => 'select',
                'std'     => '',
                'label'   => __( 'Show', 'woocommerce' ),
                'options' => array(
                    ''         => __( 'All Tests', 'woocommerce' ),
                    'featured' => __( 'Featured Tests', 'woocommerce' ),
                    'onsale'   => __( 'On-sale Tests', 'woocommerce' ),
                ),
            ),
            'orderby'     => array(
                'type'    => 'select',
                'std'     => 'date',
                'label'   => __( 'Order by', 'woocommerce' ),
                'options' => array(
                    'date'  => __( 'Date', 'woocommerce' ),
                    'price' => __( 'Price', 'woocommerce' ),
                    'rand'  => __( 'Random', 'woocommerce' ),
                    'sales' => __( 'Sales', 'woocommerce' ),
                ),
            ),
            'order'       => array(
                'type'    => 'select',
                'std'     => 'desc',
                'label'   => _x( 'Order', 'Sorting order', 'woocommerce' ),
                'options' => array(
                    'asc'  => __( 'ASC', 'woocommerce' ),
                    'desc' => __( 'DESC', 'woocommerce' ),
                ),
            ),
            'hide_free'   => array(
                'type'  => 'checkbox',
                'std'   => 0,
                'label' => __( 'Hide free Tests', 'woocommerce' ),
            ),
            'show_hidden' => array(
                'type'  => 'checkbox',
                'std'   => 0,
                'label' => __( 'Show hidden Tests', 'woocommerce' ),
            ),
        );

        parent::__construct();
    }

    /**
     * Query the Tests and return them.
     *
     * @param  array $args     Arguments.
     * @param  array $instance Widget instance.
     * @return WP_Query
     */
    public function get_Tests( $args, $instance ) {
        $number                      = ! empty( $instance['number'] ) ? absint( $instance['number'] ) : $this->settings['number']['std'];
        $show                        = ! empty( $instance['show'] ) ? sanitize_title( $instance['show'] ) : $this->settings['show']['std'];
        $orderby                     = ! empty( $instance['orderby'] ) ? sanitize_title( $instance['orderby'] ) : $this->settings['orderby']['std'];
        $order                       = ! empty( $instance['order'] ) ? sanitize_title( $instance['order'] ) : $this->settings['order']['std'];
        $product_visibility_term_ids = wc_get_product_visibility_term_ids();

        $query_args = array(
            'posts_per_page' => $number,
            'post_status'    => 'publish',
            'post_type'      => 'product',
            'no_found_rows'  => 1,
            'order'          => $order,
            'meta_query'     => array(),
            'tax_query'      => array(
                'relation' => 'AND',
            ),
        ); // WPCS: slow query ok.

        if ( empty( $instance['show_hidden'] ) ) {
            $query_args['tax_query'][] = array(
                'taxonomy' => 'product_visibility',
                'field'    => 'term_taxonomy_id',
                'terms'    => is_search() ? $product_visibility_term_ids['exclude-from-search'] : $product_visibility_term_ids['exclude-from-catalog'],
                'operator' => 'NOT IN',
            );
            $query_args['post_parent'] = 0;
        }

        if ( ! empty( $instance['hide_free'] ) ) {
            $query_args['meta_query'][] = array(
                'key'     => '_price',
                'value'   => 0,
                'compare' => '>',
                'type'    => 'DECIMAL',
            );
        }

        if ( 'yes' === get_option( 'woocommerce_hide_out_of_stock_items' ) ) {
            $query_args['tax_query'] = array(
                array(
                    'taxonomy' => 'product_visibility',
                    'field'    => 'term_taxonomy_id',
                    'terms'    => $product_visibility_term_ids['outofstock'],
                    'operator' => 'NOT IN',
                ),
            ); // WPCS: slow query ok.
        }

        switch ( $show ) {
            case 'featured':
                $query_args['tax_query'][] = array(
                    'taxonomy' => 'product_visibility',
                    'field'    => 'term_taxonomy_id',
                    'terms'    => $product_visibility_term_ids['featured'],
                );
                break;
            case 'onsale':
                $product_ids_on_sale    = wc_get_product_ids_on_sale();
                $product_ids_on_sale[]  = 0;
                $query_args['post__in'] = $product_ids_on_sale;
                break;
        }

        switch ( $orderby ) {
            case 'price':
                $query_args['meta_key'] = '_price'; // WPCS: slow query ok.
                $query_args['orderby']  = 'meta_value_num';
                break;
            case 'rand':
                $query_args['orderby'] = 'rand';
                break;
            case 'sales':
                $query_args['meta_key'] = 'total_sales'; // WPCS: slow query ok.
                $query_args['orderby']  = 'meta_value_num';
                break;
            default:
                $query_args['orderby'] = 'date';
        }

        return new WP_Query( apply_filters( 'woocommerce_Tests_widget_query_args', $query_args ) );
    }

    /**
     * Output widget.
     *
     * @see WP_Widget
     *
     * @param array $args     Arguments.
     * @param array $instance Widget instance.
     */
    public function widget( $args, $instance ) {
        if ( $this->get_cached_widget( $args ) ) {
            return;
        }

        ob_start();

        $Tests = $this->get_Tests( $args, $instance );
        if ( $Tests && $Tests->have_posts() ) {
            $this->widget_start( $args, $instance );

            echo wp_kses_post( apply_filters( 'woocommerce_before_widget_product_list', '<ul class="product_test_list_widget">' ) );

            $template_args = array(
                'widget_id'   => $args['widget_id'],
                'show_rating' => true,
            );

            while ( $Tests->have_posts() ) {
                $Tests->the_post();
                wc_get_template( 'content-widget-product.php', $template_args );
            }

            echo wp_kses_post( apply_filters( 'woocommerce_after_widget_product_list', '</ul>' ) );

            $this->widget_end( $args );
        }

        wp_reset_postdata();

        echo $this->cache_widget( $args, ob_get_clean() ); // WPCS: XSS ok.
    }




}