<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WaterAnalysisController extends Controller
{
    public function index()
    {
        return view('home');
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

        $result = 'Layak';

        if (
            $request->ph < 6.5 || $request->ph > 8.5 ||
            $request->turbidity > 5
        ) {
            $result = 'Tidak Layak';
        }

        return back()->with('result', $result);
    }
}