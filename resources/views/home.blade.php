@extends('layouts.app')

@section('content')

@if (session('status'))
    <div class="alert alert-success" role="alert">
        {{ session('status') }}
    </div>
@endif
<?php
    $user_id = Auth::user()->id;
    $role_id = Auth::user()->role_id;


    $data = DB::table('users')
        ->leftJoin('master_role', 'users.role_id', 'master_role.id')
        ->select(
            'master_role.role as role_user', 
            'users.name as name', 
            'users.email',
            'users.alamat',
            'users.no_hp'
        )
        ->where('users.id', $user_id)
        ->first();
    
    $alamat = '';
    $no_hp = '';
    $hidden = '';

    if ($data->no_hp == null) {
        $no_hp = 'No hp belum ditambahkan';
    } else {
        $no_hp = $data->no_hp;
    }
    
    
    if ($data->alamat == null) {
        $alamat = 'Balum ada alamat,';
    } else {
        $alamat = $data->alamat;
        $hidden = 'hidden';
    };
?>
@if($role_id == 1)
<div class="container mt-4 mb-4 border bdcontainer border-info rounded3">
    <div class="row p-3">
        <div class="row mb-2">
            @if (\Session::has('message'))
                <div class="alert alert-success text-center">
                    {!! \Session::get('message') !!}
                </div>
            @elseif(\Session::has('error'))
                <div class="alert alert-danger text-center">
                    {!! \Session::get('error') !!}
                </div>
            @endif
        </div>
        <div class="col-md-4">
            <div class="row border border-5 border-info rounded rounded-circle p-1">
                <img class="rounded bg-light rounded-circle" src="{{ url('img_profile/profile_img.png') }}" alt="" srcset="">
            </div>
        </div>
        <div class="col-md-8">
            <div class="row p-4">
                <h2 class="fw-bold text-info mt-4">{{ __('Selamat datang kembali ') }} {{ $data->name }} {{ __('!') }}</h2>
                <div class="col-md-12 mt-4">
                    <h5 class="text-info">Profil kamu:</h5>
                    <table class="table">
                        <tbody>
                            <tr>
                                <td scope="row">Username</td>
                                <td>{{ $data->name }}</td>
                            </tr>
                            <tr>
                                <td scope="row">Email</td>
                                <td>{{ $data->email }}</td>
                            </tr> 
                            <tr>
                                <td scope="row">Alamat</td>
                                <td>{{ $alamat }}
                                
                                </td>
                                
                            </tr>
                            <tr>
                                <td scope="row">No hp</td>
                                <td>{{ $no_hp }}
                                
                                </td>
                                
                            </tr>      
                            <tr>
                                <td></td>
                                <td><span>
                                    <a href="#" class="btn btn-info text-light rounded-pill" onclick="tambah_alamat($user_id)" data-toggle="modal" data-target="#m1" type="button" role="button">Edit profile</a>
                                </span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    

    <div class="row">
        <div class="col-md-3">
            <p ><a class="text-decoration-none text-info" href="{{ url('/cart') }}">Transaksi Berlangsung</a></p>
            <p ><a class="text-decoration-none text-info" href="{{ url('/daftar_transaksi') }}">Semua Transaksi</a></p>
            <p >
            <a class="text-decoration-none text-info" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a></p>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
        </div>
        <div class="col-md-9">
            <h5 class="text-info">Status Pembelianmu:</h5>
            <table class="table text-center">
                <tbody>
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
                    
                    <tr {{ $hidden }} class="bg-info text-light">
                        <th>No</th>
                        <th>Nama Produk</th>
                        <th>Qty</th>
                        <th>Status Transaksi</th>
                        
                    </tr>
                    <tr>
                    @foreach ($data_keranjang as $keranjang )
                        @php
                            $status_id = $keranjang->status_produk;
                            $status = DB::table('keranjang')
                                ->leftJoin('master_status_produk', 'keranjang.status_produk', 'master_status_produk.id')
                                ->select('master_status_produk.keterangan')
                                ->where('master_status_produk.id', $status_id)
                                ->first();
                            
                            
                            $warna = '';
                                switch ($status->keterangan) {

                                    case 'Menunggu Pembayaran':
                                        $warna = 'text-danger';
                                        break;
                                    case 'Menunggu Konfirmasi Admin':
                                        $warna = 'text-info';
                                        break;
                                    case 'Sedang Dikirim':
                                        $warna = 'text-success';
                                        break;
                                    default:
                                        $warna = 'text-dark';
                                        break;
                                }
                            
                        @endphp
                        <td scope="row">{{ $no++ }}</td>
                        <td>{{ $keranjang->nama_produk }}</td>
                        <td>{{ $keranjang->qty }}</td>
                        <td class="fw-bold {{ $warna }}">{{ $status->keterangan }}</td>
                    </tr>
                    @endforeach
                    <tr>
                        <td {{ $hidden2 }} class="bg-info fw-bold text-light" colspan="4">Anda tidak mempunyai transaksi apapun</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>


