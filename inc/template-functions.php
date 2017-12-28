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
		'has_archive' => false,
		'publicly_queryable' => true,
		'query_var' => true,
		'supports' => ['title', 'thumbnail', 'editor']
	];

	register_post_type('fan', $args); // small letters
}

add_action('init', 'fan_cpt_register');

function img_post_custom_metabox() {

    add_meta_box(
        'img_pos',
        __( 'Featured Image position' ),
        'fan_img_meta_callback',
        'fan',
        'side',
        'low'
    );
}
add_action( 'add_meta_boxes', 'img_post_custom_metabox' );

function img_url_custom_metabox() {

    add_meta_box(
        'fan_img_url',
        __( 'Photo Link' ),
        'fan_img_url_meta_callback',
        'fan',
        'side',
        'low'
    );
}
add_action( 'add_meta_boxes', 'img_url_custom_metabox' );

function fan_img_url_meta_callback( $post ) {
    wp_nonce_field( basename( __FILE__ ), 'img_form' );
    $img_pos = get_post_meta( $post->ID );

    $fan_img_link = (!empty($img_pos['fan_img_link']) ? esc_attr(  $img_pos['fan_img_link'][0]  ) : null);
    $fan_email = (!empty($img_pos['fan_email']) ? esc_attr(  $img_pos['fan_email'][0]  ) : null);

    ?>

    <div>
        <div class="form__group">
            <input type="text" name="fan_img_link" id="fan_img_link" class="form__control" placeholder="Link" value="<?php echo $fan_img_link; ?>">
        </div>
        <div class="form__group">
            <input type="text" name="fan_email" id="fan_email" class="form__control" placeholder="Email" value="<?php echo $fan_email; ?>">
        </div>
    </div>

    <?php 
}

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
    if ( isset( $_POST[ 'fan_email' ] ) ) {
        update_post_meta( $post_id, 'fan_email', sanitize_text_field( $_POST[ 'fan_email' ] ) );
    }
    if ( isset( $_POST[ 'fan_img_link' ] ) ) {
        update_post_meta( $post_id, 'fan_img_link', sanitize_text_field( $_POST[ 'fan_img_link' ] ) );
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



// Default value for post like count

function addDefaultMetaValue($post_id) {
    add_post_meta($post_id, '_post_like_count', 0, true);
}
add_action('save_post_fans', 'addDefaultMetaValue');


// form 

function my_enqueue() {

    if ( is_page( 'submit' ) ) {

      wp_enqueue_script( 'ajax-script', get_template_directory_uri() . '/js/user-data.js', NULL, 1.0, true);
      
    //   wp_localize_script('ajax-script', 'magicalData', array(
    //       'nonce' => wp_create_nonce('wp_rest'),
    //       'siteURL' => get_site_url()
    //   ));

    wp_localize_script( 'ajax-script', 'my_ajax_object',
        array( 
            'ajax_url' => admin_url( 'admin-ajax.php' ),
            'nonce' => wp_create_nonce('user-submitted')
        ) );
    } 
}
add_action( 'wp_enqueue_scripts', 'my_enqueue' );

function process_user_generated_post() {

    // check_ajax_referer( 'user-submitted-inquiry', 'security' );
    check_ajax_referer( 'user-submitted', 'security' );


    // var_dump($_POST['security']);

  $response_code = $_POST['captcha'];

  $arr = [
      'secret' => '6LccYT4UAAAAAJ38F9VZ0nJvbJ8G3MWkYdjxB67r',
      'response' => $response_code
  ];


  function curl($url, $parameters) {
      
      $ch = curl_init();
      curl_setopt($ch, CURLOPT_URL, $url);
      curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($parameters));
      curl_setopt($ch, CURLOPT_POST, true);

      $headers = [];
      $headers[] = "Content-Length:" . strlen(http_build_query($parameters));

      curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
      return curl_exec($ch);
  }

  $returned = curl("https://www.google.com/recaptcha/api/siteverify", $arr);

//   var_dump($returned);


  $data = json_decode($returned);
  $check = $data->success;

//   var_dump($check);


  if($check) {

    $email = sanitize_email($_POST['email']);

      $question_data = array(
          'post_title' => sanitize_text_field( $_POST[ 'name' ] ),
          'post_status' => 'draft',
          'post_type' => 'fan',
          'post_content' =>  sprintf('%s %s', 
              '<br> Email Address: ' . sanitize_text_field( $email ),
              '<br> Description: ' . sanitize_text_field( $_POST[ 'message' ]))
      );


        $post_id = wp_insert_post( $question_data, true );

        if ( $post_id ) {
            update_post_meta($post_id, 'fan_img_link', sanitize_text_field( $_POST[ 'link' ]));
            update_post_meta($post_id, 'fan_img_link', sanitize_text_field( $_POST[ 'link' ]));
        }

    //   if ( $post_id ) {
    //       wp_set_object_terms(
    //           $post_id,
    //           sanitize_text_field( $_POST[ 'type' ] ),
    //           'type',
    //           true
    //       );
    //       update_post_meta( $post_id, 'contact_email', sanitize_email( $_POST[ 'data' ][ 'type' ] ) );
    //   }

      wp_send_json_success( $post_id );

      wp_die();
      
  }
  
}
add_action( 'wp_ajax_process_user_generated_post', 'process_user_generated_post' );
add_action( 'wp_ajax_nopriv_process_user_generated_post', 'process_user_generated_post' );


