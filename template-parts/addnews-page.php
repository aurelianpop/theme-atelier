<?php
/**
 * Template part for displaying page content in page.php.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package theme-atelier
 */

?>

<article class="container" id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <header class="entry-header">
        <?php the_title('<h1 class="entry-title">', '</h1>'); ?>
        <hr class="blue accent-4"/>
    </header><!-- .entry-header -->

    <div class="entry-content">
        <?php
        the_content();

        wp_link_pages(array(
            'before' => '<div class="page-links">' . esc_html__('Pages:', 'theme-atelier'),
            'after' => '</div>',
        ));
        ?>
        <div class="at-add-news">
            <form id="at_save_news" action="" method="post" enctype="multipart/form-data">
                <div class="row">
                    <div class="input-field col s6">
                        <input id="post_title" type="text" name="post_title" required="" aria-required="true" value=""
                               class="validate">
                        <label for="post_title">Titlul</label>
                    </div>
                    <div class="file-field input-field col s6">
                        <div class="btn light-blue accent-4">
                            <span>Adauga imagine</span>
                            <input type="file" name="fileToUpload[]" required="" aria-required="true" id="fileToUpload">
                        </div>
                        <div class="file-path-wrapper">
                            <input class="file-path validate" name="img" type="text">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12">
                        <textarea id="post_content" name="post_content" required="" aria-required="true"
                                  class="materialize-textarea"></textarea>
                        <label for="post_content">Continut stire</label>
                    </div>
                </div>
                <input type='hidden' value="<?php echo wp_create_nonce('save_new_post'); ?>" name='nonce'/>
                <input type='hidden' value="post" name='post_type'/>
                <input type="hidden" name="action" id="action" value="save_news">
                <button class="btn waves-effect waves-light  light-blue accent-4" type="submit">Adauga stire
                    <i class="material-icons right">send</i>
                </button>
            </form>
        </div>
        <div class="at-pending-news padding-top60 padding-bottom60">
            <h2>Noutati care asteapta aprobare</h2>
            <hr class="blue accent-4"/>
            <?php
            $user = wp_get_current_user();
            $args = array(
                'numberposts' => -1,
                'offset' => 0,
                'orderby' => 'date',
                'order' => 'DESC',
                'post_type' => 'post',
                'author' => $user->ID,
                'post_status' => 'draft',
                'suppress_filters' => true
            );
            $posts_array = get_posts($args);
            if(!empty($posts_array)){ ?>
            <ul class="at-pending-news-list collection">
                <?php foreach ($posts_array as $post) {
                    $url = wp_get_attachment_url(get_post_thumbnail_id($post->ID));
                    ?>
                    <li class="at-news-item-<?php echo $post->ID; ?> collection-item avatar">
                        <img src="<?php echo $url; ?>" alt="" class="circle">
                        <span class="title font-weight700"><?php echo $post->post_title; ?></span>
                        <p class="padding-right30">
                            <?php echo substr($post->post_content, 0, 300); ?>
                        </p>
                        <a href="#at-delete-news-modal" data-id="<?php echo $post->ID; ?>"
                           class="delete-item-modal modal-trigger lock_open secondary-content light-blue-text text-accent-4"><i
                                class="material-icons">delete</i></a>
                    </li>
                <?php } ?>
            </ul>
            <?php }
            else { ?><p>Toate noutatile au fost aprobate.</p>
            <?php } ?>
            <div id="at-delete-news-modal" class="at-delete-news-modal modal">
                <div class="light-blue accent-4 modal-content white-text">Sterge stire</div>
                <div class="modal-content">
                    <p>Sunteti sigur ca vreti sa stergeti aceste stiri? The delete action cannot be undone.</p>
                    <div class="modal-footer">
                        <a id="ta-delete-news" href="javascript:void(0)"
                           class="modal-action modal-close waves-effect waves-light btn light-blue accent-4 white-link"
                           data-id="">Da</a>
                        <a href="javascript:void(0)"
                           class="modal-action modal-close waves-effect waves-light btn light-blue accent-4 white-link">Nu</a>
                    </div>
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