@elseif($role_id == 2)
<div class="container mt-4 mb-4 p-4 bdcontainer border border-info rounded3">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="">
                <h3 class="text-info fw-bold">Admin Dashboard</h3>
                {{ __('Selamat datang kembali ') }} {{ $data->name }} {{ __('!') }}
                <div class="row p-3 mt-4">
                    <div class="col-md-3 mb-3 ">
                        <div class="bdcard border border-success rounded3">
                            <div class="card-body">
                                <ion-icon name="images" class="text-info ion-icon"></ion-icon>
                                <h5 class="card-title">Landing Image</h5>
                                <a href="{{ url('landing_img') }}" class="btn btn-info rounded-pill">Klik Disini~</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <div class=" bdcard border border-primary rounded3">
                            <div class="card-body">
                                <ion-icon name="duplicate" class="text-info ion-icon"></ion-icon>
                                <h5 class="card-title">Input Produk</h5>
                                <a href="{{ url('input_produk') }}" class="btn btn-info rounded-pill">Klik Disini~</a>
                            </div>
                        </div>
                        
                    </div>
                    <div class="col-md-3 mb-3">
                        <div class=" bdcard border border-primary rounded3">
                            <div class="card-body">
                                <ion-icon name="receipt" class="text-info ion-icon"></ion-icon>
                                <h5 class="card-title">Report Produk</h5>
                                <a href="{{ url('report_produk') }}" class="btn btn-info rounded-pill">Klik Disini~</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <div class=" bdcard border border-danger rounded3">
                            <div class="card-body">
                                <ion-icon name="cart" class="text-info ion-icon"></ion-icon>
                                <h5 class="card-title">Pesanan Masuk</h5>
                                <a href="{{ url('pesanan_masuk') }}" class="btn btn-info rounded-pill">Klik Disini~</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <div class=" bdcard border border-danger rounded3">
                            <div class="card-body text-center">
                                <ion-icon name="close-circle-outline" class="text-danger ion-icon"></ion-icon>
                                <h5 class="card-title">Konfirmasi Pembatalan</h5>
                                <a href="{{ url('konfirmasi_pembatalan') }}" class="btn btn-danger rounded-pill">Klik Disini~</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <div class=" bdcard border border-danger rounded3">
                            <div class="card-body">
                                <ion-icon name="cash-outline" class="text-danger ion-icon"></ion-icon>
                                <h5 class="card-title">Daftar Refund User</h5>
                                <a href="{{ url('daftar_refund') }}" class="btn btn-danger rounded-pill">Klik Disini~</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <div class=" bdcard border border-success rounded3">
                            <div class="card-body">
                                <ion-icon name="file-tray-full-outline" class="text-info ion-icon"></ion-icon>
                                <h5 class="card-title">Report Pesanan Users</h5>
                                <a href="{{ url('report_pesanan') }}" class="btn btn-info rounded-pill">Klik Disini~</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>  

@endif

<!-- MODAL -->

<div class="modal fade" id="m1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title w-100" id="myModalLabel">Edit profile:</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="data_tambah_alamat">

                <div class="row justify-content-center text-right">
                    <div class="col-md-12">
                        <form action="{{ url('/simpan_tambah_alamat') }}" method="post">
                            @csrf
                            <div class="row my-2">
                                <div class="col-md-3">
                                    <label for="name" class="col-form-label text-md-end">Username</label>
                                </div>
                                <div class="col-md-9">
                                    <input id="name" class="form-control" name="name" required autocomplete="username" value="{{ $data->name }}" autofocus>
                                </div>
                            </div>
                            <div class="row my-2">
                                <div class="col-md-3">
                                    <label for="email" class="col-form-label text-md-end">Email</label>
                                </div>
                                <div class="col-md-9">
                                    <input id="email" class="form-control" name="email" required autocomplete="email" value="{{ $data->email }}" autofocus>
                                </div>
                            </div>
                            <div class="row my-2">
                                <div class="col-md-3">
                                    <label for="alamat" class="col-form-label text-md-end">Alamat</label>
                                </div>
                                <div class="col-md-9">
                                    <input id="alamat" class="form-control" name="alamat" required autocomplete="alamat" value="{{ $alamat }}" autofocus>
                                </div>
                            </div>
                            <div class="row my-2">
                                <div class="col-md-3">
                                    <label for="no_hp" class="col-form-label text-md-end">No HP</label>
                                </div>
                                <div class="col-md-9">
                                    <input id="no_hp" class="form-control" name="no_hp" required autocomplete="no_hp" value="{{ $no_hp }}" autofocus>
                                </div>
                            </div>
                            
                            
                            <input hidden id="user_id" class="form-control" name="user_id" required autocomplete="user_id" value="{{ $user_id }}" autofocus>
                            <div class="row justify-content-end align-item-end mt-3">
                                <div class="col-md-6">
                                    <button type="submit" class="btn btn-info rounded-pill">
                                        Simpan
                                    </button>

                                </div>
                            </div>
                        </form>
            
                    </div>
                </div>
    
            </div>
        </div>
    </div>
</div>

<!-- SCRIPT -->


<script>
    function tambah_alamat(user_id) {
        var token = '{{ csrf_token() }}';
        var my_url = "{{url('/tambah_alamat')}}";
        var formData = {
            '_token': token,
            'user_id': user_id
        };
        $.ajax({
            method: 'POST',
            url: my_url,
            data: formData,
            success: function (resp) {
                $('#data_tambah_alamat').html(resp);
            },
            error: function (resp) {
                console.log(resp);
            }
 });
}
</script>


@endsection
