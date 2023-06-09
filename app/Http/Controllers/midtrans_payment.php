<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use TheSeer\Tokenizer\Exception;

class midtrans_payment extends Controller
{
    public function midtrans_payment() 
    {
        
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

        // Set your Merchant Server Key
        \Midtrans\Config::$serverKey = 'SB-Mid-server-nvH-Qw85P2bKJkUGaS5Ijvnw';
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = false;
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = true;

        $params = array(
            'transaction_details' => array(
                'order_id' => rand(),
                'gross_amount' => $data_harga,
            ),
        );

        
        $snapToken = \Midtrans\Snap::getSnapToken($params);

        $data_update = [
            'status_produk' => 2,
        ];

        // UPDATE DATA DAN INPUT DATA

        $data_keranjang = DB::table('keranjang')
                ->where('keranjang.user_id', $user_id)
                ->whereIn('keranjang.status_produk', [1,2])
                ->update($data_update);

                
        $data = [
            'snapToken' => $snapToken,
            'data_harga' => $data_harga,
        ];

        return view ('pembeli.midtrans_payment', $data);
    }
    public function simpan_pembayaran(Request $request) 
    {
        try {
        $user_id = Auth::user()->id;
        $json = json_decode($request->get('json'));

        

        $data = [
            'user_id' => $user_id,
            'transaction_status' => $json->transaction_status,
            'transaction_id' => $json->transaction_id,
            'order_id' => $json->order_id,
            'gross_amount' => $json->gross_amount,

        ];
        $data_update = [
            'order_id' => $json->order_id,
            'status_produk' => 3,
        ];

        $data_midtrans = DB::table('midtrans')
                    ->insert($data);

        $data_keranjang = DB::table('keranjang')
        ->where('keranjang.user_id', $user_id)
        ->whereIn('keranjang.status_produk', [1,2])
        ->update($data_update);

        return redirect('home')->with('message', 'Berhasil melakukan transaksi!');

    } catch (Exception $e) {
        DB::rollback();
        return redirect('home')->with('error', 'Gagal melakukan transaksi');
    }
    }

    public function simpan_pembayaran_pending(Request $request) 
    {
        try {
        $user_id = Auth::user()->id;
        $json = json_decode($request->get('json'));

        $data = [
            'user_id' => $user_id,
            'transaction_status' => $json->transaction_status,
            'transaction_id' => $json->transaction_id,
            'order_id' => $json->order_id,
            'gross_amount' => $json->gross_amount,

        ];

        $data_midtrans = DB::table('midtrans')
                    ->insert($data);

        return redirect('home')->with('message', 'Berhasil! Segera selesaikan pembayaran anda!');

    } catch (Exception $e) {
        DB::rollback();
        return redirect('home')->with('error', 'Gagal melakukan transaksi');
    }
    }
    public function simpan_pembayaran_error(Request $request) 
    {
        try {
        $user_id = Auth::user()->id;
        $json = json_decode($request->get('json'));
        $data = [
            'user_id' => $user_id,
            'transaction_status' => $json->transaction_status,
            'transaction_id' => $json->transaction_id,
            'order_id' => $json->order_id,
            'gross_amount' => $json->gross_amount,

        ];

        $data_midtrans = DB::table('midtrans')
                    ->insert($data);

        return redirect('home')->with('message', 'Transaksi Error');

    } catch (Exception $e) {
        DB::rollback();
        return redirect('home')->with('error', 'Gagal melakukan transaksi');
    }
    }
}
