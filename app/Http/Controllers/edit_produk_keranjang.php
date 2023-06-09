<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use TheSeer\Tokenizer\Exception;

class edit_produk_keranjang extends Controller
{
    public function edit_produk_keranjang($id)
    {
        try {
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
                        'keranjang.bukti_pembayaran',
                        'keranjang.resi',
                        
                    )
                    ->where('keranjang.user_id', $user_id)
                    ->where('keranjang.status_produk', 1)
                    ->where('keranjang.id', $id)
                    ->first();


            $data = [
                'data_keranjang' => $data_keranjang,
                'id' => $id
            ];


            return view('pembeli.edit_produk_keranjang', $data);
        } catch (Exception $e) {
            return $e;
        }
    }
    public function simpan_edit_keranjang(Request $request)
    {
        try {
            $id = $request->id;
            $harga = DB::table('produk_kucing')
                    ->leftJoin('keranjang', 'produk_kucing.id' , 'keranjang.produk_id' )
                    ->select(
                        'produk_kucing.harga'
                    )
                    ->where('keranjang.id', $id)
                    ->first();

            // dd($request->all());
            $qty = $request->qty;
            $harga_produk = $harga->harga * $qty;
            $data_update = [
                'qty' => $qty,
                'harga_produk' => $harga_produk,
                
            ];
            // dd($harga_produk);
            
            DB::beginTransaction();
            $update_produk = DB::table('keranjang')
                ->where('id', $id)
                ->update($data_update);

            //Commit Transaction
            DB::commit();

            return redirect()->back()->with('message', 'Jumlah Qty Berhasil dirubah, Silahkan buka menu keranjang untuk melihat');
        } catch (Exception $e) {
            //rollback Transaction
            DB::rollback();
            return redirect()->back()->with('error', 'Waduhh.. error, mohon coba lagi atau hubungi admin dimenu contact');
        }
            


    }
}
