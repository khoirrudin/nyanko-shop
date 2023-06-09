
@extends('layouts.app')


@section('content')
<div class="container mt-4 mb-4">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="border border-info p-4 bdcontainer rounded3">
                <h3 class="text-info fw-bold">Upload Bukti Refund</h3>
                <p>Pastikan nominal dan nama sama</p>
                <div class="card-body">
                    
                    <div class="responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr class="bg-info text-white" align="center">
                                    <th scope="col">No</th>
                                    <th scope="col">Nama User</th>
                                    <th scope="col">Nama Rek</th>
                                    <th scope="col">Bank</th>
                                    <th scope="col">No Rek</th>
                                    <th scope="col">Nominal</th>
                                </tr>
                            </thead>
                            <tbody class="text-center">
                                @php 
                                    $no=1;
                                @endphp
                                @foreach($data_refund as $refund)
                                
                                <tr>
                                    @php
                                    $name =
                                        DB::table('users')
                                        ->select(
                                            'users.name as name',
                                            'users.id as user_id'
                                        )
                                        ->where('users.id', $user_id)
                                        ->first();
                                    $data_pesanan_user = DB::table('keranjang')
                                        ->select(
                                            'keranjang.harga_produk'
                                        )
                                        ->where('user_id', $user_id)
                                        ->whereIn('status_produk', [9,6])
                                        ->first();
                                        
                                        // var_dump($name);

                                    @endphp
                                    <td>{{ $no++ }}</td>
                                    <td class="">{{ $name->name }}</td>
                                    <td class="">{{ $refund->nama_rek }}</td>
                                    <td class="">{{ $refund->bank }}</td>
                                    <td class="fw-bold">{{ $refund->no_rek }}</td>
                                    <td class="fw-bold">{{ $data_pesanan_user->harga_produk }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="row justify-content-center align-item-center text-center">
                            <div class="col-md-6 ">
                                <form method="POST" action="{{ url('/simpan_upload_refund/'.$user_id) }}" enctype="multipart/form-data">
                                    @csrf
                                    <label for="bukti_pembayaran" class="text-info fw-bold">Upload Bukti Refund</label>
                                    <input required id="bukti_pembayaran" type="file" class="form-control border-info" name="bukti_pembayaran">
                                    <div class="row justify-content-center align-item-center">
                                        <div class="col-md-3 ">
                                            <button type="submit" class="mt-2 btn btn-info rounded-pill">Upload!</button>
                                        </div>
                                    </div>             
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
