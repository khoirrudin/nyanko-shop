@extends('layouts.nav')


@section('content_home')
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

<h4 class="text-info">Pesanan anda ditolak admin</h4>
<p class="text-info">Isi form refund segera!</p>
<table class="table table-striped ">
    <thead {{ $hidden }}>
        <tr class="bg-info text-white" align="center">
            <th scope="col">No</th>
            <th scope="col">Gambar</th>
            <th scope="col">Nama Produk</th>
            <th scope="col">Qty</th>
            <th scope="col">Harga</th>
            <th scope="col">Alasan penolakan</th>
        </tr>
    </thead>
    <tbody class="text-center">
        @foreach($data_keranjang as $row)
            @php
            $user_id = Auth::user('users')->id;
            $produk_id = $row->produk_id;
            $data = DB::table('keranjang')
                ->leftJoin('produk_kucing', 'keranjang.produk_id', 'produk_kucing.id')
                ->select('produk_kucing.gambar_produk', 'keranjang.status_produk')
                ->where('produk_kucing.id', $produk_id)
                ->first(); 

            $data_refund = DB::table('pesanan_ditolak')
                ->select('alasan')
                ->where('user_id', $user_id)
                ->first();
            @endphp
        <tr>
            <td>{{ $no++ }}</td>
            
            <td align="center">
                <img class="img-fluid rounded shadow-sm"
                    src="{{ asset('img_produk_anak_kucing/'.$data->gambar_produk) }}"
                    style="width: 90px; height:90px" alt="Gambar Produk">
            </td>
            <td class="">{{ $row->nama_produk }}</td>
            <td class="">{{ $row->qty }}</td>
            <td class="fw-bold">Rp.{{ number_format($row->harga_produk,2,',','.') }}</td>
            <td>{{ $data_refund->alasan }}</td>
        </tr>
        @endforeach
        
        <tr>
            <td {{ $hidden }} class="fw-bold bg-info text-light" colspan="4">Total belanja anda:</td>
            <td {{ $hidden }} class="fw-bold bg-info text-light">Rp.{{ number_format($data_harga,2,',','.') }}</td>
            <td class="fw-bold bg-info text-light"></td>
                
        </tr>
        <tr>
            <td {{ $hidden2 }} class="bg-info text-light"  colspan="5">Anda tidak mempunyai transaksi apapun</td>
            <td class="text-danger fw-bold" colspan="5" {{ $hidden }}>
                <p>Isi form refund</p>
            </td>
            <td {{ $hidden }}><a href="{{ url('/form_refund') }}">
                <button  class="btn btn-danger rounded-pill">Form refund</button></a>
            </td>
        </tr>
        
    </tbody>
</table>

 @endsection
