<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WaterAnalysis extends Model
{
    use HasFactory;

    protected $fillable = [
        'ph',
        'hardness',
        'solids',
        'chloramines',
        'sulfate',
        'conductivity',
        'organic_carbon',
        'trihalomethanes',
        'turbidity',
        'result',
        'probability',
    ];
}