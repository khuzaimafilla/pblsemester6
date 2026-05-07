<?php

return [

    'pH' => [
        'min' => 6.5,
        'max' => 8.5,
        'label' => '6.5 - 8.5',
        'danger' => 'pH tidak normal dapat menyebabkan iritasi dan mengindikasikan ketidakseimbangan kimia air.',
        'suggestion' => 'Lakukan penyesuaian pH dan filtrasi sebelum konsumsi.',
    ],

    'Hardness' => [
        'max' => 500,
        'label' => '< 500 mg/L',
        'danger' => 'Kesadahan tinggi dapat menyebabkan penumpukan mineral dan menurunkan kualitas air.',
        'suggestion' => 'Gunakan water softener atau filtrasi tambahan.',
    ],

    'TDS' => [
        'max' => 500,
        'label' => '< 500 ppm',
        'danger' => 'TDS tinggi menunjukkan kandungan zat terlarut berlebih dalam air.',
        'suggestion' => 'Gunakan filtrasi reverse osmosis (RO).',
    ],

    'Chloramines' => [
        'max' => 4,
        'label' => '< 4 ppm',
        'danger' => 'Kloramin berlebih dapat menyebabkan iritasi dan memengaruhi kualitas air.',
        'suggestion' => 'Gunakan filtrasi karbon aktif atau dechlorination.',
    ],

    'Sulfate' => [
        'max' => 250,
        'label' => '< 250 mg/L',
        'danger' => 'Sulfat tinggi dapat menyebabkan rasa pahit dan gangguan pencernaan.',
        'suggestion' => 'Gunakan filtrasi ion exchange atau reverse osmosis.',
    ],

    'Conductivity' => [
        'max' => 400,
        'label' => '< 400 µS/cm',
        'danger' => 'Conductivity tinggi menunjukkan tingginya kandungan ion terlarut.',
        'suggestion' => 'Lakukan pemurnian dan filtrasi tambahan.',
    ],

    'Trihalomethanes' => [
        'max' => 80,
        'label' => '< 80 µg/L',
        'danger' => 'Trihalomethanes tinggi berpotensi menimbulkan risiko kesehatan jangka panjang.',
        'suggestion' => 'Kurangi penggunaan klorin berlebih dan gunakan karbon aktif.',
    ],

    'Turbidity' => [
        'max' => 5,
        'label' => '< 5 NTU',
        'danger' => 'Kekeruhan tinggi dapat mengindikasikan kontaminasi mikroorganisme.',
        'suggestion' => 'Lakukan filtrasi dan perebusan sebelum konsumsi.',
    ],

];