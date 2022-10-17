<?php

namespace HivePress\Components;

use HivePress\Helpers as hp;
use HivePress\Models;
use HivePress\Emails;


defined('ABSPATH') || exit;

/**
 * Component class.
 */
final class Hello_World extends Component
{

    /**
     * Class constructor.
     *
     * @param array $args Component arguments.
     */
    public function __construct($args = [])
    {

        add_filter(
            'hivepress/v1/menus/user_account',
            function ($menu) {
                $menu['items']['hello_world'] = [
                    'label' => 'Hello World',
                    'route' => 'hello_world_page',
                    '_order' => 123
                ];

                return $menu;
            }
        );

        add_filter(
            'hivepress/v1/templates/listings_view_page',
            function ($template) {
                return hivepress()->helper->merge_trees(
                    $template,
                    [
                        'blocks' => [
                            'page_sidebar' => [
                                'blocks' => [
                                    'hello_world' => [
                                        'type' => 'container',
                                        'tag' => 'a',
                                        'attributes' => [
                                            'class' => ['button', 'button--secondary'],
                                            'href' => hivepress()->router->get_url('hello_world_page'),
                                        ],
                                        'blocks' => [
                                            'hello_world_text' => [
                                                'type' => 'content',
                                                'content' => 'Hello World',
                                            ]
                                        ],
                                        'order' => 10
                                    ],
                                ]
                            ],
                        ],
                    ]
		);
            }
        );

        parent::__construct($args);
    }

}
