@extends('layouts.app')

@section('content')
<div class="container mt-4 mb-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card p-4 border-info bdcontainer">
                <h3 class="text-info fw-bold">Isi Form Input Dengan Benar~</h3>

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
                    <form method="POST" action="{{ url('simpan_input_produk') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row mb-2">
                            <label for="nama_produk" class="col-md-4 col-form-label text-md-end">Nama Produk</label>


                            <div class="col-md-6">
                                <input id="nama_produk" type="text" class="form-control" name="nama_produk" required
                                    placeholder="Contoh: Whiskas Kitten 1kg">
                            </div>
                        </div>

                        <div class="row mb-2">
                            <label for="gambar_produk" class="col-md-4 col-form-label text-md-end">Gambar Produk</label>

                            <div class="col-md-6">
                                <input id="gambar_produk" type="file" class="form-control" name="gambar_produk" required>
                            </div>
                        </div>

                        <div class="row mb-2">
                            <label for="stok_produk" class="col-md-4 col-form-label text-md-end">Stok Produk</label>

                            <div class="col-md-6">
                                <input id="stok_produk" type="number" class="form-control" name="stok_produk" required
                                    placeholder="Contoh: 10">
                            </div>
                        </div>

                        <div class="row mb-2">
                            <label for="harga" class="col-md-4 col-form-label text-md-end">Harga Produk</label>

                            <div class="col-md-6">
                                <input id="harga" type="number" class="form-control" name="harga" required
                                    placeholder="Contoh: 20.000">
                            </div>
                        </div>

                        <div class="row mb-2">
                            <label for="kategori_produk" class="col-md-4 col-form-label text-md-end">Kategori Produk</label>

                            <div class="col-md-6">
                                <select class="form-control" name="kategori_produk">
                                    <option value="">Pilih</option>
                                    @foreach ($data_master_kategori as $kategori)
                                    <option value="{{ $kategori->id }}">{{ $kategori->kategori }}</option>
                                        
                                    @endforeach
                                    {{-- <option value="1">Makanan Kering Bayi</option>
                                    <option value="2">Makanan Kering Dewasa</option>
                                    <option value="3">Makanan Basah Bayi</option>
                                    <option value="4">Makanan Basah Dewasa</option>
                                    <option value="5">Perlengkapan Kucing</option> --}}
                                </select>
                            </div>
                        </div>

                        <div class="row mb-2">
                            <label for="produk_brand" class="col-md-4 col-form-label text-md-end">Produk Brand</label>

                            <div class="col-md-6">
                                <select class="form-control" name="produk_brand">
                                    <option value="">Pilih</option>
                                    @foreach ($data_brand as $brand)
                                    <option value="{{ $brand->id }}">{{ $brand->brand }}</option>
                                        
                                    @endforeach
                                    {{-- <option value="1">Whiskas</option>
                                    <option value="2">Royal Canin</option>
                                    <option value="3">Pro Plan</option>
                                    <option value="4">Equilibrio</option>
                                    <option value="5">Black Wood</option>
                                    <option value="6">Bolt</option> --}}
                                </select>
                            </div>
                        </div>

                        <div class="row mb-2">
                            <label for="deskripsi_produk" class="col-md-4 col-form-label text-md-end">Deskripsi
                                Produk</label>


                            <div class="col-md-6">
                                <textarea id="deskripsi_produk" class="form-control" name="deskripsi_produk"></textarea>
                            </div>
                        </div>

                        <div class="row mb-2">
                            <div class="col-md-8 offset-md-4">
                                <button class="btn btn-info rounded-pill" type="submit">Simpan</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
