<?php

function chi_answer_meta_box_for_question($post_type){
    if ($post_type = "chi_answer")
	{
        add_meta_box(
            'so_meta_box',
            __( 'Choose a&nbsp;Question and a&nbsp;Doctor:', 'chi_questionnaire' ),
            'question_id_meta_box',
            $post_type,
            'side' ,
            'low'
        );
    }
}


function chi_answer_save_metabox( $post_id, $post, $update){

    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return;
    }


    if (!isset($_POST["question_id"]))
    {
        $answer_question_id = get_post_meta( $post_id, 'question_id', true);
        $answer_question_id = empty($answer_question_id) && absint($answer_question_id) ? [] : $answer_question_id;
        update_post_meta($post_id, 'question_id', $answer_question_id );
    }

    if (isset($_POST["question_id"]))
    {
        $answer_question_id = ($_POST["question_id"]);
        $answer_question_id = empty($answer_question_id) && absint($answer_question_id) ? [] : $answer_question_id;
        update_post_meta($post_id, 'question_id', $answer_question_id );
    }

    if (isset($_POST["doctor_id"]))
    {
        $answer_doctor_id = $_POST["doctor_id"];
        $answer_doctor_id = empty($answer_doctor_id) ? [] : $answer_doctor_id;

        update_post_meta($post_id, 'doctor_id', $answer_doctor_id );
    }

    if (!isset($_POST["doctor_id"]))
    {
        $answer_doctor_id = get_post_meta( $post_id, 'doctor_id', true);
        $answer_doctor_id = empty($answer_doctor_id) ? [] : $answer_doctor_id;

        update_post_meta($post_id, 'doctor_id', $answer_doctor_id );
    }



}

function question_id_meta_box($post){
    $question_id = get_post_meta($post->ID, 'question_id', true); //true ensures you get just one value instead of an array
    $doctor_id = get_post_meta($post->ID, 'doctor_id', true); //true ensures you get just one value instead of an array
    echo '<pre>';
    print_r( $question_id );
    echo '</pre>';
    $questions = [
        'post' => get_posts(
            [
                'numberposts' => -1,
                'post_type' => 'chi_question',
                'post_status' => 'publish',
            ],
            )
        ];

    $doctors = [
        'post' => get_posts(
            [
                'numberposts' => -1,
                'post_type' => 'chi_doctor',
                'post_status' => 'publish',
            ],
            )
    ];

    ?>
    <style>
        select#doctor_id,
        select#question_id
        {
            width: 100%;
        }
    </style>
    <?php if ( !empty($questions['post']) ):  ?>
    <div class="box-question">
        <label  for="question_id" ><?php _e( 'Choose a Question:', 'chi_questionnaire' ) ?></label>

        <select name="question_id" id="question_id">
            <?php
            foreach ( $questions['post'] as $question ) {

                $id = $question->ID;
                $name = "[".$id."]" . " − " . $question->post_title;
                ?>
                <option value="<?php echo $id?>" <?php selected( $doctor_id, $id ); ?>>
                    <?php echo $name ?>
                </option>
                <?php

            }
            ?>

        </select>
    </div>
    <?php endif ?>
    <?php if ( !empty($doctors['post']) ):  ?>
    <div class="box-doctor">
        <label for="doctor_id"><?php _e( 'Choose a Doctor:', 'chi_questionnaire' ) ?></label>

        <select name="doctor_id" id="doctor_id">
            <?php
            foreach ( $doctors['post'] as $doctor ) {

                $id = $doctor->ID;
                $name = "[".$id."]" . " − " . $doctor->post_title;
                ?>
                <option value="<?php echo $id?>" <?php selected( $question_id, $id ); ?>>
                    <?php echo $name ?>
                </option>
                <?php

            }
            ?>
        </select>
    </div>
       <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/js/standalone/selectize.min.js" integrity="sha256-+C0A5Ilqmu4QcSPxrlGpaZxJ04VjsRjKu+G82kl5UJk=" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/css/selectize.bootstrap3.min.css" integrity="sha256-ze/OEYGcFbPRmvCnrSeKbRTtjG4vGLHXgOqsyLFTRjg=" crossorigin="anonymous" />

        <script>
	        jQuery(document).ready(function () {
		        jQuery('select').selectize({
			        sortField: 'text'
		        });
	        });
        </script>-->
<?php endif ?>
    <?php
}