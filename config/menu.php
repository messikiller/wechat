<?php
return [
    [
        "name"       => "Care center",
        "sub_button" => [
            [
                "type" => "view",
                "name" => "My information",
                "url"  => env('APP_URL') . '/member/profile'
            ],
            [
                "type" => "view",
                "name" => "Doctor center（ES）",
                "url"  => env('APP_URL') . '/care/doctor/endoscope'
            ],
            [
                "type" => "view",
                "name" => "Doctor center（US）",
                "url"  => env('APP_URL') . '/care/doctor/ultrasound'
            ],

            [
                "type" => "view",
                "name" => "My Machine",
                "url"  => env('APP_URL') . '/member/machine'
            ],
            [
                "type" => "view",
                "name" => "Distributor center",
                "url"  => env('APP_URL') . '/care/provider/center'
            ],
        ],
    ],
    [
        "name"       => "Support",
        "sub_button" => [
            [
                "type" => "view",
                "name" => "News",
                "url"  => env('APP_URL') . '/support/news'
            ],
            [
                "type" => "view",
                "name" => "Ultrasound center",
                "url"  => env('APP_URL') . '/support/ultrasound/center'
            ],
            [
                "type" => "view",
                "name" => "Endoscopy center",
                "url"  => env('APP_URL') . '/support/endoscope/center'
            ],
            [
                "type" => "view",
                "name" => "Endoscopy maintain",
                "url"  => env('APP_URL') . '/support/endoscope/maintain'
            ],
        ],
    ],
    [
        "name"       => "Sonoscape",
        "sub_button" => [
            [
                "type" => "view",
                "name" => "Home",
                "url"  => env('APP_URL') . '/home/index'
            ],
            [
                "type" => "view",
                "name" => "About Us",
                "url"  => env('APP_URL') . '/about/us'
            ],
            [
                "type" => "view",
                "name" => "Global Branch",
                "url"  => env('APP_URL') . '/about/globe'
            ],
            [
                "type" => "view",
                "name" => "Contract us",
                "url"  => env('APP_URL') . '/about/contact'
            ],
        ],
    ],
];
