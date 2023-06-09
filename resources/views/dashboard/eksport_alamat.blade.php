<!doctype html>
<html lang="en">

<head>
  <title>Title</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS v5.2.1 -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/jsbarcode@3.11.0/dist/JsBarcode.all.min.js"></script>


</head>

<body>
    <div class="container mt-3">
        <div id="dokumen" class="row justify-content-center align-item-center">
            <div class="col-md-8 border border-info rounded">
                <div class="row">
                    <div class="col-md-6">
                        <h1 class="text-center mt-3 font-weight-bold">Nyanko~</h1>
                    </div>
                    <div class="col-md-6">
                        <svg class="barcode"
                        jsbarcode-height="60"
                        jsbarcode-value="{{ $order_id }}"
                        jsbarcode-textmargin="0"
                        jsbarcode-fontoptions="bold">
                        </svg>
                    </div>
                </div>
                <div class="row border-top border-bottom border-dark">
                    <div class="col-md-12">
                        <h5>Kode pesanan: {{ $order_id }}</h5>
                    </div>
                </div>
                <div class="row mt-3 border-bottom border-info">
                    <div class="col-md-6">
                        <h5>Penerima:</h5>
                        <p class="font-weight-bold">{{ $data_alamat->name }}</p>
                        <p>{{ $data_alamat->alamat }}</p>
                        <p>{{ $data_alamat->no_hp }}</p>
                    </div>
                    <div class="col-md-6">
                        <h5>Pengirim:</h5>
                        <p class="font-weight-bold">Nyanko Shop</p>
                        <span>Jl. Mangga VI No.45, Lamper Kidul</span>
                        <br><span>Kec. Semarang Sel.,</span>
                        <br><span>Kota Semarang</span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <p class="text-center font-italic">----------------------------------------potong disini----------------------------------------</p>
                    </div>
                    
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <p>Kode pesanan: {{ $order_id }}</p>
                        <p>Kode transaksi: {{ $data_transaksi->transaction_id }}</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <p class="font-weight-bold">Daftar item</p>
                        <table class="table">
                            @foreach ($data_keranjang as $data)
                            <tr>
                                <td>{{ $data->qty }}x</td>
                                <td>{{ $data->nama_produk }}</td>
                            </tr>
                            @endforeach
                            
                        </table>
                    </div>
                </div>
            </div>  
        </div>
        <div class="row justify-content-center align-item-center mt-4" >
            <div class="col-md-2">
                <button class="btn btn-md btn-info rounded-pill" onclick="printElement('dokumen')">Cetak dokumen</button>
            </div>
        </div>
        
    </div>
    



  





  <script>
    JsBarcode(".barcode").init();
  </script>

  <script>
    function printElement(dokumen) {
        var printContents = document.getElementById(dokumen).innerHTML;
     var originalContents = document.body.innerHTML;

     document.body.innerHTML = printContents;

     window.print();

     document.body.innerHTML = originalContents;
}
  </script>
</body>

</html>