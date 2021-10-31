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
use App\Http\Controllers\Facultative\FacultativeSlipController;
use App\Http\Controllers\Facultative\HeaderFacultativeController;
use App\Http\Controllers\MarineHullController;
use App\Http\Controllers\HioController;
use App\Http\Controllers\PaController;

Route::get('get-state-lookup',[HeaderFacultativeController::class, 'getStateLookup']);
Route::get('get-currency-lookup',[HeaderFacultativeController::class, 'getCurrencyLookup']);
Route::get('get-city-lookup',[HeaderFacultativeController::class, 'getCityLookup']);
Route::get('get-address-lookup',[HeaderFacultativeController::class, 'getAddressLookup']);
Route::get('get-postal-lookup',[HeaderFacultativeController::class, 'getPostalLookup']);
Route::get('get-building-rate',[HeaderFacultativeController::class, 'getBuildingRate']);
Route::get('get-ceding-detail',[HeaderFacultativeController::class, 'getCedingDetail']);
Route::get('get-kurs-detail',[HeaderFacultativeController::class, 'getKursDetail']);

Route::get('get-route-list','TransactionController@showRouteList');
Route::get('get-ship-list','TransactionController@showShipList');
Route::get('get-hull-type','MarineHullController@showTypeList');
Route::post('get-slip-hull', [MarineHullController::class, 'showSlipHullList'])->name('sliplist.hull');;


Route::post('/store-ship-list','TransactionController@storeshiplist')->name('shiplist.store');
Route::post('update-ship-list/{id}', 'TransactionController@updateshiplist')->name('shiplist.update');
Route::delete('/delete-ship-list/{id}','TransactionController@destroyshiplist')->name('shiplist.delete');

Route::post('/store-hull-count','MarineHullController@storehullcount')->name('hullcount.store');
Route::delete('/delete-hull-count/{id}','MarineHullController@destroyhullcount')->name('hullcount.delete');


Route::post('/store-fe-sliplocation-list',[HeaderFacultativeController::class,'storelocationlist'])->name('locationlist.store');
Route::post('/refreshslipdetail',[HeaderFacultativeController::class,'refreshRiskLocation'])->name('locationlist.refresh');

Route::delete('/delete-sliplocation-list/{id}',[HeaderFacultativeController::class, 'destroysliplocationlist'])->name('sliplistlocation.delete');

Route::post('/store-fe-sliplocationdetail-list',[HeaderFacultativeController::class, 'storedetaillocation'])->name('locationlistdetail.store');
Route::delete('/delete-sliplocationdetail-list/{id}',[HeaderFacultativeController::class, 'destroysliplocationdetail'])->name('sliplistlocationdetail.delete');


Route::get('get-interest-list','TransactionController@showinterestinsuredList');
Route::post('/store-interest-list','TransactionController@storeinterestlist')->name('interestlist.store');
Route::post('update-interest-list/{id}', 'TransactionController@updateinterestlist')->name('interestlist.update');
Route::delete('/delete-interest-list/{id}','TransactionController@destroyinterestlist')->name('interestlist.delete');

Route::get('get-installment-list','TransactionController@showinstallmentList');
Route::post('/store-installment-list','TransactionController@storeinstallmentlist')->name('installment.store');
Route::post('update-installment-list/{id}', 'TransactionController@updateinstallmentlist')->name('installmentlist.update');
Route::delete('/delete-installment-list/{id}','TransactionController@destroyinstallmentlist')->name('installment.delete');

Route::get('get-extendcoverage-list','TransactionController@showextendcoverageList');
Route::post('/store-extendcoverage-list','TransactionController@storeextendcoveragelist')->name('extendcoverage.store');
Route::post('update-extendcoverage-list/{id}', 'TransactionController@updateextendcoveragelist')->name('extendcoverage.update');
Route::delete('/delete-extendcoverage-list/{id}','TransactionController@destroyextendcoveragelist')->name('extendcoverage.delete');

