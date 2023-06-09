
@extends('layouts.app')


@section('content')
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

<div class="container mt-4 mb-4">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="border border-info p-4 bdcontainer rounded3">
                <h3 class="text-info fw-bold">Pesanan masuk</h3>
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
                        <table class="table table-striped" id="pesanan">
                            <thead>
                                <tr class="bg-info text-white" align="center">
                                    <th scope="col">No</th>
                                    <th scope="col">Order Id</th>
                                    <th scope="col">Tanggal</th>
                                    <th scope="col">Nama user</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                
                                @foreach($data_order as $row)
                                <tr>
                                    @php
                                    $data = DB::table('keranjang')
                                            ->select(
                                                'keranjang.user_id',
                                                'keranjang.harga_produk',
                                                'keranjang.order_id',
                                                'keranjang.created_at',
                                                'keranjang.status_produk'
                                            )
                                            ->where('keranjang.order_id', $row->order_id)
                                            ->first();

                                    $name = DB::table('users')
                                            ->select(
                                                'users.name as name',
                                                'users.id as user_id'
                                            )
                                            ->where('users.id', $data->user_id)
                                            ->first();

                                    $nama_status = DB::table('master_status_produk')
                                                ->select(
                                                    'keterangan'
                                                )
                                                ->where(
                                                    'id', $data->status_produk
                                                )
                                                ->first();

                                    $warna_status = '';
                                    
                                    switch ($data->status_produk) {
                                        
                                        case '4':
                                            $warna_status = 'text-info';
                                            break;
                                            
                                        case '5':
                                            $warna_status = 'text-success';
                                            break;
 
                                        case '7':
                                            $warna_status = 'text-warning';
                                            break;

                                        case '10':
                                            $warna_status = 'text-dark';
                                            break;

                                        
                                        default:
                                            $warna_status = 'text-danger fw-bold';
                                            break;
                                    }

                                    
                                

                                    @endphp
                                    <td>{{ $no++ }}</td>
                                    <td class="">{{ $row->order_id }}</td>
                                    <td class="">{{ $row->tanggal }}</td>
                                    <td class="">{{ $name->name }}</td>
                                    <td class="{{ $warna_status }}">{{ $nama_status->keterangan }}</td>
                                    
                                    <td align="center">
                                        <button class="btn btn-sm btn-info rounded-pill mb-2" onclick="detail({{ $row->order_id }})" data-toggle="modal" data-target="#m3{{ $row->order_id }}">Detail</button>
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


<!-- ----------------------------------------- MODAL DETAIL ---------------------------------------------------------- -->

@foreach($data_order as $row)

@php
    $order_id = $row->order_id;
    $data = DB::table('keranjang')
            ->select(
                'keranjang.user_id',
                'keranjang.harga_produk',
                'keranjang.order_id',
                'keranjang.created_at'
            )
            ->where('keranjang.order_id', $row->order_id)
            ->first();
@endphp

