<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
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
use App\Http\Controllers\StoreReceiveChildPartController;
use App\Http\Controllers\StoreIssueEntryController;
use App\Http\Controllers\GeneralController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\PurchaseOrderController;
use App\Http\Controllers\GoodReceivedNoteController;
use App\Http\Controllers\PartMatrixController;
use App\Http\Controllers\PoMasterController;
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
// Route::get('/email/verify', function () {
//     return view('auth.verify');
// })->middleware('auth')->name('verification.notice');
// Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
//     $request->fulfill();
//     return redirect('/');
// })->middleware(['auth', 'signed'])->name('verification.verify');

Route::middleware(['auth'])->group(function () {
    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::resource('setting', SettingController::class);
    Route::get('operation/export/', [OperationController::class, 'export']);
    Route::resource('operation', OperationController::class);
    Route::resource('stocking_points', StockingPointController::class);
    Route::resource('category', CategoryController::class);
    Route::resource('type', TypeController::class);
    Route::get('child_part_number/export/', [ChildPartNumberController::class, 'export'])->name('child_part_number.export');
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
    Route::get('store_receive/getConfirm/{id}', [StoreReceiveEntryController::class,'getConfirm'])->name('store.getConfirm');
    Route::post('store_receive/getRawMaterials', [StoreReceiveEntryController::class,'getRawMaterials'])->name('store.materials');
    Route::post('store_receive/getSupplier', [StoreReceiveEntryController::class,'getSupplier'])->name('store.getSupplier');
    Route::post('store_receive/getPurchaseOrder', [StoreReceiveEntryController::class,'getPurchaseOrder'])->name('store.getPurchaseOrder');
    Route::post('store_receive/getChildPartNumber', [StoreReceiveEntryController::class,'getChildPartNumber'])->name('store.getChildPartNumber');
    Route::post('store_receive/getMaterialPurchaseOrder', [StoreReceiveEntryController::class,'getMaterialPurchaseOrder'])->name('store.getMaterialPurchaseOrder');
    Route::resource('store_receive', StoreReceiveEntryController::class);
    Route::post('store_issue/getChildPartNumbers', [StoreIssueEntryController::class,'getChildPartNumbers'])->name('store.nesting_child_parts');
    Route::post('store_issue/getNestingQuantity', [StoreIssueEntryController::class,'getNestingQuantity'])->name('store.nesting_quantity');
    Route::get('store_issue/getDcIssuance', [StoreIssueEntryController::class,'getDcIssuance'])->name('store_issue.dc_issuance');
    Route::resource('store_issue', StoreIssueEntryController::class);
    Route::resource('supplier', SupplierController::class);
    Route::get('/purchase_order/print/{id}', [PurchaseOrderController::class,'print'])->name('print');
    Route::post('/getPurchaseItems', [PurchaseOrderController::class,'getPurchaseItems'])->name('getPurchaseItems');
    Route::resource('purchase_order', PurchaseOrderController::class);
    Route::resource('good_received_note', GoodReceivedNoteController::class);
    Route::post('/types', [GeneralController::class,'getTypes'])->name('general.types');
    Route::post('/materials', [GeneralController::class,'getMaterials'])->name('general.materials');
    Route::post('/suppliers', [GeneralController::class,'getSuppliers'])->name('general.suppliers');
    Route::post('/nestings', [GeneralController::class,'getNestings'])->name('general.nestings');
    Route::post('/grn_numbers', [GeneralController::class,'getGrns'])->name('general.grns');
    Route::post('/nesting_sequences', [GeneralController::class,'getNestingSequences'])->name('general.nesting_sequences');
    Route::post('/nesting_list', [GeneralController::class,'getNestingList'])->name('general.nesting_list');
    Route::post('/nesting_part_numbers', [GeneralController::class,'getNestingPartNumbers'])->name('general.nesting_part_numbers');
    Route::post('/avaialable_quantity', [GeneralController::class,'getAvailableQuantity'])->name('general.avaialable_quantity');
    Route::resource('part_matrix', PartMatrixController::class);
    Route::resource('store_receive_child_part', StoreReceiveChildPartController::class);
    Route::resource('po_master', PoMasterController::class);
    
});
