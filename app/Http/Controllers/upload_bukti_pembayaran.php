<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use TheSeer\Tokenizer\Exception;

class upload_bukti_pembayaran extends Controller
{
    public function upload_bukti_pembayaran()
    {
        

        return view('pembeli.upload_bukti_pembayaran');
    }
    
    public function simpan_upload_bukti_pembayaran(Request $request)
    {
        try {
            $user_id = Auth::user()->id;
            $bukti_pembayaran = $request->file('bukti_pembayaran');

            //ambil ekstensi gambar
            $ext_bukti_pembayaran = $bukti_pembayaran->getClientOriginalExtension();
            //ambil nama gambar
            $nama_bukti_pembayaran = $bukti_pembayaran->getClientOriginalName();
            //pindahkan gambar ke folder public/img_bukti_pembayaran
            $bukti_pembayaran->move('img_bukti_pembayaran/', $nama_bukti_pembayaran);

            
           
            $data_update1 = [
                'status_produk' => 3,
                'bukti_pembayaran' => $nama_bukti_pembayaran,
            ];
           
            //Start Transaction
            DB::beginTransaction();
            $update_produk = DB::table('keranjang')
                            ->where('user_id', $user_id)
                            ->where('status_produk', 2)

                            ->update($data_update1);

            //Commit Transaction
            DB::commit();

            return redirect()->back()->with('message', 'Bukti pembayaran berhasil diupload, Silahkan tunggu admin untuk mengkonfirmasi. Detail transaksi anda di halaman akun anda');
        } catch (Exception $e) {
            //rollback Transaction
            DB::rollback();
            return redirect()->back()->with('error', 'Gagal mengupload file, silahkan coba lagi atau hubungi admin di menu Contact Us');
        }
    }
}
