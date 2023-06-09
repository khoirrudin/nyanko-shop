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
@endphp
<h4 class="text-info">Menunggu pembayaran</h4>
<p class="text-info">Pastikan jumlah pembayaran sesuai!</p>


<table class="table table-striped ">
    <thead {{ $hidden }}>
        <tr class="bg-info text-white" align="center">
            <th scope="col">No</th>
            <th scope="col">Gambar</th>
            <th scope="col">Nama Produk</th>
            <th scope="col">Qty</th>
            <th scope="col">Harga</th>
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
            <td class="">{{ $row->qty }}</td>
            <td class="fw-bold">Rp.{{ number_format($row->harga_produk,2,',','.') }}</td>
        </tr>
        @endforeach
        
        <tr>
            <td {{ $hidden }} class="fw-bold bg-info text-light" colspan="4">Jumlah yang harus anda bayarkan:</td>
            <td {{ $hidden }} class="fw-bold bg-info text-light">Rp.{{ number_format($data_harga,2,',','.') }}</td>
                
        </tr>
        
        
        
        <tr class="bg-white">
            <td class="" colspan="2" {{ $hidden }}></td>
            
                

            <td {{ $hidden2 }} class="bg-info text-light"  colspan="6">Anda tidak mempunyai transaksi yang harus dibayar</td>
            <td><a href="{{ url('/midtrans_payment') }}"><button {{ $hidden }} class="btn btn-info rounded-pill">Proses pembayaran</button></a></td>
            <td class="" colspan="2" {{ $hidden }}>
            </td>          
        </tr>
        <tr {{ $hidden }} class="bg-white">
            <td colspan="2" ></td> 
            <td><button  class="btn btn-danger rounded-pill" onclick="batal_pesanan('{{ Auth::user()->id }}')">Batalkan pesanan</button></td>
            <td class="" colspan="2" ></td> 
        </tr>
        
    </tbody>
</table>
<script>
function batal_pesanan(user_id) {
    // var id = id;
    var token = '{{ csrf_token() }}';
    var my_url = "{{ url('/batal_pesanan') }}";
    
    var formData = {
            '_token': token,
            'user_id': user_id
        };
        // console.log(formData);

    Swal.fire({
        title: 'Apa anda yakin ingin membatalkan pesanan?',
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
                title: 'Pesanan berhasil dibatalkan!',
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
 @endsection
