<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnalysisHistory extends Model
{
    use HasFactory;

    // =========================
    // TABLE
    // =========================
    protected $table = 'analysis_histories';

    // =========================
    // MASS ASSIGNMENT
    // =========================
    protected $fillable = [

        // PARAMETER AIR
        'ph',
        'hardness',
        'solids',
        'chloramines',
        'sulfate',
        'conductivity',
        'organic_carbon',
        'trihalomethanes',
        'turbidity',

        // HASIL AI
        'result',
        'probability',
        'confidence',

    ];
}