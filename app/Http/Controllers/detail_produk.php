<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class detail_produk extends Controller
{
    public function detail_produk($id)
    {
        $data_produk = DB::table('produk_kucing')
                    ->select(
                        'produk_kucing.id',
                        'produk_kucing.nama_produk',
                        'produk_kucing.gambar_produk',
                        'produk_kucing.stok',
                        'produk_kucing.deskripsi_produk',
                        'produk_kucing.harga',
                        'produk_kucing.kategori_id',
                        'produk_kucing.status',
                    )
                    ->where('produk_kucing.id', $id)
                    ->get();
        $data = [
            'data_produk' => $data_produk,
        ];
        // dd($data);



        return view('produk.detail_produk', $data);
    }
}
