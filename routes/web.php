<?php

use App\User;
use App\Role;

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

// Route::get('/clear-cache', function() {
//     $exitCode = Artisan::call('cache:clear');
//     $exitCode = Artisan::call('config:cache');
//     return 'DONE'; //Return anything
// });

Auth::routes();

Route::group(array('middleware' => 'guest'), function() {

    Route::get('/', function () {
        return view('auth.login');
    });

});

Route::group(array('middleware' => 'auth'), function() {

    Route::get('/dashboard','HomeController@index')->name('dashboard');

});

/* 
|--------------------------------------------------------------------------
| Admin Pusat
|--------------------------------------------------------------------------
*/

Route::group(['prefix' => 'pusat', 'middleware' => ['role:admin|owner|lord|finance|accounting|manager']], function() {

    Route::group(['prefix' => '/pemasaran', 'middleware' => 'auth'], function() {
        
        // Kontrak
        Route::resource('/kontrak', 'Admin\Pemasaran\KontrakController');
        Route::resource('/pic', 'Admin\Pemasaran\PICController');
        Route::resource('/koreksi','Admin\Pemasaran\KoreksiController');
        
        // Store
        Route::post('/kontrak/store/create', 'Admin\Pemasaran\StoreController@create')->name('store.create');
        Route::post('/store/simpan','Admin\Pemasaran\StoreController@store')->name('store.simpan');
        Route::delete('/store/hapus/{id}','Admin\Pemasaran\StoreController@destroy')->name('store.destroy');
        Route::get('/kontrak/store/{id}/edit','Admin\Pemasaran\StoreController@edit')->name('store.edit');
        Route::put('/kontrak/store/{id}/update','Admin\Pemasaran\StoreController@update')->name('store.update');
        Route::post('/kontrak/store/import','Admin\Pemasaran\StoreController@import')->name('store.import');

        // Tarif
        Route::resource('/kontrak/tarif', 'Admin\Pemasaran\TarifController');
        Route::post('/kontrak/tarif/create','Admin\Pemasaran\TarifController@create')->name('tarif.create');
        Route::post('/kontrak/tarif/import','Admin\Pemasaran\TarifController@import')->name('tarif.import');

        // Download
        Route::get('/download/file/tarif','Admin\Pemasaran\KontrakController@download_tarif')->name('download.file.tarif');
        Route::get('/download/file/store','Admin\Pemasaran\KontrakController@download_store')->name('download.file.store');

    });

    Route::group(['prefix' => '/operasional', 'middleware' => 'auth'], function() {

        Route::group(['middleware' => ['role:owner|lord|manager']], function() {
            // Persetujuan Budget
            Route::resource('/persetujuanbudget','Admin\Operasional\PersetujuanBudgetController');
            Route::get('/persetujuanbudget/setujui/{id}','Admin\Operasional\PersetujuanBudgetController@setujui')->name('persetujuanbudget.setujui');
        });

    });

    Route::group(['prefix' => '/keuangan', 'middleware' => 'auth'], function() {
        
        //Keuangan Cabang
        Route::get('/keuangan-cabang','Admin\Keuangan\KeuanganCabangController@index')->name('keuangan.cabang');

        // Persetujuan Budget
        Route::resource('/suratjalan','Admin\Keuangan\SuratJalanController');
        Route::get('/suratjalan/terima/{id}','Admin\Keuangan\SuratJalanController@terima')->name('suratjalan.terima');

        Route::group(['prefix' => 'pusat', 'middleware' => ['role:owner|lord|finance|accounting|manager']], function() {
            // Invoice
            Route::resource('/invoice', 'Admin\Keuangan\InvoiceController');
            Route::get('/invoice/cetak/{id}','Admin\Keuangan\InvoiceController@cetak')->name('invoice.cetak');
            Route::post('/invoice/detail/store','Admin\Keuangan\InvoiceController@detailstore')->name('invoice.detail.store');
            Route::put('/invoice/detail/update/{id}','Admin\Keuangan\InvoiceController@detailupdate')->name('invoice.detail.update');
            Route::delete('/invoice/detail/destroy/{id}','Admin\Keuangan\InvoiceController@detaildestroy')->name('invoice.detail.destroy');
        });

        // Payment
        Route::get('/payment/belumlunas','Admin\Keuangan\PaymentController@belum_index')->name('payment.belum.index');
        Route::get('/payment/belumlunas/{id}','Admin\Keuangan\PaymentController@belum_show')->name('payment.belum.show');
        Route::post('/payment/belumlunas/store','Admin\Keuangan\PaymentController@belum_store')->name('payment.belum.store');
        Route::put('/payment/belumlunas/update/{id}','Admin\Keuangan\PaymentController@belum_update')->name('payment.belum.update');
        Route::get('/payment/belumlunas/lunas/{id}','Admin\Keuangan\PaymentController@belum_lunas')->name('payment.belum.lunas');
        Route::get('/payment/lunas/','Admin\Keuangan\PaymentController@lunas_index')->name('payment.lunas.index');
        Route::delete('/payment/delete/{id}','Admin\Keuangan\PaymentController@payment_delete')->name('payment.delete');

        // Reconcile
        Route::resource('/reconcile', 'Admin\Operasional\ReconsileController');
    });

    Route::group(['prefix' => '/data', 'middleware' => ['role:admin|owner|lord|finance|accounting|manager']], function() {

        Route::get('/laporan/suratjalan','Admin\Laporan\LaporanController@surat_jalan_index')->name('laporan.sj.index');
        Route::post('/laporan/suratjalan/cetak','Admin\Laporan\LaporanController@surat_jalan_cetak')->name('laporan.sj.cetak');
        Route::get('/laporan/suratjalanall','Admin\Laporan\LaporanController@surat_jalan_index1')->name('laporan.sj1.index');
        Route::post('/laporan/suratjalanall/cetak','Admin\Laporan\LaporanController@surat_jalan_cetak1')->name('laporan.sj1.cetak');
        Route::get('/laporan/omset','Admin\Laporan\LaporanController@omset_index')->name('laporan.omset.index');
        Route::post('/laporan/omset/cetak','Admin\Laporan\LaporanController@omset_cetak')->name('laporan.omset.cetak');
        Route::get('/laporan/ar','Admin\Laporan\LaporanController@ar_index')->name('laporan.ar.index');
        Route::post('/laporan/ar/cetak','Admin\Laporan\LaporanController@ar_cetak')->name('laporan.ar.cetak');
        Route::get('/laporan/ap','Admin\Laporan\LaporanController@ap_index')->name('laporan.ap.index');
        Route::post('/laporan/ap/cetak','Admin\Laporan\LaporanController@ap_cetak')->name('laporan.ap.cetak');
        Route::get('/laporan/gp','Admin\Laporan\LaporanController@gp_index')->name('laporan.gp.index');
        Route::post('/laporan/gp/cetak','Admin\Laporan\LaporanController@gp_cetak')->name('laporan.gp.cetak');
        Route::get('/laporan/gpa','Admin\Laporan\LaporanController@gpa_index')->name('laporan.gpa.index');
        Route::post('/laporan/gpa/cetak','Admin\Laporan\LaporanController@gpa_cetak')->name('laporan.gpa.cetak');
        
    });

    Route::group(['prefix' => '/other', 'middleware' => ['role:admin|owner|lord|finance|accounting|manager']], function() {

        // Purchasing
        Route::resource('/purchasing','Admin\Other\PurchasingController');
        Route::get('/purchasing/{id}/payment','Admin\Other\PurchasingController@payment_index')->name('purchasing.payment.index');
        Route::post('/purchasing/payment/store','Admin\Other\PurchasingController@payment_store')->name('purchasing.payment.store');
        Route::put('/purchasing/payment/update/{id}','Admin\Other\PurchasingController@payment_update')->name('purchasing.payment.update');
        Route::delete('/purchasing/payment/destroy/{id}','Admin\Other\PurchasingController@payment_destroy')->name('purchasing.payment.destroy');

        Route::group(['middleware' => ['role:owner|lord|manager']], function() {
            // Payroll
            Route::resource('/payroll-periode', 'Admin\Other\PayrollPeriodeController');
            Route::resource('/payroll-karyawan', 'Admin\Other\PayrollKaryawanController');
            Route::post('payroll-karyawan-import','Admin\Other\PayrollKaryawanController@import_excel')->name('payroll.import');
            Route::get('payroll-karyawan-print/{id}','Admin\Other\PayrollKaryawanController@print')->name('payroll.print');
            Route::get('payroll-karyawan-print-bundle/{id}','Admin\Other\PayrollKaryawanController@printall')->name('payroll_bundle.print');
            Route::get('payroll-karyawan-clean/{id}','Admin\Other\PayrollKaryawanController@clean')->name('payroll.clean');
        });

        // Leasing
        Route::resource('/leasing', 'Admin\Other\LeasingController');
        Route::get('/leasing/{id}/payment','Admin\Other\LeasingController@payment_index')->name('leasing.payment.index');
        Route::post('/leasing/payment/store','Admin\Other\LeasingController@payment_store')->name('leasing.payment.store');
        Route::put('/leasing/payment/update/{id}','Admin\Other\LeasingController@payment_update')->name('leasing.payment.update');
        Route::delete('/leasing/payment/destroy/{id}','Admin\Other\LeasingController@payment_destroy')->name('leasing.payment.destroy');
        
    });

    Route::group(['prefix' => '/master', 'middleware' => 'auth'], function() {

        Route::resource('/kendaraan','Admin\Master\MasterKendaraanController');
        Route::resource('/jeniskendaraan','Admin\Master\MasterJenisKendaraanController');
        Route::resource('/driver','Admin\Master\MasterDriverController');
        Route::resource('/region','Admin\Master\MasterRegionController');
        Route::resource('/partner', 'Admin\Master\MasterPartnerController');

        Route::group(['middleware' => ['role:owner|lord|manager']], function() {
            Route::resource('/karyawan','Admin\Master\MasterKaryawanController');
            Route::resource('/jabatan','Admin\Master\MasterJabatanController');
        });

    });

});

