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

    foreach ( $query->posts as $answer)
    {
        $answers_conten[] = [
            "ID" 			=>	get_post($answer->ID)->ID,
            "text" 			=>	get_post($answer->ID)->post_content,
            "question_id"	=>	get_post_meta($answer->ID, 'question_id', true),
            "doctor_id"		=>	get_post_meta($answer->ID, 'doctor_id', true)
        ];
    }
    wp_reset_postdata();
    ?>
    <section id="home" class="contents">
        <div class="container">
            <h3 class="page-title text-center"><?php echo get_post($atts['id'])->post_content?></h3>

            <ul class="timeline panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                <li class="timeline-line"></li>
                <?php
                foreach ($answers_conten as $answer_conten)
                {

                    ?>
                    <li class="timeline-item">
                        <div class="timeline-badge"><a href="#"></a></div>
                        <div class="timeline-panel">
                            <div class="panel">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
                                            <div class="timeline-heading"><?php echo get_post($answer_conten["doctor_id"])->post_title?></div> <span class="expand-icon-wrap" aria-expanded="false" aria-controls="collapseTwo"></span>
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel">
                                    <div class="panel-body">
                                        <div class="timeline-content">
                                            <div>
                                                <strong><?php echo get_post($answer_conten["doctor_id"])->post_content?></strong>
                                            </div>
                                            <?php echo $answer_conten["text"] ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                    <?php
                }
                ?>
            </ul>
        </div>
    </section>
    <!-- </div>  end container -->
    <?php

}

