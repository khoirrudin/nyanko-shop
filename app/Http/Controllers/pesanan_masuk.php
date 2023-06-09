<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use TheSeer\Tokenizer\Exception;

class pesanan_masuk extends Controller
{
    public function pesanan_masuk()
    {
        try {
            $data_status = DB::table('keranjang')
                            ->select(
                                'keranjang.user_id',
                                'keranjang.status_produk',
                            )
                            ->where('keranjang.status_produk', 3)
                            // ->where('keranjang.status_produk', 5)
                            ->first();

            $data_keranjang = DB::table('keranjang')
                    ->select(
                        'keranjang.id',
                        'keranjang.user_id',
                        'keranjang.produk_id',
                        'keranjang.nama_produk',
                        'keranjang.harga_produk',
                        'keranjang.qty',
                        'keranjang.bukti_pembayaran',
                        'keranjang.order_id',
                    )
                    ->where('keranjang.status_produk', 3)
                    ->get();

            $data_order = DB::table('midtrans')
                        ->leftJoin(
                            'keranjang',
                            'midtrans.order_id',
                            
                            'keranjang.order_id'
                        )
                        ->select(
                            'midtrans.order_id as order_id',
                            'midtrans.transaction_id as transaction',
                            'midtrans.created_at as tanggal'
                        )
                        ->where('keranjang.status_produk', 3)
                        ->get();

            // dd($data_order);

                

            $data = [
                'data_keranjang' => $data_keranjang,
                'data_status' => $data_status,
                'data_order' => $data_order
            ];
            // dd($data_keranjang);

            return view('dashboard.pesanan_masuk', $data);
        } catch (Exception $e) {
            return $e;
        }
    }
}

