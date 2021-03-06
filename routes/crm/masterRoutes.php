<?php

use App\Http\Controllers\BankController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MasterController;
use App\Http\Controllers\CedingBrokerController;
use App\Http\Controllers\KocController;
use App\Http\Controllers\GolfFieldHoleController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\StateController;
use App\Http\Controllers\FeLookupLocationController;
use App\Http\Controllers\ProductGroupController;
use App\Http\Controllers\EarthQuakeZoneController;
use App\Http\Controllers\FloodZoneController;
use App\Http\Controllers\CauseOfLossController;
use App\Http\Controllers\NatureOfLossController;
use App\Http\Controllers\SurveyorController;
use App\Http\Controllers\MasterPrefixController;
use App\Http\Controllers\BusinessType;
use App\Http\Controllers\LossDescriptionController;
use App\Http\Controllers\TypeOfCoverageController;
use App\Http\Controllers\TypeOfMindepController;

Route::get('get-state-list', 'FeLookupLocationController@getStateList');
Route::get('get-city-list', 'FeLookupLocationController@getCityList');
Route::get('get-city-all', 'MasterController@getCityList');
Route::get('get-cedingbroker-autocode', 'CedingBrokerController@generatecode')->name('cedingbroker.getcode');
Route::get('get-koc-autocode', 'KocController@generatecode')->name('koc.getcode');
Route::get('get-cob-autocode', 'MasterController@generatecodecob')->name('cob.getcode');
Route::get('get-ocp-autocode', 'MasterController@generatecodeocp')->name('ocp.getcode');
Route::get('get-state-all', 'StateController@getState')->name('state.getall');


