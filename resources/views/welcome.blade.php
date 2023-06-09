@extends('layouts.app')

@section('content')

@php
    try {
        $value = Auth::user()->id;
    } catch (\Throwable $th) {
        $value = null;
    }
    
@endphp
{{-- @if (Route::has('login'))
<div class="sm:fixed sm:top-0 sm:right-0 p-6 text-right">
    @auth
        <a href="{{ url('/home') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Home</a>
    @else
        <a href="{{ route('login') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Log in</a>

        @if (Route::has('register'))
            <a href="{{ route('register') }}" class="ml-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Register</a>
        @endif
    @endauth
</div>
@endif --}}

<div class="container bg-info rounded3 mt-3">
    <div class="row justify-content-center align-items-center p-5">
        <div class="col-md-8 ">
            <h1 class="mx-5 fw-bold text-light">Distributor Terpercaya</h1>
            <h1 class="mx-5 fw-bold text-light">Untuk Kebutuhan Kucing Anda.</h1>
            <p class="mx-5 text-light">Belanja sekarang dan dapatkan gratis ongkir <br>Keseluruh wilayah Indonesia</p>
            <a href="{{ url('/display_semua_produk') }}">
            <button type="button" class="btn btn-light mx-5 rounded-pill ">Belanja Sekarang!</button></a>
        </div>
        <div class="col-md-4 ">
            @foreach ($data_landing as $img )
            <img style="height: 300px;" src="{{ asset('img_landing/'.$img->gambar_landing) }}" alt="" srcset="">
            @endforeach
        </div>
    </div>  
</div>
<!------------------------ card bagian 1 KATEGORI ------------------------->
<div class="container mt-5">
    <h3 class="fw-bold">Pilih berdasarkan kategori</h3>
    <div class="row justify-content-center align-items-center mt-3 text-center ">
        @foreach ($data_master_kategori as $kategori )
        <div class="col-md-2 mx-3 mb-4 border border-info rounded3 bdcontainer kategori">
            <a class="text-decoration-none" href="{{ url('/filter_kategori/'.$kategori->id) }}">
                <img src="{{ asset('img_kategori/'.$kategori->img) }}" class="card-img-top rounded3 my-2" alt="Gambar Produk">
                <div class="row">
                    <h5 class="fw-bold text-dark">{{ $kategori->kategori }}</h5>
                </div>
            </a>
        </div>
        @endforeach
        
    </div>
</div>


<!--------------------------- card bagian 2 ANAK KUCING ------------------------->
<div class="container mt-5 border-top border-info p-2">
    <h3 class="fw-bold">Penuhi Kebutuhan sikecil</h3>
    <div class="row mt-3">
        @foreach ($data_produk_anak_kucing as $produk )
        
        <input hidden type="text" name="user_id" id="user_id" value="{{ $value }}">
            <div class="col-md-3 mb-4 ">
                <a class="text-decoration-none" href="{{ url('/detail_produk/'.$produk->id) }}">
                <div class="bdcard border border-info kategori">
                    <img src="{{ asset('img_produk_anak_kucing/'.$produk->gambar_produk) }}" class="card-img-top" alt="Gambar Produk">
                    <div class="card-body">
                        <h5 class="card-title fw-bold text-info">Rp.{{ number_format($produk->harga,2,',','.') }}</h5>
                        <p class="text-truncate fw-bold text-dark">{{ $produk->nama_produk }}</p>
                    </div>
                </a>
                    <div class="row justify-content-center align-items-center mb-3">
                        <div class="col-md-10">
                            <button onclick="tambah_keranjang('{{$produk->id}}')"
                                class="btn btn-info rounded-pill">Beli Sekarang!</button>
                        </div>                        
                    </div>
                </div>   
            </div>
        
        @endforeach
    </div>
