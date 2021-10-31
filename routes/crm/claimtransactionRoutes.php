<?php

use App\Http\Controllers\Claim\ClaimController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Claim_controller;
use App\Http\Controllers\ClaimInsuredDataController;
use App\Http\Controllers\Claim\MarineController;
use App\Http\Controllers\PDFController;

Route::post('/store-claimlocation-list', 'Claim_controller@storelocationamountlist')->name('claimlocation.store');

Route::get('testpdf', [PDFController::class, 'test']);
Route::get('reportcepdf', [PDFController::class, 'reportCEPDF']);

Route::group(['prefix' => '/claimtransaction-data', 'middleware' => ['auth']], function () {

    Route::get('/detailslipclaim/{idm}', [Claim_controller::class, 'getdetailSlipClaim']);

    // Route::get('/detailslipclaimRiskLocation/{idm}', [Claim_controller::class, 'getRiskLocationSlip']);
    // Route::get('/changeinterimclaim/{regcomp}/{counter}', [Claim_controller::class, 'changeSlipClaimInterim']);
    // Route::get('/changeplaclaim/{regcomp}/{counter}', [Claim_controller::class, 'changeSlipClaimPLA']);

    Route::get('/getCountClaim/{idm}', [Claim_controller::class, 'getCountClaim']);

    Route::get('/claiminsured/index', [ClaimInsuredDataController::class, 'index']);
    Route::get('/testing', [Claim_controller::class, 'testing']);

    Route::post('/destroy/{id}', [Claim_controller::class, 'destroy']);
    Route::delete('/destroy/{id}', [Claim_controller::class, 'destroy']);

    Route::get('/reportcepdf/{regcomp}/{doccounter}', [PDFController::class, 'reportCEPDF']);
    Route::get('/hardcopypdf/{regcomp}/{doccounter}', [PDFController::class, 'hardcopyPDF']);
    Route::post('/claiminsured/store', [ClaimInsuredDataController::class, 'store']);

    Route::group(['prefix' => '/marine'], function () {
        // Route::get('/index', [MarineController::class, 'indexMarine']);
        Route::get('/slipdetails/{number}', [MarineController::class, 'slipDetails']);
        Route::post('/claim/store', [MarineController::class, 'storeClaim']);

        Route::get('/cargo/{mainClaimEntryFAC}', [MarineController::class, 'update']);
        Route::get('/retrieve/cargo', [MarineController::class, 'retrieveDataCargo']);
        Route::post('/retrieve/cargo', [MarineController::class, 'retrieveDataCargo']);

        Route::get('/hull/{mainClaimEntryFAC}', [MarineController::class, 'update']);
        Route::get('/retrieve/hull', [MarineController::class, 'retrieveDataHull']);
        Route::post('/retrieve/hull', [MarineController::class, 'retrieveDataHull']);


        // Route::get('/{type}', [MarineController::class, 'index']);
    });

    Route::group(['prefix' => '/{type}'], function () {
        Route::get('/getlatestregcount/{regcomp}', [Claim_controller::class, 'getLatestRegCompCounter']);
        Route::get('/getlatestdoccount/{regcomp}', [Claim_controller::class, 'getLatestDocCounter']);
        Route::post('/store-claimmanual-list', 'Claim_controller@storemanualamountlist')->name('claimmanual.store');
        Route::delete('/delete-claimmanual-list/{id}', 'Claim_controller@destroyamountmanuallist')->name('claimmanual.delete');
        Route::get('/detailslipclaimAmount/{regcomp}/{counter}', [Claim_controller::class, 'getdetailAmountSlip']);
        Route::get('/getfilterdata/{regcomp}', [Claim_controller::class, 'getFilterData']);
        Route::post('/viewattch', [Claim_controller::class, 'storeViewAttachment']);
        Route::delete('/viewattch/{claimViewAttachment}', [Claim_controller::class, 'deleteViewAttachment']);
        Route::post('/multidocument', [Claim_controller::class, 'multiDocument'])->name('multidocument');
        Route::get('/lastcestatus/{status_ce}', [Claim_controller::class, 'getLastCeStatusCounter']);
        Route::get('/lastce/{abb}', [Claim_controller::class, 'getLastCeCounter']);
        Route::post('/getclaimbycounter', [Claim_controller::class, 'getClaimByCounter']);
        Route::get('/getLastRegcompStatus/{regcomp}', [Claim_controller::class, 'getLastRegcompStatus']);
        Route::post('/correctionclaim', [Claim_controller::class, 'correctionClaim']);
        Route::get('/updatetotalloss/{regcomp}/{counter}', [Claim_controller::class, 'updateTotalLoss']);

        Route::get('/entry', [Claim_controller::class, 'index']);

        Route::post('/changeDocumentStatus', [Claim_controller::class, 'changeDocumentStatus']);
        Route::get('/getInsuredandRiskLocation/{number}', [Claim_controller::class, 'getInsuredandRiskLocation']);

        Route::get('/index', [Claim_controller::class, 'indexclaim'])->name('claimindex');
        Route::post('/index', [Claim_controller::class, 'indexclaim'])->name('claimindex');

        Route::get('/update/{id}', [Claim_controller::class, 'updateindex']);

        Route::post('/store', [Claim_controller::class, 'storeclaiminsured']);

        Route::post('/retrievedata', [Claim_controller::class, 'retrieveData']);
        Route::get('/retrievedata', [Claim_controller::class, 'retrieveData']);

        Route::post('/storece/{mainClaimEntryFAC}', [Claim_controller::class, 'storeCe']);

        Route::post('/storenoce/{mainClaimEntryFAC}', [Claim_controller::class, 'storeNoCe']);

        Route::get('/', [Claim_controller::class, 'agendaCE']);
    });
});

Route::group(['prefix' => '/claim', 'middleware' => ['auth']], function () {
    Route::get('/entry', [ClaimController::class, 'index']);
    Route::post('/filter', [ClaimController::class, 'filter']);
    Route::post('/', [ClaimController::class, 'store']);
});
