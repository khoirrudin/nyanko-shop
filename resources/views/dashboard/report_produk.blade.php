@extends('layouts.app')


@section('content')
<div class="container mt-4 mb-4">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="border border-info p-4 bdcontainer rounded3">
                <h3 class="text-info fw-bold">Report Produk</h3>
                <div class="card-body">
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
                    <div class="responsive">
                        <table class="table table-striped" id="produk">
                            <thead>
                                <tr class="bg-info text-white " align="center">
                                    <th class="text-center" scope="col">No</th>
                                    <th class="text-center" scope="col">Gambar</th>
                                    <th class="text-center" scope="col">Nama Produk</th>
                                    <th class="text-center" scope="col">Stok</th>
                                    <th class="text-center" scope="col">Harga</th>
                                    <th class="text-center" scope="col">Deskripsi</th>
                                    <th class="text-center" scope="col">Kategori</th>
                                    <th class="text-center" scope="col">Brand</th>
                                    <th class="text-center" scope="col">Status</th>
                                    <th class="text-center" scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php 
                                    $no=1;
                                @endphp
                                @foreach($data_produk_kucing as $row)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    @php
                                        $status = $row->status;
                                        $warna = '';
                                        $button = '';
                                        $text_button = '';
                                        $hidden = '';
                                        $text = '';
                                        if ($status == 1) {
                                            $status = "Aktif";
                                            $warna = "text-success";
                                            $button = "btn-danger";
                                            $text_button = "Hapus";
                                        } else {
                                            $status = "Terhapus";
                                            $warna = "text-danger";
                                            $button = "btn-success";
                                            $text_button = "Pulihkan";
                                            $hidden = "hidden";
                                            $text = "text-muted";
                                        };
                                        
                                    @endphp
                                    <td align="center">
                                        <img class="img-fluid rounded shadow-sm"
                                            src="{{ asset('img_produk_anak_kucing/'.$row->gambar_produk) }}"
                                            style="width: 90px; height:90px" alt="Gambar Produk">
                                    </td>
                                    <td class="{{ $text }}">{{ $row->nama_produk }}</td>
                                    <td class="{{ $text }}">{{ $row->stok }}</td>
                                    <td class="{{ $text }}">{{ $row->harga }}</td>
                                    <td class="{{ $text }}">{{ $row->deskripsi_produk }}</td>
                                    @php
                                        $kategori = $row->kategori_id;
                                        if ($kategori == 1) {
                                            $kategori = "Makanan Kering Baby";
                                        } elseif ($kategori == 2) {
                                            $kategori = "Makanan Kering dewasa";
                                        } elseif ($kategori == 3) {
                                            $kategori = "Makanan Basah Baby";
                                        } elseif ($kategori == 4) {
                                            $kategori = "Makanan Basah Dewasa";
                                        } else {
                                            $kategori = "Perlengkapan Kucing";
                                        };
                                    @endphp
                                    <td class="{{ $text }}">{{ $kategori }}</td>
                                    @php
                                        $brand = $row->brand;
                                        if ($brand == 1) {
                                            $brand = "Whiskas";
                                        } elseif ($brand == 2) {
                                            $brand = "Royal Canin";
                                        } elseif ($brand == 3) {
                                            $brand = "Pro Plan";
                                        } elseif ($brand == 4) {
                                            $brand = "Equilibrio";
                                        } elseif ($brand == 5) {
                                            $brand = "Black Wood";
                                        } else {
                                            $brand = "Bolt";
                                        };
                                    @endphp
                                    <td class="{{ $text }}">{{ $brand }}</td>
                                    
                                    <td class="fw-bold {{ $warna }}">{{ $status }}</td>
                                    <td align="center">

                                        <button class="btn btn-sm btn-info rounded-pill mb-2" onclick="edit_produk({{ $row->id }})" data-toggle="modal" data-target="#m1{{ $row->id }}">Edit</button>
{{-- 
                                        <a href="{{ url('/edit_produk/'.$row->id) }}" class="btn btn-sm btn-info mb-2 rounded-pill" {{ $hidden }}>Edit</a> --}}

                                        <button data-bs-toggle="tooltip"
                                    data-bs-title="hapus_produk" onclick="hapus_produk('{{$row->id}}')"
                                    class="btn btn-sm rounded-pill {{ $button }}">{{ $text_button }}</button>

                                        {{-- <a href="{{ url('/hapus_produk/'.$row->id) }}" class="btn btn-sm rounded-pill {{ $button }}">{{ $text_button }}</a> --}}
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<!--Modal -->
@foreach($data_produk_kucing as $row)
<div class="modal fade" id="m1{{ $row->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title w-100" id="myModalLabel">Edit produk untuk {{ $row->nama_produk }}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="data_edit_produk{{ $row->id }}">

                <div class="row justify-content-center text-center">
                    <div class="col-md-12">
                        <form method="POST" action="{{ url('/simpan_edit_produk') }}" enctype="multipart/form-data">
                            @csrf
                                
        {{-- NAMA PRODUK --}}
                            <div class="row mb-3">
                                <label for="nama_produk" class="col-md-4 col-form-label text-md-end">Nama Produk</label>
                                <div class="col-md-6">
                                    <input id="nama_produk" type="text" class="form-control border-info" name="nama_produk"
                                        value="{{ $row->nama_produk }}" required autocomplete="nama_produk" autofocus>
                                </div>
                            </div>
        {{-- GAMBAR --}}
                            <div class="row mb-3">
                                <label for="gambar_produk" class="col-md-4 col-form-label text-md-end">Gambar Produk</label>
                                <div class="col-md-6">
                                    <img class="img-fluid rounded shadow-sm mb-2"
                                        src="{{ asset('img_produk_anak_kucing/'.$row->gambar_produk) }}"
                                        style="width: 90px; height:110px" alt="Gambar Produk">
                                    <input id="gambar_produk" type="file" class="form-control border-info" name="gambar_produk">
                                    <input id="gambar_produk_lama" type="text" class="form-control" name="gambar_produk_lama" value="{{ $row->gambar_produk }}" hidden>
                                </div>
                            </div>
        {{-- STOK --}}
                            <div class="row mb-3">
                                <label for="stok_produk" class="col-md-4 col-form-label text-md-end">Stok</label>
                                <div class="col-md-6">
                                    <input id="stok_produk" type="number" class="form-control border-info" name="stok_produk" value={{ $row->stok }}
                                        required autocomplete="stok_produk" autofocus>
                                </div>
                            </div>
        {{-- HARGA --}}
                            <div class="row mb-3">
                                <label for="harga" class="col-md-4 col-form-label text-md-end">Harga</label>
                                <div class="col-md-6">
                                    <input id="harga" type="number" class="form-control border-info" name="harga" value={{ $row->harga }}
                                        required autocomplete="harga" autofocus>
                                </div>
                            </div>
        {{-- Deskribsi Produk --}}
                            <div class="row mb-3">
                                <label for="deskripsi_produk" class="col-md-4 col-form-label text-md-end">Deskripsi
                                    Produk</label>
                                <div class="col-md-6">
                                    <textarea id="deskripsi_produk" class="form-control border-info" name="deskripsi_produk"
                                        value="{{ $row->deskripsi_produk }}">{{ $row->deskripsi_produk }}</textarea>
                                </div>
                            </div>
    {{-- KATEGORY --}}
                            <div class="row mb-2">
                                <label for="kategori_produk" class="col-md-4 col-form-label text-md-end">Kategori Produk</label>
    
                                <div class="col-md-6">
    
                                    <select id="kategori_produk" class="form-control" name="kategori_produk">
                                        <option value="">Pilih</option>
                                        <option value="1">Makanan Kering Bayi</option>
                                        <option value="2">Makanan Kering Dewasa</option>
                                        <option value="3">Makanan Basah Bayi</option>
                                        <option value="4">Makanan Basah Dewasa</option>
                                        <option value="5">Perlengkapan Kucing</option>
                                    </select>
    
                                    <input id="kategori_lama" type="text" class="form-control" name="kategori_lama" value="{{ $row->kategori_id }}" hidden>
                                </div>
                            </div>
    {{-- BRAND --}}
                            <div class="row mb-2">
                                <label for="produk_brand" class="col-md-4 col-form-label text-md-end">Produk Brand</label>
    
                                <div class="col-md-6">
                                    <select id="produk_brand" class="form-control" name="produk_brand">
                                        <option value="">Pilih</option>
                                        <option value="1">Whiskas</option>
                                        <option value="2">Royal Canin</option>
                                        <option value="3">Pro Plan</option>
                                        <option value="4">Equilibrio</option>
                                        <option value="5">Black Wood</option>
                                        <option value="6">Bolt</option>
                                    </select>
    
                                    <input id="brand_lama" type="text" class="form-control" name="brand_lama" value="{{ $row->brand }}" hidden>
                                </div>
                            </div>
        {{-- TOMBOL SUBMIT --}}
                            <input hidden id="id" class="form-control" name="id" required autocomplete="id" value="{{ $row->id }}" autofocus>
                            <div class="row mb-3 ">
                                <div class="col-md-6 offset-md-4 align-right">
                                    <button type="submit" class=" btn rounded-pill btn-info">Simpan</button>
                                </div>
                            </div>
                        </form>
            
                    </div>
                </div>
    
            </div>
        </div>
    </div>
