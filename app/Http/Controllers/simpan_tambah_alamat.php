<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use TheSeer\Tokenizer\Exception;

class simpan_tambah_alamat extends Controller
{
    public function simpan_tambah_alamat(Request $request)
    {
        try {
            $name = $request->name;
            $email = $request->email;
            $alamat = $request->alamat;
            $no_hp = $request->no_hp;
            $user_id = $request->user_id;

            $data_update = [
                'name' => $name,
                'alamat' => $alamat,
                'email' => $email,
                'no_hp' => $no_hp,
            ];
           
            //Start Transaction
            DB::beginTransaction();
            $update_produk = DB::table('users')
                            ->where('id', $user_id)

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
