<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use TheSeer\Tokenizer\Exception;

class tolak_pesanan extends Controller
{
    public function tolak_pesanan($user_id)
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


        return view('dashboard.tolak_pesanan', $data);
    }
    public function simpan_alasan_penolakan(Request $request)
    {
        try {
            $alasan = $request->alasan;
            $user_id = $request->id;
            $order_id = $request->order_id;

            $data_update = [
                'status_produk' => 6,
            ];

            $data_input = [
                'user_id' => $user_id,
                'alasan' => $alasan,
            ];
           
            //Start Transaction
            DB::beginTransaction();
            $update_produk = DB::table('keranjang')
                            ->where('order_id', $order_id)
                            ->where('status_produk', 3)

                            ->update($data_update);


            $update_penolakan = DB::table('pesanan_ditolak')
                            ->insert($data_input);

            //Commit Transaction
            DB::commit();

            return redirect()->back()->with('message', 'Penolakan berhasil dilakukan, pastikan melakukan refund transaksi user');
        } catch (Exception $e) {
            //rollback Transaction
            DB::rollback();
            return redirect()->back()->with('error', 'Gagal melakukan penolakan, pastikan data benar');
        }
    }
}
