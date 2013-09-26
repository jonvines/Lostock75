<?php
	/**
	 * Starkers functions and definitions
	 *
	 * For more information on hooks, actions, and filters, see http://codex.wordpress.org/Plugin_API.
	 *
 	 * @package 	WordPress
 	 * @subpackage 	Starkers
 	 * @since 		Starkers 4.0
	 */

	/* ========================================================================================================================
	
	Required external files
	
	======================================================================================================================== */

	require_once( 'external/starkers-utilities.php' );

	/* ========================================================================================================================
	
	Theme specific settings

	Uncomment register_nav_menus to enable a single menu with the title of "Primary Navigation" in your theme
	
	======================================================================================================================== */

	add_theme_support('post-thumbnails');
	
	register_nav_menus(array('primary' => 'Primary Navigation'));
    /**
     * Registers two widget areas.
     *
     * @since Twenty Thirteen 1.0
     *
     * @return void
     */
    function lostock_widgets_init() {
	    register_sidebar( array(
		    'name'          => __( 'Main Widget Area', 'Lostock' ),
		    'id'            => 'sidebar-1',
		    'description'   => __( 'Appears in the sidebar section of the site.', 'Lostock' ),
		    'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		    'after_widget'  => '</aside>',
		    'before_title'  => '<h2 class="widget-title">',
		    'after_title'   => '</h2>',
	    ) );
        register_sidebar( array(
		    'name'          => __( 'Front Widget Area', 'Lostock' ),
		    'id'            => 'front-sidebar-1',
		    'description'   => __( 'Appears in the front page of the site.', 'Lostock' ),
		    'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		    'after_widget'  => '</aside>',
		    'before_title'  => '<h3 class="widget-title">',
		    'after_title'   => '</h3>',
	    ) );
        register_sidebar( array(
		    'name'          => __( 'Comments Widget Area', 'Lostock' ),
		    'id'            => 'comments-sidebar-1',
		    'description'   => __( 'Appears in the left sidebar of the site.', 'Lostock' ),
		    'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		    'after_widget'  => '</aside>',
		    'before_title'  => '<h2 class="widget-title">',
		    'after_title'   => '</h2>',
	    ) );
    }
    add_action( 'widgets_init', 'lostock_widgets_init' );

	/* ========================================================================================================================
	
	Actions and Filters
	
	======================================================================================================================== */

	add_action( 'wp_enqueue_scripts', 'starkers_script_enqueuer' );

	add_filter( 'body_class', array( 'Starkers_Utilities', 'add_slug_to_body_class' ) );

	/* ========================================================================================================================
	
	Custom Post Types - include custom post types and taxonimies here e.g.

	e.g. require_once( 'custom-post-types/your-custom-post-type.php' );
	
	======================================================================================================================== */

    // Register people contact
    add_action('init', 'construction_register');

    function construction_register() {
 
	    $labels = array(
		    'name' => _x('Construction', 'post type general name'),
		    'singular_name' => _x('Construction', 'post type singular name'),
		    'add_new' => _x('Add New', 'Construction'),
		    'add_new_item' => __('Add New Construction'),
		    'edit_item' => __('Edit Construction'),
		    'new_item' => __('New Construction'),
		    'view_item' => __('View Construction'),
		    'search_items' => __('Search Construction'),
		    'not_found' =>  __('Nothing found'),
		    'not_found_in_trash' => __('Nothing found in Trash'),
		    'parent_item_colon' => ''
	    );
 
	    $args = array(
		    'labels' => $labels,
		    'public' => true,
		    'publicly_queryable' => true,
		    'show_ui' => true,
		    'query_var' => true,
		    'rewrite' => true,
		    'capability_type' => 'post',
		    'hierarchical' => false,
		    'menu_position' => 5,
		    'supports' => array('title','excerpt','editor','thumbnail','page-attributes'),
		    'taxonomies' => array('category', 'post_tag') // this is IMPORTANT
	      ); 
 
	    register_post_type( 'construction' , $args );
    }

	/* ========================================================================================================================
	
	Scripts
	
	======================================================================================================================== */

	/**
	 * Add scripts via wp_head()
	 *
	 * @return void
	 * @author Keir Whitaker
	 */

	function starkers_script_enqueuer() {
		wp_register_script( 'site', get_template_directory_uri().'/js/site.js', array( 'jquery' ) );
		wp_enqueue_script( 'site' );

		wp_register_style( 'screen', get_stylesheet_directory_uri().'/style.css', '', '', 'screen' );
        wp_enqueue_style( 'screen' );
	}	

	/* ========================================================================================================================
	
	Comments
	
	======================================================================================================================== */

	/**
	 * Custom callback for outputting comments 
	 *
	 * @return void
	 * @author Keir Whitaker
	 */
	function starkers_comment( $comment, $args, $depth ) {
		$GLOBALS['comment'] = $comment; 
		?>
		<?php if ( $comment->comment_approved == '1' ): ?>	
		<li>
			<article id="comment-<?php comment_ID() ?>">
				<?php echo get_avatar( $comment ); ?>
				<h4><?php comment_author_link() ?></h4>
				<time><a href="#comment-<?php comment_ID() ?>" pubdate><?php comment_date() ?> at <?php comment_time() ?></a></time>
				<?php comment_text() ?>
			</article>
		<?php endif;
	}

    function change_post_menu_label() {
	    global $menu;
	    global $submenu;
	    $menu[5][0] = 'News';
	    $submenu['edit.php'][5][0] = 'News';
	    $submenu['edit.php'][10][0] = 'Add News';
	    $submenu['edit.php'][16][0] = 'News Tags';
	    echo '';
    }
    function change_post_object_label() {
	    global $wp_post_types;
	    $labels = &$wp_post_types['post']->labels;
	    $labels->name = 'News';
	    $labels->singular_name = 'News';
	    $labels->add_new = 'Add News';
	    $labels->add_new_item = 'Add News';
	    $labels->edit_item = 'Edit News';
	    $labels->new_item = 'News';
	    $labels->view_item = 'View News';
	    $labels->search_items = 'Search News';
	    $labels->not_found = 'No News found';
	    $labels->not_found_in_trash = 'No News found in Trash';
    }
    add_action( 'init', 'change_post_object_label' );
    add_action( 'admin_menu', 'change_post_menu_label' );

    // custom image sizes
    if ( function_exists( 'add_image_size' ) ) { 
	    add_image_size( 'construction-thumb', 450, 262, true ); //(cropped)
    }