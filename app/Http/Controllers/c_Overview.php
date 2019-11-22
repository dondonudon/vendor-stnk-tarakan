<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class c_Overview extends Controller
{
    public function index() {
        return view('dashboard.overview.index');
    }
}
