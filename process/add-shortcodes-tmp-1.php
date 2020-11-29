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
	<div class="chi-time-line-container">
	<h1><?php echo get_post($atts['id'])->post_content?></h1>
	<?php
    foreach ($answers_conten as $answer_conten)
	{

		?>
		<div class="item">
			<div class="image">
				<div>
					<?php echo get_the_post_thumbnail($answer_conten["doctor_id"], 'thumbnail'); ?>
					<span><?php echo get_post($answer_conten["doctor_id"])->post_title?></span>
				</div>
			</div>
			<div class="details">
				<div>
                    <h5><?php echo get_post($answer_conten["doctor_id"])->post_content?></h5>
					<?php echo $answer_conten["text"] ?>
				</div>
			</div>
		</div>
		<?php
	}
    ?>
	</div> <!-- end container -->
	<?php

}

