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
<h4 class="text-info">Pesanan dalam pengiriman</h4>
<p class="text-info">Pesanan anda sedang dalam pengiriman! Cek update pengiriman dengan nomor resi</p>
<table class="table table-striped ">
    <thead {{ $hidden }}>
        <tr class="bg-info text-white" align="center">
            <th scope="col">No</th>
            <th scope="col">Gambar</th>
            <th scope="col">Nama Produk</th>
            <th scope="col">Kurir</th>
            <th scope="col">Nomor resi</th>
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
            <td class="">{{ $row->kurir }}</td>
            <td class="">
                
                {{ $row->resi }} 
                <input type="text" name="resi" id="resi" value="{{ $row->resi }}" hidden>
                <button class="border border-light rounded rounded-pill" onclick="copytext()"><ion-icon class="text-info" name="copy-outline"></ion-icon></button>
            </td>
        </tr>
        @endforeach
        <tr>
            <td {{ $hidden2 }} class="bg-info text-light"  colspan="4">Anda tidak mempunyai transaksi apapun</td>
            <td colspan="5" {{ $hidden }}><button data-bs-toggle="tooltip"
                data-bs-title="konfirmasi" onclick="konfirmasi('{{ Auth::user()->id }}')"
                class="btn btn-info btn-sm rounded-pill p-2 fw-bold ">Konfirmasi Produk Sudah Diterima</button>
            </td>
        </tr>
        
    </tbody>
</table>
<script>
    function copytext() {
      // Get the text field
      var copyText = document.getElementById("resi");
    
      // Select the text field
      copyText.select();
      copyText.setSelectionRange(0, 99999); // For mobile devices
    
      // Copy the text inside the text field
      navigator.clipboard.writeText(copyText.value);
      
      // Alert the copied text
    //   alert("Copied the text: " + copyText.value);
            Swal.fire({
        position: 'center',
        icon: 'success',
        title: 'Berhasil dicopy ke Clipboard',
        showConfirmButton: false,
        timer: 1500
        })
    }

    function konfirmasi(user_id) {
        // var id = id;
        var token = '{{ csrf_token() }}';
        var my_url = "{{ url('/konfirmasi') }}";
        
        var formData = {
                '_token': token,
                'user_id': user_id
            };
            // console.log(formData);
    
        Swal.fire({
            title: 'Apa anda yakin sudah menerima produk ini?',
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
                    title: 'Terimakasih sudah berbelanja bersama kami!',
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
