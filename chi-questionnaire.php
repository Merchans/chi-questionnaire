<?php
/*
Plugin Name: CHI Questionnaire
Plugin URI: https://kongres-online.cz/
Description: Questionnaire for doctors.
Version: 0.1
Author: Richard Markovič
Text Domain: chi-questionnaire
Domain Path: /languages/
*/

if	( ! defined('ABSPATH') ) {
    die();
}

// Setup
define('RM_DEV_MODE', true);
define('PLUGIN_HOME', plugin_dir_url(__FILE__) );
define('PLUGIN_HOME_URI', dirname( plugin_basename( __FILE__ ) ) );

// Includes
include('inc/activate.php');
include('inc/enqueue.php');
include('inc/add-menu-page.php');
include('inc/cpt-init.php');
include('process/save-post.php');
include('process/save-post-meta.php');
include('process/add-columns.php');
include('process/add-shortcodes.php');

// Hooks
register_activation_hook(__FILE__, 'chi_activate_plugin' );
add_action( 'plugins_loaded', 'shitty_views_load_textdomain' );
add_action( 'admin_menu', 'chi_admin_menu' );
add_action('init','cpt_init');
add_action( 'admin_enqueue_scripts', 'chi_enqueue_admin', 100, 1 );
add_action( 'wp_enqueue_scripts', 'chi_enqueue_front_end');
add_action('save_post_chi_answer', 'chi_answer_save_metabox', 3, 10 );
add_action( 'add_meta_boxes', 'chi_answer_meta_box_for_question' );
add_action('manage_chi_question_posts_custom_column', 'chi_add_post_questions_columns_data', 10, 2);

// Filters
add_filter('manage_chi_question_posts_columns', 'chi_add_post_questions_columns');
add_filter('manage_edit-chi_question_sortable_columns', 'chi_add_sortable_post_question_column');


// Shortcodes
add_shortcode('question','chi_add_question');