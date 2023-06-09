<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use TheSeer\Tokenizer\Exception;

class display_semua_produk extends Controller
{
    public function display_semua_produk()
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
                        'produk_kucing.status',
                    )
                    ->where('produk_kucing.status', 1)
                    // ->whereIn()
                    ->get();

            $data_master_kategori = DB::table('master_kategori')
                    ->select(
                        'master_kategori.id',
                        'master_kategori.kategori'
                    )
                    ->get();

            $data_brand = DB::table('master_brand')
            ->select(
                'master_brand.id',
                'master_brand.brand',
                'master_brand.logo_brand',
            )
            ->get();

            $data = [
                'data_produk_anak_kucing' => $data_produk_anak_kucing,

                'data_brand' => $data_brand,

                'data_master_kategori' => $data_master_kategori,
                
            ];


            return view('produk.display_semua_produk', $data,);
        } catch (Exception $e) {
            return $e;
        }
    }
}
