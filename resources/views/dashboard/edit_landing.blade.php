@extends('layouts.app')


@section('content')
<div class="container mt-4 mb-4">
    <div class="row justify-content-center ">
        <div class="col-md-8 ">
            <div class="card border border-info p-3 bdcontainer">
                <h4 class="text-info fw-bold">Edit Gambar Landing {{ $id }}</h4>
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
                    <form method="POST" action="{{ url('/simpan_edit_landing/'.$id) }}" enctype="multipart/form-data">
                        @csrf
                        @foreach($data_tabel_landing_img as $row)
    {{-- GAMBAR --}}
                        <div class="row mb-3">
                            <label for="gambar_landing" class="col-md-4 col-form-label text-md-end">Gambar Landing</label>
                            <div class="col-md-6">
                                <img class="img-fluid rounded shadow-sm mb-2"
                                    src="{{ asset('img_landing/'.$row->gambar_landing) }}"
                                    style="width: 90px; height:110px" alt="Gambar Landing">
                                <input id="gambar_landing" type="file" class="form-control border-info" name="gambar_landing">
                                <input id="gambar_landing_lama" type="text" class="form-control" name="gambar_landing_lama" value="{{ $row->gambar_landing }}" hidden>
                            </div>
                        </div>
    {{-- TOMBOL SUBMIT --}}
                        <div class="row mb-3">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-info rounded-pill">Simpan</button>
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