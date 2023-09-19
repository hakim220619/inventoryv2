<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AplikasiController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BahanBakuController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\PesananController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UsersController;

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

Route::get('/', function () {
    return view('backend.auth.login');
});
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('login', [AuthController::class, 'login_action'])->name('login.action');
Route::get('/forgetPassword', [AuthController::class, 'forgetPassword'])->name('forgetPassword');
Route::post('/forgetPassword/action', [AuthController::class, 'forgetPasswordAction'])->name('forgetPasswordAction');
Route::get('/resetPassword/{token}', [AuthController::class, 'resetPassword'])->name('resetPassword');
Route::post('/resetPassword/action', [AuthController::class, 'resetPasswordAction'])->name('resetPasswordAction');
Route::middleware(['auth'])->group(function () {
    Route::get('dashboard', [DashboardController::class, 'view'])->name('dashboard');
    Route::get('dashboardLoad', [DashboardController::class, 'load_data'])->name('dashboard.load_data');
    Route::get('load_delivered', [DashboardController::class, 'load_delivered'])->name('dashboard.load_delivered');
    Route::get('sendDelivered', [DashboardController::class, 'sendDelivered'])->name('dashboard.sendDelivered');
    Route::get('logout', [AuthController::class, 'logout'])->name('logout');

    //Aplikasi
    Route::get('aplikasi', [AplikasiController::class, 'view'])->name('aplikasi');
    Route::post('/aplikasi/editProses', [AplikasiController::class, 'editProses'])->name('aplikasi.editProses');


    //Admin
    Route::get('admin', [AdminController::class, 'view'])->name('admin');
    Route::get('addAdmin', [AdminController::class, 'addAdmin'])->name('admin.addAdmin');
    Route::post('admin/addProses', [AdminController::class, 'addProses'])->name('admin.addProses');
    Route::post('admin/editProses', [AdminController::class, 'editProses'])->name('admin.editProses');
    Route::post('admin/changePassword', [AdminController::class, 'changePassword'])->name('admin.changePassword');
    Route::get('admin/delete/{id}', [AdminController::class, 'delete'])->name('admin.delete');

    //Users
    Route::get('users', [UsersController::class, 'view'])->name('users');
    Route::get('addUsers', [UsersController::class, 'addUsers'])->name('users.addUsers');
    Route::post('users/addProses', [UsersController::class, 'addProses'])->name('users.addProses');
    Route::post('users/editProses', [UsersController::class, 'editProses'])->name('users.editProses');
    Route::post('users/changePassword', [UsersController::class, 'changePassword'])->name('users.changePassword');
    Route::get('users/delete/{id}', [UsersController::class, 'delete'])->name('users.delete');

    //Users
    Route::get('/BahanBaku', [BahanBakuController::class, 'view'])->name('BahanBaku');
    Route::get('addBahanBaku/{en}', [BahanBakuController::class, 'addBahanBaku'])->name('BahanBaku.addBahanBaku');
    Route::post('BahanBaku/addProses', [BahanBakuController::class, 'addProses'])->name('BahanBaku.addProses');
    Route::post('BahanBaku/editProses/{en}', [BahanBakuController::class, 'editProses'])->name('BahanBaku.editProses');
    Route::get('BahanBaku/delete/{id}', [BahanBakuController::class, 'delete'])->name('BahanBaku.delete');
    Route::get('BahanBaku/deleteProduct/{id}', [BahanBakuController::class, 'deleteProduct'])->name('BahanBaku.deleteProduct');


    //Product
    Route::get('/product', [ProductController::class, 'view'])->name('product');
    Route::get('/product/add', [ProductController::class, 'add'])->name('product.add');
    Route::get('/load_data', [ProductController::class, 'load_data'])->name('product.load_data');
    Route::get('/listProduct', [ProductController::class, 'listProduct'])->name('product.listProduct');
    Route::get('/add_orders', [ProductController::class, 'add_orders'])->name('product.add_orders');
    Route::get('/sendDataProduct', [ProductController::class, 'sendDataProduct'])->name('product.sendDataProduct');
    Route::post('product/editProses', [ProductController::class, 'editProses'])->name('product.editProses');
    Route::get('product/delete/{id}', [ProductController::class, 'delete'])->name('product.delete');
    //Pesanan
    
    Route::get('/pesanan', [PesananController::class, 'view'])->name('pesanan');
    Route::get('/load_data-pesanan', [PesananController::class, 'load_data'])->name('pesanan.load_data');
    Route::get('/cart', [PesananController::class, 'cart'])->name('pesanan.cart');
    Route::get('/add_orders-pesanan', [PesananController::class, 'add_orders'])->name('pesanan.add_orders');
    Route::get('/transaksi', [PesananController::class, 'transaksi'])->name('pesanan.transaksi');
    Route::get('/rejected', [PesananController::class, 'rejected'])->name('pesanan.rejected');
    Route::get('/riwayat-pesanan', [PesananController::class, 'riwayatPesanan'])->name('pesanan.riwayatPesanan');
    Route::get('/addProductAll', [PesananController::class, 'addProductAll'])->name('pesanan.addProductAll');
    Route::get('/batalProductAll', [PesananController::class, 'batalProductAll'])->name('pesanan.batalProductAll');

    //Laporan
    Route::get('/laporan', [LaporanController::class, 'view'])->name('laporan');
    Route::get('/load_data-laporan', [LaporanController::class, 'load_data'])->name('laporan.load_data');
    Route::get('/process', [LaporanController::class, 'process'])->name('laporan.process');
    //Profile
    Route::get('profile', [ProfileController::class, 'view'])->name('profile');
});
