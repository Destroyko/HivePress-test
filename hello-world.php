<?php
/**
 * Plugin Name: Hello World
 * Description: Test task
 * Version: 5.0.0
 * Author: Vasiliy Kriukov
 * Author URI: https://example.com/
 * Text Domain: hello-world
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;

// Register extension directory.
add_filter(
    'hivepress/v1/extensions',
    function ($extensions) {
        $extensions[] = __DIR__;

        return $extensions;
    }
);