</div>
@endforeach




<script>
    $(document).ready( function () {
    $('#produk').DataTable();
} );

</script>
<script>
function hapus_produk(id) {
    // var id = id;
    var token = '{{ csrf_token() }}';
    var my_url = "{{ url('/hapus_produk') }}";
    
    var formData = {
            '_token': token,
            'id': id
        };
        // console.log(formData);

    Swal.fire({
        title: 'APAKAH ANDA YAKIN?',
        // text: "You won't be able to revert this!",
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'YAKIN'
    }).then((result) => {
        if (result.isConfirmed) {
            Swal.fire({
                position: 'center',
                icon: 'success',
                title: 'PRODUK BERHASIL DIHAPUS/DIPULIHKAN',
                confirmButtonColor: '#3085d6',
                showConfirmButton: true,
                // timer: 1500
            }).then((result) => {
                if (result.isConfirmed) {

                    $.ajax({
                        method: 'POST',
                        url: my_url,
                        data: formData,
                        success: function (resp) {
                            location.reload();
                        },
                        error: function (resp) {
                            console.log(resp);
                        }
                    });

                }
            })
        }
    })
}


</script>
<script>
    function edit_produk(id) {
       var token = '{{ csrf_token() }}';
       var my_url = "{{url('/report_produk')}}";
       var formData = {
           '_token': token,
           'id': id
       };
       $.ajax({
           method: 'POST',
           url: my_url,
           data: formData,
           success: function (resp) {
               $('#data_edit_produk').html(resp);
           },
           error: function (resp) {
               console.log(resp);
           }
});
}

</script>
@endsection
