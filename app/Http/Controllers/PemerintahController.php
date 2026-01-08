<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PemerintahController extends Controller
{
    public function dashboard()
    {
        return view('pemerintah.dashboard');
    }

    public function monitoring()
    {
        return view('pemerintah.monitoring');
    }

    public function keluhan()
    {
        return view('pemerintah.keluhan');
    }

    public function laporan()
    {
        return view('pemerintah.laporan');
    }

    public function manajemenSekolah()
    {
        return view('pemerintah.manajemen_sekolah');
    }

    public function menu()
    {
        return view('pemerintah.menu');
    }
}
