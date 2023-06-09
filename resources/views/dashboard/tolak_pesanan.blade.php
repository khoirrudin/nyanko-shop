
@extends('layouts.app')


@section('content')
<div class="container mt-4 mb-4">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="border border-info p-4 bdcontainer rounded3">
                <h3 class="text-info fw-bold">Upload resi</h3>
                <div class="card-body">
                    <div class="row mb-2">
                        @if (\Session::has('message'))
                            <div class="alert alert-success">
                                {!! \Session::get('message') !!}
                            </div>
                        @elseif(\Session::has('error'))
                            <div class="alert alert-danger">
                                {!! \Session::get('error') !!}
                            </div>
                        @endif
                    </div>
                    <div class="responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr class="bg-info text-white" align="center">
                                    <th scope="col">No</th>
                                    <th scope="col">Nama User</th>
                                    <th scope="col">Nama Produk</th>
                                    <th scope="col">Qty</th>
                                    <th scope="col">Harga</th>
                                    <th scope="col">Alamat</th>
                                </tr>
                            </thead>
                            <tbody class="text-center">
                                @php 
                                    $no=1;
                                @endphp
                                @foreach($data_pesanan_user as $row)
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
                                        
                                        // var_dump($name);

                                    @endphp
                                    <td>{{ $no++ }}</td>
                                    <td class="">{{ $name->name }}</td>
                                    <td class="">{{ $row->nama_produk }}</td>
                                    <td class="">{{ $row->qty }}</td>
                                    <td class="">{{ $row->harga_produk }}</td>
                                    <td class="">{{ $alamat_user->alamat }}</td>
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
                                <form action="{{ url('/simpan_alasan_penolakan/'.$user_id) }}" method="post">
                                    @csrf
                                    <label class="fw-bold text-danger " for="alasan">Masukkan alasan penolakan</label>
                                    <input class="form-control border-info" type="text" name="alasan" id="alasan" placeholder="Masukkan...">
                                    <button class="mt-2 btn btn-danger rounded-pill" type="submit">Upload</button>
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
