<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\DisplayProduk;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [DisplayProduk::class, 'display_produk'])->name('display_produk');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

/*
|
|
|
---------------------------------------------------------------------------
----------------- HALAMAN ADMIN -------------------------------------------
|
|
|
*/

Route::group( ['middleware' => ['auth']], function(){
    // Landing img

    Route::get('/landing_img', [App\Http\Controllers\landing_img::class, 'landing_img'])->name('landing_img');

    Route::get('/edit_landing/{id}', [App\Http\Controllers\landing_img::class, 'edit_landing'])->name('edit_landing');

    Route::post('/simpan_edit_landing', [App\Http\Controllers\landing_img::class, 'simpan_edit_landing'])->name('simpan_edit_landing');

    // Input Produk

    Route::get('/input_produk', [App\Http\Controllers\input_produk::class, 'input_produk'])->name('input_produk');

    Route::post('/simpan_input_produk', [App\Http\Controllers\input_produk::class, 'simpan_input_produk'])->name('simpan_input_produk');

    // report Produk

    Route::get('/report_produk', [App\Http\Controllers\report_produk::class, 'report_produk'])->name('report_produk');

    Route::get('/edit_produk/{id}', [App\Http\Controllers\report_produk::class, 'edit_produk'])->name('edit_produk');

    Route::post('/simpan_edit_produk', [App\Http\Controllers\report_produk::class, 'simpan_edit_produk'])->name('simpan_edit_produk');

    Route::post('/hapus_produk', [App\Http\Controllers\report_produk::class, 'hapus_produk'])->name('hapus_produk');


    // Pesanan Masuk

    Route::get('/pesanan_masuk', [App\Http\Controllers\pesanan_masuk::class, 'pesanan_masuk'])->name('pesanan_masuk');

    // upload resi

    Route::get('/upload_resi/{user_id}', [App\Http\Controllers\upload_resi::class, 'upload_resi'])->name('upload_resi');

    Route::post('/simpan_upload_resi', [App\Http\Controllers\upload_resi::class, 'simpan_upload_resi'])->name('simpan_upload_resi');

    // tolak pesanan

    Route::get('/tolak_pesanan/{user_id}', [App\Http\Controllers\tolak_pesanan::class, 'tolak_pesanan'])->name('tolak_pesanan');

    Route::post('/simpan_alasan_penolakan', [App\Http\Controllers\tolak_pesanan::class, 'simpan_alasan_penolakan'])->name('simpan_alasan_penolakan');

    // konfirmasi pembatalan

    Route::get('/konfirmasi_pembatalan', [App\Http\Controllers\konfirmasi_pembatalan::class, 'konfirmasi_pembatalan'])->name('konfirmasi_pembatalan');

    Route::post('/simpan_konfirmasi_pembatalan', [App\Http\Controllers\konfirmasi_pembatalan::class, 'simpan_konfirmasi_pembatalan'])->name('simpan_konfirmasi_pembatalan');

    // daftar refund user

    Route::get('/daftar_refund', [App\Http\Controllers\daftar_refund::class, 'daftar_refund'])->name('daftar_refund');

    Route::get('/upload_refund/{user_id}', [App\Http\Controllers\daftar_refund::class, 'upload_refund'])->name('upload_refund');


    Route::post('/simpan_upload_refund/{user_id}', [App\Http\Controllers\daftar_refund::class, 'simpan_upload_refund'])->name('simpan_upload_refund');
    // report pesanan user

    Route::get('/report_pesanan', [App\Http\Controllers\report_pesanan::class, 'report_pesanan'])->name('report_pesanan');

    // eksport alamat

    Route::get('/eksport_alamat/{id}/{order_id}', [App\Http\Controllers\eksport_alamat::class, 'eksport_alamat'])->name('eksport_alamat');

});











