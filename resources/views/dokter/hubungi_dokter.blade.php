@extends('layouts.app')

@section('content')


<div class="container bdcontainer my-5 rounded3 border border-info">
    <div class="row p-3">
        <div class="col-md-5 bg-info rounded3">
            <img src="{{ asset('img_doctor/doctor.png') }}" alt="" srcset="" class="card-img-top">
        </div>
        <div class="col-md-7 p-5">
            <h3 class="fw-bold ">Profil Dokter:</h3>
            <h5 class="fw-bold ">Drh. Anisa Eka Kinanti</h5>
            <p class="">Dokter Anisa telah menempuh pendidikan di Fakultas Kedokteran Hewan Universitas Gadjah Mada Yogyakarta <br>
            Telah menempuh pendidikan profesi selama 1,5 serta telah berpengalaman lebih dari 10 Tahun
            </p>
            <a href="https://wa.me/6282298084347">
                <button type="button" class="btn btn-info rounded-pill fw-bold">Konsultasi sekarang!</button>
            </a>
        </div>
    </div>
</div>





@endsection