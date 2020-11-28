<?php

function chi_admin_menu() {
    add_menu_page(
        __('Questionnaire', 'chi-questionnaire'),
        __('Questionnaire', 'chi-questionnaire'),
        'read',
        'questionnaire-manager',
        '', // Callback, leave empty
        'dashicons-format-quote',
        12 // Position
    );
}