<?php

/**
 * BG : blue, indigo, purple, pink, red, orange, yellow, green, teal, cyan, gray, gray-dark, black
 * Type : dark, light
 * Shadow : 0-4.
 */
return [
    'navbar'  => [
        'bg'     => 'white',
        'type'   => 'light',
        'border' => true,
        'user'   => [
            'visible' => false,
            'shadow'  => 0,
        ],
    ],
    'sidebar' => [
        'type'    => 'light', // dark
        'shadow'  => 4,
        'border'  => true,
        'compact' => false,
        'links'   => [
            'bg'     => 'indigo',
            'shadow' => 1,
        ],
        'brand'   => [
            'bg'   => 'white',
            'logo' => [
                'bg'     => 'indigo',
                'icon'   => '<img src="/assets/vendor/boilerplate/images/vendor/ncc.png" width="20" height="20"alt="Logo">',
                'text'   => 'GUJ (I) COY NCC',
                'shadow' => 2,
            ],
        ],
        'user'    => [
            'visible' => true,
            'shadow'  => 2,
        ],
    ],
    'footer'  => [
        'visible'    => true,
        'vendorname' => 'GUJ (I) COY NCC',
        'vendorlink' => '',
    ],
    'card'    => [
        'outline'       => true,
        'default_color' => 'info',
    ],
];