Route::get('get-conditionneeded-list','TransactionController@showconditionneededList');
Route::post('/store-conditionneeded-list','TransactionController@storeconditionneededlist')->name('conditionneeded.store');
Route::post('update-conditionneeded-list/{id}', 'TransactionController@updateconditionneededlist')->name('conditionneeded.update');
Route::delete('/delete-conditionneeded-list/{id}','TransactionController@destroyconditionneededlist')->name('conditionneeded.delete');

Route::get('get-deductible-list','TransactionController@showdeductibleList');
Route::post('/store-deductible-list','TransactionController@storedeductiblelist')->name('deductible.store');
Route::post('update-deductible-list/{id}', 'TransactionController@updatedeductiblelist')->name('deductible.update');
Route::delete('/delete-deductible-list/{id}','TransactionController@destroydeductiblelist')->name('deductible.delete');

Route::get('get-retrocession-list','TransactionController@showretrocessionList');
Route::post('/store-retrocession-list','TransactionController@storeretrocessionlist')->name('retrocession.store');
Route::post('update-retrocession-list/{id}', 'TransactionController@updateretrocessionlist')->name('retrocession.update');
Route::delete('/delete-retrocession-list/{id}','TransactionController@destroyretrocessionlist')->name('retrocession.delete');

Route::get('get-holedetail-list','TransactionController@showholedetailList');
Route::post('/store-holedetail-list','HioController@storeholedetaillist')->name('holedetail.store');
Route::post('update-holedetail-list/{id}', 'TransactionController@updateholedetaillist')->name('holedetail.update');
Route::delete('/delete-holedetail-list/{id}','TransactionController@destroyholedetaillist')->name('holedetail.delete');

Route::post('/store-propertytype-list','TransactionController@storepropertytypelist')->name('propertytype.store');
Route::delete('/delete-propertytype-list/{id}','TransactionController@destroypropertytypelist')->name('propertytype.delete');
Route::post('store-multi-file-ajax', [HeaderFacultativeController::class, 'storeMultiFile']);
Route::post('store-insured-file-ajax', [PaController::class, 'storeMultiFile']);
Route::get('/detailslip/{idm}', [FeSlipController::class, 'getdetailSlip']);

Route::get('/detailslipnumber/{idm}', [FeSlipController::class, 'getdetailSlipNumber']);
Route::get('/detailendorsementslip/{idm}', [FeSlipController::class, 'getdetailEndorsementSlip']);



