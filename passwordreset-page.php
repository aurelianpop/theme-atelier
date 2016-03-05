<?php
/*
Template Name: Password Reset Template
*/

wp_head();
global $wpdb, $user_ID;

function tg_validate_url()
{
    global $post;
    $page_url = esc_url(get_permalink($post->ID));
    $urlget = strpos($page_url, "?");
    if ($urlget === false) {
        $concate = "?";
    } else {
        $concate = "&";
    }
    return $page_url . $concate;
}

if (!$user_ID) { //block logged in users

    if (isset($_GET['key']) && $_GET['action'] == "reset_pwd") {
        $reset_key = $_GET['key'];
        $user_login = $_GET['login'];
        $user_data = $wpdb->get_row($wpdb->prepare("SELECT ID, user_login, user_email FROM $wpdb->users WHERE user_activation_key = %s AND user_login = %s", $reset_key, $user_login));

        $user_login = $user_data->user_login;
        $user_email = $user_data->user_email;

        if (!empty($reset_key) && !empty($user_data)) {
            $new_password = wp_generate_password(12, false);
            //echo $new_password; exit();
            wp_set_password($new_password, $user_data->ID);
            //mailing reset details to the user


            $headers = array('Content-Type: text/html; charset=UTF-8', 'From: myQuote <proiecte@myquote.com>');
            $subject = "Parola resetata cu succes";
            $msg = '

		        	<html><head>
						<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300italic,300,400italic,600,600italic,700,700italic,800,800italic" rel="stylesheet" type="text/css">
					</head>
					<body> 
						<strong><span style=" font-size: 30px; margon-bottom: 20px;">my</span><span style=" font-size: 30px; margon-bottom: 30px; color: #52b266;">Q</span><span style=" font-size: 30px; margon-bottom: 20px; ">uote</span></strong><br/><br/>
						
						Noua parola a contului tau <br/><br/>

						<strong>User: </strong>' . $user_login . '<br/>
						<strong>Parola: </strong>' . $new_password . ' <br/><br/>

						Te poti loga cu noua parola la adresa: <a href="' . get_option('siteurl') . '/login/">' . get_option('siteurl') . '/login/</a> <br/><br/>

						Dupa ce te-ai logat vei putea schimba parola la adresa: <a href="' . get_option('siteurl') . '/account/">' . get_option('siteurl') . '/account/ </a><br/><br/>

						Mult succes! <br/><br/>

						Echipa <strong>my<span style="color: #52b266;">Q</span>uote</strong>.<br/>
						Contact: <a href="mailto:info@myquote.ro">info@myquote.ro</a>; www.myquote.ro
					</body>
					</html>
					';

            if ($msg && !wp_mail($user_email, $subject, $msg, $headers)) {
                echo "<div class='error'>E-mail-ul nu a putut fi trimis dintr-un motiv necunoscut.</div>";
                exit();
            } else {
                $redirect_to = get_bloginfo('url') . "/autentificare/?action=reset_success";
                wp_safe_redirect($redirect_to);
                exit();
            }
        } else exit('Not a Valid Key.');

    }
    //exit();

    if ($_POST && $_POST['action'] == "tg_pwd_reset") {
        if (!wp_verify_nonce($_POST['tg_pwd_nonce'], "tg_pwd_nonce")) {
            exit("No trick please");
        }
        if (empty($_POST['user_input'])) {
            echo "<div class='error'>Te rog introdu User-ul sau E-mail-ul corect.</div>";
            exit();
        }
        //We shall SQL escape the input
        $user_input = sanitize_text_field($_POST['user_input']);

        if (strpos($user_input, '@')) {
            $user_data = get_user_by('email', $user_input);
            if (empty($user_data) || $user_data->caps['administrator'] == 1) { //delete the condition $user_data->caps[administrator] == 1, if you want to allow password reset for admins also
                echo "<div class='error'>Adresa de E-mail invalida!</div>";
                exit();
            }
        } else {
            $user_data = get_userdatabylogin($user_input);
            if (empty($user_data) || $user_data->caps[administrator] == 1) { //delete the condition $user_data->caps[administrator] == 1, if you want to allow password reset for admins also
                echo "<div class='error'>Username invalid!</div>";
                exit();
            }
        }

        $user_login = $user_data->user_login;
        $user_email = $user_data->user_email;

        $key = $wpdb->get_var($wpdb->prepare("SELECT user_activation_key FROM $wpdb->users WHERE user_login = %s", $user_login));
        if (empty($key)) {
            //generate reset key
            $key = wp_generate_password(20, false);
            $wpdb->update($wpdb->users, array('user_activation_key' => $key), array('user_login' => $user_login));
        }


        $headers = array('Content-Type: text/html; charset=UTF-8', 'From: myQuote <proiecte@myquote.com>');
        $subject = "Cerere de resetare parola";
        $msg = '

        	<html><head>
				<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300italic,300,400italic,600,600italic,700,700italic,800,800italic" rel="stylesheet" type="text/css">
			</head>
			<body> 
				<strong><span style=" font-size: 30px; margon-bottom: 20px;">my</span><span style=" font-size: 30px; margon-bottom: 30px; color: #52b266;">Q</span><span style=" font-size: 30px; margon-bottom: 20px; ">uote</span></strong><br/><br/>
				
				O cerere de resetare a parolei a fost inaintata pentru contul: <br/><br/>

				<strong>User: </strong>' . $user_login . '<br/><br/>

				Daca aceasta cerere a fost inaintata din greseala, ignora acest email si parola nu se va schimba. <br/><br/>

				Pentru a reseta parola, viziteaza urmatoarea adresa: <br/><br/>

				<a href="' . tg_validate_url() . "action=reset_pwd&key=$key&login=" . rawurlencode($user_login) . '">' . tg_validate_url() . "action=reset_pwd&key=$key&login=" . rawurlencode($user_login) . '</a> <br/><br/>

				Vei primi un email cu noua parola.<br/><br/>

				Mult succes! <br/><br/>

				Echipa <strong>my<span style="color: #52b266;">Q</span>uote</strong>.<br/>
				Contact: <a href="mailto:info@myquote.ro">info@myquote.ro</a>; www.myquote.ro
			</body>
			</html>
			';

        if ($msg && !wp_mail($user_email, $subject, $msg, $headers)) {
            echo "<div class='error'>E-mail-ul a esuat dintr-un motiv necunoscut.</div>";
            exit();
        } else {
            echo "<div class='success'>Ti-am trimis un E-mail cu instructiuni de resetare a parolei.</div>";
            exit();
        }

    } else {
        get_header(); ?>
        <script src="http://code.jquery.com/jquery-2.2.1.min.js"></script>
        <div id="main-content" class="main-content">

            <div id="contentwrapper">
                <div id="content" class="site-content" role="main">
                    <div class="innertube">
                        <article>
                            <?php if (have_posts()) : ?>

                                <?php while (have_posts()) : the_post(); ?>
                                    <?php the_content(); ?>
                                    <form class="user_form" id="wp_pass_reset" action="" method="post">
                                        <h1>Resetare Parola</h1>
                                        <div class="input-field">
                                            <input id="user-or-email" type="text" class="text" name="user_input" value=""/>
                                            <label for="user-or-email">User sau E-mail</label>
                                        </div>
                                            <br/>
                                        <input type="hidden" name="action" value="tg_pwd_reset"/>
                                        <input type="hidden" name="tg_pwd_nonce"
                                               value="<?php echo wp_create_nonce("tg_pwd_nonce"); ?>"/>
                                        <input type="submit" id="submitbtn" class="reset_password" name="submit"
                                               value="Reset Password"/>
                                        <div id="result"></div>
                                    </form>
                                    <!-- To hold validation results -->
                                    <script type="text/javascript">
                                        $("#wp_pass_reset").submit(function () {
                                            $('#result').html('<span class="loading">Validating...</span>').fadeIn();
                                            var input_data = $('#wp_pass_reset').serialize();
                                            $.ajax({
                                                type: "POST",
                                                url: "<?php echo get_permalink($post->ID); ?>",
                                                data: input_data,
                                                success: function (msg) {
                                                    $('.loading').remove();
                                                    $('<div>').html(msg).appendTo('div#result').hide().fadeIn('slow');
                                                }
                                            });

                                            return false;
                                        });
                                    </script>

                                <?php endwhile; ?>

                            <?php else : ?>

                            <h2><?php _e('Not Found'); ?></h1>

                                <?php endif; ?>
                        </article>
                    </div>
                </div><!-- #content -->
            </div>
        </div><!-- #main-content -->
        <?php

        get_footer();
    }
} else {
    wp_redirect(home_url());
    exit;
    //redirect logged in user to home page
}
?>