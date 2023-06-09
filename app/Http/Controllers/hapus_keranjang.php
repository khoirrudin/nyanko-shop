<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class hapus_keranjang extends Controller
{
    public function hapus_keranjang(Request $request)
    {
        $id = $request->id;

        DB::table('keranjang')
            ->where('id', $id)
            ->delete();
            
    }
}
