<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\DB;

class report_produk extends Controller
{
    public function report_produk()
    {
        try {
            $data_produk_kucing = DB::table('produk_kucing')
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
                    ->get();


            $data = [
                'data_produk_kucing' => $data_produk_kucing
            ];


            return view('dashboard.report_produk', $data);
        } catch (Exception $e) {
            return $e;
        }
    }
    public function edit_produk($id)
    {
        try {
            $data_produk_kucing = DB::table('produk_kucing')
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
                    ->where('produk_kucing.id', $id)
                    ->get();


            $data = [
                'data_produk_kucing' => $data_produk_kucing,
                'id' => $id
            ];


            return view('dashboard.edit_produk', $data);
        } catch (Exception $e) {
            return $e;
        }
    }
    public function simpan_edit_produk(Request $request)
    {
        try {
            $gambar_produk = $request->file('gambar_produk');
            $id = $request->id;

            if($gambar_produk != ""){
                //ambil ekstensi gambar
                $ext_gambar_produk = $gambar_produk->getClientOriginalExtension();
                //ambil nama gambar
                $nama_gambar_produk = $gambar_produk->getClientOriginalName();
                //pindahkan gambar ke folder public/gambar/gambar_produk
                $gambar_produk->move('img_produk_anak_kucing/', $nama_gambar_produk);
            } else{
                $nama_gambar_produk = $request->gambar_produk_lama;
            }

            $kategori = $request->kategori_produk;

            if ($kategori == "") {
                $kategori = $request->kategori_lama;
            }

            $brand = $request->produk_brand;

            if ($brand == "") {
                $brand = $request->brand_lama;
            }
 
            $data_update = [
                'nama_produk' => $request->nama_produk,
                'gambar_produk' => $nama_gambar_produk,
                'stok' => $request->stok_produk,
                'harga' => $request->harga,
                'deskripsi_produk' => $request->deskripsi_produk,
                'kategori_id' => $kategori,
                'brand' => $brand,
            ];
            // dd($data_update);
           
            //Start Transaction
            DB::beginTransaction();
            $update_produk = DB::table('produk_kucing')->where('id', $id)->update($data_update);

            //Commit Transaction
            DB::commit();

            return redirect()->back()->with('message', 'Mantab!! Data berhasil disimpan! Yeeyy!');
        } catch (Exception $e) {
            //rollback Transaction
            DB::rollback();
            return redirect()->back()->with('error', 'Waduhh.. Gagal menyimpan data.. Jangan panik, kita coba sekali lagi!');
        }
    }





    public function hapus_produk(Request $request)
    {
        $id = $request->id;

        $data_produk_kucing = DB::table('produk_kucing')
                    ->select(
                        'produk_kucing.id',
                        'produk_kucing.nama_produk',
                        'produk_kucing.status',
                    )
                    ->where('produk_kucing.id', $id)
                    ->first();

            $status = $data_produk_kucing->status;
            $databaru  = '';
            if ($status == 1) {
                $databaru = 2;
            } else {
                $databaru = 1;
            };

        DB::table('produk_kucing')
            ->where('id', $id)
            ->update([
                'status' => $databaru,
            ]);
    }

}




