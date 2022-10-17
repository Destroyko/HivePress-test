<?php

namespace HivePress\Controllers;

use HivePress\Helpers as hp;
use HivePress\Models;
use HivePress\Blocks;
use HivePress\Forms;
use \Datetime;

// Exit if accessed directly.
defined('ABSPATH') || exit;

/**
 * Controller class.
 */
final class Hello_World extends Controller
{

    /**
     * Class constructor.
     *
     * @param array $args Controller arguments.
     */
    public function __construct($args = [])
    {
        $args = hp\merge_arrays(
            [
                'routes' => [
                    'hello_world_page' => [
                        'title' => esc_html__('Hello world page'),
                        'base' => 'hello-world',
                        'path' => '/hello-world',
                        'redirect' => [$this, 'redirect_user_page'],
                        'action' => [$this, 'render_hello_world_page']
                    ],
                    'user_update_name_action' => [
                        'path' => '/user-update-name',
                        'method' => 'POST',
                        'action' => [$this, 'update_user_name'],
                        'rest' => true,
                    ],

                ],
            ],
            $args
        );

        parent::__construct($args);
    }

    public function update_user_name()
    {

        if (!is_user_logged_in()) {
            return hp\rest_error(401);
        }

        $user_meta = get_user_meta(get_current_user_id());


        if ($user_meta['first_name'][0] == 'Hello' && $user_meta['last_name'][0] == 'World') {
            $user_name = [
                'first_name' => 'John',
                'last_name' => 'Doe',
            ];
        } else {
            $user_name = [
                'first_name' => 'Hello',
                'last_name' => 'World',
            ];
        }
        if ((Models\User::query()->get_by_id(get_current_user_id()))->fill($user_name)->save()) {
            return hp\rest_response(
                200,
                [
                    'id' => get_current_user_id(),
                ]
            );
        }

        return hp\rest_error(404);
    }

    public function redirect_user_page()
    {

        if (!is_user_logged_in()) {
            wp_redirect(home_url(), 301);
            exit;
        } else {
            $current_user = wp_get_current_user();

            if ((new Datetime($current_user->user_registered)) >= (new Datetime('now'))->modify('-1 hour') == !in_array('administrator', $current_user->roles)) {
                wp_redirect(home_url(), 301);
                exit;
            }
        }

        return false;
    }

    /**
     * Renders listing feed page.
     *
     * @return string
     */
    public function render_hello_world_page()
    {

        // Render page template.
        return (new Blocks\Template(
            [
                'template' => 'hello_world_page',
            ]
        ))->render();
    }

}
