<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class batal_pesanan extends Controller
{
    public function batal_pesanan(Request $request)
    {
        $user_id = $request->user_id;

        DB::table('keranjang')
            ->where('user_id', $user_id)
            ->where('status_produk', 2)
            ->delete();
            
    }
}
