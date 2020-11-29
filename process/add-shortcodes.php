<?php

function chi_add_question( $atts )
{
    // set defaults
    $atts = shortcode_atts(array(
        'id' => '',
    ), $atts );

    if ( $atts['id'] == '' || empty($atts) )
    {?>
        <style>
            .closebtn {
                margin-left: 15px;
                color: white;
                font-weight: bold;
                float: right;
                font-size: 22px;
                line-height: 20px;
                cursor: pointer;
                transition: 0.3s;
            }

            .closebtn:hover {
                color: black;
            }
        </style>
        <div class="alert alert-info">
            <strong>ID</strong> <?php _e('is empty. Set the ID [question id="x"].','chi-questionnaire') ?>
            <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
        </div>
        <?php
    return;
    }

    if ( !is_question( $atts['id'] ) )
    {
        ?>
        <style>
            .closebtn {
                margin-left: 15px;
                color: white;
                font-weight: bold;
                float: right;
                font-size: 22px;
                line-height: 20px;
                cursor: pointer;
                transition: 0.3s;
            }

            .closebtn:hover {
                color: black;
            }
        </style>
        <div class="alert alert-info">
            <strong><?php _e('Enter the ID from the question section.','chi-questionnaire') ?></strong>
            <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
        </div>
        <?php
        return;
    }

    $args = array(
        'post_type'  => 'chi_answer',
        'meta_key'   => 'question_id',
        'orderby'    => 'meta_value_num',
        'order'      => 'ASC',
        'meta_query' => array(
            array(
                'key'     => 'question_id',
                'value'   => $atts['id'],
                'compare' => '=',
            ),
        ),
    );
    $query = new WP_Query( $args );
    foreach ( $query as $answer)
    {
        echo '<pre>';
        print_r( $answer->post_title );
        echo '</pre>';
    }

    die();
    return "foo and bar";
}

