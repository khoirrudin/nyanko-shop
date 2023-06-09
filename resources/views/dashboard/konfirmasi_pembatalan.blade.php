
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
                <h3 class="text-info fw-bold">Pesanan menunggu konfirmasi pembatalan</h3>
                <div class="card-body">
                    
                    <div class="responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr class="bg-info text-white" align="center">
                                    <th scope="col">No</th>
                                    <th scope="col">Nama User</th>
                                    <th scope="col">Nama Produk</th>
                                    <th scope="col">Qty</th>
                                    <th scope="col">Harga</th>
                                    <th scope="col">Alasan</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="text-center">
                                <tr {{ $hidden2 }}>
                                    <td colspan="10">Tidak Ada Data</td>
                                </tr>
                                @foreach($data_keranjang as $row)
                                <tr>
                                    @php
                                    $name =
                                        DB::table('users')
                                        ->select(
                                            'users.name as name',
                                            'users.id as user_id'
                                        )
                                        ->where('users.id', $row->user_id)
                                        ->first();
                                        
                                        // var_dump($name);
                                    $alasan = DB::table('data_refund')
                                            ->select(
                                                'data_refund.alasan'
                                            )
                                            ->where('data_refund.user_id', $row->user_id)
                                            ->first();

                                    @endphp
                                    <td>{{ $no++ }}</td>
                                    <td class="">{{ $name->name }}</td>
                                    <td class="">{{ $row->nama_produk }}</td>
                                    <td class="">{{ $row->qty }}</td>
                                    <td class="">{{ $row->harga_produk }}</td>
                                    <td class="">{{ $alasan->alasan }}</td>
                                    
                                    <td align="center">
                                        <button data-bs-toggle="tooltip"
                                    data-bs-title="konfirmasi" onclick="konfirmasi('{{$row->id}}')"
                                    class="btn btn-sm rounded-pill btn-danger">Konfirmasi</button>

                                        

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

<script>
function konfirmasi(id) {
    // var id = id;
    var token = '{{ csrf_token() }}';
    var my_url = "{{ url('/simpan_konfirmasi_pembatalan') }}";
    
    var formData = {
            '_token': token,
            'id': id
        };
        // console.log(formData);

    Swal.fire({
        title: 'Yakin untuk mengkonfirmasi pembatalan ini?',
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
                title: 'Pembatalan berhasil dilakukan, segera lakukan refund kepada user',
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
