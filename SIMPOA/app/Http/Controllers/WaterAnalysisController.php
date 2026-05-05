<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WaterAnalysisController extends Controller
{
    public function form()
    {
        return view('pages.input');
    }

    public function analyze(Request $request)
    {
        $request->validate([
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

        // 🔥 LOGIC DUMMY (sementara)
        $isLayak = true;

        if (
            $request->ph < 6.5 || $request->ph > 8.5 ||
            $request->turbidity > 5
        ) {
            $isLayak = false;
        }

        $result = $isLayak ? 'LAYAK' : 'TIDAK';
        $probability = $isLayak ? 96.5 : 53.7;

        return redirect()->route('hasil')->with([
            'result' => $result,
            'probability' => $probability,
            'data' => $request->all()
        ]);
    }

    public function hasil()
    {
        return view('pages.hasil');
    }
}