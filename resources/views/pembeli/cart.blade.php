@extends('layouts.nav')


@section('content_home')
@php
    $no=1;
    $hidden = '';
    $hidden2 = '';
    if ($data_status == null) {
        $hidden = 'hidden';
    } else {
        $hidden2 = 'hidden';
    };
    
    $hdn = '';
    $hdn2 = '';
    if ($count > 5 ) {
        $hdn = 'hidden';
    } else {
        $hdn2 = 'hidden';
    }
    
        
@endphp

<h4 class="text-info">Keranjang belanja anda</h4>
<p class="text-info">Berikut daftar belanja anda</p>

<table class="table table-striped ">
    
    <thead {{ $hidden }}>
        <tr class="bg-info text-white" align="center">
            <th scope="col">No</th>
            <th scope="col">Gambar</th>
            <th scope="col">Nama Produk</th>
            <th scope="col">Qty</th>
            <th scope="col">Harga</th>
            <th scope="col">Aksi</th>
        </tr>
    </thead>
    <tbody class="text-center">  
        @foreach($data_keranjang as $row)
            @php
            $produk_id = $row->produk_id;
            $data = DB::table('keranjang')
                ->leftJoin('produk_kucing', 'keranjang.produk_id', 'produk_kucing.id')
                ->select('produk_kucing.gambar_produk', 'keranjang.status_produk')
                ->where('produk_kucing.id', $produk_id)
                ->first(); 

            

            @endphp
        <tr>
            <td>{{ $no++ }}</td>
            
            <td align="center">
                <img class="img-fluid rounded shadow-sm"
                    src="{{ asset('img_produk_anak_kucing/'.$data->gambar_produk) }}"
                    style="width: 90px; height:90px" alt="Gambar Produk">
            </td>
            <td class="">{{ $row->nama_produk }}</td>
            
            <td id="result" class="fw-bold">{{ $row->qty }}</td>
            <td id="result" class="fw-bold">Rp.{{ number_format($row->harga_produk,2,',','.') }}</td>
            
            <td align="center">
                <button class="btn btn-sm btn-info rounded-pill" onclick="edit_qty({{ $row->id }})" data-toggle="modal" data-target="#m1{{ $row->id }}">Tambah Qty</button>

                {{-- <a href="{{ url('/edit_produk_keranjang/'.$row->id) }}" class="btn btn-sm btn-info rounded-pill" >Edit</a> --}}

                <button data-bs-toggle="tooltip"
            data-bs-title="hapus_produk" onclick="hapus_keranjang('{{$row->id}}')"
            class="btn btn-danger btn-sm rounded-pill ">Hapus</button>

            </td>
        </tr>
        @endforeach
        <tr {{ $hdn2 }}>
            <td class="bg-danger text-light" colspan="6"> Anda hanya bisa melakukan Check Out 5 produk dalam sekali transaksi!!</td>
        </tr>
        <tr {{ $hdn }}>
            
                <td colspan="5" {{ $hidden }}></td>

                <td {{ $hidden2 }} class="bg-info text-light"  colspan="4">Anda tidak mempunyai barang dikeranjang! Ayo pilih barang kesukaan anda didaftar produk kami!</td>
                <td {{ $hidden }}><a href="{{ url('/checkout') }}"><button  class="btn btn-info rounded-pill">Checkout!</button></a></td>  
        </tr>
    </tbody>
</table>


<!--Modal -->
@foreach($data_keranjang as $row)
<div class="modal fade" id="m1{{ $row->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title w-100" id="myModalLabel">Edit produk untuk {{ $row->nama_produk }}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="data_edit_produk{{ $row->id }}">

                <div class="row justify-content-center text-center align-item-center">
                    <div class="col-md-4">
                        <form class="justify-content-center align-items-center" method="POST" action="{{ url('/simpan_edit_keranjang') }}" enctype="multipart/form-data">
                            @csrf
                            
                            <input style="width: 130px" id="qty" type="number" class="form-control border-info text-center mb-2" name="qty" value={{ $row->qty }}
                            required autocomplete="qty" autofocus>
                            
                            <input hidden id="id" class="form-control" name="id" required autocomplete="id" value="{{ $row->id }}" autofocus>
                            
                            <button type="submit" class="btn btn-info rounded-pill">Simpan</button>
                        </form>
                    </div>
                </div>
    
            </div>
        </div>
    </div>
</div>
@endforeach

<script>
function hapus_keranjang(id) {
    // var id = id;
    var token = '{{ csrf_token() }}';
    var my_url = "{{ url('/hapus_keranjang') }}";
    
    var formData = {
            '_token': token,
            'id': id
        };
        // console.log(formData);

    Swal.fire({
        title: 'Apa anda yakin ingin menghapus produk ini dari keranjang?',
        // text: "You won't be able to revert this!",
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yakin'
    }).then((result) => {
        if (result.isConfirmed) {
            Swal.fire({
                position: 'center',
                icon: 'success',
                title: 'Berhasil! Ayo isi keranjang lagi!',
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
    function edit_qty(id) {
       var token = '{{ csrf_token() }}';
       var my_url = "{{url('/cart')}}";
       var formData = {
           '_token': token,
           'id': id
       };
       $.ajax({
           method: 'POST',
           url: my_url,
           data: formData,
           success: function (resp) {
               $('#data_edit_qty').html(resp);
           },
           error: function (resp) {
               console.log(resp);
           }
});
}

</script>

@endsection
