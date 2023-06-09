<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use TheSeer\Tokenizer\Exception;

class pembayaran extends Controller
{
    public function pembayaran(Request $request)
    {
        try {

            $user_id = Auth::user()->id;
            
            
            $data_keranjang = DB::table('keranjang')
                    ->select(
                        'keranjang.id',
                        'keranjang.user_id',
                        'keranjang.produk_id',
                        'keranjang.nama_produk',
                        'keranjang.harga_produk',
                        'keranjang.qty',
                        'keranjang.status_produk',
                        
                    )
                    ->where('keranjang.user_id', $user_id)
                    ->whereIn('keranjang.status_produk', [1,2])
                    ->get();
        
            $data_harga = $data_keranjang->sum('harga_produk');


            $data_update = [
                'status_produk' => 2,
            ];


            $data = [
                'data_harga' => $data_harga,
            ];




            // UPDATE DATA DAN INPUT DATA

            $data_keranjang = DB::table('keranjang')
                    ->where('keranjang.user_id', $user_id)
                    ->whereIn('keranjang.status_produk', [1,2])
                    ->update($data_update);

                        




            return view('pembeli.pembayaran', $data);
        } catch (Exception $e) {
            return $e;
        }
    }
}
