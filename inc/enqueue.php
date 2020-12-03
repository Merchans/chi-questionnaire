<?php


function chi_enqueue_admin()
{

    $version = RM_DEV_MODE ? time() : false;

    //CSS
    wp_register_style( "chi_selectize_css", PLUGIN_HOME. '/css/selectize.bootstrap3.min.css', [], $version);
    wp_register_style( "chi-questionnaire_css", PLUGIN_HOME. '/css/chi-questionnaire.css', [], $version);

    wp_enqueue_style( "chi_selectize_css" );
    wp_enqueue_style( "chi-questionnaire_css" );

    //JS
    wp_register_script( "chi_selectize_js", PLUGIN_HOME. "/js/selectize.min.js", array('jquery'), $version, true  );
    wp_register_script( "chi_selectize_init", PLUGIN_HOME. "/js/selectize-init.js", array('jquery'), $version, true  );

    wp_enqueue_script( "chi_selectize_js" );
    wp_enqueue_script( "chi_selectize_init" );


}

function chi_enqueue_front_end()
{
    $version = RM_DEV_MODE ? time() : false;

    wp_register_style( "chi-questionnaire_front-end_css", PLUGIN_HOME. '/css/chi-questionnaire-front-end.css', [], $version);
    wp_register_style( "chi-acordeon-efect", PLUGIN_HOME. '/css/chi-acordeon-efect', [], $version);

    wp_enqueue_style( "chi-questionnaire_front-end_css" );
    wp_enqueue_style( "chi-acordeon-efect" );

    wp_register_script( "chi-acordeon-efect", PLUGIN_HOME. "/js/chi-acordeon-efect.js", array('jquery', 'jquery-ui-accordion'), $version, true  );

    wp_enqueue_script( "chi-acordeon-efect" );
}