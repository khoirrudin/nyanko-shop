<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Exception;

class DisplayProduk extends Controller
{
    public function display_produk()
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
                    ->whereIn('produk_kucing.kategori_id', [1,3])
                    ->where('produk_kucing.status', 1)
                    // ->whereIn()
                    ->take(16)
                    ->get();

            $data_master_kategori = DB::table('master_kategori')
                    ->select(
                        'master_kategori.id',
                        'master_kategori.kategori',
                        'master_kategori.img'
                    )
                    ->get();

            $data_produk_kucing_dewasa = DB::table('produk_kucing')
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
            ->whereIn('produk_kucing.kategori_id', [2,4])
            ->where('produk_kucing.status', 1)
            ->take(16)
            ->get();
            
            

            $data_landing = DB::table('landing_img')
            ->select(
                'landing_img.id',
                'landing_img.gambar_landing'
            )
            ->get();


            $data_brand = DB::table('master_brand')
            ->select(
                'master_brand.id',
                'master_brand.brand',
                'master_brand.logo_brand',
            )
            ->take(6)
            ->get();


        
            $data = [
                'data_produk_anak_kucing' => $data_produk_anak_kucing,
                'data_produk_kucing_dewasa' => $data_produk_kucing_dewasa,
                'data_landing' => $data_landing,

                'data_brand' => $data_brand,

                'data_master_kategori' => $data_master_kategori,
                
            ];


            return view('welcome', $data,);
        } catch (Exception $e) {
            return $e;
        }
    }
}
