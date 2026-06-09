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
        $pythonPath = env('PYTHON_PATH', 'python');

        $scriptPath = base_path('python-ai/predict.py');

        $process = new Process([ 
        $pythonPath, 
        $scriptPath, 
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

            $confidence='Sangat Tinggi';

        }
        elseif ($probability >=75){

            $confidence='Tinggi';

        }
        elseif($probability >=55){

            $confidence='Sedang';

        }
        elseif($probability >=45){

            $confidence='Cukup';

        }
        else{

            $confidence='Rendah';

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
            ['OrganicCarbon', $data['organic_carbon'] ?? '-'],
            ['Trihalomethanes', $data['trihalomethanes'] ?? '-'],
            ['Turbidity', $data['turbidity'] ?? '-'],

        ];

        $finalSaw = (float) $request->finalSaw;
        $sawCategory = $request->sawCategory;
        $hybridLayak = (bool) $request->hybridLayak;

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