<?php

use App\Http\Controllers\Retro\Contract\ContractController;
use App\Http\Controllers\Retro\Contract\ContractListController;
use App\Http\Controllers\Retro\Contract\FacultativeController;
use App\Http\Controllers\Retro\Contract\RetrocessionMemberController;
use App\Http\Controllers\Retro\Contract\TreatyController;
use App\Http\Controllers\Retro\Mindep\AdjusmentController;
use App\Http\Controllers\Retro\Mindep\DetailLayerController;
use App\Http\Controllers\Retro\Mindep\InstallmentController;
use App\Http\Controllers\Retro\Mindep\LayerController;
use App\Http\Controllers\Retro\Mindep\MainContractController;
use App\Http\Controllers\Retro\Mindep\PanelMemberController;
use App\Http\Controllers\Retro\Mindep\PanelRetroController;
use App\Http\Controllers\Retro\Mindep\RetroController;
use App\Http\Controllers\Retro\Mindep\SpreadingCobController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => '/retro', 'middleware' => ['auth']], function () {

  Route::group(['prefix' => '/mindep'], function () {

    Route::get('/list', [RetroController::class, 'list']);
    Route::get('/entry', [RetroController::class, 'entry']);

    Route::post('/maincontract/store', [MainContractController::class, 'store']);
    Route::get('/maincontract/{mainContract}', [MainContractController::class, 'show']);

    Route::post('/spreadingcob/store', [SpreadingCobController::class, 'store']);
    Route::get('/spreadingcob/{id}', [SpreadingCobController::class, 'index']);

    Route::post('/layer/store', [LayerController::class, 'store']);
    Route::get('/layer/{id}', [LayerController::class, 'index']);
    Route::get('/layer/show/{layer}', [LayerController::class, 'show']);

    Route::post('/installment/store', [InstallmentController::class, 'store']);
    Route::get('/installment/{id}', [InstallmentController::class, 'index']);

    Route::post('/detaillayer/store', [DetailLayerController::class, 'store']);
    Route::get('/detaillayer/{id}', [DetailLayerController::class, 'index']);

    Route::post('/panelretro/store', [PanelRetroController::class, 'store']);
    Route::get('/panelretro/{id}', [PanelRetroController::class, 'index']);

    Route::post('/panelmember/store', [PanelMemberController::class, 'store']);
    Route::get('/panelmember/{id}', [PanelMemberController::class, 'index']);

    Route::group(['prefix' => '/adjusment'], function () {
      Route::post('/store', [AdjusmentController::class, 'store']);
      Route::get('/list', [RetroController::class, 'listAdjusment']);
      Route::get('/{id}', [AdjusmentController::class, 'index']);
      Route::get('/cancelreplace/{adjusment}', [AdjusmentController::class, 'cancelreplace']);
      // Route::get('/entry', [RetroController::class, 'entryAdjusment']);
    });
  });

  Route::group(['prefix' => '/contract'], function () {
    Route::get('/entry', [ContractController::class, 'index']);
    Route::get('/entry/{id}', [ContractController::class, 'show']);
    Route::post('/store', [ContractController::class, 'store']);
    Route::post('/update/{specialContract}', [ContractController::class, 'update']);
    Route::delete('/delete/{specialContract}', [ContractController::class, 'destroy']);

    Route::get('/member/{id}', [RetrocessionMemberController::class, 'index']);
    Route::post('/member', [RetrocessionMemberController::class, 'store']);
    Route::delete('/member/{retrocessionMember}', [RetrocessionMemberController::class, 'destroy']);

    Route::get('/list', [ContractListController::class, 'index']);

    Route::get('/treaty/{id}', [TreatyController::class, 'show']);
    Route::post('/treaty', [TreatyController::class, 'store']);
    Route::delete('/treaty/{treaty}', [TreatyController::class, 'destroy']);

    Route::group(['prefix' => '/facultative'], function () {
      Route::group(['prefix' => '/retrocession'], function () {
        Route::post('/', [FacultativeController::class, 'storeRetrocession']);
        Route::delete('/{retrocession}', [FacultativeController::class, 'destroyRetrocession']);

        Route::group(['prefix' => '/member'], function () {
          Route::get('/{id}', [FacultativeController::class, 'indexMember']);
          Route::post('/', [FacultativeController::class, 'storeMember']);
          Route::delete('/{member}', [FacultativeController::class, 'destroyMember']);
        });
      });

      Route::group(['prefix' => '/premium'], function () {
        Route::post('/', [FacultativeController::class, 'storePremium']);
        Route::delete('/{premium}', [FacultativeController::class, 'destroyPremium']);
      });

      Route::group(['prefix' => '/claim'], function () {
        Route::post('/', [FacultativeController::class, 'storeClaim']);
        Route::delete('/{claim}', [FacultativeController::class, 'destroyClaim']);
      });

      Route::get('/{id}', [FacultativeController::class, 'show']);
    });
  });
});
