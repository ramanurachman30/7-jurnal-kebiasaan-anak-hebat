<?php

use App\Http\Controllers\Api\ApiGlobalController;
use App\Http\Controllers\Api\ApiUserController;
use App\Http\Controllers\Api\ComponentController;
use App\Http\Controllers\Api\GoogleAnalitycController;
use App\Http\Controllers\Api\HelperController;
use App\Http\Controllers\Api\PKMStudentHabitsController;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
// Select2 Ajax
Route::controller(HelperController::class)->group(function () {
    Route::get('/get_provinces/{keyword?}', 'getProvince')->name('getProvince.data');
});

Route::middleware(['auth:sanctum'])->group(function () {
    Route::controller(GoogleAnalitycController::class)
        ->prefix('google_analytics')
        ->name('googl\e_analytics.')
        ->group(function () {
            Route::get('', 'report')->name('report');
            Route::get('/top_refferrers', 'topRefferrers')->name('top_refferrers');
            Route::get('/most_visited_page', 'mostVistedPages')->name('most_visited_pages');
        });

    Route::controller(ComponentController::class)->group(function () {
        Route::post('/select2ajax/{model}/{key}/{display}', 'select2')->name('select2.data');
        Route::get('/sysparam/{group}/{display}', 'sysparam')->name('sysparam.data');
        Route::post('/file_upload', 'file_upload')->name('file.upload');
        Route::post('/delete_file', 'deleteFile')->name('delete.file');
    });

    Route::controller(ApiUserController::class)->prefix('user')->name('user.')->group(function () {
        Route::get('/user', function (Request $request) {
            return $request->user();
        });
        Route::put('/{id}/activation/{status}', 'activation')->name('activation');
    });

    Route::controller(PKMStudentHabitsController::class)->prefix('p_k_m_student_habits')->name('p_k_m_student_habits.')->group(function () {
        Route::post('/datatable', 'dataTable')->name('datatable');
        Route::get('/check-today', 'checkToday')->name('check-today');
    });

    // custom api global controller for user
    Route::controller(ApiGlobalController::class)->prefix('user')->name('user.')->group(function () {
        Route::post('/datatable', 'dataTableUser')->name('datatable');
    });
    Route::controller(ApiGlobalController::class)->prefix('admin/invitation')->name('event.')->group(function () {
        Route::post('/datatable', 'dataTableEventGuest')->name('datatable');
    });

    Route::controller(ApiGlobalController::class)->prefix('admin/{collection}')->name(request()->segment(3) . '.')->group(function () {
        Route::post('/datatable', 'dataTable')->name('datatable');
        Route::get('/datatable_iipc', 'dataTableIipc')->name('datatable_iipc');
        Route::get('/check-today', 'checkToday')->name('check-today');

        Route::post('/{id}', 'delete')->name('delete');
        Route::post('/{id}/trash', 'trash')->name('trash');
        Route::put('/{id}/restore', 'restore')->name('restore');
        Route::get('/check-slug', 'checkSlug')->name('check-slug');
        Route::get('/{id}', 'detail')->name('detail');
    });
});
