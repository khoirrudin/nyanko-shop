<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use TheSeer\Tokenizer\Exception;

class filter_kategori extends Controller
{
    public function filter_kategori($id)
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
                    ->where('produk_kucing.kategori_id', $id)
                    // ->whereIn()
                    ->get();

            $nama_kategori = DB::table('produk_kucing')
                        ->leftJoin('master_kategori', 'produk_kucing.kategori_id', 'master_kategori.id')
                        ->select(
                            'master_kategori.kategori as kategori',
                        )
                        ->where('produk_kucing.kategori_id', $id)
                        ->first();

            $data_master_kategori = DB::table('master_kategori')
                    ->select(
                        'master_kategori.id',
                        'master_kategori.kategori',
                        'master_kategori.img'

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
                'nama_kategori' => $nama_kategori
                
            ];


            return view('produk.filter_kategori', $data,);
        } catch (Exception $e) {
            return $e;
        }
    }
}
