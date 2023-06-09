<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use TheSeer\Tokenizer\Exception;

class ajukan_pembatalan extends Controller
{
    public function ajukan_pembatalan()
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
                    ->where('keranjang.status_produk', 3)
                    ->get();
            $data_status = DB::table('keranjang')
            ->select(
                'keranjang.user_id',
                'keranjang.status_produk',
            )
            ->where('keranjang.user_id', $user_id)
            ->where('keranjang.status_produk', 3)
            ->first();
            
            $data_harga = $data_keranjang->sum('harga_produk');
            $data = [
                'data_keranjang' => $data_keranjang,
                'data_harga' => $data_harga,
                'data_status' => $data_status,
            ];
        return view('pembeli.ajukan_pembatalan', $data);
    }
    public function upload_pembatalan(Request $request)
    {
        try {
            $user_id = Auth::user()->id;
            $alasan = $request->alasan;
            $nama_rek = $request->nama_rek;
            $bank = $request->bank_tujuan;
            $no_rek = $request->no_rek;



            $data_update = [
                'user_id' => $user_id,
                'alasan' => $alasan,
                'nama_rek' => $nama_rek,
                'bank' => $bank,
                'no_rek' => $no_rek,
            ];
            $update_status = [
                'status_produk' => 7,
            ];
           
            //Start Transaction
            DB::beginTransaction();
            $update_produk = DB::table('data_refund')
                            ->insert($data_update);
                            
            $update = DB::table('keranjang')
                ->where('user_id', $user_id)
                ->where('status_produk', 3)
                ->update($update_status);


            //Commit Transaction
            DB::commit();

            return redirect()->back()->with('message', 'Pembatalan dan refund anda sudah dikirimkan! Mohon tunggu konfirmasi dari Admin');
        } catch (Exception $e) {
            //rollback Transaction
            DB::rollback();
            return redirect()->back()->with('error', 'Gagal mengajukan pembatalan dan refund! silakan coba beberapa saat lagi');
        }
    }
}
