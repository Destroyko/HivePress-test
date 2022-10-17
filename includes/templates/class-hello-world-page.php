<?php

namespace HivePress\Templates;

use HivePress\Helpers as hp;

// Exit if accessed directly.
defined('ABSPATH') || exit;

/**
 * Template class.
 */
class Hello_World_Page extends User_Account_Page
{

    /**
     * Class constructor.
     *
     * @param array $args Template arguments.
     */
    public function __construct($args = [])
    {
        $args = hp\merge_trees(
            [
                'blocks' => [
                    'page_content' => [
                        'blocks' => [
                            'hello_world_form' => [
                                'type' => 'form',
                                'form' => 'hello_world',
                                'order' => 11
                            ],
                        ],
                    ],
                ],
            ],
            $args
        );

        parent::__construct($args);
    }
}
