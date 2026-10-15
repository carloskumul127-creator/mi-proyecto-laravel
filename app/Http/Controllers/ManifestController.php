<?php

namespace App\Http\Controllers;

class ManifestController extends Controller
{
    public function index()
    {
        return view('manifiestos.index');
    }
}