<?php

return [

    // =========================
    // pH
    // =========================
    'pH' => [
        'weight' => 0.20,

        'critical_min' => 5,
        'critical_max' => 10,

        'min' => 6.5,
        'max' => 8.5,

        'score_rules' => [

        [
            'min'=>6.5,
            'max'=>8.5,
            'score'=>1
        ],

        [
            'min'=>6,
            'max'=>9,
            'score'=>0.8
        ],

        [
            'min'=>5,
            'max'=>10,
            'score'=>0.5
        ],

        [
            'min'=>0,
            'max'=>14,
            'score'=>0
        ]

    ],

        'label' => '6.5 - 8.5',

        'low_status' => 'Terlalu Asam',
        'high_status' => 'Terlalu Basa',

        'low_danger' =>
            'pH terlalu rendah menunjukkan air bersifat asam dan dapat menyebabkan iritasi serta korosi.',

        'high_danger' =>
            'pH terlalu tinggi menunjukkan air terlalu basa dan dapat memengaruhi rasa serta kualitas air.',

        'low_suggestion' =>
            'Lakukan penyesuaian pH dan filtrasi sebelum konsumsi.',

        'high_suggestion' =>
            'Lakukan penyesuaian alkalinitas sebelum digunakan.',

    ],

    // =========================
    // HARDNESS
    // =========================
    'Hardness' => [
        'weight' => 0.10,

        'max' => 500,

        'score_rules'=>[

        [
            'min'=>0,
            'max'=>150,
            'score'=>1
        ],

        [
            'min'=>151,
            'max'=>300,
            'score'=>0.8
        ],

        [
            'min'=>301,
            'max'=>500,
            'score'=>0.5
        ],

        [
            'min'=>501,
            'max'=>10000,
            'score'=>0
        ]

    ],


        'label' => '< 500 mg/L',

        'high_status' => 'Kesadahan Tinggi',

        'high_danger' =>
            'Kesadahan tinggi dapat menyebabkan penumpukan mineral dan menurunkan kualitas air.',

        'high_suggestion' =>
            'Gunakan water softener atau filtrasi tambahan.',

    ],

    // =========================
    // TDS
    // =========================
    'TDS' => [
        'weight' => 0.15,

        'critical_max' => 1000,

        'max' => 500,

                'score_rules'=>[

    [
        'min'=>0,
        'max'=>300,
        'score'=>1
    ],

    [
        'min'=>301,
        'max'=>500,
        'score'=>0.8
    ],

    [
        'min'=>501,
        'max'=>1000,
        'score'=>0.5
    ],

    [
        'min'=>1001,
        'max'=>10000,
        'score'=>0
    ]

],


        'label' => '< 500 ppm',

        'high_status' => 'TDS Tinggi',

        'high_danger' =>
            'TDS tinggi menunjukkan kandungan zat terlarut berlebih dalam air.',

        'high_suggestion' =>
            'Gunakan filtrasi reverse osmosis (RO).',

    ],

    // =========================
    // CHLORAMINES
    // =========================
    'Chloramines' => [
        'weight' => 0.10,

        'critical_max' => 6,

        'min' => 0.2,
        'max' => 4,

                'score_rules'=>[

        [
            'min'=>0.2,
            'max'=>4,
            'score'=>1
        ],

        [
            'min'=>0.1,
            'max'=>5,
            'score'=>0.8
        ],

        [
            'min'=>0,
            'max'=>6,
            'score'=>0.5
        ],

        [
            'min'=>6.1,
            'max'=>100,
            'score'=>0
        ]

    ],


        'label' => '0.2 - 4 ppm',

        'low_status' => 'Kloramin Rendah',
        'high_status' => 'Kloramin Tinggi',

        'low_danger' =>
            'Kadar kloramin terlalu rendah dapat mengurangi efektivitas desinfeksi.',

        'high_danger' =>
            'Kloramin berlebih dapat menyebabkan iritasi dan memengaruhi kualitas air.',

        'low_suggestion' =>
            'Pastikan proses desinfeksi berjalan optimal.',

        'high_suggestion' =>
            'Gunakan filtrasi karbon aktif atau dechlorination.',

    ],

    // =========================
    // SULFATE
    // =========================
    'Sulfate' => [
        'weight' => 0.10,

        'critical_max' => 500,

        'max' => 250,

                'score_rules'=>[

    [
        'min'=>0,
        'max'=>150,
        'score'=>1
    ],

    [
        'min'=>151,
        'max'=>250,
        'score'=>0.8
    ],

    [
        'min'=>251,
        'max'=>500,
        'score'=>0.5
    ],

    [
        'min'=>501,
        'max'=>10000,
        'score'=>0
    ]

],


        'label' => '< 250 mg/L',

        'high_status' => 'Sulfat Tinggi',

        'high_danger' =>
            'Sulfat tinggi dapat menyebabkan rasa pahit dan gangguan pencernaan.',

        'high_suggestion' =>
            'Gunakan filtrasi ion exchange atau reverse osmosis.',

    ],

    // =========================
    // CONDUCTIVITY
    // =========================
    'Conductivity' => [
        'weight' => 0.10,

        'critical_min' => 20,
        'critical_max' => 800,

        'min' => 50,
        'max' => 400,

                'score_rules'=>[

    [
        'min'=>50,
        'max'=>400,
        'score'=>1
    ],

    [
        'min'=>30,
        'max'=>500,
        'score'=>0.8
    ],

    [
        'min'=>20,
        'max'=>800,
        'score'=>0.5
    ],

    [
        'min'=>0,
        'max'=>10000,
        'score'=>0
    ]

],


        'label' => '50 - 400 µS/cm',

        'low_status' => 'Conductivity Rendah',
        'high_status' => 'Conductivity Tinggi',

        'low_danger' =>
            'Conductivity terlalu rendah dapat menunjukkan minimnya mineral penting.',

        'high_danger' =>
            'Conductivity tinggi menunjukkan tingginya kandungan ion terlarut.',

        'low_suggestion' =>
            'Periksa kandungan mineral dalam air.',

        'high_suggestion' =>
            'Lakukan pemurnian dan filtrasi tambahan.',

    ],

    // =========================
    // TRIHALOMETHANES
    // =========================
    'Trihalomethanes' => [
        'weight' => 0.10,

        'critical_max' => 120,

        'max' => 80,

                'score_rules'=>[

    [
        'min'=>0,
        'max'=>60,
        'score'=>1
    ],

    [
        'min'=>61,
        'max'=>80,
        'score'=>0.8
    ],

    [
        'min'=>81,
        'max'=>120,
        'score'=>0.5
    ],

    [
        'min'=>121,
        'max'=>10000,
        'score'=>0
    ]

],


        'label' => '< 80 µg/L',

        'high_status' => 'Trihalomethanes Tinggi',

        'high_danger' =>
            'Trihalomethanes tinggi berpotensi menimbulkan risiko kesehatan jangka panjang.',

        'high_suggestion' =>
            'Kurangi penggunaan klorin berlebih dan gunakan karbon aktif.',

    ],

    // =========================
    // TURBIDITY
    // =========================
    'Turbidity' => [
        'weight' => 0.10,

        'critical_max' => 10,

        'min' => 0,
        'max' => 5,

               'score_rules'=>[

    [
        'min'=>0,
        'max'=>3,
        'score'=>1
    ],

    [
        'min'=>3.1,
        'max'=>5,
        'score'=>0.8
    ],

    [
        'min'=>5.1,
        'max'=>10,
        'score'=>0.5
    ],

    [
        'min'=>10.1,
        'max'=>100,
        'score'=>0
    ]

],


        'label' => '0 - 5 NTU',

        'high_status' => 'Kekeruhan Tinggi',

        'high_danger' =>
            'Kekeruhan tinggi dapat mengindikasikan kontaminasi mikroorganisme.',

        'high_suggestion' =>
            'Lakukan filtrasi dan perebusan sebelum konsumsi.',

 
    ],

    // =========================
// ORGANIC CARBON (TOC)
// =========================

'OrganicCarbon' => [

    'weight' => 0.05,

    'critical_max' => 25,

    'max' => 15,

    'score_rules'=>[

        [
            'min'=>0,
            'max'=>10,
            'score'=>1
        ],

        [
            'min'=>11,
            'max'=>15,
            'score'=>0.75
        ],

        [
            'min'=>16,
            'max'=>25,
            'score'=>0.5
        ],

        [
            'min'=>26,
            'max'=>100,
            'score'=>0
        ]

    ],

    'label'=>'< 15 ppm',

    'high_status'=>'TOC Tinggi',

    'high_danger'=>
    'Kadar karbon organik tinggi dapat mengindikasikan kontaminasi bahan organik.',

    'high_suggestion'=>
    'Lakukan filtrasi tambahan dan pemeriksaan sumber air.'

],

];