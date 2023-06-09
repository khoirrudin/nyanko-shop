<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Exception;

class landing_img extends Controller
{
    public function landing_img()
    {
        try {
            $data_tabel_landing_img = DB::table('landing_img')
                    ->select(
                        'landing_img.id',
                        'landing_img.gambar_landing'
                    )
                    ->get();
            
            $data = [
                'data_tabel_landing_img' => $data_tabel_landing_img,
            ];


            return view('dashboard.landing_img', $data);
        } catch (Exception $e) {
            return $e;
        }
    }
    public function edit_landing($id)
    {
        try {
            $data_tabel_landing_img = DB::table('landing_img')
                    ->select(
                        'landing_img.id',
                        'landing_img.gambar_landing'
                    )
                    ->where('landing_img.id', $id)
                    ->get();


            $data = [
                'data_tabel_landing_img' => $data_tabel_landing_img,
                'id' => $id
            ];


            return view('dashboard.edit_landing', $data);
        } catch (Exception $e) {
            return $e;
        }
    }
    public function simpan_edit_landing(Request $request)
    {
        try {
            $gambar_landing = $request->file('gambar_landing');
            $id = $request->id;

            if($gambar_landing != ""){
                //ambil ekstensi gambar
                $ext_gambar_landing = $gambar_landing->getClientOriginalExtension();
                //ambil nama gambar
                $nama_gambar_landing = $gambar_landing->getClientOriginalName();
                //pindahkan gambar ke folder public/gambar/gambar_landing
                $gambar_landing->move('img_landing/', $nama_gambar_landing);
            } else{
                $nama_gambar_landing = $request->gambar_landing_lama;
            }

            $data_update = [
                'gambar_landing' => $nama_gambar_landing,
            ];
        //    dd($request);
            //Start Transaction
            DB::beginTransaction();
            $update_produk = DB::table('landing_img')
                            ->where('id', $id)
                            ->update($data_update);

            //Commit Transaction
            DB::commit();

            return redirect()->back()->with('message', 'Mantab!! Data berhasil disimpan! Yeeyy!');
        } catch (Exception $e) {
            //rollback Transaction
            DB::rollback();
            return redirect()->back()->with('error', 'Waduhh.. Gagal menyimpan data.. Jangan panik, kita coba sekali lagi!');
        }
    }
}