<div class="modal fade" id="m3{{ $row->order_id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title w-100" id="myModalLabel">Detail pesanan</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="data_tolak_pesanan_masuk">

                <div class="row">
                    <div class="col-md-12">
                        <div class="responsive">
                            <div class="row justify-content-center align-item-center border-top border-info">
                                <div class="col-md-10 my-2">
                                    <table class="table">
                                        <tr>
                                            <td class="fw-bold">Kode transaksi</td>
                                            <td>:</td>
                                            <td>{{ $row->order_id }}</td>
                                            <td>
                                                
                                                <input type="text" name="harga" id="kode_transaksi" value="{{ $row->order_id }}" hidden>
                                                <button class="bg-info rounded-pill p-2 border border-info" onclick="copytext1()"><ion-icon class="text-light" name="copy-outline"></ion-icon></button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="fw-bold">Kode pembayaran</td>
                                            <td>:</td>
                                            <td>{{ $row->transaction }}</td>
                                            <td>
                                                <input type="text" name="harga" id="kode_pembayaran" value="{{ $row->transaction }}" hidden>
                                                <button class="bg-info rounded-pill p-2 border border-info" onclick="copytext2()"><ion-icon class="text-light" name="copy-outline"></ion-icon></button>
                                            </td>
                                        </tr>
                                    </table>
                                    
                                </div>   
                            </div>
                            <div class="row justify-content-center align-item-center border-top border-info">
                                <div class="col-md-10">
                                    <p class="fw-bold mt-2">Tujuan pengiriman:</p>
                                    @php
                                        $no=1;

                                        $data_user = DB::table('keranjang')
                                                    ->leftJoin(
                                                        'users',
                                                        'keranjang.user_id',
                                                        'users.id'
                                                    )
                                                    ->select(
                                                        'users.id',
                                                        'users.name',
                                                        'users.alamat',
                                                        'users.no_hp'
                                                    )
                                                    ->where('keranjang.order_id', $row->order_id)
                                                    ->first();
                                        $data_pesanan = DB::table('keranjang')
                                                    ->select(
                                                        'keranjang.nama_produk',
                                                        'keranjang.qty',
                                                        'keranjang.harga_produk'
                                                    )
                                                    ->where('keranjang.order_id', $row->order_id)
                                                    ->get();

                                        $data_harga = $data_pesanan->sum('harga_produk');

                                        

                                    @endphp
                                    <table class="table">
                                        <tr>
                                            <td>Nama</td>
                                            <td>:</td>
                                            <td>{{ $data_user->name }}</td>
                                        </tr>
                                        <tr>
                                            <td>Alamat pengiriman</td>
                                            <td>:</td>
                                            <td>{{ $data_user->alamat }}</td>
                                        </tr>
                                        <tr>
                                            <td>No telephone</td>
                                            <td>:</td>
                                            <td>{{ $data_user->no_hp }}</td>
                                        </tr>
                                    </table>
                                    <!-- HTML -->
                                        <button class="btn btn-sm btn-info rounded rounded-pill" onclick="openLinkInNewTab({{ $data_user->id }})">Cetak alamat</button>

                                </div>   
                            </div>
                            <div class="row justify-content-center align-item-center mt-3 border-top border-bottom border-info">
                                <div class="col-md-10">
                                    <p class="fw-bold mt-2">Daftar pesanan:</p>
                                    <table class="table">
                                        <thead>
                                            <tr align="center">
                                                <th scope="col">No</th>
                                                <th scope="col">Nama Produk</th>
                                                <th scope="col">Qty</th>
                                                <th scope="col">Harga</th>
                                            </tr>
                                        </thead>
                                        <tbody class="text-center">
                                            @foreach($data_pesanan as $row)
                                            <tr>
                                                
                                                <td>{{ $no++ }}</td>
                                                <td class="">{{ $row->nama_produk }}</td>
                                                <td class="">{{ $row->qty }}</td>
                                                <td class="">Rp {{ number_format($row->harga_produk,2,',','.') }}</td>
                                            </tr>
                                            @endforeach
                                            <tr>
                                                <td></td>
                                                <td></td>
                                                <td class="fw-bold">Total</td>
                                                <td class="fw-bold">Rp {{ number_format($data_harga,2,',','.') }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>   
                                
                            </div>
                           
                        </div>
                        
                    </div>
                </div>
            </div>
            <div class="row justify-content-center align-item-center my-4" >
                <div class="col-md-2">
                    <button class="btn btn-md btn-info rounded-pill" onclick="printElement('data_tolak_pesanan_masuk')">Print halaman</button>
                </div>
            </div>
        </div>
    </div>
</div>

@endforeach





<script>
    $(document).ready( function () {
    $('#pesanan').DataTable();
} );

</script>

<script>
    function detail(order_id) {
       var token = '{{ csrf_token() }}';
       var my_url = "{{url('/pesanan_masuk')}}";
       var formData = {
           '_token': token,
           'order_id': order_id
       };
       $.ajax({
           method: 'POST',
           url: my_url,
           data: formData,
           success: function (resp) {
               $('#data_tolak_pesanan_masuk').html(resp);
           },
           error: function (resp) {
               console.log(resp);
           }
});
}

</script>
<script>
    function copytext1() {
      // Get the text field
      var copyText = document.getElementById("kode_transaksi");
    
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
</script>
<script>
    function copytext2() {
      // Get the text field
      var copyText = document.getElementById("kode_pembayaran");
    
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
</script>


<script>
    // JavaScript
function openLinkInNewTab(id) {

    var order_id = document.getElementById("kode_transaksi")
    var value = order_id.value;
    var id = id;
    var myUrl =`/eksport_alamat/${id}/${value}`
    window.open(myUrl, "_blank");
    console.log(value);
}

</script>
<script>
    function printElement(data_tolak_pesanan_masuk) {
        var printContents = document.getElementById(data_tolak_pesanan_masuk).innerHTML;
     var originalContents = document.body.innerHTML;

     document.body.innerHTML = printContents;

     window.print();

     document.body.innerHTML = originalContents;
}
  </script>
@endsection
