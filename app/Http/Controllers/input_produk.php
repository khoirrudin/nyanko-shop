<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\DB;

class input_produk extends Controller
{
    public function input_produk()
    {
        $data_brand = DB::table('master_brand')
                    ->select(
                        'master_brand.id',
                        'master_brand.brand',
                        'master_brand.logo_brand',
                    )
                    ->get();
        $data_master_kategori = DB::table('master_kategori')
                    ->select(
                        'master_kategori.id',
                        'master_kategori.kategori'
                    )
                    ->get();

        $data = [

            'data_brand' => $data_brand,

            'data_master_kategori' => $data_master_kategori,
            
        ];


        return view('dashboard.input_produk', $data,);
    }

    public function simpan_input_produk(Request $request)
    {
        try {
            
            //Start Transaction
            DB::beginTransaction();
            $gambar_produk = $request->file('gambar_produk');

            //Mengambil ekstensi gambar
            $ext_gambar_produk = $gambar_produk->getClientOriginalExtension();
            //Mengambil nama gambar
            $nama_gambar_produk = $gambar_produk->getClientOriginalName();
            //pindahkan gambar ke folder public/gambar/gambar_produk
            $gambar_produk->move('img_produk_anak_kucing/', $nama_gambar_produk);

            // dd($nama_gambar_produk);


            $data = [
                'nama_produk' => $request->nama_produk,
                'gambar_produk' => $nama_gambar_produk,
                'stok' => $request->stok_produk,
                'harga' => $request->harga,
                'deskripsi_produk' => $request->deskripsi_produk,
                'kategori_id' => $request->kategori_produk,
                'brand' => $request->produk_brand,
            ];
            // dd($data);

            $insert_data = DB::table('produk_kucing')->insert($data);

            //Commit Transaction
            DB::commit();

            return redirect()->back()->with('message', 'Data produk berhasil di input');
        } catch (Exception $e) {
            //rollback Transaction
            DB::rollback();
            return redirect()->back()->with('error', 'Data gagal di input, silahkan coba lagi!');
        }
    }
}