function register_user_inquiry() {
    $labels = [
        'name' => 'Messages',
        'singular_name' => 'Message',
        'add_new_item' => 'Add New Message',
        'edit_item' => 'Edit Message'
    ];

    $args = [
        'labels'                => $labels,
        'show_ui'               => true,
        'show_in_rest'          => true,
        'public'                => true,
        'has_archive'           => true,
        'publicly_queryable'    => true,
        'query_var'             => true,
        'menu_icon'             => 'dashicons-admin-comments',
        'supports'              => ['title', 'editor']
    ];

    register_post_type('message', $args);
}

add_action('init', 'register_user_inquiry');



// adds global seo input fields

function global_meta_box() {

    $screens = get_post_types( array('public' => true) );

    foreach ( $screens as $screen ) {
        add_meta_box(
            'global_meta',
            __( 'SEO' ),
            'global_meta_box_callback',
            $screen,
            'normal'
        );
    }
}

add_action( 'add_meta_boxes', 'global_meta_box' );

function global_meta_box_callback($post) {

    wp_nonce_field( basename( __FILE__ ), 'global_meta_seo' );
    $globals = get_post_meta( $post->ID );

    $seo_title = !empty( $globals['seo_title'] ) ? esc_attr(  $globals['seo_title'][0]  ) : null;
    $meta_desc = !empty( $globals['meta_desc'] ) ? esc_attr(  $globals['meta_desc'][0]  ) : null;


    ?>

    <div>
        <div class="form__group">
            <input type="text" name="seo_title" id="seo_title" class="form__control" placeholder="SEO title" value="<?php echo $seo_title; ?>"> 
        </div>
        <div class="form__group">
            <textarea name="meta_desc" id="meta_desc" cols="30" rows="5" class="form__control" placeholder="Meta Description" ><?php echo $meta_desc; ?></textarea>
        </div>
    </div>


    <?php 
}

function global_meta_save( $post_id) {
    $is_autosave = wp_is_post_autosave( $post_id );
    $is_revision = wp_is_post_revision( $post_id );
    $is_valid_nonce = ( isset( $_POST[ 'global_meta_seo' ] ) && wp_verify_nonce( $_POST[ 'global_meta_seo' ], basename( __FILE__ ) ) ) ? 'true' : 'false';


    if ( $is_autosave || $is_revision || !$is_valid_nonce ) {
        return;
    }

    if ( isset( $_POST[ 'meta_desc' ] ) ) {
        update_post_meta( $post_id, 'meta_desc', sanitize_text_field( $_POST[ 'meta_desc' ] ) );
    }
    if ( isset( $_POST[ 'seo_title' ] ) ) {
        update_post_meta( $post_id, 'seo_title', sanitize_text_field( $_POST[ 'seo_title' ] ) );
    }
}
add_action( 'save_post', 'global_meta_save' );

// Submit page option

function submit_option_meta()
{
    global $post;

    if($post->post_name == 'submit')
    {

  
        add_meta_box(
            'submit_page_opt_meta', // $id
            'Submittion', // $title
            'submit_option_meta_callback', // $callback
            'page', // $page
            'side', // $context
            'high'); // $priority
        
    }
}
add_action('add_meta_boxes', 'submit_option_meta');

function submit_option_meta_callback($post) {
    wp_nonce_field( basename( __FILE__ ), 'submit_opt_nonce' );

    $sub_meta = get_post_meta( $post->ID );

    $submit_opt = !empty( $sub_meta['submit_opt'] ) ? esc_attr(  $sub_meta['submit_opt'][0]  ) : null;

    ?>
        <select name="submit_opt" id="submit_opt" class="form__control">
            <option value="0"<?php echo $submit_opt == 0 ? 'selected' : '' ?> > Open</option>
            <option value="1"<?php echo $submit_opt == 1 ? 'selected' : '' ?> > Close</option>
        </select>
    <?php
}

function submit_option_meta_save( $post_id) {
    $is_autosave = wp_is_post_autosave( $post_id );
    $is_revision = wp_is_post_revision( $post_id );
    $is_valid_nonce = ( isset( $_POST[ 'submit_opt_nonce' ] ) && wp_verify_nonce( $_POST[ 'submit_opt_nonce' ], basename( __FILE__ ) ) ) ? 'true' : 'false';


    if ( $is_autosave || $is_revision || !$is_valid_nonce ) {
        return;
    }

    if ( isset( $_POST[ 'submit_opt' ] ) ) {
        update_post_meta( $post_id, 'submit_opt', sanitize_text_field( $_POST[ 'submit_opt' ] ) );
    }
}
add_action( 'save_post', 'submit_option_meta_save' );



function my_custom_fonts() {
    echo '<style>
        .form__group {
            margin-bottom: 10px;
        }
        .form__control {
            width: 100%;
            padding: 7px 10px;
        } 
    </style>';
}

add_action('admin_head', 'my_custom_fonts');