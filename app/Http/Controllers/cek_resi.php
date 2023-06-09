<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class cek_resi extends Controller
{
    public function cek_resi() {
        
        return view('produk.cek_resi');
    }
}
