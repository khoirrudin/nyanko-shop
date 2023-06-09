<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class keranjang extends Controller
{
    
    public function keranjang(Request $request)
    {
            // dd($request->all());
            $id = $request->id;
            $user_id = $request->user_id;
            
    
            $data_produk = DB::table('produk_kucing')
                        ->select(
                            'nama_produk',
                            'harga'
                        )
                        ->where('id', $id)
                        ->first();
            $insert_data = [
                'user_id' => $user_id,
                'produk_id' => $id,
                'nama_produk' => $data_produk->nama_produk,
                'harga_produk' => $data_produk->harga,

            ];
            // dd($insert_data);
            

            DB::table('keranjang')
                    ->insert($insert_data);
            // return redirect()->back();


    }
    

}
