<?php

namespace HivePress\Forms;

use HivePress\Helpers as hp;

// Exit if accessed directly.
defined('ABSPATH') || exit;


class Hello_World extends Form
{

    public function __construct($args = [])
    {
        $args = hp\merge_arrays(
            [
                'message' => hivepress()->translator->get_string('changes_have_been_saved'),
                'action' => hivepress()->router->get_url('user_update_name_action'),
                'method' => 'POST',
                'redirect' => false,
                'button' => [
                    'label' => 'Change my name',
                ],
            ],
            $args
        );

        parent::__construct($args);
    }
}
