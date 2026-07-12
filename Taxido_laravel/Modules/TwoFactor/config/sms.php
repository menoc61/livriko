<?php

    return [
        'name' => 'TwoFactor',
        'slug' => 'twoFactor',
        'image' => 'modules/twoFactor/images/logo.svg',
        'configs' => [
            'twoFactor_key' => env('TWOFACTOR_API_KEY'),
            'otp_template_name' => env('OTP_TEMPLATE_NAME'),
        ],
        'fields' => [
            'twoFactor_key' => [
                'type' => 'password',
                'label' => 'TwoFactor Key',
            ],
            'otp_template_name' => [
                'type' => 'password',
                'label' => 'Template Name',
            ],
        ],
    ];
