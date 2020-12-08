<?php

function chi_add_question( $atts )
{
    // set defaults
    $atts = shortcode_atts(array(
        'id' => '',
    ), $atts );
    if ( $atts['id'] == '' || empty($atts) )
    {ob_start();?>
        <div class="alert alert-info">
            <?php _e('<strong>ID</strong> is empty. Set the ID [question id="x"].','chi-questionnaire') ?>
            <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
        </div>
        <?php
        return ob_get_clean();
    }

    if ( !is_question( $atts['id'] ) )
    { ob_start(); ?>
        <div class="alert alert-info">
            <strong><?php _e('Enter the ID from the question section.','chi-questionnaire') ?></strong>
            <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
        </div>
        <?php
        return ob_get_clean();
    }
    ob_start();
    
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
            <?php echo get_post($atts['id'])->post_content?>

			<a href="#" class="btn-toogle-class">
				<i class="chi-arrow chi-down"></i>
                <?php _e('See other answers','chi-questionnaire') ?>
			</a>
			<dl class="chi-dl-container">
                <?php
                foreach ($answers_conten as $answer_conten)
                {

                    ?>
					<dt class="chi-dt">
                        <?php  if ( has_post_thumbnail( $answer_conten["doctor_id"] ) ): ?>
                            <?php echo get_the_post_thumbnail($answer_conten["doctor_id"], 'thumbnail', array( "class" => "chi-doctor-img") ); ?>
                                        <?php endif; ?>
                        <?php  if ( !has_post_thumbnail( $answer_conten["doctor_id"] ) ): ?>
							<img src="<?php echo PLUGIN_HOME . "img/user.png" ?>" alt="doctor" class="chi-doctor-img">
                        <?php endif; ?>
						<a href="#" target="_blank" class="chi-doctor-name"><?php echo get_post($answer_conten["doctor_id"])->post_title?></a>
						<i class="chi-arrow chi-down"></i>
					</dt>
					<dd class="chi-dd">
						<?php echo get_post($answer_conten["doctor_id"])->post_content?>
						<br><br>
						<?php echo $answer_conten["text"] ?>
					</dd>

                    <?php
                }
                ?>
			</dl>
    </section>
    <?php
    return ob_get_clean();
}

function chi_add_advertising( $atts ) {
    $atts = shortcode_atts(array(
        'id' => '',
    ), $atts );
    if ( $atts['id'] == '' || empty($atts) )
    {ob_start();?>
		<div class="alert alert-info">
            <?php _e('<strong>ID</strong> is empty. Set the ID [advertising id="x"].','chi-questionnaire') ?>
			<span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
		</div>
        <?php
        return ob_get_clean();
    }

    if ( !check_post_type( $atts['id'], "chi_inzerce" ) )
    { ob_start(); ?>
		<div class="alert alert-info">
			<strong><?php _e('Enter the ID from the advertising section.','chi-questionnaire') ?></strong>
			<span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
		</div>
        <?php
        return ob_get_clean();
    }
    ob_start();
    $advertising = get_post($atts['id']);
    $advertising_content = $advertising->post_content;
    ?>
	<div class="chi-bg-white">
		<div class="d-flex h-20 mt-4">
			<div class="chi-tag text-uppercase mr-auto p-2">
				<span class="chi-tag_link">
					<?php _e('advertising message','chi-questionnaire') ?>
				</span>

			</div>
		</div>
		<hr class="divider mt-0" />
		<div class="chi-advertise">
			<?php echo $advertising_content; ?>
		</div>
		<hr class="divider mt-0" />
	</div>
    <?php return ob_get_clean();

}
