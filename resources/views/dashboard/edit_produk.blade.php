@extends('layouts.app')


@section('content')
<div class="container mt-4 mb-4">
    <div class="row justify-content-center ">
        <div class="col-md-8 ">
            <div class="card p-4 border-info bdcontainer">
                <h3 class="text-info fw-bold">Edit Produk {{ $id }}</h3>
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
                    <form method="POST" action="{{ url('/simpan_edit_produk/'.$id) }}" enctype="multipart/form-data">
                        @csrf
                        @foreach($data_produk_kucing as $row)
    {{-- NAMA PRODUK --}}
                        <div class="row mb-3">
                            <label for="nama_produk" class="col-md-4 col-form-label text-md-end">Nama Produk</label>
                            <div class="col-md-6">
                                <input id="nama_produk" type="text" class="form-control border-info" name="nama_produk"
                                    value="{{ $row->nama_produk }}" required autocomplete="nama_produk" autofocus>
                            </div>
                        </div>
    {{-- GAMBAR --}}
                        <div class="row mb-3">
                            <label for="gambar_produk" class="col-md-4 col-form-label text-md-end">Gambar Produk</label>
                            <div class="col-md-6">
                                <img class="img-fluid rounded shadow-sm mb-2"
                                    src="{{ asset('img_produk_anak_kucing/'.$row->gambar_produk) }}"
                                    style="width: 90px; height:110px" alt="Gambar Produk">
                                <input id="gambar_produk" type="file" class="form-control border-info" name="gambar_produk">
                                <input id="gambar_produk_lama" type="text" class="form-control" name="gambar_produk_lama" value="{{ $row->gambar_produk }}" hidden>
                            </div>
                        </div>
    {{-- STOK --}}
                        <div class="row mb-3">
                            <label for="stok_produk" class="col-md-4 col-form-label text-md-end">Stok</label>
                            <div class="col-md-6">
                                <input id="stok_produk" type="number" class="form-control border-info" name="stok_produk" value={{ $row->stok }}
                                    required autocomplete="stok_produk" autofocus>
                            </div>
                        </div>
    {{-- HARGA --}}
                        <div class="row mb-3">
                            <label for="harga" class="col-md-4 col-form-label text-md-end">Harga</label>
                            <div class="col-md-6">
                                <input id="harga" type="number" class="form-control border-info" name="harga" value={{ $row->harga }}
                                    required autocomplete="harga" autofocus>
                            </div>
                        </div>
    {{-- Deskribsi Produk --}}
                        <div class="row mb-3">
                            <label for="deskripsi_produk" class="col-md-4 col-form-label text-md-end">Deskripsi
                                Produk</label>
                            <div class="col-md-6">
                                <textarea id="deskripsi_produk" class="form-control border-info" name="deskripsi_produk"
                                    value="{{ $row->deskripsi_produk }}">{{ $row->deskripsi_produk }}</textarea>
                            </div>
                        </div>
{{-- KATEGORY --}}
                        <div class="row mb-2">
                            <label for="kategori_produk" class="col-md-4 col-form-label text-md-end">Kategori Produk</label>

                            <div class="col-md-6">

                                <select id="kategori_produk" class="form-control" name="kategori_produk">
                                    <option value="">Pilih</option>
                                    <option value="1">Makanan Kering Bayi</option>
                                    <option value="2">Makanan Kering Dewasa</option>
                                    <option value="3">Makanan Basah Bayi</option>
                                    <option value="4">Makanan Basah Dewasa</option>
                                    <option value="5">Perlengkapan Kucing</option>
                                </select>

                                <input id="kategori_lama" type="text" class="form-control" name="kategori_lama" value="{{ $row->kategori_id }}" hidden>
                            </div>
                        </div>
{{-- BRAND --}}
                        <div class="row mb-2">
                            <label for="produk_brand" class="col-md-4 col-form-label text-md-end">Produk Brand</label>

                            <div class="col-md-6">
                                <select id="produk_brand" class="form-control" name="produk_brand">
                                    <option value="">Pilih</option>
                                    <option value="1">Whiskas</option>
                                    <option value="2">Royal Canin</option>
                                    <option value="3">Pro Plan</option>
                                    <option value="4">Equilibrio</option>
                                    <option value="5">Black Wood</option>
                                    <option value="6">Bolt</option>
                                </select>

                                <input id="brand_lama" type="text" class="form-control" name="brand_lama" value="{{ $row->brand }}" hidden>
                            </div>
                        </div>
    {{-- TOMBOL SUBMIT --}}
                        <div class="row mb-3">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn rounded-pill btn-info">Simpan</button>
                            </div>
                        </div>
                        @endforeach
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
