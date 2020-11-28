<?php

// add 'Questions' column to admin table belonge to CPT 'theory'
function chi_add_post_questions_columns( $columns )
{

    $columns["ID"] = __("ID", "chi-questionnaire");

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

}

function chi_add_sortable_post_question_column( $columns )
{
    $columns["ID"] =  "ID";

    return $columns;
}
