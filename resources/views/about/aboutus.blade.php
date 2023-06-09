@extends('layouts.app')

@section('content')


<div class="container bdcontainer my-5 rounded3 border border-info">
    <div class="row p-2 justify-content-center align-item-center">
        <div class="col-md-5 mt-2">
            <h1 class="fw-bold text-info text-center">Tentang Nyanko~</h1>
        </div>
    </div>
    <div class="row p-3">
        <div class="col-md-5 bg-info rounded3">
            <img src="{{ asset('img_aboutus/img_toko_nyanko.png') }}" alt="" srcset="" class="card-img-top">
        </div>
        <div class="col-md-7 p-5">
            <h2 class="fw-bold ">Nyanko~</h2>
            <h5 class="fw-bold ">Cet Shop and Care</h5>
            <p class=""><span class="fw-bold text-info">Nyanko~</span>  adalah perusahaan yang bergerak dalam bidang distribusi pemasaran makanan kucing dan peralatannya <br> <br>
                Selain itu, kami juga menyediakan pelayanan perawatan kucing mulai dari memandikan hingga merawat kuku dan gigi kucing kesayangan anda <br> <br>
                <span class="fw-bold text-info ">Nyanko~</span> juga berkerja sama dengan dokter berpengalaman untuk menunjang pelayanan perawatan kami. <br> <br>
                <span class="fw-bold text-info">Nyanko~</span> telah berdiri lebih dari 10 tahun dan akan terus meningkatkan pelayanan kami demi memenuhi kebahagiaan anda dan kucing anda
            </p>        
        </div>
    </div>
    <div class="row p-2 justify-content-center align-item-center">
        <div class="col-md-5 mt-2">
            <h1 class="fw-bold text-info text-center">Staff Kami</h1>
        </div>
    </div>
    <div class="row p-2 justify-content-center align-item-center">
        <div class="col-md-3 mt-2 bg-info mx-2 rounded3 p-2">
            <img src="{{ asset('img_aboutus/img_staf.png') }}" alt="" srcset="" class="card-img-top">
            <h4 class="text-center fw-bold text-light mt-2">Kinanti Sekar Arum</h4>
        </div>
        <div class="col-md-3 mt-2 bg-info mx-2 rounded3 p-2">
            <img src="{{ asset('img_aboutus/img_staf1.png') }}" alt="" srcset="" class="card-img-top">
            
            <h4 class="text-center fw-bold text-light mt-2">Tasya Felisia</h4>
        </div>
        <div class="col-md-3 mt-2 bg-info mx-2 rounded3 p-2">
            <img src="{{ asset('img_doctor/doctor.png') }}" alt="" srcset="" class="card-img-top">
            
            <h4 class="text-center fw-bold text-light mt-2">Drh. Anisa Eka Kinanti</h4>
        </div>
    </div>

    <div class="row p-2 justify-content-center align-item-center mt-2">
        <div class="col-md-5 mt-2">
            <h1 class="fw-bold text-info text-center">Hubungi Kami</h1>
        </div>
    </div>
    <div class="row m-2 p-2  bg-info justify-content-center align-item-center rounded3">
        <div class="col-md-7 rounded3 p-2">
            <img src="{{ asset('img_aboutus/img_toko_nyanko1.png') }}" alt="" srcset="" class="card-img-top rounded3">
        </div>
        <div class="col-md-5 text-light mt-2">
            <h4 class="fw-bold ">Alamat toko offline:</h4>
            <p>Jl. Mangga VI No.45, Lamper Kidul, <br>Kec. Semarang Sel., <br>Kota Semarang, <br>Jawa Tengah 50249</p>

            <h5 class="fw-bold mt-4">Temukan kami disosial media:</h5>
            
            <div class="">
                <a href="https://www.instagram.com/kho.iru/"><i class="icon ion-social-instagram text-light iconabout"></i></a>
                <a href="https://twitter.com/Khoirru2"><i class="icon ion-social-twitter text-light iconabout"></i></a>
                <a href="https://web.facebook.com/Khoirrudin4/"><i class="icon ion-social-facebook text-light iconabout"></i></a>
            </div>

            
            <h5 class="fw-bold mt-4">Hubungi melalui WhatsApp:</h5>
            
            <a href="https://wa.me/6282298084347">
                <button type="button" class="btn btn-light text-info rounded-pill fw-bold">Hubungi sekarang!</button>
            </a>
        </div>
    </div>
</div>





@endsection