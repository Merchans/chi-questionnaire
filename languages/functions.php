<?php
define( 'THEME_DIRECTORY', get_template_directory() );
define('THEME_DIRECTORY_URI', get_template_directory_uri() );

/* CHI custom posty type */
require_once THEME_DIRECTORY ."/inc/cpt/cpt_advertising.php";
require_once THEME_DIRECTORY ."/inc/cpt/cpt_video.php";

/* CHI meta boxes*/
require_once THEME_DIRECTORY ."/inc/mtb/mtb_chi_doctors_degree.php";
require_once THEME_DIRECTORY ."/inc/mtb/mtb_chi_video.php";
require_once THEME_DIRECTORY ."/inc/mtb/mtb_chi_advertising.php";
require_once THEME_DIRECTORY ."/inc/mtb/mtb_chi_all_posts.php";
require_once THEME_DIRECTORY ."/inc/mtb/mtb_category_logo.php";
require_once THEME_DIRECTORY ."/inc/mtb/mtb_category_background.php";
require_once THEME_DIRECTORY ."/inc/mtb/mtb_chi_category_all_posts.php";
require_once THEME_DIRECTORY ."/inc/mtb/mtb_chi_category_advertising.php";
require_once THEME_DIRECTORY ."/inc/mtb/mtb_chi_checkbox_meta.php";
require_once THEME_DIRECTORY ."/inc/mtb/mtb_catagory_select.php";


/*
 * EXCERPT EDITOR
* */
require_once THEME_DIRECTORY ."/inc/excerpt-editor.php";
$excerpt = new Excerpt();

//Allow HTML Tags in Wordpress Excerpt
require_once THEME_DIRECTORY ."/inc/excerpt-allow.php";

/*
*   CHI Option Page
*/
require_once THEME_DIRECTORY ."/inc/opg/chi_option_menu_page.php";
/**
 * CHI Scripts and Styles
 */
require_once THEME_DIRECTORY ."/inc/scripts-and-styles.php";

/*
* CHI WP AMIN ORDER MENU
*/
require_once THEME_DIRECTORY ."/inc/reorder_admin_menu.php";

// CHI menuse
require_once THEME_DIRECTORY ."/inc/menues.php";


// CHI change labels
require_once THEME_DIRECTORY ."/inc/labels.php";

// CHI all header
function chi_all_headers()
{
    if ( is_front_page() ) :
        return get_header();
	elseif ( is_404() ) :
        return get_header( '404' );
	elseif ( is_category() ) :
        return get_header( 'category' );
	elseif ( is_singular( 'chi_video' ) ) :
        return get_header( 'single' );
	elseif ( is_single() ) :
        return get_header( 'single' );
    else :
       return get_header();
    endif;
}

/*
function addTitleFieldToCat(){
    $cat_title = get_term_meta($_GET['tag_ID'], '_pagetitle', true);

    ?>
    <tr class="form-field">
        <th scope="row" valign="top"><label for="cat_page_title"><?php _e('Category Page Title'); ?></label></th>
        <td>
            <input type="text" name="cat_title" id="cat_title" value="<?php echo $cat_title ?>"><br />
            <span class="description"><?php _e('Title for the Category '); ?></span>
        </td>
    </tr>
    <?php

}
add_action ( 'edit_category_form_fields', 'addTitleFieldToCat');
echo wp_get_attachment_image($_GET['tag_ID']);
function saveCategoryFields() {
    if ( isset( $_POST['cat_title'] ) ) {
        update_term_meta($_POST['tag_ID'], '_pagetitle', $_POST['cat_title']);
    }
}
add_action ( 'edited_category', 'saveCategoryFields');
*/
/*
* CHI THEME SUPPERT
*/

add_theme_support( 'post-thumbnails');
add_theme_support('menus');


add_filter( 'nav_menu_link_attributes', 'chi_menu_add_class', 10, 3 );

function chi_menu_add_class( $atts, $item, $args ) {

    if (in_array('current-menu-item', $atts) ){
        $class = 'nav-link chi-nav-link active chi-active ';
    }else
    {
        $class = 'nav-link chi-nav-link'; // or something based on $item
    }
    $atts['class'] = $class;
    return $atts;
}


