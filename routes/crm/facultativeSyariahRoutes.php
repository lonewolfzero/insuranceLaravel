<?php
use App\Http\Controllers\KocController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FeLookupLocationController;
use App\Http\Controllers\GolfFieldHoleController;
use App\Http\Controllers\CedingBrokerController;
use App\Http\Controllers\FeSlipController;
use App\Http\Controllers\FinancialLineSlipController;
use App\Http\Controllers\HeMotorSlipController;
use App\Http\Controllers\MovePropSlipController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\Claim_controller;
use App\Http\Controllers\FacultativeSyariah\FacultativeSyariahSlipController;
use App\Http\Controllers\FacultativeSyariah\HeaderFacultativeSyariahController;
use App\Http\Controllers\Facultative\FacultativeSlipController;
use App\Http\Controllers\Facultative\HeaderFacultativeController;
use App\Http\Controllers\MarineHullController;
use App\Http\Controllers\HioController;
use App\Http\Controllers\PaController;

Route::group(['prefix'=>'/syariah'], function(){

Route::get('get-state-lookup',[HeaderFacultativeSyariahController::class, 'getStateLookup']);
Route::get('get-currency-lookup',[HeaderFacultativeSyariahController::class, 'getCurrencyLookup']);
Route::get('get-city-lookup',[HeaderFacultativeSyariahController::class, 'getCityLookup']);
Route::get('get-address-lookup',[HeaderFacultativeSyariahController::class, 'getAddressLookup']);
Route::get('get-postal-lookup',[HeaderFacultativeSyariahController::class, 'getPostalLookup']);
Route::get('get-building-rate',[HeaderFacultativeSyariahController::class, 'getBuildingRate']);
Route::get('get-ceding-detail',[HeaderFacultativeSyariahController::class, 'getCedingDetail']);
Route::get('get-kurs-detail',[HeaderFacultativeSyariahController::class, 'getKursDetail']);

Route::get('get-route-list','TransactionController@showRouteList');
Route::get('get-ship-list','TransactionController@showShipList');
Route::get('get-hull-type','MarineHullController@showTypeList');
Route::post('get-slip-hull', [MarineHullController::class, 'showSlipHullList'])->name('syariah.sliplist.hull');;

Route::post('/store-ship-list','TransactionController@storeshiplist')->name('syariah.shiplist.store');
Route::post('update-ship-list/{id}', 'TransactionController@updateshiplist')->name('syariah.shiplist.update');
Route::delete('/delete-ship-list/{id}','TransactionController@destroyshiplist')->name('syariah.shiplist.delete');

Route::post('/store-hull-count','MarineHullController@storehullcount')->name('syariah.hullcount.store');
Route::delete('/delete-hull-count/{id}','MarineHullController@destroyhullcount')->name('syariah.hullcount.delete');


Route::post('/store-fe-sliplocation-list',[HeaderFacultativeSyariahController::class,'storelocationlist'])->name('syariah.locationlist.store');

Route::delete('/delete-sliplocation-list/{id}',[HeaderFacultativeSyariahController::class, 'destroysliplocationlist'])->name('syariah.sliplistlocation.delete');

Route::post('/store-fe-sliplocationdetail-list',[HeaderFacultativeSyariahController::class, 'storedetaillocation'])->name('syariah.locationlistdetail.store');
Route::delete('/delete-sliplocationdetail-list/{id}',[HeaderFacultativeSyariahController::class, 'destroysliplocationdetail'])->name('syariah.sliplistlocationdetail.delete');


Route::get('get-interest-list','TransactionController@showinterestinsuredList');
Route::post('/store-interest-list','TransactionController@storeinterestlist')->name('syariah.interestlist.store');
Route::post('update-interest-list/{id}', 'TransactionController@updateinterestlist')->name('syariah.interestlist.update');
Route::delete('/delete-interest-list/{id}','TransactionController@destroyinterestlist')->name('syariah.interestlist.delete');

Route::get('get-installment-list','FacultativeSyariahSlipController@showinstallmentList');
Route::post('/store-installment-list','FacultativeSyariahSlipController@storeinstallmentlist')->name('syariah.installment.store');
Route::post('update-installment-list/{id}', 'TransactionController@updateinstallmentlist')->name('syariah.installmentlist.update');
Route::delete('/delete-installment-list/{id}','FacultativeSyariahSlipController@destroyinstallmentlist')->name('syariah.installment.delete');

Route::get('get-extendcoverage-list','FacultativeSyariahSlipController@showextendcoverageList');
Route::post('/store-extendcoverage-list','FacultativeSyariahSlipController@storeextendcoveragelist')->name('syariah.extendcoverage.store');
Route::post('update-extendcoverage-list/{id}', 'TransactionController@updateextendcoveragelist')->name('syariah.extendcoverage.update');
Route::delete('/delete-extendcoverage-list/{id}','FacultativeSyariahSlipController@destroyextendcoveragelist')->name('syariah.extendcoverage.delete');

Route::get('get-conditionneeded-list','TransactionController@showconditionneededList');
Route::post('/store-conditionneeded-list','TransactionController@storeconditionneededlist')->name('syariah.conditionneeded.store');
Route::post('update-conditionneeded-list/{id}', 'TransactionController@updateconditionneededlist')->name('syariah.conditionneeded.update');
Route::delete('/delete-conditionneeded-list/{id}','TransactionController@destroyconditionneededlist')->name('syariah.conditionneeded.delete');

Route::get('get-deductible-list','FacultativeSyariahSlipController@showdeductibleList');
Route::post('/store-deductible-list','FacultativeSyariahSlipController@storedeductiblelist')->name('syariah.deductible.store');
Route::post('update-deductible-list/{id}', 'TransactionController@updatedeductiblelist')->name('syariah.deductible.update');
Route::delete('/delete-deductible-list/{id}','FacultativeSyariahSlipController@destroydeductiblelist')->name('syariah.deductible.delete');

Route::get('get-retrocession-list','FacultativeSyariahSlipController@showretrocessionList');
Route::post('/store-retrocession-list','FacultativeSyariahSlipController@storeretrocessionlist')->name('syariah.retrocession.store');
Route::post('update-retrocession-list/{id}', 'TransactionController@updateretrocessionlist')->name('syariah.retrocession.update');
Route::delete('/delete-retrocession-list/{id}','FacultativeSyariahSlipController@destroyretrocessionlist')->name('syariah.retrocession.delete');

Route::get('get-holedetail-list','FacultativeSyariahSlipController@showholedetailList');
Route::post('/store-holedetail-list','FacultativeSyariahSlipController@storeholedetaillist')->name('syariah.holedetail.store');
Route::post('update-holedetail-list/{id}', 'TransactionController@updateholedetaillist')->name('syariah.holedetail.update');
Route::delete('/delete-holedetail-list/{id}','FacultativeSyariahSlipController@destroyholedetaillist')->name('syariah.holedetail.delete');

Route::post('/store-propertytype-list','FacultativeSyariahSlipController@storepropertytypelist')->name('syariah.propertytype.store');
Route::delete('/delete-propertytype-list/{id}','FacultativeSyariahSlipController@destroypropertytypelist')->name('syariah.propertytype.delete');
Route::post('store-multi-file-ajax', [HeaderFacultativeSyariahController::class, 'storeMultiFile']);
Route::post('store-insured-file-ajax', [PaController::class, 'storeMultiFile']);
Route::get('/detailslip/{idm}', [FeSlipController::class, 'getdetailSlip']);

Route::get('/detailslipnumber/{idm}', [FeSlipController::class, 'getdetailSlipNumber']);
Route::get('/detailendorsementslip/{idm}', [FeSlipController::class, 'getdetailEndorsementSlip']);

    Route::group(['prefix'=>'/transaction-data','middleware'=>['auth']], function(){

        // SECTION Marine Slip Group Routes
        Route::get('/marine-slip', [TransactionController::class, 'indexmarineslip'])->middleware(['can:create-marine_slip']);
        Route::get('/marine-index', [TransactionController::class, 'indexmarine'])->middleware(['can:create-marine_slip']);
        Route::get('/marine-endorsement/{id}', [TransactionController::class, 'indexmarineendorsement']);
        Route::get('/updatemarineslip/{idm}', [TransactionController::class, 'updatemarineslip']);
        Route::post('/marine-insured/store', [TransactionController::class, 'storemarineinsured']);
        Route::post('/marine-slip/store', [TransactionController::class, 'storemarineslip']);
        Route::post('/marine-slip/updateform', [TransactionController::class, 'updatemarineslipmodal']);
        Route::post('/marine-slip/endorsementstore', [TransactionController::class, 'storeendorsementmarineslip']);
        Route::get('/detailmarineslip/{idm}', [TransactionController::class, 'getdetailmarineSlip']);
        Route::post('/marine-slip/cancel', [TransactionController::class, 'changeCancelMarine']);
        Route::get('/detailendorsementmarineslip/{idm}', [TransactionController::class, 'getdetailEndorsementmarineSlip']);


        // SECTION Marine Hull Slip Group Routes
        Route::get('/marine-hull-slip', [MarineHullController::class, 'index'])->middleware(['can:create-marine_slip']);
        Route::post('/marine-hull-insured/store', [MarineHullController::class, 'storeinsured']);
        Route::post('/marine-hull-slip/store', [MarineHullController::class, 'storeslip']);
        Route::get('/updatemarinehullslip/{idm}', [MarineHullController::class, 'updatemarinehullslip']);
        Route::post('/marine-hull-slip/updateform', [MarineHullController::class, 'updatemarinehullslipmodal']);
        Route::post('/marine-hull-slip/endorsementstore', [MarineHullController::class, 'storeendorsementmarinehullslip']);
        Route::get('/detailmarinehullslip/{idm}', [MarineHullController::class, 'getdetailmarinehullSlip']);
        Route::post('/marine-hull-slip/cancel', [MarineHullController::class, 'changeCancelMarine']);
        Route::get('/detailendorsementmarinehullslip/{idm}', [MarineHullController::class, 'getdetailEndorsementmarinehullSlip']); 

        Route::group(['prefix' => '/{type}'], function () {
            Route::get('/detailform/{id}', [HeaderFacultativeSyariahController::class, 'showdetailform']);

            Route::get('/index', [HeaderFacultativeSyariahController::class, 'index']);
            Route::get('/entry', [HeaderFacultativeSyariahController::class, 'create']);

            
            Route::get('/detail-slip/{id}', [FacultativeSyariahSlipController::class, 'show']);
            Route::get('/detail-endorsement/{id}', [FacultativeSyariahSlipController::class, 'endorsement']);
            

            Route::post('/storeheader', [HeaderFacultativeSyariahController::class, 'store']);
            Route::post('/storeslip', [FacultativeSyariahSlipController::class, 'store']);

            Route::post('/updateheader', [HeaderFacultativeSyariahController::class, 'update']);
            Route::post('/updateslip', [FacultativeSyariahSlipController::class, 'update']);

            Route::post('/endorsementslip', [FacultativeSyariahSlipController::class, 'storeendorsement']);
            Route::post('/cancelslip', [FacultativeSyariahSlipController::class, 'cancelstatus']);
        });


    });

});
?>