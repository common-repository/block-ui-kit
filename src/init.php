<?php
/**
 * Blocks Initializer
 *
 * Enqueue CSS/JS of all the blocks.
 *
 * @since   1.0.0
 * @package CGB
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Enqueue Gutenberg block assets for both frontend + backend.
 *
 * Assets enqueued:
 * 1. blocks.style.build.css - Frontend + Backend.
 * 2. blocks.build.js - Backend.
 * 3. blocks.editor.build.css - Backend.
 *
 * @uses {wp-blocks} for block type registration & related functions.
 * @uses {wp-element} for WP Element abstraction — structure of blocks.
 * @uses {wp-i18n} to internationalize the block's text.
 * @uses {wp-editor} for WP editor styles.
 * @since 1.0.0
 */
function block_ui_kit_cgb_block_assets() { // phpcs:ignore
	// Register block styles for both frontend + backend.
	wp_register_style(
		'block_ui_kit-cgb-style-css', // Handle.
		plugins_url( 'dist/blocks.style.build.css', dirname( __FILE__ ) ), // Block style CSS.
		is_admin() ? array( 'wp-editor' ) : null, // Dependency to include the CSS after it.
		null // filemtime( plugin_dir_path( __DIR__ ) . 'dist/blocks.style.build.css' ) // Version: File modification time.
	);
	
	// Register block editor script for backend.
	wp_register_script(
		'block_ui_kit-cgb-block-js', // Handle.
		plugins_url( '/dist/blocks.build.js', dirname( __FILE__ ) ), // Block.build.js: We register the block here. Built with Webpack.
		array( 'wp-blocks', 'wp-i18n', 'wp-element', 'wp-editor' ), // Dependencies, defined above.
		null, // filemtime( plugin_dir_path( __DIR__ ) . 'dist/blocks.build.js' ), // Version: filemtime — Gets file modification time.
		true // Enqueue the script in the footer.
	);

	// Register block editor styles for backend.
	wp_enqueue_style(
		'block_ui_kit-cgb-block-editor-css', // Handle.
		plugins_url( 'dist/blocks.editor.build.css', dirname( __FILE__ ) ), // Block editor CSS.
		array( 'wp-edit-blocks' ), // Dependency to include the CSS after it.
		null // filemtime( plugin_dir_path( __DIR__ ) . 'dist/blocks.editor.build.css' ) // Version: File modification time.
	);
	wp_enqueue_style(
		'block_ui_kit-cgb-style-css', // Handle.
		plugins_url( 'dist/blocks.style.build.css', dirname( __FILE__ ) ), // Block style CSS.
		array( 'wp-editor' ) // Dependency to include the CSS after it.
		// filemtime( plugin_dir_path( __DIR__ ) . 'dist/blocks.style.build.css' ) // Version: filemtime — Gets file modification time.
	);
	// WP Localized globals. Use dynamic PHP stuff in JavaScript via `cgbGlobal` object.
	wp_localize_script(
		'block_ui_kit-cgb-block-js',
		'cgbGlobal', // Array containing dynamic data for a JS Global.
		[
			'pluginDirPath' => plugin_dir_path( __DIR__ ),
			'pluginDirUrl'  => plugin_dir_url( __DIR__ ),
			// Add more data here that you want to access from `cgbGlobal` object.
		]
	);

	/**
	 * Register Gutenberg block on server-side.
	 *
	 * Register the block on server-side to ensure that the block
	 * scripts and styles for both frontend and backend are
	 * enqueued when the editor loads.
	 *
	 * @link https://wordpress.org/gutenberg/handbook/blocks/writing-your-first-block-type#enqueuing-block-scripts
	 * @since 1.16.0
	 */
	register_block_type(
		'cgb/block-block-ui-kit', array(
			// Enqueue blocks.style.build.css on both frontend & backend.
			'style'         => 'block_ui_kit-cgb-style-css',
			// Enqueue blocks.build.js in the editor only.
			'editor_script' => 'block_ui_kit-cgb-block-js',
			// Enqueue blocks.editor.build.css in the editor only.
			'editor_style'  => 'block_ui_kit-cgb-block-editor-css',
		)
	);
}

// Hook: Block assets.
add_action( 'init', 'block_ui_kit_cgb_block_assets' );
/**
 * @internal never define functions inside callbacks.
 * these functions could be run multiple times; this would result in a fatal error.
 */

/**
 * custom option and settings
 */

function block_ui_kit_settings_init() {
	// Register a new setting for "block_ui_kit" page.
	register_setting( 'block_ui_kit', 'block_ui_kit_options' );

	// Register a new section in the "block_ui_kit" page.
	

	// Register a new field in the "block_ui_kit_section_developers" section, inside the "block_ui_kit" page.
	
}

/**
 * Register our block_ui_kit_settings_init to the admin_init action hook.
 */
add_action( 'admin_init', 'block_ui_kit_settings_init' );


/**
 * Custom option and settings:
 *  - callback functions
 */


/**
 * Developers section callback function.
 *
 * @param array $args  The settings array, defining title, id, callback.
 */


/**
 * Pill field callbakc function.
 *
 * WordPress has magic interaction with the following keys: label_for, class.
 * - the "label_for" key value is used for the "for" attribute of the <label>.
 * - the "class" key value is used for the "class" attribute of the <tr> containing the field.
 * Note: you can add custom key value pairs to be used inside your callbacks.
 *
 * @param array $args
 */


