<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package mybtsarmy
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function mybtsarmy_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	return $classes;
}
add_filter( 'body_class', 'mybtsarmy_body_classes' );


function bts_member_register() {
	$labels = [
		'name' => 'BTS Members',
		'singular_name' => 'BTS Member',
		'add_new_item' => 'Add New Member',
		'edit_item' => 'Edit Member'
	];

	$args = [
		'labels' => $labels,
		'show_ui' => true,
		'public' => true,
		'has_archive' => true,
		'publicly_queryable' => true,
		'query_var' => true,
		'supports' => ['title', 'thumbnail', 'editor']
	];

	register_post_type('btsmember', $args); // small letters
}

add_action('init', 'bts_member_register');


function fan_cpt_register() {
	$labels = [
		'name' => 'Fans',
		'singular_name' => 'Fan',
		'add_new_item' => 'Add New Fan',
		'edit_item' => 'Edit Fan'
	];

	$args = [
		'labels' => $labels,
		'show_ui' => true,
		'public' => true,
		'has_archive' => true,
		'publicly_queryable' => true,
		'query_var' => true,
		'supports' => ['title', 'thumbnail', 'editor']
	];

	register_post_type('fans', $args); // small letters
}

add_action('init', 'fan_cpt_register');

function work_custom_metabox() {

    add_meta_box(
        'img_pos',
        __( 'Featured Image position' ),
        'fan_img_meta_callback',
        'fans',
        'side',
        'low'
    );
}
add_action( 'add_meta_boxes', 'work_custom_metabox' );

function fan_img_meta_callback( $post ) {
    wp_nonce_field( basename( __FILE__ ), 'img_form' );
    $img_pos = get_post_meta( $post->ID );


    $hor = (!empty($img_pos['hor']) ? esc_attr(  $img_pos['hor'][0]  ) : null);
    $ver = (!empty($img_pos['ver']) ? esc_attr(  $img_pos['ver'][0]  ) : null);
    ?>

    <div>
        <div class="form__group">
            <input type="text" name="hor" id="hor" class="form__control" placeholder="Horizontal" value="<?php echo $hor; ?>"> 
            <input type="text" name="ver" id="ver" class="form__control" placeholder="Vertical" value="<?php echo $ver; ?>">
        </div>




    </div>


    <?php 
}

function fan_img_meta_save( $post_id) {
    $is_autosave = wp_is_post_autosave( $post_id );
    $is_revision = wp_is_post_revision( $post_id );
    $is_valid_nonce = ( isset( $_POST[ 'img_form' ] ) && wp_verify_nonce( $_POST[ 'img_form' ], basename( __FILE__ ) ) ) ? 'true' : 'false';


    if ( $is_autosave || $is_revision || !$is_valid_nonce ) {
        return;
    }

    if ( isset( $_POST[ 'hor' ] ) ) {
        update_post_meta( $post_id, 'hor', sanitize_text_field( $_POST[ 'hor' ] ) );
    }
    if ( isset( $_POST[ 'ver' ] ) ) {
        update_post_meta( $post_id, 'ver', sanitize_text_field( $_POST[ 'ver' ] ) );
    }
}
add_action( 'save_post', 'fan_img_meta_save' );


function getPostViews($postID){
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
        return "0";
    }
    return $count;
}
 
// function to count views.
function setPostViews($postID) {
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        $count = 0;
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
    }else{
        $count++;
        update_post_meta($postID, $count_key, $count);
    }
}



/**
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 */
function mybtsarmy_pingback_header() {
	if ( is_singular() && pings_open() ) {
		echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
	}
}
add_action( 'wp_head', 'mybtsarmy_pingback_header' );

function list_body_class( $wp_classes, $extra_classes )
{
    // List of the only WP generated classes allowed
    // $whitelist = array( 'home', 'blog', 'archive', 'single', 'category', 'tag', 'error404', 'logged-in', 'admin-bar' );

    // List of the only WP generated classes that are not allowed
    $blacklist = array( 'blog' , 'hfeed');

    // Filter the body classes
    // Whitelist result: (comment if you want to blacklist classes)
    // $wp_classes = array_intersect( $wp_classes, $whitelist );
    // Blacklist result: (uncomment if you want to blacklist classes)
    $wp_classes = array_diff( $wp_classes, $blacklist );

    // Add the extra classes back untouched
    return array_merge( $wp_classes, (array) $extra_classes );
}
add_filter( 'body_class', 'list_body_class', 10, 2 );



require get_template_directory() . '/inc/post-like.php';