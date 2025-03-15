<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PelayanController extends Controller
{
    public function index() { return view('pelayan.dashboard'); }

}
