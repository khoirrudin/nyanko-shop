@extends('layouts.app')


@section('content')
<div class="container  mt-4 mb-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card border border-info p-4 rounded-lg bdcontainer">
                <h3 class="fw-bold text-info">Landing Image</h3>


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
                        <table class="table table-striped">
                            <thead>
                                <tr class="bg-info text-white" align="center">
                                    <th scope="col">Gambar Landing</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($data_tabel_landing_img as $row)
                                <tr>
                                    <td align="center">
                                        <img class="img-fluid rounded shadow-sm"
                                            src="{{ asset('img_landing/'.$row->gambar_landing) }}"
                                            style="width: 250px; height:250px" alt="Gambar Landing">
                                    </td>
                                    <td align="center">

                                        <button class="btn btn-info rounded-pill" onclick="edit_landing($row->id)" data-toggle="modal" data-target="#m1">Edit</button>
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

<div class="modal fade" id="m1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title w-100" id="myModalLabel">Edit landing img</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="data_edit_landing">

                <div class="row justify-content-center text-center">
                    <div class="col-md-12">
                        <form method="POST" action="{{ url('/simpan_edit_landing') }}" enctype="multipart/form-data">
                            @csrf
                            @foreach($data_tabel_landing_img as $row)
        {{-- GAMBAR --}}
                            <div class="row mb-3">
                                <label for="gambar_landing" class="col-md-4 col-form-label text-md-end">Gambar Landing:</label>
                                <div class="col-md-6">
                                    <img class="img-fluid rounded shadow-sm mb-2"
                                        src="{{ asset('img_landing/'.$row->gambar_landing) }}"
                                        style="width: 190px; height:210px" alt="Gambar Landing">
                                    <input id="gambar_landing" type="file" class="form-control border-info mt-1" name="gambar_landing">


                                    <input hidden id="id" class="form-control" name="id" required autocomplete="id" value="{{ $row->id }}" autofocus>

                                    <input id="gambar_landing_lama" type="text" class="form-control" name="gambar_landing_lama" value="{{ $row->gambar_landing }}" hidden>
                                </div>
                            </div>
        {{-- TOMBOL SUBMIT --}}
                            <div class="row mb-3 align-item-center justify-content-center">
                                <div class="col-md-2"></div>
                                <div class="col-md-9">
                                    <button type="submit" class="btn btn-info rounded-pill">Simpan</button>
                                </div>
                            </div>
                            @endforeach
                        </form>
            
                    </div>
                </div>
    
            </div>
        </div>
    </div>
</div>



<script>
     function edit_landing(id) {
        var token = '{{ csrf_token() }}';
        var my_url = "{{url('/simpan_edit_landing')}}";
        var formData = {
            '_token': token,
            'id': id
        };
        $.ajax({
            method: 'POST',
            url: my_url,
            data: formData,
            success: function (resp) {
                $('#data_edit_landing').html(resp);
            },
            error: function (resp) {
                console.log(resp);
            }
 });
}

</script>
@endsection
