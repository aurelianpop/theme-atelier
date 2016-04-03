<?php
/**
 * Template part for displaying page content in contact-page.php.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package theme-atelier
 */

?>

<article class="margin0" id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <header class="entry-header">
        <?php the_title('<h1 class="entry-title">', '</h1>'); ?>
    </header><!-- .entry-header -->

    <div class="entry-content">
        <div class="at-contact-data row">
            <div style="padding-right: 5%" class="col m7 s12">
                <?php the_content(); ?>
            </div>
            <div class="col m5 s12" style="border-left:solid 1px #cccccc; padding-left:20px">
                <div class="at-partner-form">
                    <div class="row">
                        <div class="col s12">
                            <h5>Formular de inscriere pentru ajutor copil</h5>
                            <hr class="blue accent-4">
                        </div>
                        <form class="col s12" id="at_send_email_admin" action="" method="post">
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
                                    <input id="phone" name="phone" required aria-required="true" type="text"
                                           class="validate">
                                    <label for="phone">Telefon</label>
                                </div>
                                <div class="input-field col s12">
                                    <input id="adresa" name="adress" required aria-required="true" type="text"
                                           class="validate">
                                    <label for="adresa">Adresa</label>
                                </div>
                                <div class="input-field col s12">
                                    <input id="work_place" name="work_place" required aria-required="true" type="text"
                                           class="validate">
                                    <label for="work_place">Loc de munca</label>
                                </div>
                                <div class="input-field col s12">
                                    <input id="married-yes" class="with-gap" type="radio" checked="checked" name="married" value="0">
                                    <label for="married-yes">Necasatorit</label>
                                    <input id="married-no" class="with-gap" type="radio" name="married" value="1">
                                    <label for="married-no">Casatorit</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12">
                                    <select name="has_children">
                                        <option value="0">0</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                    </select>
                                    <label>Copii</label>
                                </div>
                            </div>

                            <h5>Detalii copil</h5>
                            <hr class="blue accent-4">
                            <div class="row">
                                <div class="input-field col s12">
                                    <select id="age" name="age">
                                        <option value="7">0 - 7 ani</option>
                                        <option value="14">7 - 14 ani</option>
                                        <option value="18">14 - 18 ani</option>
                                        <option value="max">18+ ani</option>
                                    </select>
                                    <label for="age">Varsta</label>
                                </div>
                                <div class="input-field col s12">
                                    <input id="gender-m" class="with-gap" type="radio" checked="checked" name="gender" value="0">
                                    <label for="gender-m">Baiat</label>
                                    <input id="gender-f" class="with-gap" type="radio" name="gender" value="1">
                                    <label for="gender-f">Fata</label>
                                </div>
                            </div>
                            <?php $categories = get_terms( 'atelier_hobbies', 'orderby=count&hide_empty=0' ); ?>
                            <div class="row">
                                <div class="input-field col s12 m12">
                                    <select id="hobbies" name="hobbies">
                                        <?php foreach($categories as $category) { ?>
                                            <option value="<?php echo $category->term_id ?>"><?php echo $category->name ?></option>
                                        <?php } ?>
                                    </select>
                                    <label for="hobbies">Hobby-uri</label>
                                </div>
                                <div class="input-field col s12 m12">
                                    <select id="hobbies" name="help">
                                        <option value="Financiar">Financiar</option>
                                        <option value="Haine">Haine</option>
                                        <option value="Rechizite">Rechizite</option>
                                        <option value="Mobila">Mobila</option>
                                    </select>
                                    <label for="hobbies">Tip Ajutor</label>
                                </div>
                            </div>
                            <input type='hidden' value="<?php echo wp_create_nonce('child_request'); ?>"
                                   name='nonce'/>
                            <input type="hidden" name="action" id="action" value="request_child">
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
        </div>
        <?php

        ?>
    </div><!-- .entry-content -->

</article><!-- #post-## -->