/*
|
|
|
--------------------------------------------------------------------------------
----------------- HALAMAN PEMBELI ----------------------------------------------
|
|
|
*/
Route::group( ['middleware' => ['auth']], function(){

    // Masuk ke keranjang

    Route::post('/keranjang', [App\Http\Controllers\keranjang::class, 'keranjang'])->name('keranjang');
    

    // cart

    Route::get('/cart', [App\Http\Controllers\cart::class, 'cart'])->name('cart');

    Route::post('/hapus_keranjang', [App\Http\Controllers\hapus_keranjang::class, 'hapus_keranjang'])->name('hapus_keranjang');

    Route::get('/edit_produk_keranjang/{id}', [App\Http\Controllers\edit_produk_keranjang::class, 'edit_produk_keranjang'])->name('edit_produk_keranjang');

    Route::post('/simpan_edit_keranjang', [App\Http\Controllers\edit_produk_keranjang::class, 'simpan_edit_keranjang'])->name('simpan_edit_keranjang');


    // chechout

    Route::get('/checkout', [App\Http\Controllers\checkout::class, 'checkout'])->name('checkout');

    // pembayaran


    Route::post('/pembayaran', [App\Http\Controllers\pembayaran::class, 'pembayaran'])->name('pembayaran');

    // page menunggu pembayaran

    Route::get('/menunggu_pembayaran', [App\Http\Controllers\menunggu_pembayaran::class, 'menunggu_pembayaran'])->name('menunggu_pembayaran');

    // upload bukti pembayaran

    Route::get('/upload_bukti_pembayaran', [App\Http\Controllers\upload_bukti_pembayaran::class, 'upload_bukti_pembayaran'])->name('upload_bukti_pembayaran');

    Route::post('/simpan_upload_bukti_pembayaran', [App\Http\Controllers\upload_bukti_pembayaran::class, 'simpan_upload_bukti_pembayaran'])->name('simpan_upload_bukti_pembayaran');

    // batal pesanan batal_pesanan

    Route::post('/batal_pesanan', [App\Http\Controllers\batal_pesanan::class, 'batal_pesanan'])->name('batal_pesanan');

    // menunggu konfirmasi 

    Route::get('/menunggu_konfirmasi', [App\Http\Controllers\menunggu_konfirmasi::class, 'menunggu_konfirmasi'])->name('menunggu_konfirmasi');

    // pesanan ditolak

    Route::get('/pesanan_ditolak', [App\Http\Controllers\pesanan_ditolak::class, 'pesanan_ditolak'])->name('pesanan_ditolak');

    // pembatalan transaksi

    Route::get('/ajukan_pembatalan', [App\Http\Controllers\ajukan_pembatalan::class, 'ajukan_pembatalan'])->name('ajukan_pembatalan');

    Route::post('/upload_pembatalan', [App\Http\Controllers\ajukan_pembatalan::class, 'upload_pembatalan'])->name('upload_pembatalan');

    // sedang dikirim

    Route::get('/sedang_dikirim', [App\Http\Controllers\sedang_dikirim::class, 'sedang_dikirim'])->name('sedang_dikirim');

    // konfirmasi pesanan diterima

    Route::post('/konfirmasi', [App\Http\Controllers\konfirmasi::class, 'konfirmasi'])->name('konfirmasi');

    // pesanan selesai

    Route::get('/pesanan_selesai', [App\Http\Controllers\pesanan_selesai::class, 'pesanan_selesai'])->name('pesanan_selesai');

    // menunggu konfirmasi pembatalan

    Route::get('/menunggu_konfirmasi_pembatalan', [App\Http\Controllers\menunggu_konfirmasi_pembatalan::class, 'menunggu_konfirmasi_pembatalan'])->name('menunggu_konfirmasi_pembatalan');

    // daftar transaksi

    Route::get('/daftar_transaksi', [App\Http\Controllers\daftar_transaksi::class, 'daftar_transaksi'])->name('daftar_transaksi');

    
    // simpan_tambah_alamat

    Route::post('/simpan_tambah_alamat', [App\Http\Controllers\simpan_tambah_alamat::class, 'simpan_tambah_alamat'])->name('simpan_tambah_alamat');

    //form_refund

    Route::get('/form_refund', [App\Http\Controllers\form_refund::class, 'form_refund'])->name('form_refund');

    //upload_form_refund

    Route::post('/upload_form_refund', [App\Http\Controllers\form_refund::class, 'upload_form_refund'])->name('upload_form_refund');


    // Midtrans

    Route::get('/midtrans_payment', [App\Http\Controllers\midtrans_payment::class, 'midtrans_payment'])->name('midtrans_payment');

    Route::post('/simpan_pembayaran', [App\Http\Controllers\midtrans_payment::class, 'simpan_pembayaran'])->name('simpan_pembayaran');

    
    Route::post('/simpan_pembayaran_pending', [App\Http\Controllers\midtrans_payment::class, 'simpan_pembayaran_pending'])->name('simpan_pembayaran_pending');


    
    Route::post('/simpan_pembayaran_error', [App\Http\Controllers\midtrans_payment::class, 'simpan_pembayaran_error'])->name('simpan_pembayaran_error');


});


/*
|
|
|
--------------------------------------------------------------------------------
----------------- HALAMAN PRODUK ----------------------------------------------
|
|
|
*/

Route::get('/display_semua_produk', [App\Http\Controllers\display_semua_produk::class, 'display_semua_produk'])->name('display_semua_produk');

Route::get('/detail_produk/{id}', [App\Http\Controllers\detail_produk::class, 'detail_produk'])->name('detail_produk');

// filter_brand

Route::get('/filter_brand/{id}', [App\Http\Controllers\filter_brand::class, 'filter_brand'])->name('filter_brand');

// filter_kategori

Route::get('/filter_kategori/{id}', [App\Http\Controllers\filter_kategori::class, 'filter_kategori'])->name('filter_kategori');

// filter_search
Route::get('/filter_search', [App\Http\Controllers\filter_search::class, 'filter_search'])->name('filter_search');

//hubungi_dokter

Route::get('/hubungi_dokter', [App\Http\Controllers\hubungi_dokter::class, 'hubungi_dokter'])->name('hubungi_dokter');

// aboutus

Route::get('/aboutus', [App\Http\Controllers\aboutus::class, 'aboutus'])->name('aboutus');

// privacy

Route::get('/privacy', [App\Http\Controllers\privacy::class, 'privacy'])->name('privacy');

// syarat

Route::get('/syarat', [App\Http\Controllers\syarat::class, 'syarat'])->name('syarat');

// cek_resi

Route::get('/cek_resi', [App\Http\Controllers\cek_resi::class, 'cek_resi'])->name('cek_resi');

// handling redicted midtrans










