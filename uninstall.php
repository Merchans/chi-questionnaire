<?php

// If uninstall not called from WordPress, then exit.
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
    exit;
}

/**
 * Delete all post and meta data.
 */
function chi_delete_plugin_data(){

    $chi_posts_data = array(
        array(
            'post' => get_posts(
                array(
                    'numberposts' => -1,
                    'post_type' => 'chi_answers',
                    'post_status' => 'any',
                )
            )
        ),
        array(
            'post' => get_posts(
                array(
                    'numberposts' => -1,
                    'post_type' => 'chi_doctors',
                    'post_status' => 'any',
                )
            )
        ),
        array(
            'post' => get_posts(
                array(
                    'numberposts' => -1,
                    'post_type' => 'chi_questions',
                    'post_status' => 'any',
                )
            )
        ),
    );

    /**
     * Delete post.
     */
    foreach ( $chi_posts_data as $post_item ){

        // delete post meta
        foreach ( $post_item['post'] as $post ) {
            delete_post_meta($post->ID, 'myplugin_post_meta');
        }

        foreach ( $post_item['post'] as $post ) {
            wp_delete_post( $post->ID, true );
        }
    }

}

chi_delete_plugin_data();