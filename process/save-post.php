<?php

function chi_save_chi_answer_admin( $post_id, $post, $update) {
    $answer_question_id = get_post_meta( $post_id, 'question_id', true);
    $answer_question_id = empty($answer_question_id) ? [] : $answer_question_id;

    $answer_doctor_id = get_post_meta( $post_id, 'doctor_id', true);
    $answer_doctor_id = empty($answer_doctor_id) ? [] : $answer_doctor_id;

    update_post_meta($post_id, 'question_id', $answer_question_id );
    update_post_meta($post_id, 'doctor_id', $answer_doctor_id );
}