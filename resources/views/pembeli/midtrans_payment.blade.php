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
    <div class="col-md-8 justify-content-center text-center">
        <a id="pay-button" class="btn btn-info rounded-pill p-2 fw-bold">Pilih metode pembayaran</a>
    </div>     
</div>

<!-- Succes -->
<form id="submit" action="/simpan_pembayaran" method="POST">
@csrf
    <input type="hidden" name="json" id="json_callback">
</form>
<!-- Pending -->
<form id="submit_pending" action="/simpan_pembayaran_pending" method="POST">
@csrf
    <input type="hidden" name="json" id="json_callback_pending">
</form>
<!-- Error -->
<form id="submit_error" action="/simpan_pembayaran_error" method="POST">
@csrf
    <input type="hidden" name="json" id="json_callback_error">
</form>

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
    <script type="text/javascript">
        // For example trigger on button clicked, or any time you need
        var payButton = document.getElementById('pay-button');
        payButton.addEventListener('click', function () {
          // Trigger snap popup. @TODO: Replace TRANSACTION_TOKEN_HERE with your transaction token
          window.snap.pay('{{ $snapToken }}', {
          onSuccess: function(result){
            /* You may add your own implementation here */
            console.log(result);
            send_response(result);
          },
          onPending: function(result){
            /* You may add your own implementation here */
            console.log(result);
            send_response_pending(result);
          },
          onError: function(result){
            /* You may add your own implementation here */
            console.log(result);
            send_response_error(result);
          },
          onClose: function(){
            /* You may add your own implementation here */
            alert('Kamu belum menyelesaikan pembayaran!');
          }
        })
        });
      </script>
      <script>
        function send_response(result) {
            document.getElementById('json_callback').value = JSON.stringify(result);
            $('#submit').submit();
        }
      </script>
      <script>
        function send_response_pending(result) {
            document.getElementById('json_callback_pending').value = JSON.stringify(result);
            $('#submit_pending').submit();
        }
      </script>
      <script>
        function send_response_error(result) {
            document.getElementById('json_callback_error').value = JSON.stringify(result);
            $('#submit_error').submit();
        }
      </script>
@endsection

    
