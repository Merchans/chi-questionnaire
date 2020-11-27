<?php
/*
Plugin Name: CHI Questionnaire
Plugin URI: https://kongres-online.cz/
Description: A brief description of the Plugin.
Version: 0.1
Author: Richard Markovič
Domain> chi_questionnaire
*/

if	( ! defined('ABSPATH') ) {
    die();
}

// Setup

// Includes
include('inc/activate.php');
include('inc/add-menu-page.php');
include('inc/cpt-init.php');
include('process/save-post.php');
include('process/save-post-meta.php');

// Hooks
register_activation_hook(__FILE__, 'chi_activate_plugin' );
add_action( 'admin_menu', 'chi_admin_menu' );
add_action('init','cpt_init');
//add_action('save_post_chi_answer','chi_save_chi_answer_admin', 3, 10);
add_action('save_post_chi_answer', 'chi_answer_save_metabox', 3, 10 );
add_action( 'add_meta_boxes', 'chi_answer_meta_box_for_question' );

// Shortcodes
