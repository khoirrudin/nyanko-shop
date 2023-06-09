<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use TheSeer\Tokenizer\Exception;

class menunggu_konfirmasi_pembatalan extends Controller
{
    public function menunggu_konfirmasi_pembatalan()
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
                        'keranjang.bukti_pembayaran',
                        'keranjang.resi',
                        
                    )
                    ->where('keranjang.user_id', $user_id)
                    ->where('keranjang.status_produk', 7)
                    ->get();
           
            
            $data_harga = $data_keranjang->sum('harga_produk');

            $data_status = DB::table('keranjang')
                            ->select(
                                'keranjang.user_id',
                                'keranjang.status_produk',
                            )
                            ->where('keranjang.user_id', $user_id)
                            ->where('keranjang.status_produk', 7)
                            ->first();
            


            $data = [
                'data_keranjang' => $data_keranjang,
                'data_harga' => $data_harga,
                'data_status' => $data_status,
            ];
            // dd($data);


            return view('pembeli.menunggu_konfirmasi_pembatalan', $data);
        } catch (Exception $e) {
            return $e;
        }
    }
}
