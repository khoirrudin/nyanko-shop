@extends('layouts.app')

@section('content')
@php
    try {
        $value = Auth::user()->id;
    } catch (\Throwable $th) {
        $value = null;
    }
    
@endphp
<div class="container my-4 bdcontainer rounded3  border border-info">
    <div class="row">
        @foreach ($data_produk as $produk)
        
            <div class="col-md-5 bg-info rounded3 divimage">
                <img class="imgdetail" src="{{ url('img_produk_anak_kucing/'.$produk->gambar_produk) }}" alt="" srcset="">

            </div>
            <div class="col-md-6 p-3">
                <h1 class="fw-bold">{{ $produk->nama_produk }}</h1>
                @php
                    $data = DB::table('produk_kucing')
                                ->leftjoin('master_kategori', 'produk_kucing.kategori_id', 'master_kategori.id')
                                ->leftjoin('master_brand', 'produk_kucing.brand', 'master_brand.id')
                                ->select(
                                    'master_kategori.kategori as kategori',
                                    'master_brand.brand as brand',
                                    'master_brand.id as id'
                                )
                                ->where('produk_kucing.id', $produk->id)
                                ->first();
                @endphp
                <div class="row mt-3">
                    <div class="col-md-10">
                        <a class="text-decoration-none bg-info text-light rounded-pill px-2 mx-1" href="">{{ $data->kategori }}</a>
                        <a class="text-decoration-none bg-info text-light rounded-pill px-2 mx-1" href="{{ url('/filter_brand/'.$data->id) }}">{{ $data->brand }}</a>

                    </div>
                </div>
                        

                <div class="row ">
                    <div class="col-md-9 mt-4">
                        
                        <h3 class="fw-bold text-info">Rp.{{ number_format($produk->harga,2,',','.') }}
                        </h3>
                        <p>Stok: {{ $produk->stok }}</p>
                        
                        <h5 class="mt-2">Deskripsi:</h5>
                        <p>{{ $produk->deskripsi_produk }}</p>

                    </div>
                </div>
                <div class="row  mt-5">
                    <div class="col-md-9 mt-5">
                        <input hidden type="text" name="user_id" id="user_id" value="{{ $value }}">
                        <button onclick="tambah_keranjang('{{$produk->id}}')"
                            class="btn btn-info rounded-pill">Beli Sekarang!</button>
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