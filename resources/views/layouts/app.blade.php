@php
    try {
        $role_id = Auth::user()->role_id;
    } catch (\Throwable $th) {
        $role_id = null;
    }
    
@endphp


<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="/css/style.css">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <script src="/js/script.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>

    <!-- Midtrans -->
    <!-- @TODO: replace SET_YOUR_CLIENT_KEY_HERE with your client key -->
    <script type="text/javascript"
      src="https://app.sandbox.midtrans.com/snap/snap.js"
      data-client-key="SB-Mid-client-iUccKCROHQ4PL4jk"></script>
    <!-- Note: replace with src="https://app.midtrans.com/snap/snap.js" for Production environment -->

    
    

    <!-- Bootstrap 4.6 cdn -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css">
    
    

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
    
    <!-- Sweatalert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Ionicons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

    <!-- Data table -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css" />

    <script src="https://cdn.jsdelivr.net/npm/jsbarcode@3.11.0/dist/JsBarcode.all.min.js"></script>
    

</head>

<body>
    <div id="app">

        {{-- ----------  NAVBAR PEMBELI -------------- --}}

        @if($role_id == 1 || $role_id == null)

        
        <nav class="navbar navbar-expand-lg navbar-light bg-info shadow-sm ">
            
            <a class="navbar-brand fw-bold text-light" href="{{ url('/') }}">
                {{ config('app.name', 'Laravel') }}
            </a>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item px-3 mx-2">
                    <a class="nav-link text-light" aria-current="page" href="{{ url('/') }}">Home</a>
                    </li>
                    <li class="nav-item px-3 mx-2">
                    <a class="nav-link text-light" aria-current="page" href="{{ url('/display_semua_produk') }}">Produk</a>
                    </li>
                    <li class="nav-item px-3 mx-2">
                        <a class="nav-link text-light" aria-current="page" href="{{ url('/cek_resi') }}">Cek Resi</a>
                        </li>
                    <li class="nav-item px-3 mx-2">
                        <a class="nav-link text-light" aria-current="page" href="{{ url('/cart') }}">Keranjang</a>
                        </li>
                    <li class="nav-item px-3 mx-2">
                        <a class="nav-link text-light" aria-current="page" href="{{ url('/hubungi_dokter') }}">Hubungi Dokter</a>
                    </li>
                </ul>
                
            
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav me-auto">
                    <form action="{{ url('/filter_search') }}" class="d-flex mx-2" role="search" method="GET">
                        <input name="search" id="search" class="form-control me-2 rounded-5 border-light" type="search" placeholder="Cari sesuatu.." aria-label="Search">
                        <button class="btn btn-outline-light rounded-5" type="submit">Search</button>
                    </form>
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ms-auto">
                    <!-- Authentication Links -->
                    @guest
                        @if (Route::has('login'))
                            <li class="nav-item px-2 mx-2">
                                <a class="nav-link text-light" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                        @endif

                        @if (Route::has('register'))
                            <li class="nav-item px-2 mx-2">
                                <a class="nav-link
                                text-light" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                        @endif
                    @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle text-light" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item text-info" href="{{ route('home') }}">
                                    {{ __('Akun Saya') }}
                                </a>
                                <a class="dropdown-item text-info" href="{{ url('/cart') }}">{{ __('Keranjang Belanja') }}</a>
                                <a class="dropdown-item text-info" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest
                </ul>
            </div>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>
           
        </nav>

        {{-- ------------- NAVBAR ADMIN ------------ --}}

        @elseif($role_id == 2)
        <nav class="navbar navbar-expand-lg navbar-dark shadow-sm border-bottom border-info">
            <div class="container">
                <a class="navbar-brand text-info fw-bold" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item px-3 mx-2">
                      <a class="nav-link text-info" aria-current="page" href="/home">Dashboard</a>
                    </li>
                  </ul>
                  
                    <div class="collapse navbar-collapse">
                        
                    </div>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">
                        
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link text-info" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link text-info" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle text-info" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item text-info" href="{{ route('home') }}">
                                        {{ __('Akun Saya') }}
                                    </a>
                                    <a class="dropdown-item text-info" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
        @endif

        <main>
            
        </main>
    </div>

@yield('content')

{{-- -------------------FOOTER------------ --}}
<div class="footer-basic bg-info text-light rounded rounded-3">

    <div class="row justify-content-center align-item-center">
        <div class="col-md-3 text-light ">
            <h4 class="fw-bold ">Alamat toko offline:</h4>
            <p>Jl. Mangga VI No.45, Lamper Kidul, <br>Kec. Semarang Sel., <br>Kota Semarang, <br>Jawa Tengah 50249</p>
        </div>
        <div class="col-md-4">
            <footer class="mt-3">
                <ul class="text-center">
                    <li class="list-item my-2"><a href="/">Home</a></li>
                    <li class="list-item my-2"><a href="/aboutus">Tentang Kami</a></li>
                    <li class="list-item my-2"><a href="/syarat">Syarat dan Ketentuan</a></li>
                    <li class="list-item my-2"><a href="/privacy">Kebijakan Privasi</a></li>
                </ul>
            </footer>
        </div>
        <div class="col-md-3 text-right">
            <h5 class="fw-bold ">Temukan kami disosial media:</h5>
            <a href="https://www.instagram.com/kho.iru/"><i class="icon ion-social-instagram text-light iconabout"></i></a>
                <a href="https://twitter.com/Khoirru2"><i class="icon ion-social-twitter text-light iconabout"></i></a>
                <a href="https://web.facebook.com/Khoirrudin4/"><i class="icon ion-social-facebook text-light iconabout"></i></a>
                <h5 class="fw-bold mt-4">Hubungi melalui WhatsApp:</h5>
            
            <a href="https://wa.me/6282298084347">
                <button type="button" class="btn btn-light text-info rounded-pill fw-bold">Hubungi sekarang!</button>
            </a>
        </div>
    </div>
    
    <p class="copyright text-light text-button">Nyanko © 2023</p>
</div>





<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js" integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>

</body>
</html>
