<?php
/*
Plugin Name: Random_post
Plugin URI: http://thachpham.com
Description: Thực hành tạo widget item.
Author: Quyetbq
Version: 1.1
Author URI: http://google.com
*/

class Random_Post extends WP_Widget{


    /**
     * Random_Post constructor.
     */
    function __construct(){
        parent::__construct(
            'random_post',
            'Bài ngẫu nhiên',
            array( 'description'=>'Widget hiển thị bài viết ngẫu nhiên')
        );
    }


    /**
     * @param array $instance
     */
    function form($instance ) {

    }


}