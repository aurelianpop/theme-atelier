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
        <?php the_title('<h1 class="entry-title">', '</h1>'); ?>
    </header><!-- .entry-header -->

    <div class="entry-content">
        <?php
        the_content();

        wp_link_pages(array(
            'before' => '<div class="page-links">' . esc_html__('Pages:', 'theme-atelier'),
            'after' => '</div>',
        ));
        ?>
        <?php $user = wp_get_current_user(); ?>
        <div class="ta-settings padding-top10 padding-bottom60">
            <form id="at_save_settings" action="" method="post" enctype="multipart/form-data">
                <h2>Profil</h2>
                <hr class="light-blue accent-4"/>
                <div class="row">
                    <div class="input-field col s12 m4">
                        <input id="first_name" type="text" name="first_name" value="<?php echo $user->first_name; ?>"
                               class="validate">
                        <label for="first_name">Nume</label>
                    </div>
                    <div class="input-field col s12 m4">
                        <input id="last_name" type="text" name="last_name" value="<?php echo $user->last_name; ?>"
                               class="validate">
                        <label for="last_name">Prenume</label>
                    </div>
                    <div class="input-field col s12 m4">
                        <input id="cnp" type="text" name="cnp" value="<?php echo $user->cnp; ?>"
                               class="validate">
                        <label for="cnp">CNP</label>
                    </div>

                </div>
                <div class="row">
                    <div class="input-field col s12 m4">
                        <input id="email" disabled type="text" value="<?php echo $user->user_email; ?>"
                               class="validate">
                        <label for="email">Email</label>
                    </div>
                    <div class="input-field col s12 m4">
                        <input id="phone" name="phone" type="text" value="<?php echo $user->phone; ?>"
                               class="validate">
                        <label for="phone">Telefon</label>
                    </div>
                    <div class="input-field col s12 m4">
                        <input id="address" name="address" type="text" value="<?php echo $user->address; ?>"
                               class="validate">
                        <label for="address">Adresa</label>
                    </div>
                </div>
                <div class="row">
                    <h2>Detalii</h2>
                    <hr class="light-blue accent-4"/>
                    <div class="row">
                        <div class="input-field col s12 m4">
                            <select name="help">
                                <option <?php echo $user->help == 'financial' ? 'selected="selected"' : ''; ?> value="financial">Financiar
                                </option>
                                <option <?php echo $user->help == 'clothing' ? 'selected="selected"' : ''; ?> value="clothing">Haine
                                </option>
                                <option <?php echo $user->help == 'requisites' ? 'selected="selected"' : ''; ?> value="requisites">Rechizite
                                </option>
                                <option <?php echo $user->help == 'furniture' ? 'selected="selected"' : ''; ?> value="furniture">Mobila
                                </option>
                                <option <?php echo $user->help == 'other' ? 'selected="selected"' : ''; ?> value="other">Altul
                                </option>
                            </select>
                            <label>Tip Ajutor</label>
                        </div>
                        <div class="input-field col s12 m4">
                            <input id="job" name="job" type="text" value="<?php echo $user->job; ?>"
                                   class="validate">
                            <label for="job">Loc de munca</label>
                        </div>
                        <div class="input-field col s12 m4">
                            <select name="has_children">
                                <option <?php echo $user->has_children == '0' ? 'selected="selected"' : ''; ?> value="0">0</option>
                                <option <?php echo $user->has_children == '1' ? 'selected="selected"' : ''; ?> value="1">1</option>
                                <option <?php echo $user->has_children == '2' ? 'selected="selected"' : ''; ?> value="2">2</option>
                                <option <?php echo $user->has_children == '3' ? 'selected="selected"' : ''; ?> value="3">3</option>
                                <option <?php echo $user->has_children == '4' ? 'selected="selected"' : ''; ?> value="4">4</option>
                            </select>
                            <label>Copii</label>
                        </div>
                    </div>
                    <h2>Tip Profil</h2>
                    <hr class="light-blue accent-4"/>
                    <div class="row">
                        <div class="input-field col s12 m4">
                            <input id="married-yes" class="with-gap" type="radio" <?php echo $user->married == '0' ? 'checked="checked"' : ''; ?> name="married" value="0">
                            <label for="married-yes">Necasatorit</label>
                            <input id="married-no" class="with-gap" type="radio" <?php echo $user->married == '1' ? 'checked="checked"' : ''; ?> name="married" value="1">
                            <label for="married-no">Casatorit</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12 m2">
                            <input id="anonymus-yes" class="with-gap" type="radio" <?php echo $user->anonymus == '0' ? 'checked="checked"' : ''; ?> name="anonymus" value="0">
                            <label for="anonymus-yes">Anonim</label>
                            <input id="anonymus-no" class="with-gap" type="radio" <?php echo $user->anonymus == '1' ? 'checked="checked"' : ''; ?> name="anonymus" value="1">
                            <label for="anonymus-no">Public</label>
                        </div>
                    </div>

                </div>

                <input type='hidden' value="<?php echo wp_create_nonce('save_user_data'); ?>" name='nonce'/>
                <input type="hidden" name="action" id="action" value="save_user_settings">
                <button class="btn waves-effect waves-light  light-blue accent-4" type="submit">Actualizeaza
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
                esc_html__('Edit %s', 'theme-atelier'),
                the_title('<span class="screen-reader-text">"', '"</span>', false)
            ),
            '<span class="edit-link">',
            '</span>'
        );
        ?>
    </footer><!-- .entry-footer -->
</article><!-- #post-## -->
