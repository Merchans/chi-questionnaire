<?php
 /**
  * Register a custom post types called "Question", "Answers", "Doctors"
  *
  * @see get_post_type_labels() for label keys.
  */

    function cpt_init()
    {
        $labels = array(
            'name'                  => _x( 'Questions', 'Post type general name', 'chi-questionnaire' ),
            'singular_name'         => _x( 'Question', 'Post type singular name', 'chi-questionnaire' ),
            'menu_name'             => _x( 'Questions', 'Admin Menu text', 'chi-questionnaire' ),
            'name_admin_bar'        => _x( 'Question', 'Add New on Toolbar', 'chi-questionnaire' ),
            'add_new'               => __( 'Add New', 'chi-questionnaire' ),
            'add_new_item'          => __( 'Add New Question', 'chi-questionnaire' ),
            'new_item'              => __( 'New Question', 'chi-questionnaire' ),
            'edit_item'             => __( 'Edit Question', 'chi-questionnaire' ),
            'view_item'             => __( 'View Question', 'chi-questionnaire' ),
            'all_items'             => __( 'All Questions', 'chi-questionnaire' ),
            'search_items'          => __( 'Search Questions', 'chi-questionnaire' ),
            'parent_item_colon'     => __( 'Parent Questions:', 'chi-questionnaire' ),
            'not_found'             => __( 'No Questions found.', 'chi-questionnaire' ),
            'not_found_in_trash'    => __( 'No Questions found in Trash.', 'chi-questionnaire' ),
            'featured_image'        => _x( 'Question Cover Image', 'Overrides the “Featured Image” phrase for this post type. Added in 4.3', 'chi-questionnaire' ),
            'set_featured_image'    => _x( 'Set cover image', 'Overrides the “Set featured image” phrase for this post type. Added in 4.3', 'chi-questionnaire' ),
            'remove_featured_image' => _x( 'Remove cover image', 'Overrides the “Remove featured image” phrase for this post type. Added in 4.3', 'chi-questionnaire' ),
            'use_featured_image'    => _x( 'Use as cover image', 'Overrides the “Use as featured image” phrase for this post type. Added in 4.3', 'chi-questionnaire' ),
            'archives'              => _x( 'Question archives', 'The post type archive label used in nav menus. Default “Post Archives”. Added in 4.4', 'chi-questionnaire' ),
            'insert_into_item'      => _x( 'Insert into Question', 'Overrides the “Insert into post”/”Insert into page” phrase (used when inserting media into a post). Added in 4.4', 'chi-questionnaire' ),
            'uploaded_to_this_item' => _x( 'Uploaded to this Question', 'Overrides the “Uploaded to this post”/”Uploaded to this page” phrase (used when viewing media attached to a post). Added in 4.4', 'chi-questionnaire' ),
            'filter_items_list'     => _x( 'Filter Questions list', 'Screen reader text for the filter links heading on the post type listing screen. Default “Filter posts list”/”Filter pages list”. Added in 4.4', 'chi-questionnaire' ),
            'items_list_navigation' => _x( 'Questions list navigation', 'Screen reader text for the pagination heading on the post type listing screen. Default “Posts list navigation”/”Pages list navigation”. Added in 4.4', 'chi-questionnaire' ),
            'items_list'            => _x( 'Questions list', 'Screen reader text for the items list heading on the post type listing screen. Default “Posts list”/”Pages list”. Added in 4.4', 'chi-questionnaire' ),
        );

        $args = array(
            'labels'             => $labels,
            'public'             => false,
            'publicly_queryable' => false,
            'show_ui'            => true,
            'show_in_menu'       => 'questionnaire-manager',
            'query_var'          => true,
            'rewrite'            => array( 'slug' => 'question' ),
            'capability_type'    => 'post',
            'has_archive'        => true,
            'hierarchical'       => false,
            'menu_position'      => null,
            'supports'           => array( 'title', 'editor'),
        );

        register_post_type( 'chi_question', $args );


        $labels = array(
            'name'                  => _x( 'Answers', 'Post type general name', 'chi-questionnaire' ),
            'singular_name'         => _x( 'Answer', 'Post type singular name', 'chi-questionnaire' ),
            'menu_name'             => _x( 'Answers', 'Admin Menu text', 'chi-questionnaire' ),
            'name_admin_bar'        => _x( 'Answer', 'Add New on Toolbar', 'chi-questionnaire' ),
            'add_new'               => __( 'Add New', 'chi-questionnaire' ),
            'add_new_item'          => __( 'Add New Answer', 'chi-questionnaire' ),
            'new_item'              => __( 'New Answer', 'chi-questionnaire' ),
            'edit_item'             => __( 'Edit Answer', 'chi-questionnaire' ),
            'view_item'             => __( 'View Answer', 'chi-questionnaire' ),
            'all_items'             => __( 'All Answers', 'chi-questionnaire' ),
            'search_items'          => __( 'Search Answers', 'chi-questionnaire' ),
            'parent_item_colon'     => __( 'Parent Answers:', 'chi-questionnaire' ),
            'not_found'             => __( 'No Answers found.', 'chi-questionnaire' ),
            'not_found_in_trash'    => __( 'No Answers found in Trash.', 'chi-questionnaire' ),
            'featured_image'        => _x( 'Answer Cover Image', 'Overrides the “Featured Image” phrase for this post type. Added in 4.3', 'chi-questionnaire' ),
            'set_featured_image'    => _x( 'Set cover image', 'Overrides the “Set featured image” phrase for this post type. Added in 4.3', 'chi-questionnaire' ),
            'remove_featured_image' => _x( 'Remove cover image', 'Overrides the “Remove featured image” phrase for this post type. Added in 4.3', 'chi-questionnaire' ),
            'use_featured_image'    => _x( 'Use as cover image', 'Overrides the “Use as featured image” phrase for this post type. Added in 4.3', 'chi-questionnaire' ),
            'archives'              => _x( 'Answer archives', 'The post type archive label used in nav menus. Default “Post Archives”. Added in 4.4', 'chi-questionnaire' ),
            'insert_into_item'      => _x( 'Insert into Answer', 'Overrides the “Insert into post”/”Insert into page” phrase (used when inserting media into a post). Added in 4.4', 'chi-questionnaire' ),
            'uploaded_to_this_item' => _x( 'Uploaded to this Answer', 'Overrides the “Uploaded to this post”/”Uploaded to this page” phrase (used when viewing media attached to a post). Added in 4.4', 'chi-questionnaire' ),
            'filter_items_list'     => _x( 'Filter Answers list', 'Screen reader text for the filter links heading on the post type listing screen. Default “Filter posts list”/”Filter pages list”. Added in 4.4', 'chi-questionnaire' ),
            'items_list_navigation' => _x( 'Answers list navigation', 'Screen reader text for the pagination heading on the post type listing screen. Default “Posts list navigation”/”Pages list navigation”. Added in 4.4', 'chi-questionnaire' ),
            'items_list'            => _x( 'Answers list', 'Screen reader text for the items list heading on the post type listing screen. Default “Posts list”/”Pages list”. Added in 4.4', 'chi-questionnaire' ),
        );

        $args = array(
            'labels'             => $labels,
            'public'             => false,
            'publicly_queryable' => false,
            'show_ui'            => true,
            'show_in_menu'       => 'questionnaire-manager',
            'query_var'          => true,
            'rewrite'            => array( 'slug' => 'answer' ),
            'capability_type'    => 'post',
            'has_archive'        => true,
            'hierarchical'       => false,
            'menu_position'      => null,
            'supports'           => array( 'title', 'editor' ),
        );

        register_post_type( 'chi_answer', $args );

        $labels = array(
            'name'                  => _x( 'Doctors', 'Post type general name', 'chi-questionnaire' ),
            'singular_name'         => _x( 'Doctor', 'Post type singular name', 'chi-questionnaire' ),
            'menu_name'             => _x( 'Doctors', 'Admin Menu text', 'chi-questionnaire' ),
            'name_admin_bar'        => _x( 'Doctor', 'Add New on Toolbar', 'chi-questionnaire' ),
            'add_new'               => __( 'Add New', 'chi-questionnaire' ),
            'add_new_item'          => __( 'Add New Doctor', 'chi-questionnaire' ),
            'new_item'              => __( 'New Doctor', 'chi-questionnaire' ),
            'edit_item'             => __( 'Edit Doctor', 'chi-questionnaire' ),
            'view_item'             => __( 'View Doctor', 'chi-questionnaire' ),
            'all_items'             => __( 'All Doctors', 'chi-questionnaire' ),
            'search_items'          => __( 'Search Doctors', 'chi-questionnaire' ),
            'parent_item_colon'     => __( 'Parent Doctors:', 'chi-questionnaire' ),
            'not_found'             => __( 'No Doctors found.', 'chi-questionnaire' ),
            'not_found_in_trash'    => __( 'No Doctors found in Trash.', 'chi-questionnaire' ),
            'featured_image'        => _x( 'Doctor Cover Image', 'Overrides the “Featured Image” phrase for this post type. Added in 4.3', 'chi-questionnaire' ),
            'set_featured_image'    => _x( 'Set cover image', 'Overrides the “Set featured image” phrase for this post type. Added in 4.3', 'chi-questionnaire' ),
            'remove_featured_image' => _x( 'Remove cover image', 'Overrides the “Remove featured image” phrase for this post type. Added in 4.3', 'chi-questionnaire' ),
            'use_featured_image'    => _x( 'Use as cover image', 'Overrides the “Use as featured image” phrase for this post type. Added in 4.3', 'chi-questionnaire' ),
            'archives'              => _x( 'Doctor archives', 'The post type archive label used in nav menus. Default “Post Archives”. Added in 4.4', 'chi-questionnaire' ),
            'insert_into_item'      => _x( 'Insert into Doctor', 'Overrides the “Insert into post”/”Insert into page” phrase (used when inserting media into a post). Added in 4.4', 'chi-questionnaire' ),
            'uploaded_to_this_item' => _x( 'Uploaded to this Doctor', 'Overrides the “Uploaded to this post”/”Uploaded to this page” phrase (used when viewing media attached to a post). Added in 4.4', 'chi-questionnaire' ),
            'filter_items_list'     => _x( 'Filter Doctors list', 'Screen reader text for the filter links heading on the post type listing screen. Default “Filter posts list”/”Filter pages list”. Added in 4.4', 'chi-questionnaire' ),
            'items_list_navigation' => _x( 'Doctors list navigation', 'Screen reader text for the pagination heading on the post type listing screen. Default “Posts list navigation”/”Pages list navigation”. Added in 4.4', 'chi-questionnaire' ),
            'items_list'            => _x( 'Doctors list', 'Screen reader text for the items list heading on the post type listing screen. Default “Posts list”/”Pages list”. Added in 4.4', 'chi-questionnaire' ),
        );

        $args = array(
            'labels'             => $labels,
            'public'             => false,
            'publicly_queryable' => false,
            'show_ui'            => true,
            'show_in_menu'       => 'questionnaire-manager',
            'query_var'          => true,
            'rewrite'            => array( 'slug' => 'doctor' ),
            'capability_type'    => 'post',
            'has_archive'        => true,
            'hierarchical'       => false,
            'menu_position'      => null,
            'supports'           => array( 'title', 'editor', 'thumbnail' ),
        );

        register_post_type( 'chi_doctor', $args );
    }