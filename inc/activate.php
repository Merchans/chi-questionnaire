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