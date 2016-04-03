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
        <hr class="blue accent-4">
    </header><!-- .entry-header -->

    <div class="entry-content">
        <?php
        the_content();

        wp_link_pages(array(
            'before' => '<div class="page-links">' . esc_html__('Pages:', 'theme-atelier'),
            'after' => '</div>',
        ));
        ?>
        <div>
            <div class="at-partner-data row">
                <div style="padding-right: 5%" class="col m7 s12">
                    <div class="flex flex-vertical-center padding-bottom30">
                        <div class="blue-border"><img class="small-img" src="<?php echo $user->logo; ?>"/></div>
                        <div class="margin0">
                            <span class="font18">Website:<a href="<?php echo $user->user_url; ?>"
                                                            target="_blank"> <?php echo $user->user_url; ?></a>
                            <br/>
                            Email:<a
                                    href="mailto:<?php echo $user->user_email; ?>"> <?php echo $user->user_email; ?></a>
                            </span>
                        </div>
                    </div>
                    <div class="col m12 s12" style="padding: 0;">
                        <h5>Descrierea companiei:</h5>
                        <hr class="blue accent-4">
                        <p>
                            <?php echo nl2br($user->description); ?>
                        </p>
                    </div>
                    <h5>Persoana de Contact:</h5>
                    <hr class="blue accent-4">
                    <div class="grey lighten-3" style="padding:10px;">
                        <table style="font-size: 14px;line-height:30px;font-size: 16px">
                            <tbody>
                            <tr>
                                <td class="font-weight700">Nume:</td>
                                <td style="width:100%"><?php echo $user->contact_name; ?></td>
                            </tr>
                            <tr>
                                <td class="font-weight700">Prenume:</td>
                                <td style="width:100%"> <?php echo $user->contact_surname; ?></td>
                            </tr>
                            <tr>
                                <td class="font-weight700">Telefon:</td>
                                <td style="width:100%"><?php echo $user->contact_phone; ?></td>
                            </tr>
                            <tr>
                                <td class="font-weight700">Functie:</td>
                                <td style="width:100%"><?php echo $user->contact_function; ?></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col m5 s12" style="border-left:solid 1px #cccccc; padding-left:20px">
                    <div class="at-partner-form">
                        <div class="row">
                            <div class="col s12">
                                <h5>Contacteaza Partenerul</h5>
                                <hr class="blue accent-4">
                            </div>
                            <form class="col s12" id="at_send_email_partner" action="" method="post">
                                <div class="row">
                                    <div class="input-field col s12">
                                        <input id="first_name" name="first_name" required aria-required="true"
                                               type="text"
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
                                <input type='hidden' value="<?php echo wp_create_nonce('send_partner_email'); ?>"
                                       name='nonce'/>
                                <input type="hidden" name="partner_email" value="<?php echo $user->user_email; ?>">
                                <input type="hidden" name="action" id="action" value="send_partner_email">
                                <div class="row">
                                    <div class="col s12">
                                        <button class="btn waves-effect waves-light light-blue accent-4" type="submit"
                                                name="submit">Trimite
                                            <i class="material-icons right">send</i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                            <div id="result"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col s12 m12">
                    <h3>Activitati sponsorizate de acest partener</h3>
                    <hr class="blue accent-4"/>
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
                        <div class="padding-top10">
                        <ul class="at-pending-news-list collection">
                            <?php foreach ($posts_array as $post) {
                                $url = wp_get_attachment_url(get_post_thumbnail_id($post->ID));
                                ?>
                                <li class="at-news-item-<?php echo $post->ID; ?> collection-item avatar"
                                    style="padding-top: 20px">
                                    <img src="<?php echo $url; ?>" alt="" class="circle">
                                    <a href="<?php echo $post->guid; ?>"><h4
                                            class="margin0 padding-bottom30"><?php echo $post->post_title; ?></h4></a>
                                    <p>
                                        <?php $content = substr($post->post_content, 0, strpos($post->post_content, "<"));
                                        $shortContent = $content;
                                        if (strlen($content) > 300) {
                                            $shortContent = substr($content, 0, 300) . "...";
                                        }
                                        ?>
                                        <?php echo $shortContent; ?>
                                    </p>
                                </li>
                            <?php } ?>
                        </ul>
                        </div>
                    <?php } else { ?>
                        <p>Acest partener nu a adaugat nici o activitate.</p>
                    <?php } ?>
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
