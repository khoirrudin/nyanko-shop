<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use TheSeer\Tokenizer\Exception;

class upload_resi extends Controller
{
    public function upload_resi($user_id)
    {
        $data_pesanan_user = DB::table('keranjang')
                        ->select(
                            'keranjang.nama_produk',
                            'keranjang.qty',
                            'keranjang.harga_produk'
                        )
                        ->where('user_id', $user_id)
                        ->where('status_produk', 3)
                        ->get();


        $alamat_user = DB::table('users')
                        ->select(
                            'users.alamat',
                        )
                        ->where('users.id', $user_id)
                        ->first();



        $data = [
            'data_pesanan_user' => $data_pesanan_user,
            'user_id' => $user_id,
            'alamat_user' => $alamat_user,
        ];
        // dd($data);


        return view('dashboard.upload_resi', $data);
    }
    public function simpan_upload_resi(Request $request)
    {
        try {
            $resi = $request->resi;
            $kurir = $request->kurir;
            $order_id = $request->order_id;


            $data_update = [
                'resi' => $resi,
                'kurir' => $kurir,
                'status_produk' => 4,
            ];
           
            //Start Transaction
            DB::beginTransaction();
            $update_produk = DB::table('keranjang')
                            ->where('order_id', $order_id)
                            ->where('status_produk', 3)

                            ->update($data_update);

            //Commit Transaction
            DB::commit();

            return redirect()->back()->with('message', "Resi Berhasil diUpdate, Status produk berubah menjadi 'Sedang Dikirim' ");
        } catch (Exception $e) {
            //rollback Transaction
            DB::rollback();
            return redirect()->back()->with('error', 'Gagal mengupdate Resi');
        }
    }
}
