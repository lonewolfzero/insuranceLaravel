<?php

use App\Http\Controllers\Treaty\AccumulationController;
use App\Http\Controllers\Treaty\PortofolioController;
use App\Http\Controllers\Treaty\LossController;
use App\Http\Controllers\Treaty\CommissionController;
use App\Http\Controllers\Treaty\PropController;
use App\Http\Controllers\Treaty\NonPropController;
use App\Http\Controllers\Treaty\SharingController;
use App\Http\Controllers\Treaty\SlidingScaleController;
use App\Http\Controllers\Treaty\Soa\BorderoController;
use App\Http\Controllers\Treaty\SOAController;
use App\Http\Controllers\Treaty\TransferController;
use App\Http\Controllers\TreatyController;
use Illuminate\Support\Facades\Route;

Route::post('store-multi-file-ajax-acc', [AccumulationController::class, 'storeMultiFile']);

Route::group(['prefix' => '/treaty', 'middleware' => ['auth']], function () {
  Route::get('/', function () {
    return 'ok';
  });

  Route::prefix('prop')->group(function () {
    Route::get('/entry', [PropController::class, 'entry']);
    Route::post('/store', [PropController::class, 'store']);
    Route::get('/list', [PropController::class, 'list']);
    Route::get('/credit/entry', [PropController::class, 'credit']);
    Route::delete('/delete/{id}', [PropController::class, 'destroy']);
    Route::post('/update/{subDetailContract}', [PropController::class, 'update']);
    Route::get('/show/{prop}', [PropController::class, 'show']);
    Route::get('/getsubdetail/{prop}', [PropController::class, 'getsubdetail']);
    Route::get('/getbanlimit/{subDetailContract}', [PropController::class, 'getbanlimit']);
  });

  Route::prefix('sliding')->group(function () {
    Route::get('/', [SlidingScaleController::class, 'form']);
    Route::post('/filter', [SlidingScaleController::class, 'filter']);
    Route::post('/store', [SlidingScaleController::class, 'store']);
    Route::get('/cancelreplace/{sliding}', [SlidingScaleController::class, 'cancelReplace']);
  });

  Route::prefix('soa')->group(function () {
    Route::get('/index', [SOAController::class, 'index']);
    Route::get('/entry', [SOAController::class, 'entry']);
    Route::get('/list', [SOAController::class, 'list']);
    Route::get('/show/{soa}', [SOAController::class, 'show']);
    Route::post('/store', [SOAController::class, 'store']);
    Route::post('/update/{soa}', [SOAController::class, 'update']);
    Route::post('/replace/{soa}', [SOAController::class, 'replace']);
    Route::delete('/delete/{id}', [SOAController::class, 'destroy']);
    Route::post('/getTreatySummary', [SOAController::class, 'getTreatySummary']);

    Route::prefix('registration')->group(function () {
      Route::post('/', [SOAController::class, 'registration']);
      Route::get('/list', [SOAController::class, 'registrationList']);
    });

    Route::prefix('nil')->group(function () {
      Route::get('/', [SOAController::class, 'list']);
      Route::get('/list', [SOAController::class, 'nilList']);
      Route::delete('/delete/{id}', [SOAController::class, 'destroyNil']);
    });

    Route::prefix('bordero')->group(function () {
      Route::post('/upload', [BorderoController::class, 'upload']);
    });

    Route::prefix('copy')->group(function () {
      Route::post('/', [SOAController::class, 'getCopy']);
    });
  });

  Route::prefix('commission')->group(function () {
    Route::get('/entry', [CommissionController::class, 'entry']);
    Route::get('/list', [CommissionController::class, 'list']);
    Route::post('/store', [CommissionController::class, 'store']);
    Route::post('/check/form', [CommissionController::class, 'checkForm']);
    Route::post('/find', [CommissionController::class, 'find']);
    Route::delete('/delete/{id}', [CommissionController::class, 'destroy']);
    Route::post('/update/{commission}', [CommissionController::class, 'update']);

    Route::prefix('registration')->group(function () {
      Route::post('/', [CommissionController::class, 'registration']);
      Route::get('/list', [CommissionController::class, 'registrationList']);
    });
  });

  Route::prefix('loss')->group(function () {
    Route::get('/entry', [LossController::class, 'entry']);
    Route::get('/list', [LossController::class, 'list']);
    Route::post('/store', [LossController::class, 'store']);
    Route::post('/filter', [LossController::class, 'filter']);
    Route::post('/update/{loss}', [LossController::class, 'update']);
    Route::get('/cancelreplace/{loss}', [LossController::class, 'cancelReplace']);
  });

  Route::prefix('acc')->group(function () {
    Route::get('/entry', [AccumulationController::class, 'entry']);
    Route::get('/list', [AccumulationController::class, 'list']);
    Route::post('/list', [AccumulationController::class, 'list']);
    Route::post('/store', [AccumulationController::class, 'store'])->name('acc.store');
    Route::post('/storeupload', [AccumulationController::class, 'storeupload'])->name('acc.storeupload');
    Route::get('/upload', [AccumulationController::class, 'upload']);
    Route::get('/portofolio', [AccumulationController::class, 'portofolio']);
    Route::get('/delete/{accumulation}', [AccumulationController::class, 'destroy']);

    Route::delete('/delete/{accumulation}', [AccumulationController::class, 'destroy']);
  });


  Route::prefix('porto')->group(function () {
    Route::get('/entry', [PortofolioController::class, 'portofolioentry']);
    Route::get('/list', [PortofolioController::class, 'list']);
    Route::post('/store', [PortofolioController::class, 'store'])->name('acc.store');
    Route::get('/delete/{porto}', [PortofolioController::class, 'destroy']);
    Route::delete('/delete/{porto}', [PortofolioController::class, 'destroy']);
  });



  Route::prefix('nonprop')->group(function () {
    Route::get('/entry', [NonPropController::class, 'entry']);
    Route::get('/adjentry', [NonPropController::class, 'adjentry']);
    Route::get('/list', [NonPropController::class, 'list']);
    Route::post('/list', [NonPropController::class, 'list']);
    Route::get('/mindep/entry', [NonPropController::class, 'mindep']);
    Route::get('/getsubcontractbyid/{id}', [NonPropController::class, 'getsubcontractbyid']);
    Route::get('/getsubcontractdetailbyid/{id}', [NonPropController::class, 'getsubcontractbyid']);
    Route::get('/getgroupcobbyid/{id}', [NonPropController::class, 'getgroupcobbyid'])->name('mindep.getgroupcobbyid');
    Route::get('/getretrobyid/{id}', [NonPropController::class, 'getretrobyid'])->name('mindep.getretrobyid');
    Route::get('/getlayerbyid/{id}', [NonPropController::class, 'getlayerbyid'])->name('mindep.getlayerbyid');
    Route::get('/getinstallmentbyid/{id}', [NonPropController::class, 'getinstallmentbyid'])->name('mindep.getinstallmentbyid');
    Route::get('/getreinstatementbyid/{id}', [NonPropController::class, 'getreinstatementbyid'])->name('mindep.getreinstatementbyid');
    Route::get('/getadjinstallmentbyid/{id}', [NonPropController::class, 'getadjinstallmentbyid'])->name('mindep.getadjinstallmentbyid');
    Route::get('/getinstallmentcount/{id}', [NonPropController::class, 'getinstallmentcount'])->name('mindep.getinstallmentcount');
    Route::get('/getadjinstallmentcount/{id}', [NonPropController::class, 'getadjinstallmentcount'])->name('mindep.getadjinstallmentcount');
    Route::get('/getdetailcobbyid/{id}', [NonPropController::class, 'getdetailcobbyid'])->name('mindep.getdetailcobbyid');
    Route::get('/getreinstatementbyid/{id}', [NonPropController::class, 'getreinstatementbyid'])->name('mindep.getreinstatementbyid');
    Route::get('/delete/{mindep}', [NonPropController::class, 'destroy']);
    Route::delete('/delete/{mindep}', [NonPropController::class, 'destroy']);
    Route::post('/mindep/getsubcontract', [NonPropController::class, 'getsubcontractdata'])->name('mindep.getsubcontract');
    Route::post('/mindep/resetinstallmentdetail', [NonPropController::class, 'resetinstallmentdetail'])->name('mindep.resetinstallmentdetail');
    Route::post('/mindep/getgrouplayer', [NonPropController::class, 'getgrouplayerdata'])->name('mindep.getgrouplayer');
    Route::post('/mindep/getgroupcobdata', [NonPropController::class, 'getgroupcobdata'])->name('mindep.getgroupcobdata');
    Route::post('/mindep/store', [NonPropController::class, 'store'])->name('mindep.store');
    Route::post('/mindep/storesub', [NonPropController::class, 'storesub'])->name('mindep.storesub');
    Route::post('/mindep/storeadjusment', [NonPropController::class, 'storeadjusment'])->name('mindep.storeadjusment');
    Route::post('/mindep/storegroupcob', [NonPropController::class, 'storegroupcob'])->name('mindep.storegroupcob');
    Route::post('/mindep/storeretrocob', [NonPropController::class, 'storeretrocob'])->name('mindep.storeretrocob');
    Route::post('/mindep/storeinstatement', [NonPropController::class, 'storeinstatement'])->name('mindep.storeinstatement');
    Route::post('/mindep/storelayer', [NonPropController::class, 'storelayer'])->name('mindep.storelayer');
    Route::post('/mindep/storedetailcob', [NonPropController::class, 'storedetailcob'])->name('mindep.storedetailcob');
    Route::post('/mindep/storeinstallmentdetail', [NonPropController::class, 'storeinstallmentdetail'])->name('mindep.storeinstallmentdetail');
    Route::get('/detailmindep', [NonPropController::class, 'detailinstallmentmindep']);
    Route::get('/detailcobmindep', [NonPropController::class, 'detailcobmindep']);
    Route::get('/reinstatement/entry', [NonPropController::class, 'reinstatement']);
    Route::get('/reinstatement/adj/entry', [NonPropController::class, 'adjinstatement']);

    
    
    Route::post('/mindep/storereins', [NonPropController::class, 'storereins'])->name('mindep.storereins');
    Route::post('/mindep/storeadjusmentreins', [NonPropController::class, 'storeadjusmentreins'])->name('mindep.storeadjusmentreins');

    
    Route::get('/getdetailreinsid/{id}', [NonPropController::class, 'getdetailreinsid']);
    Route::get('/getdetailadjreinsid/{id}', [NonPropController::class, 'getdetailadjreinsid']);

    Route::get('/mindep/getclaimregcomp/{id}', [NonPropController::class, 'getclaimregcomp']);
    Route::get('/mindep/getclaimregcompdetail/{id}', [NonPropController::class, 'getclaimregcompdetail']);
    

    Route::get('/getdetailcobbyiddetail/{id}', [NonPropController::class, 'getdetailcobbyiddetail']);

    Route::post('/mindep/getgroupdetailcob', [NonPropController::class, 'getgroupdetailcobdata']);
    Route::post('/mindep/getgroupreinstatementdata', [NonPropController::class, 'getgroupreinstatementdata']);
    Route::post('/mindep/getgroupreinstatement', [NonPropController::class, 'getgroupreinstatementdata']);

    
                       
    Route::get('/mindep/getclaimregcomp/{id}', [NonPropController::class, 'getclaimregcomp']);


    Route::get('/getgroupcobdetailbyid/{id}', [NonPropController::class, 'getgroupcobdetailbyid']);
    Route::get('/getlayerdetailbyid/{id}', [NonPropController::class, 'getlayerdetailbyid']);
    Route::get('/getretrodetailbyid/{id}', [NonPropController::class, 'getretrodetailbyid']);
    Route::get('/getinstallmentdetailbyid/{id}', [NonPropController::class, 'getinstallmentdetailbyid']);
    Route::get('/getdetailcobbyiddetail/{id}', [NonPropController::class, 'getdetailcobbyiddetail']);
    Route::get('/getadjinstallmentdetailbyid/{id}', [NonPropController::class, 'getadjinstallmentdetailbyid']);


    Route::get('/deletesubmaster/{mindep}', [NonPropController::class, 'destroysubmaster']);
    Route::delete('/deletesubmaster/{mindep}', [NonPropController::class, 'destroysubmaster']);

    Route::get('/deletegroupcob/{mindep}', [NonPropController::class, 'destroygroupcob']);
    Route::delete('/deletegroupcob/{mindep}', [NonPropController::class, 'destroygroupcob']);

    Route::get('/deleteretro/{mindep}', [NonPropController::class, 'destroyretro']);
    Route::delete('/deleteretro/{mindep}', [NonPropController::class, 'destroyretro']);

    Route::get('/deletelayer/{mindep}', [NonPropController::class, 'destroylayer']);
    Route::delete('/deletelayer/{mindep}', [NonPropController::class, 'destroylayer']);

    Route::get('/deletereinstatement/{mindep}', [NonPropController::class, 'destroyreinstatement']);
    Route::delete('/deletereinstatement/{mindep}', [NonPropController::class, 'destroyreinstatement']);

    Route::get('/deleteadjinstallment/{mindep}', [NonPropController::class, 'destroyadjinstallment']);
    Route::delete('/deleteadjinstallment/{mindep}', [NonPropController::class, 'destroyadjinstallment']);

    Route::get('/deletedetailinstallment/{mindep}', [NonPropController::class, 'destroydetailinstallment']);
    Route::delete('/deletedetailinstallment/{mindep}', [NonPropController::class, 'destroydetailinstallment']);

    Route::get('/deletedetailcob/{mindep}', [NonPropController::class, 'destroydetailcob']);
    Route::delete('/deletedetailcob/{mindep}', [NonPropController::class, 'destroydetailcob']);


    Route::get('/deletereins/{mindep}', [NonPropController::class, 'destroyreins']);
    Route::delete('/deletereins/{mindep}', [NonPropController::class, 'destroyreins']);


    Route::get('/deleteadjreins/{mindep}', [NonPropController::class, 'destroyadjreins']);
    Route::delete('/deleteadjreins/{mindep}', [NonPropController::class, 'destroyadjreins']);


    Route::prefix('v2')->group(function () {
      Route::get('/entry', [NonPropController::class, 'entry_v2']);
    });
  });


  Route::prefix('sharing')->group(function () {
    Route::get('/entry', [SharingController::class, 'entry']);
    Route::get('/list', [SharingController::class, 'list']);
    Route::post('/list', [SharingController::class, 'list']);
    Route::post('/store', [SharingController::class, 'store'])->name('acc.store');
    Route::get('/delete/{sharing}', [SharingController::class, 'destroy']);
    Route::delete('/delete/{sharing}', [SharingController::class, 'destroy']);
  });


  Route::prefix('transfer')->group(function () {
    Route::get('/', [TransferController::class, 'index']);
    Route::get('/prop', [TransferController::class, 'list']);
    Route::post('/prop', [TransferController::class, 'list']);
    Route::get('/nonprop', [TransferController::class, 'listnonprop']);
    Route::post('/nonprop', [TransferController::class, 'listnonprop']);
    Route::post('/store', [TransferController::class, 'store'])->name('acc.store');
    Route::get('/delete/{transfer}', [TransferController::class, 'destroy']);
    Route::delete('/delete/{transfer}', [TransferController::class, 'destroy']);
  });
});
