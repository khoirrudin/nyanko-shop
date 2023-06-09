
@extends('layouts.app')


@section('content')
@php
    $no=1;
    $hidden = '';
    $hidden2 = '';
    if ($data_status == null) {
        $hidden = 'hidden';
    } else {
        $hidden2 = 'hidden';
    };   
@endphp
<div class="container mt-4 mb-4 border border-info rounded3 bdcontainer p-3">
    <h3 class="text-info fw-bold">Daftar Refund</h3>
    <div class="card-body">
        <div class="responsive">
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
            <table class="table table-striped">
                <thead>
                    <tr class="bg-danger text-white" align="center">
                        <th scope="col">No</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Nama Produk</th>
                        <th scope="col">Qty</th>
                        <th scope="col">Nominal</th>
                        <th scope="col">Alasan</th>
                        <th scope="col">Nama Rek</th>
                        <th scope="col">Bank</th>
                        <th scope="col">No Rek</th>
                        <th scope="col">Upload</th>
                    </tr>
                </thead>
                <tbody class="text-center">
                    
                    <tr {{ $hidden2 }}>
                        <td colspan="10">Tidak Ada Data</td>
                    </tr>
                    @foreach($data_keranjang as $row)
                    @php
                    
                        $name =
                            DB::table('users')
                            ->select(
                                'users.name as name',
                                'users.id as user_id',
                            )
                            ->where('users.id', $row->user_id)
                            ->first();
                            
                            // var_dump($name);
                        $refund = 
                            DB::table('data_refund')
                            ->select(
                                'alasan',
                                'nama_rek',
                                'bank',
                                'no_rek'
                            )
                            ->where('user_id', $row->user_id)
                            ->first();
                        

                        @endphp
                    
                    <tr>
                        
                        <td>{{ $no++ }}</td>
                        <td class="">{{ $name->name }}</td>
                        <td class="">{{ $row->nama_produk }}</td>
                        <td class="">{{ $row->qty }}</td>
                        <td class="">{{ $row->harga_produk }}</td>
                        <td class="">{{ $refund->alasan }}</td>
                        <td class="">{{ $refund->nama_rek }}</td>
                        <td class="">{{ $refund->bank }}</td>
                        <td class="">{{ $refund->no_rek }}</td>
                        
                        
                        <td align="center">
                            <a href="{{ url('/upload_refund/'.$name->user_id) }}" class="btn btn-sm btn-danger mb-2 rounded-pill" >Upload Bukti Refund</a>

                            

                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection
