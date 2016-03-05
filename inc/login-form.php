<?php
/**
 * Created by PhpStorm.
 * User: Pop
 * Date: 2/28/2016
 * Time: 10:20 AM
 */

function at_wp_login_form( $args = array() ) {
    $defaults = array( 'echo' => true,
        'redirect' => site_url( $_SERVER['REQUEST_URI'] ), // Default redirect is back to the current page
        'form_id' => 'loginform',
        'label_username' => __( 'Username' ),
        'label_password' => __( 'Password' ),
        'label_remember' => __( 'Remember Me' ),
        'label_log_in' => __( 'Log In' ),
        'id_username' => 'user_login',
        'id_password' => 'user_pass',
        'id_remember' => 'rememberme',
        'id_submit' => 'wp-submit',
        'remember' => true,
        'value_username' => '',
        'value_remember' => false, // Set this to true to default the "Remember me" checkbox to checked
    );
    $args = wp_parse_args( $args, apply_filters( 'login_form_defaults', $defaults ) );

    $form = '
		<form name="' . $args['form_id'] . '" id="' . $args['form_id'] . '" action="' . site_url( 'wp-login.php', 'login' ) . '" method="post">
			' . apply_filters( 'login_form_top', '' ) . '
			<div class="login-username input-field">
				<label for="' . esc_attr( $args['id_username'] ) . '">' . esc_html( $args['label_username'] ) . '</label>
				<input type="text" name="log" id="' . esc_attr( $args['id_username'] ) . '" class="input" value="' . esc_attr( $args['value_username'] ) . '" size="20" tabindex="10" />
			</div>
			<div class="login-password input-field">
				<label for="' . esc_attr( $args['id_password'] ) . '">' . esc_html( $args['label_password'] ) . '</label>
				<input type="password" name="pwd" id="' . esc_attr( $args['id_password'] ) . '" class="input" value="" size="20" tabindex="20" />
			</div>
			' . apply_filters( 'login_form_middle', '' ) . '
			' . ( $args['remember'] ? '<p class="login-remember"><input name="rememberme" type="checkbox" id="' . esc_attr( $args['id_remember'] ) . '" value="forever" tabindex="90"' . ( $args['value_remember'] ? ' checked="checked"' : '' ) . ' /> <label for="'. esc_attr( $args['id_remember'] ) .'">' . esc_html( $args['label_remember'] ) . '</label></p>' : '' ) . '
			<p class="login-submit">
				<input type="submit" name="wp-submit" id="' . esc_attr( $args['id_submit'] ) . '" class="button-primary" value="' . esc_attr( $args['label_log_in'] ) . '" tabindex="100" />
				<input type="hidden" name="redirect_to" value="' . esc_attr( $args['redirect'] ) . '" />
			</p>
			' . apply_filters( 'login_form_bottom', '' ) . '
		</form>';

    if ( $args['echo'] )
        echo $form;
    else
        return $form;
}