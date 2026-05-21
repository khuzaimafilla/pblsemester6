<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\Process\Process;
use App\Models\AnalysisHistory;
use Barryvdh\DomPDF\Facade\Pdf;

class WaterAnalysisController extends Controller
{
    // =========================
    // PAGE FORM INPUT
    // =========================
    public function form()
    {
        return view('pages.input');
    }

    // =========================
    // ANALISIS AI
    // =========================
    public function analyze(Request $request)
    {
        // =========================
        // VALIDASI INPUT
        // =========================
        $validated = $request->validate([

            // pH
            'ph' => 'required|numeric|min:0|max:14',

            // Hardness
            'hardness' => 'required|numeric|min:0|max:1000',

            // TDS / Solids
            'solids' => 'required|numeric|min:0|max:50000',

            // Chloramines
            'chloramines' => 'required|numeric|min:0|max:20',

            // Sulfate
            'sulfate' => 'required|numeric|min:0|max:1000',

            // Conductivity
            'conductivity' => 'required|numeric|min:0|max:2000',

            // Organic Carbon
            'organic_carbon' => 'required|numeric|min:0|max:50',

            // Trihalomethanes
            'trihalomethanes' => 'required|numeric|min:0|max:300',

            // Turbidity
            'turbidity' => 'required|numeric|min:0|max:100',

        ], [

            // =========================
            // CUSTOM ERROR MESSAGE
            // =========================

            'ph.max' => 'Nilai pH maksimal adalah 14.',
            'ph.min' => 'Nilai pH tidak boleh negatif.',

            'hardness.min' => 'Hardness tidak boleh negatif.',
            'solids.min' => 'TDS tidak boleh negatif.',
            'chloramines.min' => 'Chloramines tidak boleh negatif.',
            'sulfate.min' => 'Sulfate tidak boleh negatif.',
            'conductivity.min' => 'Conductivity tidak boleh negatif.',
            'organic_carbon.min' => 'Organic Carbon tidak boleh negatif.',
            'trihalomethanes.min' => 'Trihalomethanes tidak boleh negatif.',
            'turbidity.min' => 'Turbidity tidak boleh negatif.',

        ]);

        // =========================
        // FORMAT DATA UNTUK PYTHON
        // =========================
        $input = [
            "ph" => (float)$validated['ph'],
            "Hardness" => (float)$validated['hardness'],
            "Solids" => (float)$validated['solids'],
            "Chloramines" => (float)$validated['chloramines'],
            "Sulfate" => (float)$validated['sulfate'],
            "Conductivity" => (float)$validated['conductivity'],
            "Organic_carbon" => (float)$validated['organic_carbon'],
            "Trihalomethanes" => (float)$validated['trihalomethanes'],
            "Turbidity" => (float)$validated['turbidity'],
        ];

        // =========================
        // RUN PYTHON AI
        // =========================
        $process = new Process([
            'C:\\Users\\LENOVO\\AppData\\Local\\Programs\\Python\\Python311\\python.exe',
            base_path('python-ai/predict.py'),
            json_encode($input)
        ]);

        // =========================
        // FIX WINDOWS ENV
        // =========================
        $process->setEnv([
            'SYSTEMROOT' => getenv('SYSTEMROOT'),
            'WINDIR' => getenv('WINDIR'),
            'PATH' => getenv('PATH'),
        ]);

        $process->run();

        // =========================
        // JIKA PYTHON ERROR
        // =========================
        if (!$process->isSuccessful()) {
            dd($process->getErrorOutput());
        }

        // =========================
        // AMBIL HASIL AI
        // =========================
        $result = json_decode($process->getOutput(), true);

        // =========================
        // JIKA OUTPUT NULL
        // =========================
        if (!$result) {
            dd($process->getOutput());
        }

        // =========================
        // CONFIDENCE LEVEL
        // =========================
        $probability = $result['probability'];

        if ($probability >= 90) {

            $confidence = 'Sangat Yakin';

        } elseif ($probability >= 75) {

            $confidence = 'Yakin';

        } elseif ($probability >= 60) {

            $confidence = 'Cukup';

        } else {

            $confidence = 'Rendah';

        }

        // =========================
        // SAVE HISTORY DATABASE
        // =========================
        AnalysisHistory::create([

            // PARAMETER
            'ph' => $validated['ph'],
            'hardness' => $validated['hardness'],
            'solids' => $validated['solids'],
            'chloramines' => $validated['chloramines'],
            'sulfate' => $validated['sulfate'],
            'conductivity' => $validated['conductivity'],
            'organic_carbon' => $validated['organic_carbon'],
            'trihalomethanes' => $validated['trihalomethanes'],
            'turbidity' => $validated['turbidity'],

            // AI RESULT
            'result' => $result['result'],
            'probability' => $probability,
            'confidence' => $confidence,

        ]);

        // =========================
        // KIRIM KE PAGE HASIL
        // =========================
        return view('pages.hasil', [
            'result' => $result['result'],
            'probability' => $probability,
            'data' => $validated
        ]);
    }

