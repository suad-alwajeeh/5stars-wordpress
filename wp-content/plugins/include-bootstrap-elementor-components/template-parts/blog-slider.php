<?php

    $blog_posts_categories     = isset( $settings['blog_posts_categories'] ) ? $settings['blog_posts_categories'] : '';
    $readAllPostsBtn = isset( $settings['blog_post_read_all_button'] ) ? $settings['blog_post_read_all_button'] : esc_html__( 'See All', 'ebc-by-motahar' );
    $post_per_widget = isset( $settings['blog_post_count'] ) ? $settings['blog_post_count'] : '3';
    $post_type = isset( $settings['post_type'] ) ? $settings['post_type'] : 'post';
    $orderby = isset( $settings['orderby'] ) ? $settings['orderby'] : 'date';
    $order = isset( $settings['order'] ) ? $settings['order'] : 'desc';
    $offset = isset( $settings['offset'] ) ? $settings['offset'] : 'desc';
    $exclude = isset( $settings['exclude'] ) ? $settings['exclude'] : '';

    $args = array(
                'cat'               => $blog_posts_categories,
                'post_status'       => 'publish',
                'post_type'         =>  $post_type,
                'posts_per_page'    =>  $post_per_widget,
                'orderby'           =>  $orderby,
                'order'             =>  $order, 
                'offset'            =>  $offset, 
                'post__not_in'      =>  $exclude, 
            );
        
    $the_query =  new \WP_Query($args); ?>
    
    <div class="ebc-slider">
        <div class="ebc-slick-slider">
            <?php if( $the_query->have_posts() ) {
                // Load posts loop.
                while( $the_query->have_posts() ) {
                    $the_query->the_post();
                 ?>
                <div class="ebc-slick-item">
                    <?php the_post_thumbnail(); ?>
                    <div class="ebc-slick-content" style="text-align: <?php echo $settings['content_alingment']; ?>;">
                        <h2 class="ebc-slick-title"><?php the_title(); ?></h2>
                        <p class="ebc-slick-subtitle"><?php ebc_the_excerpt( $settings ); ?></p>
                    </div>
                </div>
            <?php }
            } else {
                // If no content, include the "No posts found" template.
                ?>
                <h3>
                    <?php echo __('No Posts Found!!!', 'ebc-by-motahar') ?>
                </h3>
                <?php
            }
            ?>
        </div>
    </div>