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
		<div class="accordion">
			<h3>Section 1</h3>

			<div>
				Mauris mauris ante, blandit et, ultrices a, suscipit eget, quam. Integer ut neque. Vivamus nisi metus, molestie vel, gravida in, condimentum sit amet, nunc. Nam a nibh. Donec suscipit eros. Nam mi. Proin viverra leo ut odio. Curabitur malesuada. Vestibulum a velit eu ante scelerisque vulputate.
			</div>

			<h3>Section 2</h3>

			<div>
				Sed non urna. Donec et ante. Phasellus eu ligula. Vestibulum sit amet purus. Vivamus hendrerit, dolor at aliquet laoreet, mauris turpis porttitor velit, faucibus interdum tellus libero ac justo. Vivamus non quam. In suscipit faucibus urna.
			</div></div>
		<div class="accordion">
			<h3>Section 1</h3>

			<div>
				Mauris mauris ante, blandit et, ultrices a, suscipit eget, quam. Integer ut neque. Vivamus nisi metus, molestie vel, gravida in, condimentum sit amet, nunc. Nam a nibh. Donec suscipit eros. Nam mi. Proin viverra leo ut odio. Curabitur malesuada. Vestibulum a velit eu ante scelerisque vulputate.
			</div>

			<h3>Section 2</h3>

			<div>
				Sed non urna. Donec et ante. Phasellus eu ligula. Vestibulum sit amet purus. Vivamus hendrerit, dolor at aliquet laoreet, mauris turpis porttitor velit, faucibus interdum tellus libero ac justo. Vivamus non quam. In suscipit faucibus urna.
			</div></div>
        <div class="container">
            <?php echo get_post($atts['id'])->post_content?>
            <a href="#" class="chi-btn-all-answers btnImgClick">
				<i class="chi-arrow chi-down"></i>&nbsp;<?php _e('See other answers','chi-questionnaire') ?>
            </a>
            <ul class="timeline panel-group"  role="tablist" aria-multiselectable="true">
                <?php
                foreach ($answers_conten as $answer_conten)
                {

                    ?>
                    <li class="timeline-item">
                        <!--<div class="timeline-badge"></div> -->
                        <div class="timeline-panel">
                            <div class="panel">
                                <div class="panel-heading">
                                    <div class="panel-title">
										<span class="timeline-badge">
                                        <?php  if ( has_post_thumbnail( $answer_conten["doctor_id"] ) ): ?>
                                            <?php echo get_the_post_thumbnail($answer_conten["doctor_id"], 'thumbnail'); ?>
                                        <?php endif; ?>
                                        <?php  if ( !has_post_thumbnail( $answer_conten["doctor_id"] ) ): ?>
											<img src="<?php echo PLUGIN_HOME . "img/user.png" ?>" alt="doctor">
                                        <?php endif; ?>
										</span>
                                        <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
                                            <span class="timeline-heading"><?php echo get_post($answer_conten["doctor_id"])->post_title?></span>
                                            <span class="expand-icon-wrap" aria-expanded="false" aria-controls="collapseTwo"></span>
                                        </a>
                                    </div>
                                </div>
                                <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel">
                                    <div class="panel-body">
                                        <div class="timeline-content">
                                            <div class="chi-work-station">
                                                <?php echo get_post($answer_conten["doctor_id"])->post_content?>
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

