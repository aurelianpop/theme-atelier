<?php
/**
 * Template part for displaying partners in partners-page.php.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package theme-atelier
 */
?>

<?php
$partner_id = $_GET['partner'];
$user = get_user_by('ID', $partner_id);
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <header class="entry-header">
        <h1 class="entry-title">
            <?php echo $user->display_name; ?>
        </h1>
    </header><!-- .entry-header -->

    <div class="entry-content">
        <?php
        the_content();

        wp_link_pages( array(
            'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'theme-atelier' ),
            'after'  => '</div>',
        ) );
        ?>
        <div class="row">
            <div class="at-partner-data col m8 s12">
                <div class="at-partner-logo">
                    <img src="<?php echo $user->logo; ?>" />
                </div>
                <a href="<?php echo $user->user_url; ?>" target="_blank">Website: <?php echo $user->user_url; ?></a>
                <h5>Persoana de Contact:</h5>
                <p>Nume: <?php echo $user->contact_name; ?></p>
                <p>Prenume: <?php echo $user->contact_surname; ?></p>
                <p>Telefon: <?php echo $user->contact_phone; ?></p>
                <p>Functie: <?php echo $user->contact_function; ?></p>
            </div>
            <div class="at-partner-form  col m4 s12">
                <div class="row">
                    <h5>Contacteaza Partenerul</h5>
                    <form class="col s12">
                        <div class="row">
                            <div class="input-field col s6">
                                <input placeholder="Placeholder" id="first_name" type="text" class="validate">
                                <label for="first_name">First Name</label>
                            </div>
                            <div class="input-field col s6">
                                <input id="last_name" type="text" class="validate">
                                <label for="last_name">Last Name</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s12">
                                <input disabled value="I am not editable" id="disabled" type="text" class="validate">
                                <label for="disabled">Disabled</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s12">
                                <input id="password" type="password" class="validate">
                                <label for="password">Password</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s12">
                                <input id="email" type="email" class="validate">
                                <label for="email">Email</label>
                            </div>
                        </div>
                        <div class="row">
                            <button class="btn waves-effect waves-light" type="submit" name="action">Trimite
                                <i class="material-icons right">send</i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
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
