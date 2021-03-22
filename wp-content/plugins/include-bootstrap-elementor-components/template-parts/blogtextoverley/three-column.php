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
    <div class="row">
        <?php 
            if( $the_query->have_posts() ) {
                // Load posts loop.
                while( $the_query->have_posts() ) {
                    $the_query->the_post();
                    ?>
                    <div class="col-md-4 col-xs-12 ebc-blog-margin">
                        
                        <!--Overlay effect  modern_hover_10 -->	
                        <figure class="ebc-modern-hover-10">
                            <a id="post-<?php the_ID(); ?>" <?php post_class('modern_hover_image'); ?> href="<?php the_permalink(); ?>">
                                <?php the_post_thumbnail(); ?>
                            </a>
                            <div class="ebc-post-content" style="transition: <?php echo $settings['transtion-time']; ?>s ease; transition-timing-function: <?php echo $settings['transtion-type'];?>; " >
                                <div class="ebc-blog-title">
                                    <a id="post-<?php the_ID(); ?>" <?php post_class(); ?> href="<?php the_permalink(); ?>">
                                        <h1> <?php the_title(); ?></h1>
                                    </a>
                                </div>
                                <div class="ebc-post-excerpt">
                                    <p><?php ebc_the_excerpt( $settings ); ?></p>
                                </div>
                            </div>
                        </figure>
                    </div>
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