add_filter('nav_menu_css_class' , 'special_nav_class' , 10 , 2);

function special_nav_class ($classes, $item) {
    if (in_array('current-menu-item', $classes) ){
        $classes[] = 'active chi-active';
    }
    return $classes;
}


function get_chi_make_specilal_form_category( $id = NULL )
{
    $home_url = get_home_url();
    $category_slug = get_the_category($id)[0]->slug;
    $url = $home_url  . '/' . $category_slug;

    return   $url;
}

function chi_video_time( $id = false )
{
	if ($id == false)
	{
		$id = get_the_ID();
	}
    return get_post_meta( $id, ["video_meta_box_video-length"][0] );
}

add_filter('next_posts_link_attributes', 'posts_link_attributes');
add_filter('previous_posts_link_attributes', 'posts_link_attributes');

function posts_link_attributes() {
    return 'class="add-your-class-here"';
}

/* Print lable of CP  */

function get_chi_print_cp_lables()
{
    $args=array(
        'public'                => true,
        'exclude_from_search'   => false,
        '_builtin'              => false,
    );

    $output = 'chi_video'; // names or objects, note names is the default
    $operator = 'and'; // 'and' or 'or'
    $post_types = get_post_types($args,$output,$operator);

    return $post_types["$output"]->label;
}


/*CZech date function */
function czech_date( $dateFormat, $dateData ){
    $aj = array("January","February","March","April","May","June","July","August","September","October","November","December");
    $cz = array("ledna","února","března","dubna","května","června","července","srpna","září","října","listopadu","prosince");

    $czech_date = str_replace($aj, $cz, date($dateFormat, $dateData ));
    return $czech_date;
}

/* MAIN LOOP EDIT */

function chi_category_main_query_offset( $query, $offset = 2 ) {

	if (!is_admin())
	{
		if ( $query->is_main_query() && $query->is_category() && $query->is_archive() && is_category( 'kardiovaskularni-zpravodajstvi' ) )
		{
            $args_one_video_or_post = array("post_type" => array("chi_video", "post"), "posts_per_page" => 1, "category_name" =>"kardiovaskularni-zpravodajstvi", "post_status" => "publish", 'fields' => 'ids');

           	$first_video_or_post_or_post = new  WP_Query($args_one_video_or_post);

            $post = $first_video_or_post_or_post->posts;

            $offset = 0;

            $query->set('post__not_in', $post);
		}
        if ( $query->is_main_query() && $query->is_category(  ) && $query->is_archive(  )  )
        {
            $text = array("empty");

            if (is_array(explode("/", $_SERVER['REQUEST_URI'])))
            {
                $text = array_filter(explode("/", $_SERVER['REQUEST_URI']));

            }
            // Manipulate $query here, for instance like so
			if(isset($_GET["page"]))
			{
                $page = $_GET["page"];

                if ( in_array("video", $text) )
                {
                    $page = ( ( $page - 1 ) * get_option("posts_per_page"));
                    $query->set( 'offset', $page );
                    return;
                }

                if ($page == 1)
				{
					$page = 2;
				}
                else
				{
                    $page = ( ( $page - 1 ) * get_option("posts_per_page")) + 2;
				}
				$query->set( 'offset', $page );
			}
			else if(strpos( $_SERVER['REQUEST_URI'], "?clanky-a-reportaze") or in_array("video", $text) )
			{
                $query->set( 'offset', 0 );
			}
            else if( get_term_meta( get_cat_ID($query->query["category_name"]), "_chi_selected_one_options")[0] == 2 )
            {
            	$args_three_latest_post_and_videos = array("post_type" => array("chi_video", "post"), "posts_per_page" => 3, "category_name" => $query->query["category_name"], "post_status" => "publish");

                $posts_and_videos = new  WP_Query($args_three_latest_post_and_videos);
                $ids_not_in_main_loop = wp_list_pluck( $posts_and_videos->posts, 'ID' );


                $exclude = get_term_meta( get_cat_ID($query->query["category_name"]), 'chi_selected_in_claim_posts', true );
                $query->set('post__not_in', $ids_not_in_main_loop );
            }
            else if( get_term_meta( get_cat_ID($query->query["category_name"]), "_chi_selected_one_options")[0] == 3 )
			{
				$exclude = get_term_meta( get_cat_ID($query->query["category_name"]), 'chi_selected_in_claim_posts', true );
                $query->set('post__not_in', array($exclude[0], $exclude[1], $exclude[2]));
			}
			else
			{
                $query->set( 'offset', $offset);
			}

        }
	}

}
add_action( 'pre_get_posts', "chi_category_main_query_offset" );
add_action( 'pre_get_posts', "chi_tag_add_post_type" );

