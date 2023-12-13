<?php

use App\Models\Donut;
use App\Models\User;

return [

    /*
    |--------------------------------------------------------------------------
    | Resources
    |--------------------------------------------------------------------------
    |
    | Configure the resources (models) you'd like to be available in Runway.
    |
    */

    'resources' => [

        Donut::class => [
            'name' => 'Donuts',

            'blueprint' => 'donut',

            'title_field' => 'name',

            'cp_icon' => 'radio',
        ],

        User::class => [
            'name' => 'Members',

            'blueprint' => 'member',

            'title_field' => 'name',

            'cp_icon' => 'user',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Disable Migrations?
    |--------------------------------------------------------------------------
    |
    | Should Runway's migrations be disabled?
    | (eg. not automatically run when you next vendor:publish)
    |
    */

    'disable_migrations' => false,

];
