<?php

function chi_answer_meta_box_for_question($post_type){
    if ($post_type = "chi_answer")
	{
        add_meta_box(
            'so_meta_box',
            __( 'Choose a&nbsp;Question and a&nbsp;Doctor:', 'chi_questionnaire' ),
            'custom_element_grid_class_meta_box',
            $post_type,
            'side' ,
            'low'
        );
    }
}


function chi_answer_save_metabox(){
    global $post;
    if(isset($_POST["custom_element_grid_class"])){
        //UPDATE:
        $meta_element_class = $_POST['custom_element_grid_class'];
        //END OF UPDATE

        update_post_meta($post->ID, 'custom_element_grid_class_meta_box', $meta_element_class);
        //print_r($_POST);
    }
}

function custom_element_grid_class_meta_box($post){
    $meta_element_class = get_post_meta($post->ID, 'custom_element_grid_class_meta_box', true); //true ensures you get just one value instead of an array
    ?>
    <label><?php __( 'Choose a question and a doctor:', 'chi_questionnaire' ) ?></label>

    <select name="custom_element_grid_class" id="custom_element_grid_class">
        <option value="normal" <?php selected( $meta_element_class, 'normal' ); ?>>normal</option>
        <option value="square" <?php selected( $meta_element_class, 'square' ); ?>>square</option>
        <option value="wide" <?php selected( $meta_element_class, 'wide' ); ?>>wide</option>
        <option value="tall" <?php selected( $meta_element_class, 'tall' ); ?>>tall</option>
    </select>
    <?php
}