</div>
<!--------------------------- card bagian 3 BRAND ------------------------->
<div class="container mt-5 border-top border-info p-2">
    <h3 class="fw-bold">Pilih merk kepercayaanmu!</h3>
    <div class="row mt-3">
        @foreach ($data_brand as $brand )
            <div class="col-md-4 mb-4">
                <a class="text-decoration-none" href="{{ url('/filter_brand/'.$brand->id) }}">
                    <div class="row bg-info justify-content-center align-items-center p-1 rounded rounded-pill mx-1 kategori">
                        <div class="col-md-4 imgbrand">
                            <img src="{{ asset('img_brand/'.$brand->logo_brand) }}" class="card-img-top rounded rounded-2" alt="Gambar Produk">
                            
                        </div>
                        <div class="col-md-8">
                            <h3 class="text-truncate fw-bolt text-light">{{ $brand->brand }}</h3>
                        </div>
                    </div>
                </a>
            </div>
        @endforeach
    </div>
</div> 

<!--------------------------- card bagian 5 ------------------------->
<div class="container mt-5 border-top border-info p-2">
    <h3 class="fw-bold">Untuk yang mulai dewasa</h3>
    <div class="row mt-3">
        <input hidden type="text" name="user_id" id="user_id" value="{{ $value }}">
        @foreach ($data_produk_kucing_dewasa as $produk )
            <div class="col-md-3 mb-4 ">
                <a class="text-decoration-none" href="{{ url('/detail_produk/'.$produk->id) }}">
                <div class=" bdcard border border-2 border-info kategori">
                    <img src="{{ asset('img_produk_anak_kucing/'.$produk->gambar_produk) }}" class="card-img-top" alt="Gambar Produk">
                    <div class="card-body">
                    <h5 class="card-title fw-bold text-info">Rp.{{ number_format($produk->harga,2,',','.') }}</h5>
                    <p class="text-truncate fw-bold text-dark">{{ $produk->nama_produk }}</p>
                   
                    </div>
                </a>
                    <div class="row justify-content-center align-items-center mb-3">
                        <div class="col-md-10">
                            <button onclick="tambah_keranjang('{{$produk->id}}')"
                                class="btn btn-info rounded-pill">Beli Sekarang!</button>
                        </div>
                        
                    </div>
                </div>
                
            </div>
        @endforeach
    </div>
</div>

<!--------------------------- card bagian 6 ------------------------->
<div class="container mt-5 bg-info rounded3 mb-4 p-4 ">
    <h3 class="fw-bold text-light">Butuh dokter? Bisa!</h3>
    <div class="row">
        <div class="col-md-5">
            <img src="{{ asset('img_doctor/doctor.png') }}" alt="" srcset="" class="card-img-top">
        </div>
        <div class="col-md-7 p-5">
            <h3 class="fw-bold text-light">Hubungi Dokter Kami!</h3>
            <h5 class="fw-bold text-light">Untuk konsultasi masalah kucing anda!</h5>
            <p class="fw-bold text-light">drh. Anisa Eka Kinanti</p>
            <a href="{{ url('/hubungi_dokter') }}">
                <button type="button" class="btn btn-light rounded-pill fw-bold">Hubungi Sekarang!</button>
            </a>
        </div>
    </div>
</div>


<script>
    
    function tambah_keranjang(id) {
            var user_id = $('#user_id').val();
            var token = '{{ csrf_token() }}';
            var my_url = "{{ url('/keranjang') }}";
            var formData = {
                '_token': token,
                'id': id,
                'user_id': user_id
            };
            // console.log(formData);
            
            $.ajax({
                method: 'POST',
                url: my_url,
                data: formData,
                success: function(resp){
                    Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'Berhasil ditambahkan!',
                    showConfirmButton: false,
                    timer: 1500
                    })
                // alert("Berhasil ditambahkan ke Keranjang!");
                },
                error: function(resp){
                    Swal.fire({
                    icon: 'error',
                    title: 'Anda harus login terlebih dahulu!',
                    footer: '<a href="/login">Login sekarang?</a>'
                    })
        }
});
}
</script>
@endsection