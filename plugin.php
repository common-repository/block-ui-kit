<?php
/**
 * Plugin Name: Block UI Kit
 * Plugin URI: https://gutenberglab.com/
 * Description: block-ui-kit For gutenberg editor
 * Author: GutenbergLab.com
 * Author URI: https://profiles.wordpress.org/gutenberglabcom/
 * Version: 1.0.7
 * License: GPL2+
 * License URI: https://www.gnu.org/licenses/gpl-2.0.txt
 *
 * @package CGB
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Block Initializer.
 */
require_once plugin_dir_path( __FILE__ ) . 'src/init.php';

function wpb_author_admin_notice(){
    global $pagenow;
    if ( $pagenow == 'index.php' ) {
    $user = wp_get_current_user();
    if ( in_array( 'administrator', (array) $user->roles ) ) {
    echo '<div class="notice notice-info is-dismissible">
          <p>Thank you for installing <b>Block UI Kit plugin</b>. If you like our plugin, please leave a review  <a href="https://wordpress.org/support/plugin/block-ui-kit/reviews/#new-post" target="_blank">here</a>. If you want to buy the pro version, <a href="https://gutenberglab.com" target="_blank">click here</a>. Get 20% off, use discount coupon "20%off" (Offer available until Dec 31st, 2022) </p>
         </div>';
    }
}
}
add_action('admin_notices', 'wpb_author_admin_notice');


function block_ui_kit_category( $categories ) {
    return array_merge(
        array(
            array(
                'slug' => 'block-ui-kit',
				'title' => __( 'Block UI Kit', 'Block UI Kit' ),
            ),
        ),
        $categories
    );
}
add_filter( 'block_categories', 'block_ui_kit_category', 10, 2 );


wp_enqueue_script(
    'ppath',
    plugins_url( 'assets/', __FILE__ ),
    array( 'wp-blocks', 'wp-i18n', 'wp-element', 'wp-editor', 'wp-components' ),
    '20190804',
    true
);
wp_localize_script( 'ppath', 'preview',
    array(
        'Container' => plugins_url( 'assets/img/preview/container.jpg', __FILE__ ),
		'Row' => plugins_url( 'assets/img/preview/row.jpg', __FILE__ ),
        'Column' => plugins_url( 'assets/img/preview/column.jpg', __FILE__ ),
        'Lead' => plugins_url( 'assets/img/preview/lead.jpg', __FILE__ ),
        'Blockquote' => plugins_url( 'assets/img/preview/blockquote.jpg', __FILE__ ),
        'Jumbotron' => plugins_url( 'assets/img/preview/jumbotron.jpg', __FILE__ ),
        'Accordion' => plugins_url( 'assets/img/preview/accordion.jpg', __FILE__ ),
        'Carousal' => plugins_url( 'assets/img/preview/carousal.jpg', __FILE__ ),
        'Card' => plugins_url( 'assets/img/preview/card.jpg', __FILE__ ),
        'Faq1' => plugins_url( 'assets/img/preview/faq1.jpg', __FILE__ ),
        'Faq2' => plugins_url( 'assets/img/preview/faq2.jpg', __FILE__ ),
        'Faq3' => plugins_url( 'assets/img/preview/faq3.jpg', __FILE__ ),
        'Modal' => plugins_url( 'assets/img/preview/modal.jpg', __FILE__ ),
        'Infobox' => plugins_url( 'assets/img/preview/infobox.jpg', __FILE__ ),
        'Hero1' => plugins_url( 'assets/img/preview/hero1.jpg', __FILE__ ),
        'Hero2' => plugins_url( 'assets/img/preview/hero2.jpg', __FILE__ ),
        'Hero3' => plugins_url( 'assets/img/preview/hero3.jpg', __FILE__ ),
        'Cta1' => plugins_url( 'assets/img/preview/cta1.jpg', __FILE__ ),
        'Cta2' => plugins_url( 'assets/img/preview/cta2.jpg', __FILE__ ),
        'Cta3' => plugins_url( 'assets/img/preview/cta3.jpg', __FILE__ ),
        'Cta4' => plugins_url( 'assets/img/preview/cta4.jpg', __FILE__ ),
        'Cta5' => plugins_url( 'assets/img/preview/cta5.jpg', __FILE__ ),
        'Cta6' => plugins_url( 'assets/img/preview/cta6.jpg', __FILE__ ),
        'Cta7' => plugins_url( 'assets/img/preview/cta7.jpg', __FILE__ ),
        'Cta8' => plugins_url( 'assets/img/preview/cta8.jpg', __FILE__ ),
        'Testimonial1' => plugins_url( 'assets/img/preview/testimonial1.jpg', __FILE__ ),
        'Team1' => plugins_url( 'assets/img/preview/team1.jpg', __FILE__ ),
    )
);