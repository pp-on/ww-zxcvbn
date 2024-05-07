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
function custom_zxcvbn_enqueue_script() {
    wp_enqueue_script('custom-zxcvbn-script', plugin_dir_url(__FILE__) . 'js/custom-zxcvbn.js', array(), '1.0', true);
}
add_action('wp_enqueue_scripts', 'custom_zxcvbn_enqueue_script');

