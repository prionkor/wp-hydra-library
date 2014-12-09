<?php

namespace WpHydra;

/**
 * Get page/post id by slug or title
 * @since 0.1
 * @param string $slug page/post slug
 * @param string $post_type post type
 * @return int
 *
 * */
function get_page_id($slug, $post_type = 'page'){
    // use object cache
    $cache_name = 'hydra_get_page_id_'.$slug;

    if ( false === ( $page_id = wp_cache_get( $cache_name )) ) {
        global $wpdb;

        $page_id = $wpdb->get_var("SELECT ID FROM $wpdb->posts
                                                    WHERE ( post_name = '$slug' OR post_title = '$slug' )
                                                    AND post_status = 'publish'
                                                    AND post_type='$post_type'"
        );

        wp_cache_set( $cache_name, $page_id );
    }

    return $page_id;
}

/**
 * Check if the given string is url
 * @since 0.1
 * @param string $url
 * @return bool
 * */
function is_url($url){
    return (!filter_var($url, FILTER_VALIDATE_URL)) ? false : true;
}


