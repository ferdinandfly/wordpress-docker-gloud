<?php
/*
Plugin Name: Custom New User Email
Description: Changes the copy in the email sent out to new users
*/
 
// Redefine user notification function
if ( !function_exists('wp_new_user_notification') ) {
    function wp_new_user_notification( $user_id, $plaintext_pass = '' ) {
        $user = new WP_User($user_id);
 
        $user_login = stripslashes($user->user_login);
        $user_email = stripslashes($user->user_email);
 
        $message  = sprintf('Un nouveau membre a validé son inscription.') . "\r\n\r\n";
        $message .= sprintf('Nom utilisateur : %s', $user_login) . "\r\n\r\n";
        $message .= sprintf('E-mail: %s', $user_email) . "\r\n";
        $message .= sprintf('Nom : %s', $_POST['billing_last_name']) . "\r\n";
        $message .= sprintf('Prénom : %s', $_POST['billing_first_name']) . "\r\n";
        $message .= sprintf('Société : %s', $_POST['billing_company']) . "\r\n";
        $message .= sprintf('Téléphone : %s', $_POST['billing_phone']) . "\r\n";
        $message .= sprintf('Adresse : %s', $_POST['billing_address_1']) . "\r\n";
        $message .= sprintf('Code postal : %s', $_POST['billing_postcode']) . "\r\n";
        $message .= sprintf('Ville : %s', $_POST['billing_city']) . "\r\n";
        $message .= sprintf('Pays : %s', WC()->countries->countries[$_POST['billing_country']]) . "\r\n";

        @wp_mail(get_option('admin_email'), sprintf(__('[%s] New User Registration'), get_option('blogname')), $message);
//        @wp_mail("info@ardetem.com", sprintf(__('[%s] New User Registration'), get_option('blogname')), $message);
        @wp_mail("huguet.jacques@ardetem.com", sprintf(__('[%s] New User Registration'), get_option('blogname')), $message);

        if ( empty($plaintext_pass) )
            return;
 
    }
}


if (!function_exists('sfereUserLoginNotification')) {
    function sfereUserLoginNotification($url , $user) {
        $userLogin = $user->data->user_login;
        $username = $user->data->display_name;
        $userEmail = $user->data->user_email;
        $userRegisteredTime = $user->data->user_registered;
        $message = <<<EOT
        Un memebre s'est connecté.
        Nom d'utilisateur: $userLogin
        Email: $userEmail
        Nom: $username
        Date d'inscription: $userRegisteredTime
EOT;
        @wp_mail("ferdinandfly@hotmail.com", sprintf(__('[%s] User login'), get_option('blogname')), $message);
        return true;
    }
}