Route::group(['prefix'=>'/transaction-data','middleware'=>['auth']], function(){

    // SECTION Marine Slip Group Routes
    Route::get('/marine-slip', [TransactionController::class, 'indexmarineslip'])->middleware(['can:create-marine_slip']);
    Route::get('/marine-index', [TransactionController::class, 'indexmarine'])->middleware(['can:create-marine_slip']);
    Route::post('/marine-index', [TransactionController::class, 'indexmarine'])->middleware(['can:create-marine_slip']);
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


    // SECTION Fire Engineering Slip Group Routes
    Route::get('/fe-slip', [FeSlipController::class, 'indexfeslip'])->middleware(['can:create-fe_slip']);
    Route::get('/fe-slipindex', [FeSlipController::class, 'index'])->middleware(['can:create-fe_slip']);
    Route::post('/fe-slipindex', [FeSlipController::class, 'index']);
    Route::post('/fe-insured/store', [FeSlipController::class, 'storefeinsured']);
    Route::post('/fe-insured', [TransactionController::class, 'storefeinsured']);
    Route::post('/fe-slip/store', [FeSlipController::class, 'storefeslip']);
    Route::post('/fe-slip/updateform', [FeSlipController::class, 'updatefeslipmodal']);
    Route::post('/fe-slip/cancelformnumber/{idm}', [FeSlipController::class, 'changeCancelNumber']);
    Route::post('/fe-slip/endorsementstore', [FeSlipController::class, 'storeendorsementfeslip']);
    Route::get('/fe-slip/updatefeslip/{fe}', [FeSlipController::class, 'updatefeslip']);
    Route::get('/updatefeslip/{fe}', [FeSlipController::class, 'updatefeslip']);
    Route::get('/detailslip/{idm}', [FeSlipController::class, 'getdetailSlip']);
    Route::get('/detailslipnumber/{idm}', [FeSlipController::class, 'getdetailSlipNumber']);
    Route::get('/detailendorsementslip/{idm}', [FeSlipController::class, 'getdetailEndorsementSlip']);
    Route::get('/endorsementfeslip/{ms}/{sl}', [FeSlipController::class, 'endorsementfeslip']);
    Route::get('/fe-slip/detailfeslip/{fe}', [FeSlipController::class, 'detailfeslip']);
    Route::get('/detailfeslip/{fe}', [FeSlipController::class, 'detailfeslip']);
    Route::delete('/fe-slip/destroy/{fe}', [FeSlipController::class, 'destroy']);
    Route::post('/fe-slip/getCostumers/','FeSlipController@getCostumers')->name('customer.getCostumers');

    
    // SECTION Financial Lines Slip Group Routes
    Route::get('/fl-slip', [FinancialLineSlipController::class, 'indexflslip'])->middleware(['can:create-fl_slip']);
    Route::get('/fl-slipindex', [FinancialLineSlipController::class, 'index'])->middleware(['can:create-fl_slip']);
    Route::post('/fl-slipindex', [FinancialLineSlipController::class, 'index']);
    Route::post('/fl-insured/store', [FinancialLineSlipController::class, 'storeflinsured']);
    Route::post('/fl-slip/store', [FinancialLineSlipController::class, 'storeflslip']);
    Route::post('/fl-slip/updateform', [FinancialLineSlipController::class, 'updateflslipmodal']);
    Route::post('/fl-slip/cancelformnumber/{idm}', [FinancialLineSlipController::class, 'changeCancelNumber']);
    Route::post('/fl-slip/endorsementstore', [FinancialLineSlipController::class, 'storeendorsementflslip']);
    Route::get('/fl-slip/updateflslip/{fe}', [FinancialLineSlipController::class, 'updateflslip']);
    Route::get('/updateflslip/{fe}', [FinancialLineSlipController::class, 'updateflslip']);
    Route::get('/endorsementflslip/{ms}/{sl}', [FinancialLineSlipController::class, 'endorsementflslip']);
    Route::get('/fl-slip/detailflslip/{fe}', [FinancialLineSlipController::class, 'detailflslip']);
    // Route::get('/detailflslip/{fe}', [FinancialLineSlipController::class, 'detailflslip']);
    Route::delete('/fl-slip/destroy/{fe}', [FinancialLineSlipController::class, 'destroy']);
    Route::get('/detailflslip/{idm}', [FinancialLineSlipController::class, 'getdetailSlip']);
    Route::get('/detailflendorsementslip/{idm}', [FinancialLineSlipController::class, 'getdetailEndorsementSlip']);
    
    // SECTION Moveable Property Slip Group Routes
    Route::get('/mp-slip', [MovePropSlipController::class, 'indexmpslip'])->middleware(['can:create-mp_slip']);
    Route::get('/mp-slipindex', [MovePropSlipController::class, 'index'])->middleware(['can:create-mp_slip']);
    Route::post('/mp-slipindex', [MovePropSlipController::class, 'index']);
    Route::post('/mp-insured/store', [MovePropSlipController::class, 'storempinsured']);
    Route::post('/mp-slip/store', [MovePropSlipController::class, 'storempslip']);
    Route::post('/mp-slip/updateform', [MovePropSlipController::class, 'updatempslipmodal']);
    Route::post('/mp-slip/cancelformnumber/{idm}', [MovePropSlipController::class, 'changeCancelNumber']);
    Route::post('/mp-slip/endorsementstore', [MovePropSlipController::class, 'storeendorsementmpslip']);
    Route::get('/mp-slip/updatempslip/{fe}', [MovePropSlipController::class, 'updatempslip']);
    Route::get('/updatempslip/{fe}', [MovePropSlipController::class, 'updatempslip']);
    Route::get('/endorsementmpslip/{ms}/{sl}', [MovePropSlipController::class, 'endorsementmpslip']);
    Route::get('/mp-slip/detailmpslip/{fe}', [MovePropSlipController::class, 'detailmpslip']);
    // Route::get('/detailmpslip/{fe}', [MovePropSlipController::class, 'detailmpslip']);
    Route::delete('/mp-slip/destroy/{fe}', [MovePropSlipController::class, 'destroy']);
    Route::get('/detailmpslip/{idm}', [MovePropSlipController::class, 'getdetailSlip']);
    Route::get('/detailmpendorsementslip/{idm}', [MovePropSlipController::class, 'getdetailEndorsementSlip']);
    

    // SECTION HE & Motor Slip Group 
    Route::get('/hem-slip', [HeMotorSlipController::class, 'indexhemslip'])->middleware(['can:create-hem_slip']);
    Route::get('/hem-slipindex', [HeMotorSlipController::class, 'index'])->middleware(['can:create-hem_slip']);
    Route::post('/hem-slipindex', [HeMotorSlipController::class, 'index']);
    Route::post('/hem-insured/store', [HeMotorSlipController::class, 'storeheminsured']);
    Route::post('/hem-slip/store', [HeMotorSlipController::class, 'storehemslip']);
    Route::post('/hem-slip/updateform', [HeMotorSlipController::class, 'updatehemslipmodal']);
    Route::post('/hem-slip/cancelformnumber/{idm}', [HeMotorSlipController::class, 'changeCancelNumber']);
    Route::post('/hem-slip/endorsementstore', [HeMotorSlipController::class, 'storeendorsementhemslip']);
    Route::get('/hem-slip/updatehemslip/{fe}', [HeMotorSlipController::class, 'updatehemslip']);
    Route::get('/updatehemslip/{fe}', [HeMotorSlipController::class, 'updatehemslip']);
    Route::get('/endorsementhemslip/{ms}/{sl}', [HeMotorSlipController::class, 'endorsementhemslip']);
    Route::get('/hem-slip/detailhemslip/{fe}', [HeMotorSlipController::class, 'detailhemslip']);
    // Route::get('/detailhemslip/{fe}', [HeMotorSlipController::class, 'detailhemslip']);
    Route::delete('/hem-slip/destroy/{fe}', [HeMotorSlipController::class, 'destroy']);
    Route::get('/detailhemslip/{idm}', [HeMotorSlipController::class, 'getdetailSlip']);
    Route::get('/detailhemendorsementslip/{idm}', [HeMotorSlipController::class, 'getdetailEndorsementSlip']);
    

    // SECTION Hole in Ones Slip Group Routes
    Route::get('/hio-slip', [HioController::class, 'indexhioslip'])->middleware(['can:create-hio_slip']);
    Route::get('/hio-index', [HioController::class, 'indexhio'])->middleware(['can:create-hio_slip']);
    Route::get('/hio-slip/{id}', [TransactionController::class, 'showlocationdetails'])->name('locDetails');
    Route::post('/hio-insured/store', [HioController::class, 'storehioinsured']);
    Route::post('/hio-slip/store', [HioController::class, 'storehioslip']);
    Route::delete('/hio-insured/destroyinsured/{id}', [TransactionController::class, 'destroyhioinsured']);
    Route::delete('/hio-slip/destroyslip/{id}', [TransactionController::class, 'destroyhioslip']);
    Route::get('/hio-endorsement/{id}', [TransactionController::class, 'indexmarineendorsement']);
    Route::get('/hio-slip/{id}', [TransactionController::class, 'showslipdetails']);
    Route::get('/updatehioslip/{idm}', [HioController::class, 'updatehioslip']);
    Route::get('/hio-insured/{id}', [TransactionController::class, 'showinsureddetails']);
    Route::get('/hio-insured/edit/{id}', [TransactionController::class, 'editmarineinsured']);
    Route::post('hio-insured/update/{id}', [TransactionController::class, 'updatemarineinsured']);
    Route::post('/hio-slip/updateform', [HioController::class, 'updatehioslipmodal']);
    Route::post('/hio-slip/endorsementstore', [HioController::class, 'storeendorsementhioslip']);
    Route::get('/detailhioslip/{idm}', [HioController::class, 'getdetailhioSlip']);
    Route::get('/detailendorsementhioslip/{idm}', [HioController::class, 'getdetailEndorsementhioSlip']);
    // Route::get('/detailslipnumber/{idm}', [HioController::class, 'getdetailSlipNumber']);


    // SECTION Personal Accident Slip Group Routes
    Route::get('/pa-slip', [PaController::class, 'indexpaslip'])->middleware(['can:create-pa_slip']);
    Route::get('/pa-index', [PaController::class, 'indexpa'])->middleware(['can:create-pa_slip']);
    Route::get('/updatepaslip/{idm}', [PaController::class, 'updatepaslip']);
    Route::post('/pa-insured/store', [PaController::class, 'storepainsured']);
    Route::post('/pa-slip/store', [PaController::class, 'storepaslip']);
    Route::post('/pa-slip/updateform', [PaController::class, 'updatepaslipmodal']);
    Route::post('/pa-slip/endorsementstore', [PaController::class, 'storeendorsementpaslip']);
    Route::get('/detailpaslip/{idm}', [PaController::class, 'getdetailpaSlip']);
    Route::get('/detailendorsementpaslip/{idm}', [PaController::class, 'getdetailEndorsementpaSlip']);
    Route::get('/changestatus/{idm}', [FacultativeSlipController::class, 'changestatus']);
    Route::get('/changetfdate/{idm}', [FacultativeSlipController::class, 'changetfdate']);
    // Refresh
    Route::get('/get-ceding/', [FacultativeSlipController::class, 'getCedingBroker']);
    Route::get('/get-insurable-list/', [FacultativeSlipController::class, 'getInsurableList']);
    Route::get('/get-ship/', [MarineHullController::class, 'getShip']);
    Route::get('/get-ceding-slip/{code_ms}', [FacultativeSlipController::class, 'getCedingSlip']);
    // Route::get('/detailslipnumber/{idm}', [PaController::class, 'getdetailSlipNumber']);

    // Route::get('/country', [MasterController::class, 'indexcountry'])->middleware(['can:view-country']);
    // Route::post('/country/store', [MasterController::class, 'storecountry'])->middleware(['can:create-country']);
    // Route::put('country/{country}', [MasterController::class, 'updatecountry'])->middleware(['can:update-country']);
    // Route::delete('/country/destroy/{country}', [MasterController::class, 'destroycountry'])->middleware(['can:delete-country']);
    
    // Bulk Excel Import Users
    // Route::get('/import', [ ProductController::class, 'import'])->middleware(['can:create-product']);
    // Route::post('/import', [ ProductController::class, 'importStore'])->middleware(['can:create-product']);
    

    Route::group(['prefix' => '/{type}'], function () {
        Route::get('/detailform/{id}', [HeaderFacultativeController::class, 'showdetailform']);

        Route::get('/index', [HeaderFacultativeController::class, 'index']);
        Route::post('/index', [HeaderFacultativeController::class, 'index']);
        Route::get('/entry', [HeaderFacultativeController::class, 'create']);

        
        Route::get('/detail-slip/{id}', [FacultativeSlipController::class, 'show']);
        Route::get('/detail-endorsement/{id}', [FacultativeSlipController::class, 'endorsement']);
        Route::post('/auto-update-installment', [FacultativeSlipController::class, 'autoupdateinstallment']);
        Route::post('/auto-update-retro', [FacultativeSlipController::class, 'autoupdateretro']);
        

        Route::post('/storeheader', [HeaderFacultativeController::class, 'store']);
        Route::post('/storeslip', [FacultativeSlipController::class, 'store']);

        Route::post('/updateheader', [HeaderFacultativeController::class, 'update']);
        Route::post('/updateslip', [FacultativeSlipController::class, 'update']);

        Route::post('/endorsementslip', [FacultativeSlipController::class, 'storeendorsement']);
        Route::post('/cancelslip', [FacultativeSlipController::class, 'cancelstatus']);
        Route::post('/refreshslip', [HeaderFacultativeController::class, 'refresh_table_slip']);
    });


});