Route::group(['prefix' => '/master-data', 'middleware' => ['auth']], function () {

    // SECTION Country Group Routes
    // Route::get('/country', [MasterController::class, 'indexcountry'])->middleware(['can:view-country']);
    // Route::post('/country/store', [MasterController::class, 'storecountry'])->middleware(['can:create-country']);
    // Route::put('country/{country}', [MasterController::class, 'updatecountry'])->middleware(['can:update-country']);
    // Route::delete('/country/destroy/{country}', [MasterController::class, 'destroycountry'])->middleware(['can:delete-country']);
    Route::get('/country', [MasterController::class, 'indexcountry'])->middleware(['can:create-country']);
    Route::post('/country/store', [MasterController::class, 'storecountry']);
    Route::put('country/{country}', [MasterController::class, 'updatecountry']);
    Route::delete('/country/destroy/{country}', [MasterController::class, 'destroycountry']);

    // SECTION City Routes
    // Route::get('/city',  [CityController::class, 'index'])->middleware(['can:view-city']);
    // Route::post('/city',  [CityController::class, 'index'])->middleware(['can:view-city']);
    // Route::post('/city/store', [CityController::class, 'store'])->middleware(['can:create-city']);
    // Route::put('/city/update/{city}', [CityController::class, 'update'])->middleware(['can:update-city']);
    // Route::delete('/city/destroy/{city}', [CityController::class, 'destroy'])->middleware(['can:delete-city']);
    Route::get('/city',  [CityController::class, 'index'])->middleware(['can:create-city']);
    Route::post('/city',  [CityController::class, 'index']);
    Route::post('/city/store', [CityController::class, 'store']);
    Route::put('/city/update/{city}', [CityController::class, 'update']);
    Route::delete('/city/destroy/{city}', [CityController::class, 'destroy']);

    // SECTION State Routes
    // Route::get('/state',  [StateController::class, 'index'])->middleware(['can:view-state']);
    // Route::post('/state',  [StateController::class, 'index'])->middleware(['can:view-state']);
    // Route::post('/state/store', [StateController::class, 'store'])->middleware(['can:create-state']);
    // Route::put('/state/update/{state}', [StateController::class, 'update'])->middleware(['can:update-state']);
    // Route::delete('/state/destroy/{state}', [StateController::class, 'destroy'])->middleware(['can:delete-state']);
    Route::get('/state',  [StateController::class, 'index'])->middleware(['can:create-state']);
    Route::post('/state',  [StateController::class, 'index']);
    Route::post('/state/store', [StateController::class, 'store']);
    Route::put('/state/update/{state}', [StateController::class, 'update']);
    Route::delete('/state/destroy/{state}', [StateController::class, 'destroy']);



    // SECTION COB Group Routes
    // Route::get('/cob', [MasterController::class, 'indexcob'])->middleware(['can:view-cob']);
    // Route::post('/cob/store', [MasterController::class, 'storecob'])->middleware(['can:create-cob']);
    // Route::put('cob/{cob}', [MasterController::class, 'updatecob'])->middleware(['can:update-cob']);
    // Route::delete('/cob/destroy/{cob}', [MasterController::class, 'destroycob'])->middleware(['can:delete-cob']);
    Route::get('/cob', [MasterController::class, 'indexcob'])->middleware(['can:create-cob']);
    Route::get('/business_type', [MasterController::class, 'indexbt']);
    Route::post('/cob/store', [MasterController::class, 'storecob']);
    Route::post('/businesstype/store', [MasterController::class, 'storebt']);
    Route::put('cob/{cob}', [MasterController::class, 'updatecob']);
    Route::put('businesstype/{bt}', [MasterController::class, 'updatebt']);
    Route::delete('/cob/destroy/{cob}', [MasterController::class, 'destroycob']);
    Route::delete('/businesstype/destroy/{bt}', [MasterController::class, 'destroybt']);

    // SECTION Occupation Routes
    // Route::get('/occupation', [MasterController::class, 'indexoccupation'])->middleware(['can:view-occupation']);
    // Route::post('/occupation/store', [MasterController::class, 'storeoccupation'])->middleware(['can:create-occupation']);
    // Route::put('occupation/{ocp}', [MasterController::class, 'updateoccupation'])->middleware(['can:update-occupation']);
    // Route::delete('/occupation/destroy/{ocp}', [MasterController::class, 'destroyoccupation'])->middleware(['can:delete-occupation']);
    Route::get('/occupation', [MasterController::class, 'indexoccupation'])->middleware(['can:create-occupation']);
    Route::post('/occupation/store', [MasterController::class, 'storeoccupation']);
    Route::put('occupation/{ocp}', [MasterController::class, 'updateoccupation']);
    Route::delete('/occupation/destroy/{ocp}', [MasterController::class, 'destroyoccupation']);


    // SECTION currency Routes
    // Route::get('/currency', [MasterController::class, 'indexcurrency'])->middleware(['can:view-currency']);
    // Route::post('/currency/store', [MasterController::class, 'storecurrency'])->middleware(['can:create-currency']);
    // Route::put('currency/{crc}', [MasterController::class, 'updatecurrency'])->middleware(['can:update-currency']);
    // Route::delete('/currency/destroy/{crc}', [MasterController::class, 'destroycurrency'])->middleware(['can:delete-currency']);
    Route::get('/currency', [MasterController::class, 'indexcurrency'])->middleware(['can:create-currency']);
    Route::post('/currency/store', [MasterController::class, 'storecurrency']);
    Route::put('currency/{crc}', [MasterController::class, 'updatecurrency']);
    Route::delete('/currency/destroy/{crc}', [MasterController::class, 'destroycurrency']);


    // SECTION currency Exchange Routes
    // Route::get('/exchange', [MasterController::class, 'indexexchange'])->middleware(['can:view-exchange']);
    // Route::post('/exchange/store', [MasterController::class, 'storeexchange'])->middleware(['can:create-exchange']);
    // Route::put('exchange/{exc}', [MasterController::class, 'updateexchange'])->middleware(['can:update-exchange']);
    // Route::delete('/exchange/destroy/{exc}', [MasterController::class, 'destroyexchange'])->middleware(['can:delete-exchange']);
    Route::get('/exchange', [MasterController::class, 'indexexchange'])->middleware(['can:create-exchange']);
    Route::post('/exchange/store', [MasterController::class, 'storeexchange']);
    Route::put('exchange/{exc}', [MasterController::class, 'updateexchange']);
    Route::delete('/exchange/destroy/{exc}', [MasterController::class, 'destroyexchange']);


    // SECTION FE Lookup Routes
    // Route::get('/felookuplocation', [FeLookupLocationController::class, 'index'])->middleware(['can:view-felookup']);
    // Route::post('/felookuplocation', [FeLookupLocationController::class, 'index'])->middleware(['can:view-felookup']);
    // Route::post('/felookuplocation/store', [FeLookupLocationController::class, 'store'])->middleware(['can:create-felookup']);
    // Route::put('/felookuplocation/update/{fl}', [FeLookupLocationController::class, 'update'])->middleware(['can:update-felookup']);
    // Route::delete('/felookuplocation/destroy/{fl}', [FeLookupLocationController::class, 'destroy'])->middleware(['can:delete-felookup']);
    Route::get('/felookuplocation', [FeLookupLocationController::class, 'index'])->middleware(['can:create-felookup']);
    Route::get('/felookuplocationgetcountcode', [FeLookupLocationController::class, 'getCountCode']);
    Route::get('/felookuplocationgetloccountcode/{fl}', [FeLookupLocationController::class, 'getLocCountCode']);
    Route::post('/felookuplocation', [FeLookupLocationController::class, 'index']);
    Route::post('/felookuplocation/store', [FeLookupLocationController::class, 'store']);
    Route::put('/felookuplocation/update/{fl}', [FeLookupLocationController::class, 'update']);
    Route::delete('/felookuplocation/destroy/{fl}', [FeLookupLocationController::class, 'destroy']);


    // SECTION KOC Routes
    // Route::get('/koc', [KocController::class, 'index'])->middleware(['can:view-koc']);
    // Route::post('/koc/store', [KocController::class, 'store'])->middleware(['can:create-koc']);
    // Route::put('/koc/update/{koc}', [KocController::class, 'update'])->middleware(['can:update-koc']);
    // Route::delete('/koc/destroy/{koc}', [KocController::class, 'destroy'])->middleware(['can:delete-koc']);

    Route::get('/koc', [KocController::class, 'index'])->middleware(['can:create-koc']);
    Route::post('/koc/store', [KocController::class, 'store']);
    Route::put('/koc/update/{koc}', [KocController::class, 'update']);
    Route::delete('/koc/destroy/{koc}', [KocController::class, 'destroy']);



    // SECTION Golf Hole Routes
    // Route::get('/golffieldhole', [GolfFieldHoleController::class, 'index'])->middleware(['can:view-gfh']);
    // Route::post('/golffieldhole/store', [GolfFieldHoleController::class, 'store'])->middleware(['can:create-gfh']);
    // Route::put('/golffieldhole/update/{gfh}', [GolfFieldHoleController::class, 'update'])->middleware(['can:update-gfh']);
    // Route::delete('/golffieldhole/destroy/{gfh}', [GolfFieldHoleController::class, 'destroy'])->middleware(['can:delete-gfh']);
    Route::get('/golffieldhole', [GolfFieldHoleController::class, 'index'])->middleware(['can:create-gfh']);
    Route::post('/golffieldhole/store', [GolfFieldHoleController::class, 'store']);
    Route::put('/golffieldhole/update/{gfh}', [GolfFieldHoleController::class, 'update']);
    Route::delete('/golffieldhole/destroy/{gfh}', [GolfFieldHoleController::class, 'destroy']);

    // SECTION Ceding Broker Routes
    // Route::get('/cedingbroker', [CedingBrokerController::class, 'index'])->middleware(['can:view-cedingbroker']);
    // Route::post('/cedingbroker', [CedingBrokerController::class, 'index'])->middleware(['can:view-cedingbroker']);
    // Route::post('/cedingbroker/store', [CedingBrokerController::class, 'store'])->middleware(['can:create-cedingbroker']);
    // Route::put('/cedingbroker/update/{cb}', [CedingBrokerController::class, 'update'])->middleware(['can:update-cedingbroker']);
    // Route::delete('/cedingbroker/destroy/{cb}', [CedingBrokerController::class, 'destroy'])->middleware(['can:delete-cedingbroker']);
    Route::get('/cedingbroker', [CedingBrokerController::class, 'index'])->middleware(['can:create-cedingbroker']);
    Route::post('/cedingbroker', [CedingBrokerController::class, 'index']);
    Route::post('/cedingbroker/store', [CedingBrokerController::class, 'store']);
    Route::put('/cedingbroker/update/{cb}', [CedingBrokerController::class, 'update']);
    Route::post('/cedingbroker/update/{cb}', [CedingBrokerController::class, 'update']);
    Route::delete('/cedingbroker/destroy/{cb}', [CedingBrokerController::class, 'destroy']);
    Route::post('/cedingbroker/destroy/{cb}', [CedingBrokerController::class, 'destroy']);

    // SECTION Earthquake Zone Routes
    // Route::get('/earthquakezone', [EarthQuakeZoneController::class, 'index'])->middleware(['can:view-eqz']);
    // Route::post('/earthquakezone', [EarthQuakeZoneController::class, 'index'])->middleware(['can:view-eqz']);
    // Route::post('/earthquakezone/store',  [EarthQuakeZoneController::class, 'store'])->middleware(['can:create-eqz']);
    // Route::put('/earthquakezone/update/{eq}', [EarthQuakeZoneController::class, 'update'])->middleware(['can:update-eqz']);
    // Route::delete('/earthquakezone/destroy/{eq}',  [EarthQuakeZoneController::class, 'destroy'])->middleware(['can:delete-eqz']);

    Route::get('/earthquakezone', [EarthQuakeZoneController::class, 'index'])->middleware(['can:create-eqz']);
    Route::post('/earthquakezone', [EarthQuakeZoneController::class, 'index']);
    Route::post('/earthquakezone/store',  [EarthQuakeZoneController::class, 'store']);
    Route::put('/earthquakezone/update/{eq}', [EarthQuakeZoneController::class, 'update']);
    Route::delete('/earthquakezone/destroy/{eq}',  [EarthQuakeZoneController::class, 'destroy']);

    // SECTION Flood Zone Routes
    // Route::get('/floodzone', [FloodZoneController::class, 'index'])->middleware(['can:view-fz']);
    // Route::post('/floodzone', [FloodZoneController::class, 'index'])->middleware(['can:view-fz']);
    // Route::post('/floodzone/store',  [FloodZoneController::class, 'store'])->middleware(['can:create-fz']);
    // Route::put('/floodzone/update/{flood}', [FloodZoneController::class, 'update'])->middleware(['can:update-fz']);
    // Route::delete('/floodzone/destroy/{flood}',  [FloodZoneController::class, 'destroy'])->middleware(['can:delete-fz']);
    Route::get('/floodzone', [FloodZoneController::class, 'index'])->middleware(['can:create-fz']);
    Route::post('/floodzone', [FloodZoneController::class, 'index']);
    Route::post('/floodzone/store',  [FloodZoneController::class, 'store']);
    Route::put('/floodzone/update/{flood}', [FloodZoneController::class, 'update']);
    Route::delete('/floodzone/destroy/{flood}',  [FloodZoneController::class, 'destroy']);


    // SECTION Ship Type Routes
    Route::get('/shiptype', [MasterController::class, 'indexshiptype'])->middleware(['can:create-shiptype']);
    Route::post('/shiptype/store', [MasterController::class, 'storeshiptype']);
    Route::put('shiptype/{st}', [MasterController::class, 'updateshiptype']);
    Route::delete('/shiptype/destroy/{st}', [MasterController::class, 'destroyshiptype']);

    // SECTION Classification Routes
    Route::get('/classification', [MasterController::class, 'indexclassification']);
    Route::post('/classification/store', [MasterController::class, 'storeclassification']);
    Route::put('classification/{cs}', [MasterController::class, 'updateclassification']);
    Route::delete('/classification/destroy/{cs}', [MasterController::class, 'destroyclassification']);

    // SECTION Construction Routes
    Route::get('/construction', [MasterController::class, 'indexconstruction']);
    Route::post('/construction/store', [MasterController::class, 'storeconstruction']);
    Route::put('construction/{cr}', [MasterController::class, 'updateconstruction']);
    Route::delete('/construction/destroy/{cr}', [MasterController::class, 'destroyconstruction']);

    // SECTION Marine Lookup Routes
    // Route::get('/marine-lookup', [MasterController::class, 'indexmarinelookup'])->middleware(['can:view-marinelookup']);
    // Route::post('/marine-lookup/store', [MasterController::class, 'storemarinelookup'])->middleware(['can:create-marinelookup']);
    Route::put('marine-lookup/{mlu}', [MasterController::class, 'updatemarinelookup'])->middleware(['can:update-marinelookup']);
    // Route::delete('/marine-lookup/destroy/{mlu}', [MasterController::class, 'destroymarinelookup'])->middleware(['can:delete-marinelookup']);
    Route::get('/marine-lookup', [MasterController::class, 'indexmarinelookup'])->middleware(['can:create-marinelookup']);
    Route::post('/marine-lookup/store', [MasterController::class, 'storemarinelookup']);
    Route::put('marine-lookup/{mlu}', [MasterController::class, 'updatemarinelookup']);
    Route::post('marine-lookup/{mlu}', [MasterController::class, 'updatemarinelookup']);
    Route::delete('/marine-lookup/destroy/{mlu}', [MasterController::class, 'destroymarinelookup']);


    // SECTION property Type Routes
    Route::get('/propertytype', [MasterController::class, 'indexpropertytype'])->middleware(['can:create-property_type']);
    Route::post('/propertytype/store', [MasterController::class, 'storepropertytype']);
    Route::put('propertytype/{pt}', [MasterController::class, 'updatepropertytype']);
    Route::delete('/propertytype/destroy/{pt}', [MasterController::class, 'destroypropertytype']);

    // SECTION property Type Routes
    Route::get('/companytype', [MasterController::class, 'indexcompanytype'])->middleware(['can:create-company_type']);
    Route::post('/companytype/store', [MasterController::class, 'storecompanytype']);
    Route::put('companytype/{ct}', [MasterController::class, 'updatecompanytype']);
    Route::delete('/companytype/destroy/{ct}', [MasterController::class, 'destroycompanytype']);

    // SECTION condition Needed Routes
    Route::get('/conditionneeded', [MasterController::class, 'indexconditionneeded'])->middleware(['can:create-condition_needed']);
    Route::post('/conditionneeded/store', [MasterController::class, 'storeconditionneeded']);
    Route::put('conditionneeded/{cdn}', [MasterController::class, 'updateconditionneeded']);
    Route::delete('/conditionneeded/destroy/{cdn}', [MasterController::class, 'destroyconditionneeded']);

    // SECTION Interest Insured Routes
    Route::get('/interestinsured', [MasterController::class, 'indexinterestinsured'])->middleware(['can:create-interest_insured']);
    Route::post('/interestinsured/store', [MasterController::class, 'storeinterestinsured']);
    Route::put('interestinsured/{ii}', [MasterController::class, 'updateinterestinsured']);
    Route::delete('/interestinsured/destroy/{ii}', [MasterController::class, 'destroyinterestinsured']);

    // SECTION Deductible Type  Routes
    Route::get('/deductibletype', [MasterController::class, 'indexdeductibletype'])->middleware(['can:create-deductible']);
    Route::post('/deductibletype/store', [MasterController::class, 'storedeductibletype']);
    Route::put('deductibletype/{dt}', [MasterController::class, 'updatedeductibletype']);
    Route::delete('/deductibletype/destroy/{dt}', [MasterController::class, 'destroydeductibletype']);

    // SECTION Extended Coverage Routes
    Route::get('/extendedcoverage', [MasterController::class, 'indexextendedcoverage'])->middleware(['can:create-extend_coverage']);
    Route::post('/extendedcoverage/store', [MasterController::class, 'storeextendedcoverage']);
    Route::put('extendedcoverage/{ec}', [MasterController::class, 'updateextendedcoverage']);
    Route::delete('/extendedcoverage/destroy/{ec}', [MasterController::class, 'destroyextendedcoverage']);

    // SECTION Ship Port Routes
    Route::get('/shipport', [MasterController::class, 'indexshipport'])->middleware(['can:create-ship_port']);
    Route::post('/shipport/store', [MasterController::class, 'storeshipport']);
    Route::put('shipport/{sp}', [MasterController::class, 'updateshipport']);
    Route::delete('/shipport/destroy/{sp}', [MasterController::class, 'destroyshipport']);

    // SECTION Route Form Routes
    Route::get('/routeform', [MasterController::class, 'indexrouteform'])->middleware(['can:create-route']);
    Route::post('/routeform/store', [MasterController::class, 'storerouteform']);
    Route::put('routeform/{rf}', [MasterController::class, 'updaterouteform']);
    Route::delete('/routeform/destroy/{rf}', [MasterController::class, 'destroyrouteform']);

    Route::get('/insuredmarinetype', [MasterController::class, 'indexinsuredmarinetype']);
    Route::post('/insuredmarinetype/store', [MasterController::class, 'storeinsuredmarinetype']);
    Route::put('insuredmarinetype/{imt}', [MasterController::class, 'updateinsuredmarinetype']);
    Route::delete('/insuredmarinetype/destroy/{imt}', [MasterController::class, 'destroyinsuredmarinetype']);

    // Bulk Excel Import Users
    // Route::get('/import', [ ProductController::class, 'import'])->middleware(['can:create-product']);
    // Route::post('/import', [ ProductController::class, 'importStore'])->middleware(['can:create-product']);

    Route::get('/causeofloss', [CauseOfLossController::class, 'index'])->middleware(['can:create-cause_of_loss']);
    Route::post('/causeofloss/store', [CauseOfLossController::class, 'store']);
    Route::put('/causeofloss/update/{causeofloss}', [CauseOfLossController::class, 'update']);
    Route::delete('/causeofloss/destroy/{causeofloss}', [CauseOfLossController::class, 'destroy']);
    Route::post('/causeofloss/destroy/{causeofloss}', [CauseOfLossController::class, 'destroy']);


    Route::get('/natureofloss', [NatureOfLossController::class, 'index'])->middleware(['can:create-nature_of_loss']);
    Route::post('/natureofloss/store', [NatureOfLossController::class, 'store']);
    Route::post('/natureofloss/update/{natureofloss}', [NatureOfLossController::class, 'update']);
    Route::put('/natureofloss/update/{natureofloss}', [NatureOfLossController::class, 'update']);
    Route::delete('/natureofloss/destroy/{natureofloss}', [NatureOfLossController::class, 'destroy']);
    Route::post('/natureofloss/destroy/{natureofloss}', [NatureOfLossController::class, 'destroy']);


    Route::get('/surveyor', [SurveyorController::class, 'index'])->middleware(['can:create-surveyor']);
    Route::post('/surveyor/store', [SurveyorController::class, 'store']);
    Route::put('/surveyor/update/{surveyor}', [SurveyorController::class, 'update']);
    Route::delete('/surveyor/destroy/{surveyor}', [SurveyorController::class, 'destroy']);
    Route::post('/surveyor/destroy/{surveyor}', [SurveyorController::class, 'destroy']);

    Route::get('/prefixinsured', [MasterController::class, 'indexprefixinsured'])->middleware(['can:create-prefix_insured']);
    Route::post('/prefixinsured/store', [MasterController::class, 'storeprefixinsured']);
    Route::put('prefixinsured/{pi}', [MasterController::class, 'updateprefixinsured']);
    Route::delete('/prefixinsured/destroy/{pi}', [MasterController::class, 'destroyprefixinsured']);


    // LOSS DESCRIPTION
    Route::get('/lossdesc', [LossDescriptionController::class, 'index'])->middleware(['can:create-loss-desc']);
    Route::get('/lossdesc/{masterClaimDesc}', [LossDescriptionController::class, 'show']);
    Route::post('/lossdesc/store', [LossDescriptionController::class, 'store']);
    Route::put('/lossdesc/{masterClaimDesc}', [LossDescriptionController::class, 'update']);
    Route::delete('/lossdesc/{masterClaimDesc}', [LossDescriptionController::class, 'destroy']);

    // BANK
    Route::get('/bank', [BankController::class, 'index'])->middleware(['can:create-bank']);
    Route::get('/bank/{bank}', [BankController::class, 'show']);
    Route::post('/bank/store', [BankController::class, 'store']);
    Route::put('/bank/{bank}', [BankController::class, 'update']);
    Route::delete('/bank/{bank}', [BankController::class, 'destroy']);

    // TypeOfCoverage
    Route::get('/typeofcoverage', [TypeOfCoverageController::class, 'index'])->middleware(['can:create-type-of-coverage']);
    Route::get('/typeofcoverage/{typeOfCoverage}', [TypeOfCoverageController::class, 'show']);
    Route::post('/typeofcoverage/store', [TypeOfCoverageController::class, 'store']);
    Route::put('/typeofcoverage/{typeOfCoverage}', [TypeOfCoverageController::class, 'update']);
    Route::delete('/typeofcoverage/{typeOfCoverage}', [TypeOfCoverageController::class, 'destroy']);

    // TypeOfMindep
    Route::get('/typeofmindep', [TypeOfMindepController::class, 'index'])->middleware(['can:create-type-of-mindep']);
    Route::get('/typeofmindep/{typeOfMindep}', [TypeOfMindepController::class, 'show']);
    Route::post('/typeofmindep/store', [TypeOfMindepController::class, 'store']);
    Route::put('/typeofmindep/{typeOfMindep}', [TypeOfMindepController::class, 'update']);
    Route::delete('/typeofmindep/{typeOfMindep}', [TypeOfMindepController::class, 'destroy']);
});
