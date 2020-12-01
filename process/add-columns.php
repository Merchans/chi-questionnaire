<?php

// add 'Questions' column to admin table belonge to CPT 'theory'
function chi_add_post_questions_columns( $columns )
{

    $columns["ID"] = __("ID", "chi-questionnaire");
    $columns["shortcode"] = __("Shortcode", "chi-questionnaire");

    return $columns;

}


function chi_add_post_questions_columns_data( $column, $post_id )
{

    if ($column == "ID")
    {
  		?>
			<a class="row-title" href="<?php echo get_edit_post_link($post_id); ?>">
				<span class="questionId"><?php echo $post_id; ?></span>
			</a>
		<button class="copyIdButton button action"><?php _e('Copy ID', 'chi-questionnaire'); ?></button>
		<div>

		</div>
		<?php
    }

    if ($column == "shortcode")
	{
		echo '[question id="'.$post_id. '"]';
	}

}

function chi_add_sortable_post_question_column( $columns )
{
    $columns["ID"] =  "ID";

    return $columns;
}


function chi_add_post_answer_columns($columns)
{
    $columns["id_name_of_doctor"] = __("Doctor", "chi-questionnaire");
    $columns["id_name_of_question"] = __("Question", "chi-questionnaire");

    return $columns;
}

function chi_add_post_answer_columns_data( $column, $post_id )
{
	if ($column == "id_name_of_doctor")
	{
		$doctor_id = get_post_meta($post_id, "doctor_id" ,true);
        if ($doctor_id != "Pick a doctor...")
        	echo "[".$doctor_id."]"  . " − " . get_post($doctor_id)->post_title;
	}

    if ($column == "id_name_of_question")
    {
        $question_id = get_post_meta($post_id, "question_id" ,true);
        if ($question_id != "Pick a question...")
        	echo "[".$question_id."]"  . " − " . get_post($question_id)->post_title;
    }
}