Route::group(['prefix' => 'akuntansi', 'middleware' => 'auth'], function () {

    Route::group(['middleware' => ['role:admin|owner|lord|accounting|manager']], function() {

        Route::resource('/kode-akun', 'Admin\Akuntansi\KodeAkunController');
        Route::resource('/posting','Admin\Akuntansi\PostingController');
        Route::get('/posting/delete/{id}','Admin\Akuntansi\PostingController@destroy')->name('posting.hapus');
        Route::resource('/transaksi','Admin\Akuntansi\TransaksiController');
        Route::get('/transaksi/delete/{id}','Admin\Akuntansi\TransaksiController@destroy')->name('transaksi.hapus');
        Route::post('/buku-besar','Admin\Akuntansi\Laporan@bukubesar')->name('buku-besar.view');
        Route::post('/laba-rugi','Admin\Akuntansi\Laporan@labarugi')->name('laba-rugi.view');
        Route::post('/neraca','Admin\Akuntansi\Laporan@neraca')->name('neraca.view');
        Route::post('/cash-flow','Admin\Akuntansi\Laporan@cashflow')->name('cash-flow.view');
    
        Route::get('/ajax','Admin\Akuntansi\KodeAkunController@ajax');
        
        Route::get('/export-jurnal','Admin\Akuntansi\Laporan@exjurnal')->name('jurnal.export');
        Route::get('/export-transaksi','Admin\Akuntansi\Laporan@extrans')->name('trans.export');
    
        Route::get('/laporan', function() {
            return view('admin.akuntansi.laporan');
        });
        
        Route::post('/export-buku-besar','Admin\Export\ExportController@bukuBesar')->name('buku.besar.export');
        Route::post('/export-laba-rugi','Admin\Export\ExportController@labarugi')->name('laba.rugi.export');

    });

});

