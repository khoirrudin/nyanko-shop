<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class konfirmasi extends Controller
{
    public function konfirmasi(Request $request)
    {
        $user_id = $request->user_id;

        $update = [
            'status_produk' => 5,
        ];
        
        DB::table('keranjang')
            ->where('keranjang.user_id', $user_id)
            ->where('keranjang.status_produk', 4)
            ->update($update);
    }
}
