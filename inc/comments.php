<?php
/**
 * Created by PhpStorm.
 * User: Pop
 * Date: 3/20/2016
 * Time: 7:36 PM
 */

/**
 * Change comments Language
 */
add_filter( 'comment_form_defaults', function ($defaults) {

    $user = wp_get_current_user();
    $user_identity = $user->exists() ? $user->display_name : '';
    $post_id = get_the_ID();
    $req      = get_option( 'require_name_email' );
    $required_text = sprintf( ' ' . __('Campurile obligatorii sunt marcate cu %s'), '<span class="required">*</span>' );

    $defaults['title_reply'] = __( 'Lasati un comentariu' );
    $defaults['title_reply_to'] = __( 'Lasati un comentariu la %s' );
    $defaults['cancel_reply_link'] = __( 'Anulati comentariul' );
    $defaults['label_submit'] = __( 'Postati Comentariul' );

    $defaults['logged_in_as'] = '<p class="logged-in-as">' . sprintf( __( '<a class="blue-link" href="%1$s" aria-label="Inregistrat ca %2$s. Editati Profilul.">Inregistrat ca %2$s</a>. <a class="blue-link" href="%3$s">Deconectare?</a>' ), get_edit_user_link(), $user_identity, wp_logout_url( apply_filters( 'the_permalink', get_permalink( $post_id ) ) ) ) . '</p>';
    $defaults['must_log_in'] = '<p class="must-log-in">' . __( 'Trebuie sa fiti inregistrat pentru a posta un comentariu.' ) . '</p>';
    $defaults['comment_notes_before'] = '<p class="comment-notes"><span id="email-notes">' . __( 'Emailul dumneavoastra nu va fi public' ) . '</span>'. ( $req ? $required_text : '' ) . '</p>';
    $defaults['comment_field'] = '<p class="comment-form-comment"><label for="comment">' . _x( 'Comentariu', 'noun' ) . '</label> <textarea id="comment" name="comment" cols="45" rows="8"  aria-required="true" required="required"></textarea></p>';


    return $defaults;
});

add_filter( 'comment_form_default_fields', function ($fields) {

    $commenter = wp_get_current_commenter();
    $req      = get_option( 'require_name_email' );
    $aria_req = ( $req ? " aria-required='true'" : '' );
    $html_req = ( $req ? " required='required'" : '' );
    $args['format'] = current_theme_supports( 'html5', 'comment-form' ) ? 'html5' : 'xhtml';
    $html5    = 'html5' === $args['format'];

    $fields   =  array(
        'author' => '<p class="comment-form-author">' . '<label for="author">' . __( 'Nume' ) . ( $req ? ' <span class="required">*</span>' : '' ) . '</label> ' .
            '<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . $html_req . ' /></p>',
        'email'  => '<p class="comment-form-email"><label for="email">' . __( 'Email' ) . ( $req ? ' <span class="required">*</span>' : '' ) . '</label> ' .
            '<input id="email" name="email" ' . ( $html5 ? 'type="email"' : 'type="text"' ) . ' value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30" aria-describedby="email-notes"' . $aria_req . $html_req  . ' /></p>',
        'url'    => '<p class="comment-form-url"><label for="url">' . __( 'Website' ) . '</label> ' .
            '<input id="url" name="url" ' . ( $html5 ? 'type="url"' : 'type="text"' ) . ' value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" /></p>',
    );

    return $fields;
});

/**
 * New romanian texts callback for wp_list_comments()
 *
 * @param $comment
 * @param $args
 * @param $depth
 */
function comments_callback($comment, $args, $depth) {
    $GLOBALS['comment'] = $comment; ?>
<li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
    <div id="comment-<?php comment_ID(); ?>">
        <div class="comment-author vcard">

            <?php printf(__('<cite class="fn">%s</cite> <span class="says">spune:</span>'), get_comment_author_link()) ?>
        </div>
        <?php if ($comment->comment_approved == '0') : ?>
            <em><?php _e('Comentariul dvs. asteapta moderare.') ?></em>
            <br />
        <?php endif; ?>

        <div class="comment-meta commentmetadata"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>"><?php printf(__('%1$s at %2$s'), get_comment_date(),  get_comment_time()) ?></a><?php edit_comment_link(__('(Editeaza)'),'  ','') ?></div>

        <?php comment_text() ?>

        <div class="reply">
            <?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
        </div>
    </div>
    <?php
}