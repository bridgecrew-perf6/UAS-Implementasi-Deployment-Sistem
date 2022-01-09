<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Customer;
use App\Http\Controllers\DataCustController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\ScoreboardController;
use App\Http\Controllers\movieController;
use App\Http\Controllers\API\MoviesController;
use App\Http\Controllers\API\MobileController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



// Route::get('/', function () {
    // return view('home');
// });

Route::get('/', [Customer::class, 'home']);
Route::post('/', [Customer::class, 'home']);

//customer
Route::get('/data_customer1', [Customer::class, 'indexCustomer']);
//Route::get('/data_customer', [Customer::class, 'tambahCustomer']);
// Route::post('/tambah_customer', [Customer::class, 'tambahCustomer']);
//Route::get('/tambah_customer', [DataCustController::class, 'list']);
Route::get('/insertCustomer', [DataCustController::class, 'list']);
Route::post('/insertCustomer', [Customer::class, 'insertCustomer'])->name('insertCustomer');
Route::get('/insertCustomer2', [DataCustController::class, 'list2']);
Route::post('/insertCustomer2', [Customer::class, 'insertCustomer2'])->name('insertCustomer2');
Route::get('/findKota', [DataCustController::class, 'findKota'])->name('findKota');
Route::get('/findKecamatan', [DataCustController::class, 'findKecamatan'])->name('findKecamatan');
Route::get('/findKelurahan', [DataCustController::class, 'findKelurahan'])->name('findKelurahan');
Route::get('/findKodepos', [DataCustController::class, 'findKodepos'])->name('findKodepos');

//barang
Route::get('/barang', [BarangController::class, 'indexBarang']);
Route::get('/findBarang', [BarangController::class, 'findBarang']);
Route::post('/cetak_barcode', [BarangController::class, 'cetak_barcode']);
Route::get('/cetak_barcode', [BarangController::class, 'cetak_barcode']);
Route::post('/cetak_barcode2', [BarangController::class, 'cetak_barcode2']);
Route::get('/cetak_barcode2', [BarangController::class, 'cetak_barcode2']);
Route::get('/BarcodeScanner', 'App\Http\Controllers\BarangController@Scanner');

//Gelocation
Route::get('/table_toko', [LocationController::class, 'index']);
Route::get('/insertToko', [LocationController::class, 'indexToko']);
Route::post('/insertToko', [LocationController::class, 'insertToko'])->name('insertToko');
Route::get('/titik_kunjungan', [LocationController::class, 'titik_kunjungan'])->name('titik_kunjungan');
Route::get('/toko_barcode/{id}', [LocationController::class, 'toko_barcode'])->name('toko_barcode');
Route::get('/data-qr-code/{id}', [LocationController::class, 'data-qr-code'])->name('data-qr-code');
Route::get('/findToko', [LocationController::class, 'findToko']);

//excel
Route::post('/importexcel', [Customer::class, 'importexcel']);

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('/', function () {
    return view('/login');
})->name('login');

//login-google
Route::get('login/google', [GoogleController::class, 'redirectToProvider']);
Route::get('login/google/callback', [GoogleController::class, 'handleProviderCallback']);
Route::get('logout', [GoogleController::class, 'logout']);

Route::get('home', [Customer::class, 'home']);
Route::post('home', [Customer::class, 'home']);

//scoreboard
Route::get('/scoreboard', [ScoreboardController::class, 'scoreboard']);
Route::get('/scoreboard-controller', [ScoreboardController::class, 'index']);
Route::post('/scoreboard-controller/update', [ScoreboardController::class, 'store']);
Route::get('/messages', [ScoreboardController::class, 'message']);

Route::resource('/api/mobiles',MobileController::class);
//movie
Route::resource('/uploud-movie',movieController::class);
Route::get('/api/moviesnowplaying', [MoviesController::class,'getMoviesNP']); 
Route::get('/api/moviesbrowse', [MoviesController::class,'getMoviesBrowse']); 
Route::get('/api/moviescomingsoon', [MoviesController::class,'getMoviesCS']);