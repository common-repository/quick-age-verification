<?php


// Register Settings For a Plugin
function qav_register_settings() {
    register_setting( 'qav_options_group', 'qav_logoimg');
    register_setting( 'qav_options_group', 'qav_question');
    register_setting( 'qav_options_group', 'qav_answer_yes');
    register_setting( 'qav_options_group', 'qav_answer_no');
    register_setting( 'qav_options_group', 'qav_not18');
    register_setting( 'qav_options_group', 'qav_remember');
}
add_action('admin_init', 'qav_register_settings');





// Creating an Options Page
function qav_register_options_page() {
    add_options_page(
        'Quick Age Verification Options (Plugin)',
        'Quick Age Verification Options',
        'manage_options',
        'quick_age_verification',
        'qav_options_page'
    );
}
add_action('admin_menu', 'qav_register_options_page');





// Display Settings on Option’s Page
function qav_options_page() {
    wp_enqueue_media();
    
    ?>
    <div>
        <h2>Quick Age Verification - Options</h2>
        <form method="post" action="options.php">
            <?php settings_fields( 'qav_options_group' ); ?>

            <table>
                <tr>
                    <td>
                        <label for="qav_logoimg">Logo for overlay: </label>
                    </td>
                    <td>
                        <div style="float: left; margin-top: 0.5em">
                            <input id="upload_image_button" type="button" class="button button-primary" value="Select image" />
                            <input id="clear_image_button" type="button" class="button" value="Clear" />
                            <input type='hidden' name='qav_logoimg' id='qav_logoimg' value='<?php echo get_option( 'qav_logoimg' ); ?>'>
                        </div>
                        <div class='image-preview-wrapper'>
                            <img id='image-preview' src='<?php echo get_option( 'qav_logoimg' ); ?>' style="padding: 0.5em; margin: 0.5em; background: lightgrey; height: 4em; min-width: 3em;">
                        </div>
                    </td>
                    <td>

                    </td>
                </tr>

                <tr>
                    <td>
                        <label for="qav_question">Age verification question: </label>
                    </td>
                    <td>
                        <textarea id="qav_question" name="qav_question" rows="5" cols="50" placeholder="Are you old enough?"><?php echo esc_textarea(get_option('qav_question')); ?></textarea>
                    </td>
                </tr>

                <tr>
                    <td>
                        <label for="">Age verification answers: </label>
                    </td>
                    <td>
                        <input type="text" id="qav_answer_yes" name="qav_answer_yes" placeholder="Yes" size="5" value="<?php echo get_option('qav_answer_yes'); ?>" />
                        <input type="text" id="qav_answer_no" name="qav_answer_no" placeholder="No" size="5" value="<?php echo get_option('qav_answer_no'); ?>" />
                        <em>(Default: "✔" and "✘" if left empty)</em>
                    </td>
                </tr>

                <tr><td colspan="2"><br/><hr><br/></td></tr>

                <tr>
                    <td>
                        <label for="qav_not18">"No"-answer notice text: </label>
                    </td>
                    <td>
                        <textarea id="qav_not18" name="qav_not18" rows="5" cols="50" placeholder="You shall not pass!"><?php echo esc_textarea(get_option('qav_not18')); ?></textarea>
                    </td>
                </tr>

                <tr><td colspan="2"><br/><hr><br/></td></tr>

                <tr>
                    <td>
                        <label for="qav_remember">Cookie remember duration: </label>
                    </td>
                    <td>
                        <input type="number" id="qav_remember" name="qav_remember" size="5" value="<?php echo get_option('qav_remember'); ?>" />
                        <em>(in DAYS)</em>
                    </td>
                </tr>
            </table>

            <?php submit_button(); ?>

        </form>


        <script type='text/javascript'>

            jQuery( document ).ready( function( $ ) {

                // Uploading files
                var file_frame;
                var wp_media_post_id = wp.media.model.settings.post.id; // Store the old id
                var set_to_post_id = 0;

                jQuery('#clear_image_button').on('click', function( event ) {
                    $( '#image-preview' ).attr( 'src', "" );
                    $( '#qav_logoimg' ).val( "" );
                });

                jQuery('#upload_image_button').on('click', function( event ){

                    event.preventDefault();

                    // If the media frame already exists, reopen it.
                    if ( file_frame ) {
                        // Set the post ID to what we want
                        file_frame.uploader.uploader.param( 'post_id', set_to_post_id );
                        // Open frame
                        file_frame.open();
                        return;
                    } else {
                        // Set the wp.media post id so the uploader grabs the ID we want when initialised
                        wp.media.model.settings.post.id = set_to_post_id;
                    }

                    // Create the media frame.
                    file_frame = wp.media.frames.file_frame = wp.media({
                        title: 'Select a image to upload',
                        button: {
                            text: 'Use this image',
                        },
                        multiple: false	// Set to true to allow multiple files to be selected
                    });

                    // When an image is selected, run a callback.
                    file_frame.on( 'select', function() {
                        // We set multiple to false so only get one image from the uploader
                        attachment = file_frame.state().get('selection').first().toJSON();

                        // Do something with attachment.id and/or attachment.url here
                        $( '#image-preview' ).attr( 'src', attachment.url ).css( 'width', 'auto' );
                        $( '#qav_logoimg' ).val( attachment.url );

                        // Restore the main post ID
                        wp.media.model.settings.post.id = wp_media_post_id;
                    });

                    // Finally, open the modal
                    file_frame.open();
                });

                // Restore the main ID when the add media button is pressed
                jQuery( 'a.add_media' ).on( 'click', function() {
                    wp.media.model.settings.post.id = wp_media_post_id;
                });
            });

        </script>

    </div>
    <?php
} 

