<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class eksport_alamat extends Controller
{
    public function eksport_alamat(Request $request, $user_id, $order_id) {
        $data_alamat = DB::table('users')
                    ->select(
                        'users.id',
                        'users.name',
                        'users.alamat',
                        'users.no_hp'
                    )
                    ->where('users.id', $user_id)
                    ->first();
        $data_keranjang = DB::table('keranjang')
                    ->select(
                        'qty',
                        'nama_produk'
                    )
                    ->where('order_id', $order_id)
                    ->get();
        $data_transaksi = DB::table('midtrans')
                    ->select(
                        'transaction_id'
                    )
                    ->where('order_id', $order_id)
                    ->first();

        $data = [
            'data_alamat' => $data_alamat,
            'data_keranjang' => $data_keranjang,
            'order_id' => $order_id,
            'data_transaksi' => $data_transaksi
        ];






        return view('dashboard.eksport_alamat', $data);
    }
}
