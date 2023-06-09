<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use TheSeer\Tokenizer\Exception;

class report_pesanan extends Controller
{
    public function report_pesanan()
    {
        try {
            $data_status = DB::table('keranjang')
                            ->select(
                                'keranjang.user_id',
                                'keranjang.status_produk',
                            )
                            ->whereIn('keranjang.status_produk', [2,3,4,5,6,7,8,9,10])
                            ->first();



            $data_pesanan = DB::table('keranjang')
                    ->select(
                        'keranjang.user_id',
                        'keranjang.nama_produk',
                        'keranjang.harga_produk',
                        'keranjang.qty',
                        'keranjang.status_produk',
                        'keranjang.order_id',
                        'keranjang.resi'
                    )
                    ->whereIn('keranjang.status_produk', [2,3,4,5,6,7,8,9,10])
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
                        ->whereIn('keranjang.status_produk', [2,3,4,5,6,7,8,9,10])
                        ->get();


            $data = [
                'data_keranjang' => $data_pesanan,
                'data_status' => $data_status,
                'data_order' => $data_order
            ];


            return view('dashboard.report_pesanan', $data);
        } catch (Exception $e) {
            return $e;
        }
    }
}
