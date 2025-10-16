<?php

return [
    /*
    |--------------------------------------------------------------------------
    | KSMIF OPREC Configuration
    |--------------------------------------------------------------------------
    |
    | Configuration values for KSMIF Open Recruitment Game Besar application.
    |
    */

    'submissions' => [
        'per_page_default' => env('SUBMISSIONS_PER_PAGE', 10),
        'per_page_min' => 5,
        'per_page_max' => 50,
    ],

    'teams' => [
        'per_page' => 15,
    ],

    'snippets' => [
        'per_page' => 15,
    ],

    'operators' => [
        'default_email' => env('DEFAULT_OPERATOR_EMAIL', 'operator@ksmif.test'),
        'default_password' => env('DEFAULT_OPERATOR_PASSWORD', 'password'),
    ],
];

