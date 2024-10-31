<?php

/**
 * Plugin Name: Quick Age Verification
 * Description: Verify the age of website users.
 * Version: 1.1.2
 * Author: Gerhard Kocher
 * Author URI: https://cookers.at/development
 */

include "qav_options.php";



function qav_initialization() {
    if(isset($_COOKIE['is_over_18'])) return;

    wp_enqueue_style('age_verif_css', plugins_url('age_verif.css',__FILE__ ), null, "1.1.2");
    wp_enqueue_script('age_verif_js', plugins_url('age_verif.js',__FILE__ ), array('jquery'), "1.1.2c", true);
}
add_action( 'wp_enqueue_scripts', 'qav_initialization' );



function qav_footer_html_overlay()
{
    // if cookie is already set, no overlay.
    if(isset($_COOKIE['is_over_18'])) return;

    // else: show the age_verif overlay:
    ?>

    <div id="age_verif" class="overlay">
        <div class="content">
            <?php if(!empty(get_option( 'qav_logoimg' ))) { echo '<img src="'.get_option( 'qav_logoimg' ).'" alt="" />'; } ?>

            <div class="question">
                <?php echo wpautop(get_option('qav_question')); ?>
            </div>

            <button class="over18"  data-remember="<?php echo get_option('qav_remember') ? get_option('qav_remember') : '1'; ?>">
                <?php echo get_option('qav_answer_yes') ? get_option('qav_answer_yes') : '✔'; ?>
            </button>
            <button class="younger">
                <?php echo get_option('qav_answer_no') ? get_option('qav_answer_no') : '✘'; ?>
            </button>

            <div class="not18" style="display: none">
                <?php echo wpautop(get_option('qav_not18')); ?>
            </div>
        </div>
    </div>

    <?php
}
add_action('wp_footer', 'qav_footer_html_overlay', 100 );