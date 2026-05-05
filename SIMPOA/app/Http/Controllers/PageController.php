<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    /**
     * Landing Page / Beranda
     */
    public function beranda()
    {
        return view('pages.landing');
    }

    /**
     * Halaman Prosedur
     */
    public function prosedur()
    {
        return view('pages.prosedur');
    }

    /**
     * Halaman Tentang SIMPOA
     */
    public function tentang()
    {
        return view('pages.about');
    }

    // Halaman Wawasan Kandungan Air
    public function wawasan()
    {
        return view('pages.wawasan');
    }

    // Halaman Coba Form Input
    public function form()
    {
        return view('pages.input');
    }
}