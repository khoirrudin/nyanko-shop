@extends('layouts.app')

@section('content')
@php
    try {
        $value = Auth::user()->id;
    } catch (\Throwable $th) {
        $value = null;
    }
    
@endphp
<div class="container mt-5 p-2">
    <h3 class="fw-bold">Pilihan produk dari brand {{ $nama_brand->brand }}</h3>
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
                    alert("Silahkan Login Terlebih Dahulu!")
        }
});
}
</script>
@endsection