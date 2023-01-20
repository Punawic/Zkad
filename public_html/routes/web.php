<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CashflowController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\CampaignController;
use App\Http\Controllers\SalesController;
use App\Http\Controllers\AdvertisingController;
use App\Http\Controllers\DeliveryController;
use App\Http\Controllers\ShippingController;
use App\Http\Controllers\PercentController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\IncomeController;


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
Route::get('/storage-path',function(){
    
    \Artisan::call('storage:link');
});


Route::get('/', function () {
    return redirect('/login');
});

Route::resource('dashboard/cashflow',CashflowController::class);
Route::get('dashboard/cashflow/destroy/{id}',[CashflowController::class,'destroy'])->name('cashflow.destroy');

Route::resource('dashboard/page',PageController::class);
Route::get('dashboard/page/destroy/{id}',[PageController::class,'destroy'])->name('page.destroy');

Route::resource('dashboard/campaign',CampaignController::class);
Route::get('dashboard/campaign/destroy/{id}',[CampaignController::class,'destroy'])->name('campaign.destroy');

Route::resource('dashboard/sales',SalesController::class);
Route::get('dashboard/sales/destroy/{id}',[SalesController::class,'destroy'])->name('sales.destroy');


Route::resource('dashboard/advertising',AdvertisingController::class);
Route::get('dashboard/advertising/destroy/{id}',[AdvertisingController::class,'destroy'])->name('advertising.destroy');


Route::resource('dashboard/delivery',DeliveryController::class);
Route::get('dashboard/delivery/destroy/{id}',[DeliveryController::class,'destroy'])->name('delivery.destroy');

Route::resource('dashboard/shipping',ShippingController::class);
Route::get('dashboard/shipping/destroy/{id}',[ShippingController::class,'destroy'])->name('shipping.destroy');

Route::resource('dashboard/income',IncomeController::class);
Route::get('dashboard/income/destroy/{id}',[IncomeController::class,'destroy'])->name('income.destroy');

Route::resource('dashboard/percent',PercentController::class);
Route::post('dashboard/percent-by-page/store',[PercentController::class,'percentByPageStore'])->name('percent.page.store');
Route::get('dashboard/percent/destroy/{id}',[PercentController::class,'destroy'])->name('percent.destroy');
Route::get('dashboard/percent/destroy-by-day/{id}',[PercentController::class,'destroyByDay'])->name('percent.destroyByDay');
Route::get('dashboard/percent-by-page/',[PercentController::class,'percentByPagesearch'])->name('percent.page.search');

// Route::get('dashboard/percent/page',[PercentController::class,'pageIndex'])->name('percent.page.index');

Route::resource('dashboard/users',UserController::class);
Route::get('dashboard/users/destroy/{id}',[UserController::class,'destroy'])->name('users.destroy');


Route::get('dashboard/setting',[SettingController::class,'index'])->name('setting.index');
Route::post('dashboard/setting/update',[SettingController::class,'update'])->name('setting.update');
Route::post('dashboard/setting/password/update',[SettingController::class,'updatePassword'])->name('setting.password');

Auth::routes();

Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');


Route::get('logout',function(){
    Auth::logout();
    return redirect('login');
})->name('logout');

Route::post('/sales/export', [SalesController::class, 'export_excel'])->name('sales.export_excel');

Route::post('/percent_days/export', [PercentController::class, 'export_excel'])->name('percent_days.export_excel');

Route::post('/percent_pages/export', [PercentController::class, 'export_excel1'])->name('percent_pages.export_excel');

Route::post('/advertising/export', [AdvertisingController::class, 'export_excel'])->name('advertising.export_excel');

Route::post('/cashflow/export', [CashflowController::class, 'export_excel'])->name('cashflow.export_excel');

Route::post('/shipping/export', [ShippingController::class, 'export_excel'])->name('shipping.export_excel');

Route::post('/income/export', [IncomeController::class, 'export_excel'])->name('income.export_excel');