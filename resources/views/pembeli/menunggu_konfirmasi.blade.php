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

<h4 class="text-info">Menunggu konfirmasi admin</h4>
<p class="text-info">Pesanan anda sedang diproses oleh admin maksimal 1x24jam, mohon sabar menunggu!</p>

<table class="table table-striped ">
    <thead {{ $hidden }}>
        <tr class="bg-info text-white" align="center">
            <th scope="col">No</th>
            <th scope="col">Gambar</th>
            <th scope="col">Nama Produk</th>
            <th scope="col">Qty</th>
            <th scope="col">Harga</th>
        </tr>
    </thead>
    <tbody class="text-center">
        @foreach($data_keranjang as $row)
            @php
            $produk_id = $row->produk_id;
            $data = DB::table('keranjang')
                ->leftJoin('produk_kucing', 'keranjang.produk_id', 'produk_kucing.id')
                ->select('produk_kucing.gambar_produk', 'keranjang.status_produk')
                ->where('produk_kucing.id', $produk_id)
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
            <td class="fw-bold">Rp. {{ $row->harga_produk }}</td>
        </tr>
        @endforeach
        
        <tr>
            <td {{ $hidden }} class="fw-bold bg-info text-light" colspan="4">Total belanja anda:</td>
            <td {{ $hidden }} class="fw-bold bg-info text-light">Rp. {{ $data_harga }}</td>
                
        </tr>
        <tr>
            <td {{ $hidden2 }} class="bg-info text-light"  colspan="4">Anda tidak mempunyai transaksi apapun</td>
            <td class="text-danger fw-bold" colspan="4" {{ $hidden }}>
                <p>Ingin membatalkan pesanan?</p>
            </td>
            <td {{ $hidden }}><a href="{{ url('/ajukan_pembatalan') }}">
                <button  class="btn btn-danger rounded-pill">Ajukan pembatalan</button></a>
            </td>
        </tr>
        
    </tbody>
</table>

 @endsection
