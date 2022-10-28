<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\OperationController;
use App\Http\Controllers\StockingPointController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TypeController;
use App\Http\Controllers\ChildPartNumberController;
use App\Http\Controllers\PartMasterController;
use App\Http\Controllers\NestingController;
use App\Http\Controllers\RawMaterialTypeController;
use App\Http\Controllers\RawMaterialController;
use App\Http\Controllers\ChildPartBomController;
use App\Http\Controllers\NestingSequenceController;
use App\Http\Controllers\ProcessMasterController;
use App\Http\Controllers\StoreReceiveEntryController;
use App\Http\Controllers\StoreIssueEntryController;
use App\Http\Controllers\GeneralController;
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

Auth::routes();


Route::middleware(['auth'])->group(function () {
    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::resource('setting', SettingController::class);
    Route::resource('operation', OperationController::class);
    Route::resource('stocking_points', StockingPointController::class);
    Route::resource('category', CategoryController::class);
    Route::resource('type', TypeController::class);
    Route::resource('child_part_number', ChildPartNumberController::class);
    Route::resource('part_master', PartMasterController::class);
    Route::resource('nesting', NestingController::class);
    Route::resource('nesting_sequence', NestingSequenceController::class);
    Route::resource('raw_material_type', RawMaterialTypeController::class);
    Route::resource('raw_material', RawMaterialController::class);
    Route::resource('child_part_bom', ChildPartBomController::class);
    Route::post('child_part_bom/getnestingSequence', [ChildPartBomController::class,'getNestingSequence'])->name('getNestingSequence');
    Route::post('child_part_bom/getChildPartnumber', [ChildPartBomController::class,'getChildPartnumber'])->name('getChildPartnumber');
    Route::post('child_part_bom/getRawMaterials', [ChildPartBomController::class,'getRawMaterials'])->name('getRawMaterials');
    Route::resource('process_master', ProcessMasterController::class);
    Route::resource('store_receive', StoreReceiveEntryController::class);
    Route::resource('store_issue', StoreIssueEntryController::class);
    Route::post('/materials', [GeneralController::class,'getMaterials'])->name('getMaterials');
});
