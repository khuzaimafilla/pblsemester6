<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\Process\Process;

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
            'ph' => 'required|numeric',
            'hardness' => 'required|numeric',
            'solids' => 'required|numeric',
            'chloramines' => 'required|numeric',
            'sulfate' => 'required|numeric',
            'conductivity' => 'required|numeric',
            'organic_carbon' => 'required|numeric',
            'trihalomethanes' => 'required|numeric',
            'turbidity' => 'required|numeric',
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
        // KIRIM KE PAGE HASIL
        // =========================
        return view('pages.hasil', [
            'result' => $result['result'],
            'probability' => $result['probability'],
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
}