Route::group(['prefix' => 'cabang', 'middleware' => ['role:user|lord']], function() {

    Route::group(['prefix' => '/operasional', 'middleware' => 'auth'], function() {
        
        // PO Controller
        Route::resource('/po', 'Admin\Operasional\POController');

        // Budget Controller
        Route::resource('/budget', 'Admin\Operasional\BudgetController');
        Route::get('/budget/{id}/create', 'Admin\Operasional\BudgetController@create')->name('budget.create');
        Route::put('/budget/{id}/pengajuanbudget','Admin\Operasional\BudgetController@pengajuan')->name('budget.pengajuan');

        // BudgetStore Controller
        Route::resource('/budgetstore', 'Admin\Operasional\BudgetStoreController');

        // Koreksi PO Controller
        Route::resource('/koreksipo','Admin\Operasional\KoreksiPOController');
        Route::get('/koreksipo/hapus/{id}','Admin\Operasional\KoreksiPOController@destroy')->name('koreksipo.hapus');

        // Surat Jalan
        Route::resource('/sj', 'Admin\Operasional\SuratJalanController');
        Route::get('/sj/terima/{id}', 'Admin\Operasional\SuratJalanController@terima')->name('sj.terima');
        Route::get('/sj/cetak/{id}', 'Admin\Operasional\SuratJalanController@cetak')->name('sj.cetak');

        // SJ Barang
        Route::resource('/sjbarang', 'Admin\Operasional\SJBarangController');

        // Pengeluaran
        Route::resource('/pengeluaran','Admin\Operasional\PengeluaranController');

    });

});


// Logout
Route::get('/logout', 'Auth\LoginController@logout')->name('logout');

/*
|--------------------------------------------------------------------------
| Ajax
|--------------------------------------------------------------------------
*/

// Get Data
Route::get('/provinces/get/{id}', 'Ajax\AjaxController@cities');
Route::get('/cities/get/{id}', 'Ajax\AjaxController@districts');
Route::get('/districts/get/{id}', 'Ajax\AjaxController@villages');
Route::get('/nopol/get/{id}','Ajax\AjaxController@nopol');
Route::get('/tarif/get/{id}/{store}','Ajax\AjaxController@tarif');
Route::get('/koreksi/get/{id}','Ajax\AjaxController@koreksi');