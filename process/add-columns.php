<?php

// add 'Komentář' column to admin table belonge to CPT 'theory'
function chi_add_post_questions_columns( $columns )
{

    $columns["ID"] = __("ID", "chi_questionnaire");

    return $columns;

}


function chi_add_post_questions_columns_data( $column, $post_id )
{

    if ($column == "ID")
    {
  		?>
		<span class="questionId"><?php echo $post_id; ?></span>
		<button class="copyIdButton"><?php _e('Copy ID', 'chi_questionnaire'); ?></button>
		<?php
    }

}

function hnilicka_add_sortable_post_komentar_column( $columns )
{
    $columns["komentar"] =  "komentar";

    return $columns;
}


// order by 'komentar' column
function hnilicka_komentar_column_orderby( $query )
{
    if (! is_admin() )
    {
        return;
    }

    $orderby = $query->get( 'orderby' );

    if ( "komentar" === $orderby)
    {
        $query->set( "meta_key", "vypis" );
        $query->set( "orderby", "meta_value" );
    }
}


// add 'Texty Hotovo' column to admin table belonge to CPT 'theory'
function hnilicka_add_post_texty_hotovo_columns( $columns )
{
    $columns["texty_hotovo"] = __("Texty Hotovo", "hnilicka");

    return $columns;

}


function hnilicka_add_post_texty_hotovo_columns_data( $column, $post_id )
{

    if ($column == "texty_hotovo")
    {
        $val = get_field("texty_hotovo", $post_id);

        if ( $val && isset($val) && $val != "" )
        {
            ?>
            <label class="screen-reader-text" for="<?php echo $post_id?>"><?php echo $val ?></label>
            <input id="<?php echo $post_id?>" type="checkbox" name="post[]" value="<?php echo $val?>" disabled checked>
            <div class="locked-indicator">
                <span class="locked-indicator-icon" aria-hidden="true"></span>
                <span class="screen-reader-text"><?php echo $val?></span>
            </div>
            <?php
        }
        else
        {
            ?>
            <input id="<?php echo $post_id?>" type="checkbox" name="post[]" value="" disabled>
            <div class="locked-indicator">
                <span class="locked-indicator-icon" aria-hidden="true"></span>
                <span class="screen-reader-text"></span>
            </div>
            <?php
        }
    }

}

// order by 'texty hotovo' column
function hnilicka_post_texty_hotovo_column_orderby( $query )
{
    if (! is_admin() )
    {
        return;
    }

    $orderby = $query->get( 'orderby' );

    if ( "texty_hotovo" === $orderby)
    {
        $query->set( "meta_key", "texty_hotovo" );
        $query->set( "orderby", "meta_value" );
    }
}

function hnilicka_post_obrazky_hotovo_column_orderby( $query )
{
    if (! is_admin() )
    {
        return;
    }

    $orderby = $query->get( 'orderby' );

    if ( "obrazky_hotovo" === $orderby)
    {
        $query->set( "meta_key", "obrazky_hotovo" );
        $query->set( "orderby", "meta_value" );
    }
}



function hnilicka_add_sortable_post_texty_hotovo_column( $columns )
{
    $columns["texty_hotovo"] =  "texty_hotovo";

    return $columns;
}


// add 'Texty Hotovo' column to admin table belonge to CPT 'theory'
function hnilicka_add_post_obrazky_hotovo_columns( $columns )
{
    $columns["obrazky_hotovo"] = __("Obrázky Hotovo", "hnilicka");

    return $columns;

}


function hnilicka_add_sortable_post_obrazky_hotovo_column( $columns )
{
    $columns["obrazky_hotovo"] =  "obrazky_hotovo";

    return $columns;
}



function hnilicka_add_post_obrazky_hotovo_columns_data( $column, $post_id )
{

    if ($column == "obrazky_hotovo")
    {
        $val = get_field("obrazky_hotovo", $post_id);

        if ( $val && isset($val) && $val != "" )
        {
            ?>
            <label class="screen-reader-text" for="<?php echo $post_id?>"><?php echo $val ?></label>
            <input id="<?php echo $post_id?>" type="checkbox" name="post[]" value="<?php echo $val?>" disabled checked>
            <div class="locked-indicator">
                <span class="locked-indicator-icon" aria-hidden="true"></span>
                <span class="screen-reader-text"><?php echo $val?></span>
            </div>
            <?php
        }
        else
        {
            ?>
            <input id="<?php echo $post_id?>" type="checkbox" name="post[]" value="" disabled>
            <div class="locked-indicator">
                <span class="locked-indicator-icon" aria-hidden="true"></span>
                <span class="screen-reader-text"></span>
            </div>
            <?php
        }
    }

}