/**
 * Add the top level menu page.
 */
function block_ui_kit_options_page() {
	add_menu_page(
		'Block UI Kit',
		'Block UI Kit',
		'manage_options',
		'block_ui_kit',
		'block_ui_kit_options_page_html'
	);
}


/**
 * Register our block_ui_kit_options_page to the admin_menu action hook.
 */
add_action( 'admin_menu', 'block_ui_kit_options_page' );


/**
 * Top level menu callback function
 */
function block_ui_kit_options_page_html() {
	// check user capabilities
	if ( ! current_user_can( 'manage_options' ) ) {
		return;
	}

	// add error/update messages

	// check if the user have submitted the settings
	// WordPress will add the "settings-updated" $_GET parameter to the url
	if ( isset( $_GET['settings-updated'] ) ) {
		// add settings saved message with the class of "updated"
		add_settings_error( 'block_ui_kit_messages', 'block_ui_kit_message', __( 'Settings Saved', 'block_ui_kit' ), 'updated' );
	}

	// show error/update messages
	settings_errors( 'block_ui_kit_messages' );
	?>
	<div class="wrap">
		<h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
		<form method="post" action="options.php">
            <?php
               settings_fields("section");
 
               do_settings_sections("bootCSS");
               echo "<p>If checked, then Bootstrap CSS will be inserted into the head of your website. </p>";

               do_settings_sections("bootjs");
               echo "<p>If checked, then Bootstrap JS will automatically be inserted into the footer of your website.</p>";  
              

               do_settings_sections("bootjquery");
               echo "<p>If checked, then Wordpress Bundled jQuery will be loaded</p>";  
               submit_button();
            ?>
        </form>
	</div>
	<?php
}


// add_settings_section(
// 	'eg_setting_section',
// 	'Example settings section in reading',
// 	'eg_setting_section_callback_function',
// 	'reading'
// );
// function eg_setting_section_callback_function( $arg ) {
// 	// echo section intro text here
// 	echo '<p>id: ' . $arg['id'] . '</p>';             // id: eg_setting_section
// 	echo '<p>title: ' . $arg['title'] . '</p>';       // title: Example settings section in reading
// 	echo '<p>callback: ' . $arg['callback'] . '</p>'; // callback: eg_setting_section_callback_function
// }




function buikCSS_settings_page()
{
    add_settings_section("section", '<div style="font-size:16px;margin-top:20px;">Bootstrap CSS & JS Setting</div>',  null , "bootCSS");

    add_settings_field("bootCSS-checkbox", "Include Bootstrap CSS?", "buik_checkbox_display", "bootCSS", "section");  
    register_setting("section", "bootCSS-checkbox");

}
function buikjs_settings_page()
{

    
    add_settings_section("section", null, null, "bootjs");
    add_settings_field("bootjs-checkbox", "Include Bootstrap Javascripts?", "buikjs_checkbox_display", "bootjs", "section");  
    register_setting("section", "bootjs-checkbox");
}
function buikjquery_settings_page()
{

    
    add_settings_section("section", null, null, "bootjquery");
    add_settings_field("bootjquery-checkbox", "Include jQuery?", "buikjquery_checkbox_display", "bootjquery", "section");  
    register_setting("section", "bootjquery-checkbox");
}



function buik_checkbox_display()
{
   ?>
   
        <!-- Here we are comparing stored value with 1. Stored value is 1 if user checks the checkbox otherwise empty string. -->
		
        <input type="checkbox" name="bootCSS-checkbox" value="1" <?php checked(1, get_option('bootCSS-checkbox'), true); ?> />
   <?php
}

add_action("admin_init", "buikCSS_settings_page");

function buikjs_checkbox_display()
{
   ?>
        <!-- Here we are comparing stored value with 1. Stored value is 1 if user checks the checkbox otherwise empty string. -->
        <input type="checkbox" name="bootjs-checkbox" value="1" <?php checked(1, get_option('bootjs-checkbox'), true); ?> />
   <?php
}


add_action("admin_init", "buikjs_settings_page");

function buikjquery_checkbox_display()
{
   ?>
        <!-- Here we are comparing stored value with 1. Stored value is 1 if user checks the checkbox otherwise empty string. -->
        <input type="checkbox" name="bootjquery-checkbox" value="1" <?php checked(1, get_option('bootjquery-checkbox'), true); ?> />
   <?php
}


add_action("admin_init", "buikjquery_settings_page");
	
$bootCSS = get_option('bootCSS-checkbox', '');
if($bootCSS == '1') {
    wp_enqueue_style( 'bootstrapCSS', plugin_dir_url( __FILE__ ) . '../assets/css/bootstrap.min.css',true,'4.6.2','all');
} 

$bootjquery = get_option('bootjquery-checkbox', '');
if($bootjquery == '1') {
    wp_enqueue_script( 'jquery', plugin_dir_url( __FILE__ ) . '/wp-includes/js/jquery/jquery.js',true,'3.6.0','all');
    //wp_add_inline_script( 'jquery', 'var jQuery = $.noConflict(true);' );
}

$bootjs = get_option('bootjs-checkbox', '');
if($bootjs == '1') {
    wp_enqueue_script( 'bootstrapjs', plugin_dir_url( __FILE__ ) . '../assets/js/bootstrap.bundle.min.js',true,'4.6.2','all');
  

}





