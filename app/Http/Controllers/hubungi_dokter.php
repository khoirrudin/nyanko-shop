<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class hubungi_dokter extends Controller
{
    public function hubungi_dokter()
    {
        return view('dokter.hubungi_dokter');
    }
}