    // =========================
    // PAGE HASIL
    // =========================
    public function hasil()
    {
        return view('pages.hasil');
    }

    // =========================
    // EXPORT PDF
    // =========================
    public function exportPdf(Request $request)
    {
        // =========================
        // DATA
        // =========================
        $data = json_decode($request->data, true);

        $result = $request->result;

        $probability = $request->probability;

        $isLayak = $result === 'LAYAK';

        // =========================
        // LOAD STANDARDS
        // =========================
        $standards = config('water_standards');

        // =========================
        // CONFIDENCE
        // =========================
        if ($probability >= 90) {

            $confidence = 'Sangat Yakin';

        } elseif ($probability >= 75) {

            $confidence = 'Yakin';

        } elseif ($probability >= 60) {

            $confidence = 'Cukup';

        } else {

            $confidence = 'Rendah';

        }

        // =========================
        // ROWS
        // =========================
        $rows = [
            ['pH', $data['ph'] ?? '-'],
            ['Hardness', $data['hardness'] ?? '-'],
            ['TDS', $data['solids'] ?? '-'],
            ['Chloramines', $data['chloramines'] ?? '-'],
            ['Sulfate', $data['sulfate'] ?? '-'],
            ['Conductivity', $data['conductivity'] ?? '-'],
            ['Trihalomethanes', $data['trihalomethanes'] ?? '-'],
            ['Turbidity', $data['turbidity'] ?? '-'],
        ];

        // =========================
        // SAW
        // =========================
        $sawScore = 0;

        $totalWeight = 0;

        foreach ($rows as $row) {

            $parameter = $row[0];

            $value = (float)$row[1];

            $rule = $standards[$parameter] ?? null;

            if ($rule) {

                $weight = $rule['weight'] ?? 0;

                $totalWeight += $weight;

                $parameterScore = 1;

                if (
                    isset($rule['min']) &&
                    $value < $rule['min']
                ) {

                    $parameterScore = 0;

                }

                if (
                    isset($rule['max']) &&
                    $value > $rule['max']
                ) {

                    $parameterScore = 0;

                }

                $sawScore += ($parameterScore * $weight);

            }

        }

        // =========================
        // FINAL SAW
        // =========================
        $finalSaw = 0;

        if ($totalWeight > 0) {

            $finalSaw = ($sawScore / $totalWeight) * 100;

        }

        // =========================
        // SAW CATEGORY
        // =========================
        if ($finalSaw >= 80) {

            $sawCategory = 'Kualitas Sangat Baik';

        } elseif ($finalSaw >= 60) {

            $sawCategory = 'Kualitas Baik';

        } elseif ($finalSaw >= 40) {

            $sawCategory = 'Kualitas Sedang';

        } else {

            $sawCategory = 'Kualitas Buruk';

        }

        // =========================
        // CRITICAL RULE
        // =========================
        $criticalFailed = false;

        foreach ($rows as $row) {

            $parameter = $row[0];

            $value = (float)$row[1];

            $rule = $standards[$parameter] ?? null;

            if ($rule) {

                if (
                    isset($rule['critical_min']) &&
                    $value < $rule['critical_min']
                ) {

                    $criticalFailed = true;

                }

                if (
                    isset($rule['critical_max']) &&
                    $value > $rule['critical_max']
                ) {

                    $criticalFailed = true;

                }

            }

        }

        // =========================
        // HYBRID DECISION
        // =========================
        $hybridLayak = false;

        if (

            !$criticalFailed &&

            (
                $finalSaw >= 70 ||
                ($isLayak && $finalSaw >= 60)
            )

        ) {

            $hybridLayak = true;

        }

        // =========================
        // PDF
        // =========================
        $pdf = Pdf::loadView('pages.pdf', [

            'data' => $data,
            'result' => $result,
            'probability' => $probability,
            'confidence' => $confidence,
            'standards' => $standards,
            'rows' => $rows,
            'finalSaw' => $finalSaw,
            'sawCategory' => $sawCategory,
            'hybridLayak' => $hybridLayak,

        ]);

        // =========================
        // STREAM PDF
        // =========================
        return $pdf->stream('SIMPOA-Analysis.pdf');
    }
}