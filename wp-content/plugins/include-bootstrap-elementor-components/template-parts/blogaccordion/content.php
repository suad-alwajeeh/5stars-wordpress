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
    


    <div class="ebc-blog-head d-flex justify-content-center mb-4">
        <h2 class="ebc-blog-posts-heading"><?php echo $settings['blog_post_heading']; ?> </h2>
    </div>
    <div class="ebc-accordion-wrapper">
        <div class="accordion">
            <ul>
            <?php 
                if( $the_query->have_posts() ) {
                    // Load posts loop.
                    while( $the_query->have_posts() ) {
                        $the_query->the_post();
                        /* grab the url for the full size featured image */
                        $featured_img_url = get_the_post_thumbnail_url(get_the_ID(),'full'); 
                        ?>
                        <li style="background-image: url('<?php echo esc_url($featured_img_url); ?>'); ">
                            <div class="ebc-accordion-content">
                                <div class="ebc-blog-title">
                                    <a href="<?php the_permalink(); ?>" class="sliderLink">
                                        <h2><?php the_title(); ?></h2>
                                    </a>
                                </div>
                                <div class="ebc-post-excerpt">
                                    <?php ebc_the_excerpt( $settings ); ?>
                                </div>
                            </div>
                        </li>
                        <?php
                    }

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
    
    <?php if( 'yes' == $settings['see_all_post_btn'] ) { 
        $seeAllTarget = $settings['blog_post_read_all_button_url']['is_external'] ? ' target="_blank"' : '';
		$seeAllNofollow = $settings['blog_post_read_all_button_url']['nofollow'] ? ' rel="nofollow"' : '';
    ?>
        <div class="ebc-blog-foot d-flex justify-content-center my-4">
            <button class="btn btn-primary">
                <a href="<?php echo $settings['blog_post_read_all_button_url']['url'] ?>" <?php echo $seeAllTarget; echo $seeAllNofollow; ?>><?php echo $readAllPostsBtn; ?></a>
            </button>
        </div>
    <?php } ?>