function chi_tag_add_post_type( $query )
{
    if ( $query->is_main_query() )
	{
		if ( $query->is_tag() )
		{
            $query->set('post_type' , array("post", "chi_video"));
		}
	}
}

/**
 * Pagination
 */

function get_pagination_links()
{
    global $wp_query;
    if (isset($_GET["page"]))
	{
        $wp_query->query_vars['page'] > 1 ? $current = $wp_query->query_vars['page'] : $current = 1;
	}
    else
	{
		$current = 1;
	}

    return paginate_links(array(
        'base' => @add_query_arg('page', '%#%#ostatni-clanky'),
        'format' => '?page=%#%#ostatni-clanky',
        'current' => $current,
        'total' => $wp_query->max_num_pages,
        'prev_next' => true,
        'before_page_number'	=>'<span class="chi-page-link">',
        'after_page_number'		=> '</span>',
        'prev_text' => '',
        'next_text' => '<i class="chi-next-button"></i>'
    ));
}



function filter_post_type_link($link, $post)
{
    if ($post->post_type != 'chi_video')
        return $link;

    if ($cats = get_the_terms($post->ID, 'category'))
        $link = str_replace('%category%', array_pop($cats)->slug, $link);

    return $link;
}

add_filter('post_type_link', 'filter_post_type_link', 10, 2);


add_action('pre_get_posts', function($query) {
    if ( ! is_admin() && $query->is_main_query() ) {

        //var_dump( array_filter(explode("/", $_SERVER['REQUEST_URI']))[1] );
        $text = array("empty");
        if (is_array(explode("/", $_SERVER['REQUEST_URI'])))
        {
            $text = array_filter(explode("/", $_SERVER['REQUEST_URI']));
            //var_dump(array_filter(explode("/", $_SERVER['REQUEST_URI']))[1]);
        }

        if ( in_array("video", $text) )
        {
            if ( is_archive() || is_category() ) {
                $query->set( 'post_type', 'chi_video' );
				/*$query->set( 'offset', 0 );*/
				if (strpos( $_SERVER['REQUEST_URI'], "?clanky-a-reportaze"))
				{
                    $query->set( 'post_type', 'post' );
				}
            }
        }
    }
});



function get_url_var($name)
{
    $strURL = $_SERVER['REQUEST_URI'];
    $arrVals = explode("/",$strURL);
    $found = 0;
    foreach ($arrVals as $index => $value)
    {
        if($value == $name) $found = $index;
    }
    $place = $found + 1;
    return $arrVals[$place];
}



/* CATEGORY CHANGE CHECKBOX to RADIOBOX */
function admin_js() { ?>
    <script type="text/javascript">

		jQuery(document).ready( function () {
			jQuery('form#post').find('.categorychecklist input').each(function() {
				var new_input = jQuery('<input type="radio" />'),
				    attrLen = this.attributes.length;

				for (i = 0; i < attrLen; i++) {
					if (this.attributes[i].name != 'type') {
						new_input.attr(this.attributes[i].name.toLowerCase(), this.attributes[i].value);
					}
				}

				jQuery(this).replaceWith(new_input);
			});
		});

    </script>
<?php }

add_action('admin_head', 'admin_js');


function has_title_meta_box( $meta_box )
{
	if (isset($meta_box) && !empty($meta_box))
		return $meta_box . " – ";
	return "";
}


