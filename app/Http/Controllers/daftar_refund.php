<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use TheSeer\Tokenizer\Exception;

class daftar_refund extends Controller
{
    public function daftar_refund()
    {
        try {
            $data_status = DB::table('keranjang')
                            ->select(
                                'keranjang.user_id',
                                'keranjang.status_produk',
                            )
                            ->whereIn('keranjang.status_produk', [9])
                            // ->where('keranjang.status_produk', 5)
                            ->first();

            $data_keranjang = DB::table('keranjang')
                    ->select(
                        'keranjang.id',
                        'keranjang.user_id',
                        'keranjang.produk_id',
                        'keranjang.nama_produk',
                        'keranjang.harga_produk',
                        'keranjang.qty',
                        'keranjang.bukti_pembayaran',
                    )
                    ->whereIn('keranjang.status_produk', [9])
                    ->get();

            $data = [
                'data_keranjang' => $data_keranjang,
                'data_status' => $data_status,
            ];
            // dd($data_keranjang);

            return view('dashboard.daftar_refund', $data);
        } catch (Exception $e) {
            return $e;
        }
    }
    //upload_refund
    public function upload_refund($user_id)
    {
        $data_pesanan_user = DB::table('keranjang')
                        ->select(
                            'keranjang.harga_produk'
                        )
                        ->where('user_id', $user_id)
                        ->whereIn('status_produk', [9])
                        ->get();


        $data_refund = DB::table('data_refund')
                    ->select(
                        'alasan',
                        'nama_rek',
                        'bank',
                        'no_rek'

                    )
                    ->where('user_id', $user_id)
                    ->get();



        $data = [
            'data_pesanan_user' => $data_pesanan_user,
            'user_id' => $user_id,
            'data_refund' => $data_refund,
        ];
        // dd($data);


        return view('dashboard.upload_refund', $data);
    }
    public function simpan_upload_refund(Request $request, $user_id)
    {
        try {

            $id = $request->id;
            
            $bukti_pembayaran = $request->file('bukti_pembayaran');

            //ambil ekstensi gambar
            $ext_bukti_pembayaran = $bukti_pembayaran->getClientOriginalExtension();
            //ambil nama gambar
            $nama_bukti_pembayaran = $bukti_pembayaran->getClientOriginalName();
            //pindahkan gambar ke folder public/img_bukti_pembayaran
            $bukti_pembayaran->move('img_bukti_pembayaran/', $nama_bukti_pembayaran);

            $data_update = [
                'status_produk' => 10,
            ];
            $data_update_refund = [
                'bukti_refund' => $nama_bukti_pembayaran,
                'status' => 2,
            ];

            DB::beginTransaction();

            $update = DB::table('keranjang')
                        ->where('user_id', $user_id)
                        ->where('status_produk', 9)
                        ->update($data_update);
            $update_refund = DB::table('data_refund')
                        ->where('user_id', $user_id)
                        ->update($data_update_refund);
            
            DB::commit();

            return redirect('/daftar_refund')
                    ->with('message', 'Berhasil mengupload Bukti');
        } catch (Exception $e) {
            //rollback Transaction
            DB::rollback();
            return redirect()->back()->with('error', 'Gagal Mengupload Bukti');
        }
    }
}
