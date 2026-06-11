<?php

namespace App\Http\Controllers;

class PageController extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function geotrace()
    {
        return view('geotrace');
    }

    public function fuelpoint()
    {
        return view('fuelpoint');
    }

    public function povertymap()
    {
        return view('povertymap');
    }

    public function registerKk()
    {
        return view('register_kk');
    }
}
