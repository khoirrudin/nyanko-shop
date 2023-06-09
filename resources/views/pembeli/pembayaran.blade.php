@extends('layouts.nav')


@section('content_home')
            <h3 class="text-center fw-bold text-info">Lakukan pembayaran sebesar:</h3>
            <p class="text-center fw-bold text-info">Nominal sudah termasuk semua transaksi yang menunggu pembayaran anda</p>
            <div class="row justify-content-center item-align-center">
                <div class="col-md-2"></div>
                <div class="col-md-4 bg-info rounded-pill p-1 mt-2">
                    <h2 class="text-light text-center fw-bold">Rp.{{ number_format($data_harga,2,',','.') }}</h2>
                </div>
                <div class="col-md-2 item-align-center mt-2 p-1">
                    <input type="text" name="harga" id="harga" value="{{ $data_harga }}" hidden>
                    <button class="bg-info rounded-pill p-2 border border-info" onclick="copytext()"><ion-icon class="text-light" name="copy-outline"></ion-icon></button>

                </div>
            </div>
            <div class="row justify-content-center item-align-center mt-3">
                <div class="col-md-8 ">
                    <p class="text-center">Mohon lakukan pembayaran dengan nilai nominal yang sama sampai angka terkhir untuk mempermudahkan konfirmasi</p>
                    <div class="row justify-content-center item-align-center mt-3">
                        <img class="loginimg" src="img_qris/qris.png" alt="" srcset="">

                    </div>
                </div>
            </div>
            <div class="row justify-content-center item-align-center mt-3">
                <div class="col-md-8 justify-content-center text-center">
                    <a class="btn btn-info rounded-pill p-2 fw-bold" href="{{ url('/upload_bukti_pembayaran') }}">Upload Bukti Pembayaran</a>
                </div>     
            </div>
            <div class="row justify-content-center item-align-center mt-3">
                <div class="col-md-8 justify-content-center text-center">
                    <a class="btn btn-info rounded-pill p-2 fw-bold" href="{{ url('/upload_bukti_pembayaran') }}">Pilih metode pembayaran</a>
                </div>     
            </div>
               
       
<script>
    function copytext() {
      // Get the text field
      var copyText = document.getElementById("harga");
    
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
@endsection
