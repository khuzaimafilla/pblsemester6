<?php

return [

    // =========================
    // pH
    // =========================
    'pH' => [

        'min' => 6.5,
        'max' => 8.5,

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

        'max' => 500,

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

        'max' => 500,

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

        'min' => 0.2,
        'max' => 4,

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

        'max' => 250,

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

        'min' => 50,
        'max' => 400,

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

        'max' => 80,

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

        'min' => 0,
        'max' => 5,

        'label' => '0 - 5 NTU',

        'high_status' => 'Kekeruhan Tinggi',

        'high_danger' =>
            'Kekeruhan tinggi dapat mengindikasikan kontaminasi mikroorganisme.',

        'high_suggestion' =>
            'Lakukan filtrasi dan perebusan sebelum konsumsi.',

    ],

];