function chi_claims()
{

    $category = get_the_category()[0]->slug;


    $args_one_video = array("post_type" => array("chi_video", "post"), "posts_per_page" => 1, "category_name" => $category, "post_status" => "publish");
    $first_video = new  WP_Query($args_one_video);
    $ids_not_in_main_loop = wp_list_pluck( $first_video->posts, 'ID' );

    $args_two_posts = array("post_type" => array("post", "chi_video"), "posts_per_page" => 2, "category_name" => $category, "post__not_in" => [$ids_not_in_main_loop[0]]);

    $category_posts = new WP_Query($args_two_posts);
    $ids_not_in_main_loop = wp_list_pluck( $first_video->posts, 'ID' );
    $ids_not_in_main_loop[] = wp_list_pluck( $category_posts->posts, 'ID' );
    $ids_not_in_main_loop = array_merge($ids_not_in_main_loop, $ids_not_in_main_loop[1]);
    unset($ids_not_in_main_loop[1]);

    $ids_not_in_main_loop = array_values($ids_not_in_main_loop);

    return $ids_not_in_main_loop;

}


add_filter( 'body_class', function( $classes ) {
    if ( is_single() || is_category() ) {
        global $post;

        foreach( ( get_the_category( $post->ID ) ) as $category ) {
            $classes[] = 'special-' . $category->slug;
        }
    }

    return $classes;
} );



// Custom single template by category
// https://halgatewood.com/wordpress-custom-single-templates-by-category
// For single posts
add_filter('single_template', 'chi_check_for_category_single_template');
function chi_check_for_category_single_template( $t )
{
    foreach( (array) get_the_category() as $cat )
    {
    	if	(is_singular("chi_video"))
		{
            foreach( (array) get_the_category() as $cat )
            {
                if ( file_exists(STYLESHEETPATH . "/single-chi_video-category-{$cat->slug}.php") ) return STYLESHEETPATH . "/single-chi_video-category-{$cat->slug}.php";
                if($cat->parent)
                {
                    $cat = get_the_category_by_ID( $cat->parent );
                    if ( file_exists(STYLESHEETPATH . "/single-chi_video-category-{$cat->slug}.php") ) return STYLESHEETPATH . "/single-chi_video-category-{$cat->slug}.php";
                }
            }
            return $t;
		}

        if ( file_exists(STYLESHEETPATH . "/single-category-{$cat->slug}.php") ) return STYLESHEETPATH . "/single-category-{$cat->slug}.php";
        if($cat->parent)
        {
            $cat = get_the_category_by_ID( $cat->parent );
            if ( file_exists(STYLESHEETPATH . "/single-category-{$cat->slug}.php") ) return STYLESHEETPATH . "/single-category-{$cat->slug}.php";
        }
    }
    return $t;
}


// https://markjaquith.wordpress.com/2014/02/19/template_redirect-is-not-for-loading-templates/
function kardiovaskularni_zpravodajstvi_template_file( $template ) {

    if ( is_tax() )
    {

        $term   = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );

       $kardiovaskularni_zpravodajstvi_ID = 50;   // Taxnomie ID for "kardiovaskularni-zpravodajstvi"
		if ($term->parent)
		{
			if ($term->parent == $kardiovaskularni_zpravodajstvi_ID)
			{
                $new_template = locate_template( array( 'taxonomy-congress-kardiovaskularni-zpravodajstvi.php' ) );
                if ( '' != $new_template )
                {
                    return $new_template ;
                }
			}
		}
    }

    return $template;
}
add_filter( 'template_include', 'kardiovaskularni_zpravodajstvi_template_file', 99 );



// https://www.webhostinghero.com/how-to-share-a-draft-page-in-wordpress/?fbclid=IwAR1hn_xdoMmt80d8LHgGbqFtHUMMnQd_GKG94KW_MaAPpyoUb5tdobbYA5w
// https://designwithvalerie.com/share-draft-post-in-wordpress/

