<?php


/**
 * Get all types of post.
 * @return array
 */
function ebc_get_all_post_types()
{
    $ebc_post_types = array(
        'post' => 'Post',
        'page' => 'Page',
        'product' => 'Product',

    );

    return $ebc_post_types;

}
/**
 * Get all types of post.
 * @return array
 */
function ebc_get_all_types_post()
{
    $posts = get_posts([
        'post_type' => 'any',
        'post_style' => 'all_types',
        'post_status' => 'publish',
        'posts_per_page' => '-1',
    ]);

    if (!empty($posts)) {
        return wp_list_pluck($posts, 'post_title', 'ID');
    }

    return [];
}


    /**
     * POst Orderby Options
     *
     * @return array
     */
    function ebc_get_post_orderby_options()
    {
        $orderby = array(
            'ID' => 'Post ID',
            'author' => 'Post Author',
            'title' => 'Title',
            'date' => 'Date',
            'modified' => 'Last Modified Date',
            'parent' => 'Parent Id',
            'rand' => 'Random',
            'comment_count' => 'Comment Count',
            'menu_order' => 'Menu Order',
        );

        return $orderby;
    }


/**
 * Retrieve Blog Categories
 *
 * @since 1.0.3
 * @return array
 */
function ebc_get_blog_categories() {
    $categories = get_categories();
    
    foreach( $categories as $category ) {
        $id = esc_attr( $category->term_id );
        $cat[$id] = esc_html( $category->name );
    }
    
    return $cat;
}

/**
 * Custom Excerpt Length
 *
 * @since 1.0.3
 */
function ebc_the_excerpt( $settings) {
    $length = isset( $settings['excerpt_length'] ) ? $settings['excerpt_length'] : '99';
    $readmore = isset( $settings['excerpt_readmore'] ) ? $settings['excerpt_readmore'] : esc_html__( 'Read More', 'ebc-by-motahar' );
    
	$excerpt = get_the_excerpt();
	$length++;

	if ( mb_strlen( $excerpt ) > $length ) {
		$subex = mb_substr( $excerpt, 0, $length - 5 );
		$exwords = explode( ' ', $subex );
		$excut = - ( mb_strlen( $exwords[ count( $exwords ) - 1 ] ) );
		if ( $excut < 0 ) {
			echo mb_substr( $subex, 0, $excut );
		} else {
			echo $subex;
		}

        if( 'yes' == $settings['readmore_link'] ) {
		  echo '<p><a href="'. get_the_permalink() .'" class="ebc-link-readmore">'. $readmore . '</a></p>';
        }
	} else {
		echo $excerpt;
	}
}