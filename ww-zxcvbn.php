<?php
/*
Plugin Name: ww-xcvbn
Description: Replaces default Zxcvbn library with Zxcvbn TypeScript library.
Version: 1.0
Author: Oswaldo Nickel
*/

function dequeue_default_zxcvbn() {
    wp_dequeue_script('zxcvbn-async');
    wp_dequeue_script('zxcvbn-async-legacy');
    wp_dequeue_script('password-strength-meter');
}
add_action('wp_enqueue_scripts', 'dequeue_default_zxcvbn', 9999);

//mein script einziehen
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

