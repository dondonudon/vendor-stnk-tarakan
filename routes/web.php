<?php

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

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

//Route::get('/', function () {
//    return view('welcome');
//});


Route::get('login','c_Login@index');
Route::post('login/submit','c_Login@submit');
Route::post('logout','c_Login@logout');

Route::get('sidebar','c_Dashboard@sidebar');

Route::get('data/dealer', 'c_Dashboard@dealer');
Route::get('data/samsat', 'c_Dashboard@samsat');
Route::get('data/wilayah-provinsi', 'c_Dashboard@wilayahProvinsi');
Route::get('data/wilayah-kota', 'c_Dashboard@wilayahKota');

Route::middleware(['check.login','menupermission'])->group(function () {
    Route::get('/', 'c_Overview@index');

    Route::get('reset-password', 'c_Profile@resetPassword');
    Route::post('reset-password/submit', 'c_Profile@resetPasswordSubmit');

    Route::get('profile', 'c_Profile@edit');
    Route::post('profile/submit', 'c_Profile@submit');

    Route::get('system-utility/menu-group','c_SystemMenuGroup@index');
    Route::get('system-utility/menu-group/list','c_SystemMenuGroup@list');
    Route::get('system-utility/menu-group/baru','c_SystemMenuGroup@add');
    Route::get('system-utility/menu-group/edit/{id}','c_SystemMenuGroup@edit');
    Route::post('system-utility/menu-group/submit','c_SystemMenuGroup@submit');

    Route::get('system-utility/menu','c_SystemMenu@index');
    Route::get('system-utility/menu/list','c_SystemMenu@list');
    Route::get('system-utility/menu/baru','c_SystemMenu@add');
    Route::get('system-utility/menu/edit/{id}','c_SystemMenu@edit');
    Route::post('system-utility/menu/submit','c_SystemMenu@submit');

    Route::get('master/user-management','c_MasterUserManagement@index');
    Route::get('master/user-management/list','c_MasterUserManagement@list');
    Route::get('master/user-management/baru','c_MasterUserManagement@add');
    Route::get('master/user-management/edit/{username}','c_MasterUserManagement@edit');
    Route::post('master/user-management/submit','c_MasterUserManagement@submit');

    Route::get('master/dealer','c_MasterDealer@index');
    Route::get('master/dealer/list','c_MasterDealer@list');
    Route::get('master/dealer/baru','c_MasterDealer@add');
    Route::get('master/dealer/edit/{id}','c_MasterDealer@edit');
    Route::post('master/dealer/submit','c_MasterDealer@submit');

    Route::get('master/samsat','c_MasterSamsat@index');
    Route::get('master/samsat/list','c_MasterSamsat@list');
    Route::get('master/samsat/baru','c_MasterSamsat@add');
    Route::get('master/samsat/edit/{id}','c_MasterSamsat@edit');
    Route::post('master/samsat/submit','c_MasterSamsat@submit');

    Route::get('master/harga','c_MasterHarga@index');
    Route::get('master/harga/list','c_MasterHarga@list');
    Route::get('master/harga/baru','c_MasterHarga@add');
    Route::get('master/harga/edit/{id}','c_MasterHarga@edit');
    Route::post('master/harga/submit','c_MasterHarga@submit');

    Route::get('master/kendaraan','c_MasterKendaraan@index');
    Route::get('master/kendaraan/list','c_MasterKendaraan@list');
    Route::get('master/kendaraan/baru','c_MasterKendaraan@add');
    Route::get('master/kendaraan/edit/{kode}','c_MasterKendaraan@edit');
    Route::post('master/kendaraan/submit','c_MasterKendaraan@submit');

    Route::get('transaction/purchase-order','c_TransactionPurchaseOrder@index');
    Route::post('transaction/purchase-order/validasi','c_TransactionPurchaseOrder@validasi');
    Route::get('transaction/purchase-order/detail/{nopo}','c_TransactionPurchaseOrder@detail');
    Route::post('transaction/purchase-order/daftar-kendaraan','c_TransactionPurchaseOrder@daftarKendaraan');
//    Route::get('transaction/purchase-order/list','c_TransactionPurchaseOrder@list');
    Route::get('transaction/purchase-order/baru','c_TransactionPurchaseOrder@add');
    Route::post('transaction/purchase-order/submit','c_TransactionPurchaseOrder@submit');

    Route::get('transaction/validasi-notice','c_TransactionValidateNotice@index');
    Route::get('transaction/validasi-notice/list','c_TransactionValidateNotice@list');
    Route::get('transaction/validasi-notice/validasi/{nopo}','c_TransactionValidateNotice@validasi');
    Route::get('transaction/validasi-notice/check-total-data','c_TransactionValidateNotice@checkTotalData');
    Route::post('transaction/validasi-notice/daftar-validasi','c_TransactionValidateNotice@daftarValidasi');
    Route::get('transaction/validasi-notice/baru','c_TransactionValidateNotice@add');
    Route::post('transaction/validasi-notice/submit','c_TransactionValidateNotice@submit');

    Route::get('transaction/update-kelengkapan-bbn','c_TransactionNoticeKelengkapan@index');
    Route::get('transaction/update-kelengkapan-bbn/list','c_TransactionNoticeKelengkapan@list');
    Route::get('transaction/update-kelengkapan-bbn/update-kelengkapan/{nopo}/{id}','c_TransactionNoticeKelengkapan@updateKelengkapan');
    Route::get('transaction/update-kelengkapan-bbn/validasi/{nopo}','c_TransactionNoticeKelengkapan@validasi');
    Route::get('transaction/update-kelengkapan-bbn/check-total-data','c_TransactionNoticeKelengkapan@checkTotalData');
    Route::post('transaction/update-kelengkapan-bbn/daftar-validasi','c_TransactionNoticeKelengkapan@daftarValidasi');
    Route::get('transaction/update-kelengkapan-bbn/baru','c_TransactionNoticeKelengkapan@add');
    Route::post('transaction/update-kelengkapan-bbn/submit','c_TransactionNoticeKelengkapan@submit');

    Route::get('transaction/stnk-dari-samsat','c_TransactionStnkSamsat@index');
    Route::get('transaction/stnk-dari-samsat/list','c_TransactionStnkSamsat@list');
    Route::get('transaction/stnk-dari-samsat/update-kelengkapan/{nopo}/{id}','c_TransactionNoticeKelengkapan@updateKelengkapan');
    Route::get('transaction/stnk-dari-samsat/validasi/{nopo}','c_TransactionStnkSamsat@validasi');
    Route::get('transaction/stnk-dari-samsat/check-total-data','c_TransactionNoticeKelengkapan@checkTotalData');
    Route::post('transaction/stnk-dari-samsat/daftar-validasi','c_TransactionStnkSamsat@daftarValidasi');
    Route::post('transaction/stnk-dari-samsat/submit','c_TransactionStnkSamsat@submit');

    Route::get('transaction/stnk-ke-dealer','c_TransactionStnkDealer@index');
    Route::get('transaction/stnk-ke-dealer/list','c_TransactionStnkDealer@list');
    Route::get('transaction/stnk-ke-dealer/validasi/{nopo}','c_TransactionStnkDealer@validasi');
    Route::post('transaction/stnk-ke-dealer/daftar-validasi','c_TransactionStnkDealer@daftarValidasi');
    Route::post('transaction/stnk-ke-dealer/submit','c_TransactionStnkDealer@submit');

    Route::get('transaction/bpkb-dari-samsat','c_TransactionBpkbSamsat@index');
    Route::get('transaction/bpkb-dari-samsat/list','c_TransactionBpkbSamsat@list');
    Route::get('transaction/bpkb-dari-samsat/validasi/{nopo}','c_TransactionBpkbSamsat@validasi');
    Route::post('transaction/bpkb-dari-samsat/daftar-validasi','c_TransactionBpkbSamsat@daftarValidasi');
    Route::post('transaction/bpkb-dari-samsat/submit','c_TransactionBpkbSamsat@submit');

    Route::get('transaction/bpkb-ke-dealer','c_TransactionBpkbDealer@index');
    Route::get('transaction/bpkb-ke-dealer/list','c_TransactionBpkbDealer@list');
    Route::get('transaction/bpkb-ke-dealer/validasi/{nopo}','c_TransactionBpkbDealer@validasi');
    Route::post('transaction/bpkb-ke-dealer/daftar-validasi','c_TransactionBpkbDealer@daftarValidasi');
    Route::post('transaction/bpkb-ke-dealer/submit','c_TransactionBpkbDealer@submit');
});