add_filter( 'posts_results', 'chi_set_query_to_draft', null, 2 );
function chi_set_query_to_draft( $posts, $query ) {

	if (!is_single())
	{
		return $posts;
	}
    if ( sizeof( $posts ) != 1 )
        return $posts;

    $post_status_obj = get_post_status_object(get_post_status( $posts[0]));

    if ( !$post_status_obj->name == 'draft' )
        return $posts;

    if (isset($_GET["key"])) {
        if ( $_GET['key'] != 'private_preview' )
            return $posts;
    }

    if (!isset($_GET['key'] ))
	{
		return $posts;
	}


    $query->_draft_post = $posts;

    add_filter( 'the_posts', 'show_draft_post', null, 2 );
}

function show_draft_post( $posts, $query ) {
    remove_filter( 'the_posts', 'show_draft_post', null, 2 );
    return $query->_draft_post;
}

add_filter("preview_post_link", "sctick_a_preview_link_key", 10);


function sctick_a_preview_link_key($preview_link)
{
	$preview_link = $preview_link . "&key=private_preview";

	return $preview_link;
}


// Add a <sup> and <sub> index to TinyMC
// from: https://wptavern.com/how-to-add-subscript-and-superscript-characters-in-wordpress
function chi_mce_buttons_2($buttons) {
    /**
     * Add in a core button that's disabled by defaultmce_buttons_2
	 *
	 */
    $buttons[] = 'Special character';
    $buttons[] = 'superscript';
    $buttons[] = 'subscript';


    return $buttons;


}


function chi_mce_buttons( $buttons )
{
    $buttons = "count";
	return $buttons;
}
//add_filter('mce_buttons_4', 'chi_mce_buttons');
//add_filter('mce_buttons_3', 'chi_mce_buttons');
add_filter('mce_buttons_2', 'chi_mce_buttons_2');
//add_filter('mce_buttons', 'chi_mce_buttons');

function lt_html_excerpt($text) { // Fakes an excerpt if needed
	global $post;
	if ( '' == $text ) {
		$text = get_the_content('');
		$text = apply_filters('the_content', $text);
		$text = str_replace('\]\]\>', ']]&gt;', $text);
		/*just add all the tags you want to appear in the excerpt --
		be sure there are no white spaces in the string of allowed tags */
		$text = strip_tags($text,'<p><br><b><a><em>');
		/* you can also change the length of the excerpt here, if you want */
		$excerpt_length = 15;
		$words = explode(' ', $text, $excerpt_length + 1);
		if (count($words)> $excerpt_length) {
			array_pop($words);
			array_push($words, '[...]');
			$text = implode(' ', $words);
		}

		$text = closetags( $text);
	}
	return $text;
}



/* remove the default filter */
//remove_filter('get_the_excerpt', 'wp_trim_excerpt');

/* now, add your own filter */
//add_filter('get_the_excerpt', 'lt_html_excerpt');

/* Plugin Name: My TinyMCE Buttons */
//add_action( 'admin_init', 'my_tinymce_button' );

function my_tinymce_button() {
    if ( current_user_can( 'edit_posts' ) && current_user_can( 'edit_pages' ) ) {
        //add_filter( 'mce_buttons', 'my_register_tinymce_button' );
        //add_filter( 'mce_external_plugins', 'my_add_tinymce_button' );
    }
}

function my_register_tinymce_button( $buttons ) {
    array_push( $buttons, "chi_stats", "button_green" );
    return $buttons;
}

function my_add_tinymce_button( $plugin_array ) {
    $plugin_array['my_button_script'] = THEME_DIRECTORY_URI . '/mybuttons.js';
    return $plugin_array;
}


/*
echo '<pre>';
print_r( $post->post_type );
echo '</pre>';
echo '<pre>';
print_r( mb_strlen( wp_strip_all_tags($post->post_content)) );
echo '</pre>';
*/

