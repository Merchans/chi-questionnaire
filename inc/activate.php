<?php

function chi_activate_plugin()
{

}

/**
 * Load translation
 */

function shitty_views_load_textdomain() {
    load_plugin_textdomain( 'chi-questionnaire', false, PLUGIN_HOME_URI. '/languages/' );
}

if( ! function_exists( 'is_question' ) )
{
    function is_question( $mixed )
    {
        $mixed = ( 'chi_question' == get_post_type( $mixed ) ) ? 1 : 0;
        return $mixed;
    }
}
if( ! function_exists( 'check_post_type' ) ) {
    function check_post_type($id, $type)
    {
        $post_type = get_post_type($id);
        if ($post_type == $type) {
            return 1;
        } else {
            return 0;
        }
    }
}


