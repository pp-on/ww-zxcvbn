<?php
/*
Plugin Name: ww-xcvbn
Description: Replaces default Zxcvbn library with Zxcvbn TypeScript library.
Version: 1.0
Author: Oswaldo Nickel

function dequeue_default_zxcvbn() {
    wp_dequeue_script('zxcvbn-async');
    wp_dequeue_script('zxcvbn-async-legacy');
    wp_dequeue_script('password-strength-meter');
}
add_action('wp_enqueue_scripts', 'dequeue_default_zxcvbn', 9999);
*/

function deregister_default_zxcvbn() {
    wp_deregister_script('zxcvbn-async');
    wp_deregister_script('zxcvbn-async-legacy');
    wp_deregister_script('password-strength-meter');
}
add_action('wp_enqueue_scripts', 'deregister_default_zxcvbn', 9999);
add_action('admin_enqueue_scripts', 'deregister_default_zxcvbn', 9999);


//mein script einziehen
// Enqueue the compiled JavaScript file for the admin new user page
function enqueue_ww_zxcvbn_script_admin($hook) {
    if ($hook !== 'user-new.php') {
        return;
    }
    wp_enqueue_script('ww-zxcvbn', plugin_dir_url(__FILE__) . 'dist/ww-zxcvbn.js', array(), '1.0', true);
}
add_action('admin_enqueue_scripts', 'enqueue_ww_zxcvbn_script_admin');

// Add password strength indicator to new user form in admin area
function add_password_strength_indicator_to_new_user() {
    ?>
    <h3>Password</h3>
    <table class="form-table">
        <tr>
            <th><label for="password">Password</label></th>
            <td>
                <input type="password" id="password" name="password" autocomplete="off">
                <div id="password-strength"></div>
            </td>
        </tr>
    </table>
    <?php
}
add_action('user_new_form', 'add_password_strength_indicator_to_new_user');
// Enqueue the compiled JavaScript file for the front-end registration page
function enqueue_ww_zxcvbn_script_frontend() {
    if (is_page('register')) { // Replace 'register' with your registration page slug
        wp_enqueue_script('ww-zxcvbn', plugin_dir_url(__FILE__) . 'dist/ww-zxcvbn.js', array(), '1.0', true);
    }
}
add_action('wp_enqueue_scripts', 'enqueue_ww_zxcvbn_script_frontend');


function ww_zxcvbn_enqueue_script() {
    wp_enqueue_script('ww-zxcvbn-script', plugin_dir_url(__FILE__) . 'dist/ww-zxcvbn.js', array(), '1.0', true);
}
add_action('wp_enqueue_scripts', 'ww_zxcvbn_enqueue_script');

function add_password_strength_indicator() {
    ?>
    <p>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password">
        <div id="password-strength"></div>
    </p>
    <?php
}
add_action('register_form', 'add_password_strength_indicator_to_forms');
add_action('lostpassword_form', 'add_password_strength_indicator_to_forms');
