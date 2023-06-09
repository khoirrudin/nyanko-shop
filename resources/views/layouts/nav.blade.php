@extends('layouts.app')


@section('content')
<div class="container mt-4 mb-4">
    <div class="row">
        <div class="col-md-2 rounded3 bdcontainer p-3 mx-3 border border-info">
            <!-- home -->
                <p><a class="text-decoration-none text-info" href="{{ url('/home') }}">{{ __('Akun anda') }}</a></p>
            <!-- Keranjang -->
                <p><a class="text-decoration-none text-info" href="{{ url('/cart') }}">{{ __('Keranjang') }}</a></p>
            <!-- Menunggu pembayaran -->
                <p><a class="text-decoration-none text-info" href="{{ url('/menunggu_pembayaran') }}">{{ __('Menunggu pembayaran') }}</a></p>
            <!-- Menunggu konfirmasi -->
                 <p><a class="text-decoration-none text-info" href="{{ url('/menunggu_konfirmasi') }}">{{ __('Menunggu konfirmasi') }}</a></p>
            <!-- Sedang dikirim -->
                <p><a class="text-decoration-none text-info" href="{{ url('/sedang_dikirim') }}">{{ __('Sedang dikirim') }}</a></p>
            <!-- Pesanan Selesai -->
                <p><a class="text-decoration-none text-info" href="{{ url('/pesanan_selesai') }}">{{ __('Pesanan selesai') }}</a></p>
        <!-- Pesanan ditolak -->
                <p><a class="text-decoration-none text-info" href="{{ url('/pesanan_ditolak') }}">{{ __('Pesanan ditolak') }}</a></p>
            <!-- Konfirmasi pembatalan -->
                <p><a class="text-decoration-none text-info" href="{{ url('/menunggu_konfirmasi_pembatalan') }}">{{ __('Menunggu konfirmasi pembatalan') }}</a></p>
            <!-- Daftar transaksi -->
                <p><a class="text-decoration-none text-info" href="{{ url('/daftar_transaksi') }}">{{ __('Daftar transaksi') }}</a></p>
        </div>
        <div class="col-md-9 rounded3 bdcontainer p-3 border border-info">
            @yield('content_home')
        </div>
    </div>
</div>


@endsection

