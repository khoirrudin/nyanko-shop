<?php

namespace App\Http\Controllers;

use Brick\Math\Exception\MathException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use TheSeer\Tokenizer\Exception;

class checkout extends Controller
{
    
    public function checkout()
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
                    ->where('keranjang.status_produk', 1)
                    ->get();
           
            
            $data_harga = $data_keranjang->sum('harga_produk');

            $data_status = DB::table('keranjang')
                            ->select(
                                'keranjang.user_id',
                                'keranjang.status_produk',
                            )
                            ->where('keranjang.user_id', $user_id)
                            ->where('keranjang.status_produk', 1)
                            ->first();
            


            $data = [
                'data_keranjang' => $data_keranjang,
                'data_harga' => $data_harga,
                'data_status' => $data_status,
            ];
            // dd($data_harga);


            return view('pembeli.checkout', $data);
        } catch (Exception $e) {
            return $e;
        }
    }
}
