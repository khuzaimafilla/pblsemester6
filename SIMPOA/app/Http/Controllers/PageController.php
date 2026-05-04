<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    /**
     * Halaman Beranda / Landing Page
     */
    public function beranda()
    {
        return view('pages.beranda');
    }

    /**
     * Halaman Prosedur / Cek Air
     * (Diisi sesuai kebutuhan tim lain)
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
        return view('pages.about.blade');
    }
}