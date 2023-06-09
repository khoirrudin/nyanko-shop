@extends('layouts.app')

@section('content')
<div class="container border border-info bdcontainer my-3 rounded3">
    <div class="row">
        <div class="col-md-12">
            <div class="row mt-3 justify-content-center align-items-center">
                <div class="col-md-8 text-center">
                    <h3 class="text-info fw-bold">
                        Lacak resi:
                    </h3>
                </div>
            </div>
            <div class="row mt-3 justify-content-center align-items-center">
                <div class="col-md-8">
                    <div class="row">
                        <div class="col-md-3">
                            <select required class="form-select border border-info" id="courier">
                                <option selected>Kurir</option>
                                <option value="jne">JNE</option>
                                <option value="pos">POS</option>
                                <option value="jnt">JNT</option>
                                <option value="sicepat">SiCepat</option>
                                <option value="tiki">Tiki</option>
                                <option value="anteraja">AnterAja</option>
                                <option value="wahana">Wahana</option>
                                <option value="ninja">Ninja</option>
                                <option value="lion">Lion</option>
                            </select>
                        </div>
                        <div class="col-md-7">
                            <input required class="form-control me-2 border border-info" type="search" placeholder="Nomor resi" aria-label="Search" id="awb">
                        </div>
                        <div class="col-md-2"><button 
                            onclick="lacak()"
                              class="btn btn-outline-info" id="search">Lacak</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row my-3">
        <div class="col-md-12">
            <p class="text-danger text-center">Jika hasil tidak muncul, pastikan nama kurir dan nomor resi anda benar</p>
            <div class="row justify-content-center align-items-center">
                <div class="col-md-6" id="detail">
                    
                </div>
            </div>
            <div class="row justify-content-center align-items-center" >
                <div class="col-md-9">
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">Tanggal</th>
                            <th scope="col">Deskripsi</th>
                        </tr>
                        </thead>
                        <tbody id="hasil">
                        
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    
</div>

<script >

function lacak() {
    var url = 'https://api.binderbyte.com/v1/track';
    var api_key = '4309843cda4ace3e22ac7231f3fccc5116690fe3fbddfab338bff6051ccaee57';
    var courier = $('#courier').val();
    var awb = $('#awb').val();
    var data = {
            'api_key' : api_key,
            'courier' : courier,
            'awb' : awb
    };
    
    $.ajax({
        url: url,
        method: 'GET',
        dataType: 'json',
        data: data,
        success: function(result) {
            let hasil = result.data;

            let summary = hasil.summary;
            let detail = hasil.detail;
            let history = hasil.history;

            $('#detail').append(`
            <table class="table">
                <thead>
                <tr>
                    <th colspan="4" scope="col">Detail:</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>Nomor resi:</td>
                    <td>`+ summary.awb +`</td>
                    <td>Kurir:</td>
                    <td>`+ summary.courier +`</td>
                </tr>
                <tr>
                    <td>Status</td>
                    <td>`+ summary.status +`</td>
                    <td>Dari:</td>
                    <td>`+ detail.origin +`</td>
                </tr>
                <tr>
                    <td>Pengirim:</td>
                    <td>`+ detail.shipper +`</td>
                    <td>Tujuan:</td>
                    <td>`+ detail.destination +`</td>
                </tr>
                <tr>
                    <td>Penerima:</td>
                    <td>`+ detail.receiver +`</td>
                </tr>
                </tbody>
            </table>
            `);

            $.each(history, function (i, data){
                $('#hasil').append(`
                <tr>
                    <td>`+ data.date +`</td>
                    <td>`+ data.desc +`</td>
                </tr>
                `);
            });
        }

    });
};
</script>

@endsection