add_action( 'admin_print_footer_scripts', 'check_textarea_length' );
function check_textarea_length() {  ?>

	<script type="text/javascript">
		// jQuery ready fires too early, use window.onload instead

		window.onload = function () {


			// are we using visual editor?
			var visual = (typeof tinyMCE != "undefined") && tinyMCE.activeEditor && !tinyMCE.activeEditor.isHidden()?true:false;

			if(visual)
			{
				title_content = $("#title").val().replace(/(<([^>]+)>)/ig,'').replace(/&nbsp;/g, '').length ;
				editor_content = tinymce.get("content").getContent().replace(/(<([^>]+)>)/ig,'').replace(/&nbsp;/g, '').length;
				html_excerpt = tinymce.get("htmlExcerpt").getContent().replace(/(<([^>]+)>)/ig,'').replace(/&nbsp;/g, '').length;
				sum = title_content + editor_content + html_excerpt;


				jQuery('.mce-statusbar .mce-container-body')
					.append('<span class="word-count-message">' +
						'titulek: '+ title_content +' perex: '+ html_excerpt  +' hlavní obsah: '+ editor_content  +' SUM('+ sum +')'+
						'</span>');

				$("#title").on("keyup", function () {

					title_content = $("#title").val().replace(/(<([^>]+)>)/ig,'').replace(/&nbsp;/g, '').length ;
					editor_content = tinymce.get("content").getContent().replace(/(<([^>]+)>)/ig,'').replace(/&nbsp;/g, '').length;
					html_excerpt = tinymce.get("htmlExcerpt").getContent().replace(/(<([^>]+)>)/ig,'').replace(/&nbsp;/g, '').length;
					sum = title_content + editor_content + html_excerpt;

					jQuery('.word-count-message').remove();
					jQuery('.mce-statusbar .mce-container-body')
						.append('<span class="word-count-message">' +
							'titulek: '+ title_content +' perex: '+ html_excerpt  +' hlavní obsah: '+ editor_content  +' SUM('+ sum +')'+
							'</span>');

				});

				tinyMCEExcerpt = tinymce.get("htmlExcerpt");
				tinyMCEExcerpt.on('keyup', function(ed,e) {

					title_content = $("#title").val().replace(/(<([^>]+)>)/ig,'').replace(/&nbsp;/g, '').length ;
					editor_content = tinymce.get("content").getContent().replace(/(<([^>]+)>)/ig,'').replace(/&nbsp;/g, '').length;
					html_excerpt = tinymce.get("htmlExcerpt").getContent().replace(/(<([^>]+)>)/ig,'').replace(/&nbsp;/g, '').length;
					sum = title_content + editor_content + html_excerpt;

					jQuery('.word-count-message').remove();
					jQuery('.mce-statusbar .mce-container-body')
						.append('<span class="word-count-message">' +
							'titulek: '+ title_content +' perex: '+ html_excerpt  +' hlavní obsah: '+ editor_content  +' SUM('+ sum +')'+
							'</span>');
				});

				tinyMCE.activeEditor.on('keyup', function(ed,e) {

					title_content = $("#title").val().replace(/(<([^>]+)>)/ig,'').replace(/&nbsp;/g, '').length ;
					editor_content = tinymce.get("content").getContent().replace(/(<([^>]+)>)/ig,'').replace(/&nbsp;/g, '').length;
					html_excerpt = tinymce.get("htmlExcerpt").getContent().replace(/(<([^>]+)>)/ig,'').replace(/&nbsp;/g, '').length;
					sum = title_content + editor_content + html_excerpt;

					jQuery('.word-count-message').remove();
					jQuery('.mce-statusbar .mce-container-body')
						.append('<span class="word-count-message">' +
							'titulek: '+ title_content +' perex: '+ html_excerpt  +' hlavní obsah: '+ editor_content  +' SUM('+ sum +')'+
							'</span>');

				});
			}

		}
	</script>
	<style type="text/css">
		.wp_themeSkin .word-count-message { font-size:0.7em; display:none; float:right; color:#fff; font-weight:bold; margin-top:2px; }
		.wp_themeSkin .toomanychars .mce-statusbar { background:red; }

		.wp_themeSkin .toomanychars .word-count-message { display:block; }

	</style>
	<script>
		var clipboard = new ClipboardJS('#copy-url-button', {
			target: function() {
				return document.querySelector('a[data-clipboard-text]');
			}
		});
		var clipboardView = new ClipboardJS('#copy-url-button-view', {
			target: function() {
				return document.querySelector('a[data-clipboard-text]');
			}
		});
		clipboard.on('success', function(e) {
			console.log(e);
		});

		clipboard.on('error', function(e) {
			console.log(e);
		});

		clipboardView.on('success', function(e) {
			console.log(e);
		});

		clipboardView.clipboard.on('error', function(e) {
			console.log(e);
		});

	</script>
    <?php

}
?>

<?php


add_filter('get_sample_permalink_html', 'add_copyurl_to_clipboard');
add_action( 'admin_init', 'copy_to_clipboard_init' );
add_action('admin_enqueue_scripts', 'add_clipboard_path');

function copy_to_clipboard_init() {
    /* Register our script. */
    wp_register_script( 'zero-clipboard', THEME_DIRECTORY_URI . '/js/ZeroClipboard.min.js' );
    wp_register_script( 'zero-clipboard-main',  THEME_DIRECTORY_URI . '/js/main.js');
    wp_enqueue_script( 'zero-clipboard' );
    wp_enqueue_script( 'zero-clipboard-main', 'jquery' );

}

function add_clipboard_path(){
    wp_localize_script( 'zero-clipboard-main', 'ZeroClipboardSettings', array( 'path' => THEME_DIRECTORY_URI . '/js/clipboard.min.js',));
}

function add_copyurl_to_clipboard($return){
    global $post;
    if (get_post_status($post) == "publish" ) {
       $return .= sprintf("<span id='copy-url-btn'><a href='#' id=\"copy-url-button\" data-clipboard-text='%s' class='button button-small'>Kopírovat odkaz</a></span> ", get_permalink($post->ID));
    }
    $return .= sprintf("<span id='copy-url-btn-view'><a href='#' id=\"copy-url-button-view\" data-clipboard-text='%s' class='button button-small'>Kopírovat náhledový odkaz</a></span> ", get_site_url("","", "https") ."?p=$post->ID&preview=true&key=private_preview");

    return $return;
}

// Need to add filters for posts and pages.
//add_filter('page_row_actions','row_action_copy', 10, 2);
//add_filter('post_row_actions','row_action_copy', 10, 2);

function row_action_copy($actions, $post){
    $actions['copy_url'] = '<a href="#" data-clipboard-text="' . get_permalink($post->ID) . '" class="row-action-copy-url">Copy URL</a>';
    $actions['show_url'] = '<a href="#" data-clipboard-text="' . get_permalink($post->ID) . '" class="row-action-copy-url">W Copy URL</a>';
    return $actions;
}


/*

function draft_permalink( $post) {
    if (in_array($post->post_status, array('draft', 'pending', 'auto-draft'))) {
        $my_post = clone $post;
        $my_post->post_status = 'published';
        $my_post->post_name = sanitize_title($my_post->post_name ? $my_post->post_name : $my_post->post_title, $my_post->ID);
        $permalink = get_permalink($my_post);
    } else {
        $permalink = get_permalink();
    }

    return $permalink;
}

function get_draft_permalink( $url, $post, $leavename=false ) {

    if ( $post->post_status == 'draft' )
        $url = draft_permalink($post);

    return $url;
}
add_filter( 'post_link', 'get_draft_permalink', 10, 3 );
*/

add_filter( 'tiny_mce_before_init', 'tinymce_add_chars' );
function tinymce_add_chars( $settings ) {
    $new_chars = json_encode( array(
        array( '37;', '%' ),
        array( '8224', 'Dagger' ),
        array( '8230', 'Horizontal ellipsis' ),
        array( '8539', '1/8 Fraction' ),
        array( '8730', 'Square Root' ),
        array( '8818', 'Less than or equivalent to' ),
        array( '8819', 'Greater than or equivalent to' ),
        array( '0963', 'Sigma' ),
        array( '0956', 'Mu' ),
    ) );
    $settings['charmap_append'] = $new_chars;
    return $settings;
}


if (is_single( )) {
    $args = array(
    'post_type'  => 'chi_answer',
    'meta_key'   => 'question_id',
    'orderby'    => 'meta_value_num',
    'order'      => 'ASC',
    'meta_query' => array(
        array(
            'key'     => 'question_id',
            'value'   => '6532',
            'compare' => '=',
        ),
    ),
);

$query = new WP_Query( $args );
echo '<pre>';
print_r( $query );
echo '</pre>';
die();

}