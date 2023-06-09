<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Exception;

class HomeController extends Controller
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

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user_id = Auth::user()->id;
        
        $data_keranjang = DB::table('keranjang')
                ->select(
                    'keranjang.nama_produk',
                    'keranjang.status_produk',
                    'keranjang.qty',
                )
                ->where('keranjang.user_id', $user_id)
                ->orderBy('id', 'DESC')
                ->limit(5)
                ->get();

        $data_status = DB::table('keranjang')
        ->select(
            'keranjang.user_id',
            'keranjang.status_produk',
        )
        ->where('keranjang.user_id', $user_id)
        ->first();

        $data = [
            'data_keranjang' => $data_keranjang,
            'data_status' => $data_status,
        ];


        return view('home' , $data);
    }
}
