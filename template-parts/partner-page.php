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

        wp_link_pages(array(
            'before' => '<div class="page-links">' . esc_html__('Pages:', 'theme-atelier'),
            'after' => '</div>',
        ));
        ?>
        <div class="row">
            <div class="at-partner-data col m8 s12">
                <div class="at-partner-logo">
                    <img src="<?php echo $user->logo; ?>"/>
                </div>
                <p>Website:<a href="<?php echo $user->user_url; ?>" target="_blank"> <?php echo $user->user_url; ?></a>
                </p>
                <p>Email:<a href="mailto:<?php echo $user->user_email; ?>"> <?php echo $user->user_email; ?></a></p>
                <h5>Persoana de Contact:</h5>
                <p>Nume: <?php echo $user->first_name; ?></p>
                <p>Prenume: <?php echo $user->contact_surname; ?></p>
                <p>Telefon: <?php echo $user->contact_phone; ?></p>
                <p>Functie: <?php echo $user->contact_function; ?></p>

                <h3>Acivitati sponsorizate de acest partener</h3>
                <?php
                $args = array(
                    'numberposts' => -1,
                    'offset' => 0,
                    'orderby' => 'date',
                    'order' => 'DESC',
                    'post_type' => 'atelier_activities',
                    'author' => $user->ID,
                    'post_status' => 'publish',
                    'suppress_filters' => true
                );
                $posts_array = get_posts($args);
                ?>
                <?php if ($posts_array) { ?>
                    <ul class="at-pending-news-list collection">
                        <?php foreach ($posts_array as $post) {
                            $url = wp_get_attachment_url(get_post_thumbnail_id($post->ID));
                            ?>
                            <li class="at-news-item-<?php echo $post->ID; ?> collection-item avatar">
                                <img src="<?php echo $url; ?>" alt="" class="circle">
                                <span class="title"><?php echo $post->post_title; ?></span>
                                <p>
                                    <?php $content = substr($post->post_content, 0, strpos($post->post_content, "<")); ?>
                                    <?php echo substr($content, 0, 300); ?>
                                </p>
                            </li>
                        <?php } ?>
                    </ul>
                <?php } else { ?>
                    <p>Acest partener nu a adaugat nici o activitate.</p>
                <?php } ?>
            </div>
            <div class="at-partner-form  col m4 s12">
                <div class="row">
                    <h5>Contacteaza Partenerul</h5>
                    <form class="col s12" id="at_send_email_partner" action="" method="post">
                        <div class="row">
                            <div class="input-field col s12">
                                <input id="first_name" name="first_name" required aria-required="true" type="text"
                                       class="validate">
                                <label for="first_name">Nume</label>
                            </div>
                            <div class="input-field col s12">
                                <input id="last_name" name="last_name" required aria-required="true" type="text"
                                       class="validate">
                                <label for="last_name">Prenume</label>
                            </div>
                            <div class="input-field col s12">
                                <input id="email" name="email" type="email" required aria-required="true"
                                       class="validate">
                                <label for="email">Email</label>
                            </div>
                            <div class="input-field col s12">
                                <input id="subject" name="subject" type="text" required aria-required="true"
                                       class="validate">
                                <label for="subject">Titlu
                                    <Mesaj></Mesaj>
                                </label>
                            </div>
                            <div class="input-field col s12">
                                <textarea id="mesaj" name="message" required aria-required="true"
                                          class="materialize-textarea"></textarea>
                                <label for="mesaj">Mesaj</label>
                            </div>
                        </div>
                        <input type='hidden' value="<?php echo wp_create_nonce('send_partner_email'); ?>" name='nonce'/>
                        <input type="hidden" name="partner_email" value="<?php echo $user->user_email; ?>">
                        <input type="hidden" name="action" id="action" value="send_partner_email">
                        <div class="row">
                            <button class="btn waves-effect waves-light light-blue accent-4" type="submit"
                                    name="submit">Trimite
                                <i class="material-icons right">send</i>
                            </button>
                        </div>
                    </form>
                    <div id="result"></div>
                </div>
            </div>
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
