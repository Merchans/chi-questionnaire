<?php


function chi_enqueue_admin()
{

    $version = RM_DEV_MODE ? time() : false;

    //CSS
    wp_register_style( "chi_selectize_css", PLUGIN_HOME. '/css/selectize.bootstrap3.min.css', [], $version);

    wp_enqueue_style( "chi_selectize_css" );

    //JS
    wp_register_script( "chi_selectize_js", PLUGIN_HOME. "/js/selectize.min.js", array('jquery'), $version, true  );
    wp_register_script( "chi_selectize_init", PLUGIN_HOME. "/js/selectize-init.js", array('jquery'), $version, true  );

    wp_enqueue_script( "chi_selectize_js" );
    wp_enqueue_script( "chi_selectize_init" );


}

