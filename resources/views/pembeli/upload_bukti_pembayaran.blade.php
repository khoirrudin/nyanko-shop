@extends('layouts.nav')


@section('content_home')

<h4 class="text-info text-center fw-bold">Upload bukti pembayaran anda</h4>
<p class="text-danger text-center">Pastikan bukti pembayaran anda terlihat jelas 
    <br> Bukti harus berisi nama pengirim, tujuan tranfer, nominal tranfer dan bukti transaksi berhasil atau sukses
    <br> atau buka <a href="http://">syarat dan ketentuan</a> kami untuk lebih jelas.
</p>
<div class="row justify-content-center align-item-center">
    <div class="col-md-6">
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
        <form method="POST" action="{{ url('/simpan_upload_bukti_pembayaran') }}" enctype="multipart/form-data">
            @csrf
            
            <input required id="bukti_pembayaran" type="file" class="form-control border-info" name="bukti_pembayaran">
            <div class="row justify-content-center align-item-center">
                <div class="col-md-3 ">
                    <button type="submit" class="mt-2 btn btn-info rounded-pill">Upload!</button>
                </div>
            </div>             
        </form>
    </div>   
</div>
       

@endsection
