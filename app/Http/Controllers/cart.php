<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Console\View\Components\Alert;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


class cart extends Controller
{
     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function cart()
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
                        
                    )
                    ->where('keranjang.user_id', $user_id)
                    ->where('keranjang.status_produk', 1)
                    ->get();

            $data_status = DB::table('keranjang')
                            ->select(
                                'keranjang.user_id',
                                'keranjang.status_produk',
                            )
                            ->where('keranjang.user_id', $user_id)
                            ->where('keranjang.status_produk', 1)
                            ->first();

            
        
            $count = $data_keranjang->count();

        
            

            $data = [
                'data_keranjang' => $data_keranjang,
                'data_status' => $data_status,
                'count' => $count,
            ];
            // dd($data_status);


            return view('pembeli.cart', $data);
            
            
            
        } catch (Exception $e) {
            return $e;
        }
    }
}
