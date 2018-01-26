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
                "name" => "Doctor center（US）",
                "url"  => env('APP_URL') . '/care/doctor/endoscope'
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
            [
                "type" => "view",
                "name" => "Contract us",
                "url"  => env('APP_URL') . '/about/contact'
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
                "name" => "about us",
                "url"  => env('APP_URL') . '/about/us'
            ],
            [
                "type" => "view",
                "name" => "Gloabal Branch",
                "url"  => env('APP_URL') . '/about/globe'
            ]
        ],
    ],
];
