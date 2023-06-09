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

<h4 class="text-info text-center fw-bold">Ajukan pembatalan dan refund transaksi</h4>
<p class="text-danger text-center">
    Isi form pembatalan transaksi berikut! <br>
    Pastikan nama dan nomor rekening tujuan refund benar <br>
    
</p>
<div {{ $hidden }} class="row">
    <div class="col-md-12 ">
        <div class="row text-center">
            <h5>Jumlah Transaksi Anda:</h5>
        </div>
        <div class="row justify-content-center align-item-center">
            <div class="col-md-6 bg-info rounded-pill">
                <h3 class="text-center text-light fw-bold">Rp. {{ $data_harga }}</h3>
            </div>
        </div>
        <p class="text-center">Uang anda akan dikembalikan 100%</p>
    </div>
</div>
<div {{ $hidden2 }} class="row justify-content-center align-item-center">
    <div class="col-md-9 bg-danger p-1 rounded-pill mb-2">
        <h4 class="text-light text-center">Anda tidak mempunyai transaksi untuk direfund!</h4>
    </div>
</div>
<div class="row justify-content-center align-item-center">
    <div class="col-md-12">
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
        <form {{ $hidden }}  method="POST" action="{{ url('/upload_pembatalan') }}" enctype="multipart/form-data">
            @csrf
            <div class="row mb-2">
                <label for="alasan" class="col-md-4 col-form-label text-md-end">Alasan Pembatalan</label>


                <div class="col-md-6">
                    <textarea id="alasan" type="text-area" class="form-control" name="alasan" required
                        placeholder="Isikan alasanmu"></textarea>
                </div>
            </div>
            <div class="row mb-2">
                <label for="nama_rek" class="col-md-4 col-form-label text-md-end">Nama Pemilik no rekening</label>


                <div class="col-md-6">
                    <input id="nama_rek" type="text" class="form-control" name="nama_rek" required
                        placeholder="Nama pemilik no rekening">
                </div>
            </div>
            <div class="row mb-2">
                <label for="bank_tujuan" class="col-md-4 col-form-label text-md-end">Bank Tujuan</label>

                <div class="col-md-6">
                    <select class="form-control" name="bank_tujuan">
                        <option value="">Pilih</option>
                        
                        <option value="BRI">BRI</option>
                        <option value="BNI">BNI</option>
                        <option value="BCA">BCA</option>
                        <option value="Mandiri">Mandiri</option>
                    </select>
                </div>
            </div>
            
            <div class="row mb-2">
                <label for="no_rek" class="col-md-4 col-form-label text-md-end">Nomer rekening tujuan</label>


                <div class="col-md-6">
                    <input id="no_rek" type="number" class="form-control" name="no_rek" required
                        placeholder="Nomor rekening tujuan refund">
                </div>
            </div>
            <div class="row justify-content-center align-item-center">
                <div class="col-md-5 ">
                    <button type="submit" class="mt-2 btn btn-danger rounded-pill">Ajukan pembatalan dan refund</button>
                </div>
            </div>             
        </form>
    </div>   
</div>
       

@endsection
