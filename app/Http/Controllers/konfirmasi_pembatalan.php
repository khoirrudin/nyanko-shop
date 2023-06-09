<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use TheSeer\Tokenizer\Exception;

class konfirmasi_pembatalan extends Controller
{
    public function konfirmasi_pembatalan()
    {
        try {
            $data_status = DB::table('keranjang')
                            ->select(
                                'keranjang.user_id',
                                'keranjang.status_produk',
                            )
                            ->where('keranjang.status_produk', 7)
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
                    ->where('keranjang.status_produk', 7)
                    ->get();
            
            $data_refund = DB::table('data_refund')
                        ->select(
                            'data_refund.alasan'
                        )
                        ->where('status', 1)
                        ->get();
                


            $data = [
                'data_keranjang' => $data_keranjang,
                'data_refund' => $data_refund,
                'data_status' => $data_status
            ];
            // dd($data_keranjang);

            return view('dashboard.konfirmasi_pembatalan', $data);
        } catch (Exception $e) {
            return $e;
        }
    }

    public function simpan_konfirmasi_pembatalan(Request $request)
    {
        try {
            $id = $request->id;

            $data_update = [
                'status_produk' => 9,
            ];
           
            //Start Transaction
            DB::beginTransaction();
            $update_produk = DB::table('keranjang')
                            ->where('id', $id)
                            ->where('status_produk', 7)

                            ->update($data_update);


            //Commit Transaction
            DB::commit();

            return redirect()->back();
        } catch (Exception $e) {
            //rollback Transaction
            DB::rollback();
            return redirect()->back();
        }
    }
}
