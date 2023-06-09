<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use TheSeer\Tokenizer\Exception;

class filter_search extends Controller
{
    public function filter_search(Request $request)
    {
        try {
            $data_produk_anak_kucing = DB::table('produk_kucing')
                    ->select(
                        'produk_kucing.id',
                        'produk_kucing.nama_produk',
                        'produk_kucing.gambar_produk',
                        'produk_kucing.stok',
                        'produk_kucing.deskripsi_produk',
                        'produk_kucing.harga',
                        'produk_kucing.kategori_id',
                        'produk_kucing.brand',
                        'produk_kucing.status',
                    )
                    ->where('produk_kucing.status', 1)
                    ->where('produk_kucing.nama_produk', 'LIKE', '%' .$request->search. '%' )
                    // ->whereIn()
                    ->get();
            $search = $request->search;

            $data = [
                'data_produk_anak_kucing' => $data_produk_anak_kucing,
                'search' => $search
            ];

            // dd($data);
     
            

            return view('produk.filter_search', $data,);
        } catch (Exception $e) {
            return $e;
        }
    }
}

