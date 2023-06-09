@extends('layouts.nav')


@section('content_home')

<?php
    $user_id = Auth::user()->id;
    $role_id = Auth::user()->role_id;


    $data = DB::table('users')
        ->leftJoin('master_role', 'users.role_id', 'master_role.id')
        ->select(
            'master_role.role as role_user', 
            'users.name as name', 
            'users.email',
            'users.alamat',
            'users.no_hp'
        )
        ->where('users.id', $user_id)
        ->first();
    
    $alamat = '';
    $no_hp = '';
    $hiddenalert = '';
    $hidentombol = '';
    $hiddenalert2 = '';
    $hidentombol2 = '';

    if ($data->no_hp == null) {
        $no_hp = 'No hp belum ditambahkan';
        $hidentombol2 = 'hidden';
    } else {
        $no_hp = $data->no_hp;
        $hiddenalert2 = 'hidden';
    }
    
    
    if ($data->alamat == null) {
        $alamat = 'Balum ada alamat,';
        $hidentombol = 'hidden';
    } else {
        $alamat = $data->alamat;
        $hiddenalert = 'hidden';
    };
?>

<h4 class="text-info">Belanja anda siap diCheckout!</h4>
<p class="text-info">Teliti kembali sebelum melakukan pembayaran</p>

<p class="text-info fw-bold mt-4">Alamat pengiriman:</p>
<span>{{ $data->name }}</span><br>
<span>{{ $no_hp }}</span><br>
<span>{{ $alamat }}</span>

<table class="table table-striped mt-4">
    
    <thead>
        <tr class="bg-info text-white" align="center">
            <th scope="col">No</th>
            <th scope="col">Gambar</th>
            <th scope="col">Nama Produk</th>
            <th scope="col">Qty</th>
            <th scope="col">Harga</th>
        </tr>
    </thead>
    <tbody class="text-center">
        @php 
            $no=1;
            $no_produk=1;
            
        @endphp
        @foreach($data_keranjang as $row)
            @php
            $produk_id = $row->produk_id;
            $img = DB::table('keranjang')
                ->leftJoin('produk_kucing', 'keranjang.produk_id', 'produk_kucing.id')
                ->select('produk_kucing.gambar_produk')
                ->where('produk_kucing.id', $produk_id)
                ->first();
            
            @endphp
        <tr>
            <td>{{ $no++ }}</td>
            
            <td align="center">
                <img class="img-fluid rounded shadow-sm"
                    src="{{ asset('img_produk_anak_kucing/'.$img->gambar_produk) }}"
                    style="width: 90px; height:90px" alt="Gambar Produk">
            </td>
            <td class="">{{ $row->nama_produk }}</td>
            <td class="">{{ $row->qty }}</td>
            <td class="fw-bold">Rp.{{ number_format($row->harga_produk,2,',','.') }}</td>
        </tr>
        @endforeach
        @php
                $hidden = '';
                $hidden2 = '';
                if ($data_status == null) {
                    $hidden = 'hidden';
                } else {
                    $hidden2 = 'hidden';
                };
                
            @endphp
        <tr>
            <td {{ $hidden }} class="fw-bold bg-info text-light" colspan="4">Total belanja anda:</td>
            <td {{ $hidden }} class="fw-bold bg-info text-light">Rp.{{ number_format($data_harga,2,',','.') }}</td>
                
        </tr>
        <tr {{ $hiddenalert2 }}>
            <td colspan="5">Mohon tambahkan nomor telephone anda terlebih dahulu!</td>
        </tr>
        <tr {{ $hiddenalert }}>
            <td colspan="5">Mohon lengkapi alamat anda terlebih dahulu!</td>
        </tr>
        <tr {{ $hidentombol }} {{ $hidentombol2 }}>
            <td {{ $hidden2 }}  colspan="4">Anda tidak mempunyai barang untuk dicheckout</td>

            <td {{ $hidden }} colspan="4"></td>
            
            <td>
                <a href="{{ url('/midtrans_payment') }}">
                <button {{ $hidden }}  class="btn btn-info rounded-pill">Proses pembayaran</button></a>
            </td>
            <!-- <td><a class="text-decoration-none text-light" href=""><button class="btn btn-info rounded-pill">Proses Pembayaran</button></a></td> -->
            
        </tr>
    </tbody>
</table>


@endsection
