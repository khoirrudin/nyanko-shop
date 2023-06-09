@extends('layouts.nav')


@section('content_home')
 
<div class=" p-3 ">
    <h4 class="text-info fw-bold">Edit Pesanan</h4>
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
    <div class="card-body">
        <table class="table table-striped ">
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
                    
                @endphp
                
                    @php
                    $produk_id = $data_keranjang->produk_id;
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
                    <td class="">{{ $data_keranjang->nama_produk }}</td>
                    <td class="">

                        <form class="justify-content-center align-items-center" method="POST" action="{{ url('/simpan_edit_keranjang/'.$id) }}" enctype="multipart/form-data">
                            @csrf
                            <input style="width: 120px" id="qty" type="number" class="form-control border-info text-center mb-2" name="qty" value={{ $data_keranjang->qty }}
                            required autocomplete="qty" autofocus>
                            
                            <button type="submit" class="btn btn-info rounded-pill">Simpan</button>
                        </form>
                    </td>
                    <td class="fw-bold">Rp. {{ $data_keranjang->harga_produk }}</td>
                    
                </tr>
                
            </tbody>
        </table>
        
    </div>
</div>



@endsection
