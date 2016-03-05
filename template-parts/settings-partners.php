<?php
/**
 * Template part for displaying settings content in settings-page.php.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package theme-atelier
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <header class="entry-header">
        <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
    </header><!-- .entry-header -->

    <div class="entry-content">
        <?php
        the_content();

        wp_link_pages( array(
            'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'theme-atelier' ),
            'after'  => '</div>',
        ) );
        ?>
        <?php $user = wp_get_current_user(); ?>
        <div class="ta-settings">
            <form id="at_save_settings" action="" method="post" enctype="multipart/form-data">
                <h2>Companie</h2>
                <div class="row">
                    <div class="col s2">
                        <?php $logo = get_user_meta($user->ID, 'logo', true);
                        if($logo) { ?>
                            <img id="ta-partner-logo" src="<?php echo $logo ?>">
                        <?php } else { ?>
<!--                            <img src="--><?php //echo $logo ?><!--">-->
                            Insert Empty logo Image Here
                        <?php } ?>
                    </div>
                    <div class="file-field input-field col s12">
                        <div class="btn light-blue accent-4">
                            <span>Adauga Logo</span>
                            <input type="file" name="fileToUpload" id="fileToUpload">
                        </div>
                        <div class="file-path-wrapper">
                            <input class="file-path validate" name="img" type="text">
                        </div>
                    </div>

                </div>
                <div class="row">
                    <div class="input-field col s4">
                        <input id="first_name" type="text" name="first_name" value="<?php echo $user->first_name; ?>" class="validate">
                        <label for="first_name">Nume Companie</label>
                    </div>
                    <div class="input-field col s4">
                        <input id="email" disabled type="text" value="<?php echo $user->user_email; ?>" class="validate">
                        <label for="email">Email</label>
                    </div>
                    <div class="input-field col s4">
                        <input id="user_url" type="text"  name="user_url" value="<?php echo $user->user_url; ?>" class="validate">
                        <label for="user_url">Website</label>
                    </div>
                </div>
                <h2>Persoana de contact</h2>
                <div class="row">
                    <div class="ta-contact-person col s8">
                        <div class="row">
                            <div class="input-field col s6">
                                <input id="contact_name" type="text" name="contact_name" value="<?php echo get_user_meta($user->ID, 'contact_name', true) ?>" class="validate">
                                <label for="contact_name">Nume</label>
                            </div>
                            <div class="input-field col s6">
                                <input id="contact_surname" type="text" name="contact_surname" value="<?php echo get_user_meta($user->ID, 'contact_surname', true) ?>" class="validate">
                                <label for="contact_surname">Prenume</label>
                            </div>
                            <div class="input-field col s6">
                                <input id="contact_function" type="text" name="contact_function" value="<?php echo get_user_meta($user->ID, 'contact_function', true) ?>" class="validate">
                                <label for="contact_function">Functie</label>
                            </div>
                            <div class="input-field col s6">
                                <input id="contact_phone" type="text" name="contact_phone" value="<?php echo get_user_meta($user->ID, 'contact_phone', true) ?>" class="validate">
                                <label for="contact_phone">Telefon</label>
                            </div>
                        </div>
                    </div>
                    <div class="ta-contact-image col s4">
                        <img src="#">
                    </div>
                </div>


                <input type='hidden' value="<?php echo wp_create_nonce( 'save_user_data' ); ?>" name='nonce' />
                <input type="hidden" name="action" id="action" value="save_user_settings">
                <button class="btn waves-effect waves-light  light-blue accent-4" type="submit" >Submit
                    <i class="material-icons right">send</i>
                </button>

            </form>
            <div id="output"></div>

        </div>
    </div><!-- .entry-content -->

    <footer class="entry-footer">
        <?php
        edit_post_link(
            sprintf(
            /* translators: %s: Name of current post */
                esc_html__( 'Edit %s', 'theme-atelier' ),
                the_title( '<span class="screen-reader-text">"', '"</span>', false )
            ),
            '<span class="edit-link">',
            '</span>'
        );
        ?>
    </footer><!-- .entry-footer -->
</article><!-- #post-## -->
