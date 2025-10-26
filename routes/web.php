<?php

use App\Http\Controllers\Api\GoogleAnalitycController;
use App\Http\Controllers\AppController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\ErrorControler;
use App\Http\Controllers\EventController;
use App\Http\Controllers\FileUploadController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\PKMStudentHabitsController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SitemapController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VocabulariesController;
use App\Routes\WebRouteNames;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;
use Stevebauman\Location\Facades\Location;

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

Route::get("/tailwind-test", function () {
    return view("tailwind-test");
});

Route::get("/", function () {
    return view("auth.login");
});

Route::get('/register', function () {
    return view('auth.register-murid');
});

Route::post('/register', [RegisteredUserController::class, 'store'])->name('register');

Route::controller(ErrorControler::class)->prefix('error')
    ->name('errors')
    ->prefix('error')
    ->group(function () {
        Route::get('/404', 'error404')->name('error-404');
    });

Route::get('/storagelink', function () {
    $exitCode = Artisan::call('storage:link', []);
    echo $exitCode;
});

Route::get('/composerUpdate', function () {
    $exitCode = Artisan::call('composer update', []);
    echo $exitCode;
});

Route::get('/migrate', function () {
    $exitCode = Artisan::call('migrate', []);
    echo $exitCode;
});

Route::get('/migrate_refresh', function () {
    $exitCode = Artisan::call('migrate:refresh', []);
    echo $exitCode;
});

Route::get('/migrate_fresh', function () {
    $exitCode = Artisan::call('migrate:fresh', []);
    echo $exitCode;
});

Route::get('/seed', function () {
    $exitCode = Artisan::call('db:seed', []);
    echo $exitCode;
});

Route::get('/clear_cache', function () {
    $clearCache = Artisan::call('cache:clear', []);

    return redirect()->back()->with('success', 'All cache has cleared !');
});

Route::get('/geoloaction', function () {
    $ip = request()->ip();
    $location = Location::get($ip);
    if (!$location) return "EN";
    return $location->countryCode;
});


Route::get('/home', function () {
    $page = cache()->remember('home-page', env('CACHE_TIME'), function () {
        $cachedPage = view('web.home')->render();
        return $cachedPage;
    });

    return $page;
});


require __DIR__ . '/auth.php';
require __DIR__ . '/pages.php';

Route::get('/wbs', function () {
    return view('web.wbs.wbs');
});

Route::get('lang/{lang}', [LanguageController::class, 'switchLang']);
Route::get('changelang/{lang}', [LanguageController::class, 'chageLanguage']);

Route::middleware(['auth'])->prefix('admin')->group(function () {
    Route::middleware(['verified'])->group(function () {
        Route::get('/dashboard', function () {
            return view('dashboard');
        })->name('dashboard');

        Route::get('/statistic', function () {
            return view('statistic');
        })->name('statistic');

        Route::post('/upload_file', [FileUploadController::class, 'file_upload'])->name('uploadfile');
    });



    Route::middleware(['user.access'])->group(function () {
        // Route::controller(PKMStudentHabitsController::class)->prefix('student_habits')->name('student_habits.')->group(function () {
        //     Route::get('/', 'list')->name('list');
        //     Route::get('/create', 'create')->name('create');
        //     Route::post('/', 'store')->name('store');
        //     Route::get('/{id}/edit', 'edit')->name('edit');
        //     Route::put('/{id}', 'update')->name('edit');
        // });
        Route::controller(GoogleAnalitycController::class)->prefix('google-analytic')->group(function () {
            Route::get('/visitors-and-page-views-by-date', 'index')->name('visitors-and-page-views-by-date');
            Route::get('/top-refferrers', 'topRefferrersIndex')->name('top-refferrers');
            Route::get('/most-visited-page', 'mostVisitedPageIndex')->name('most-visited-pages');
        });

        Route::controller(UserController::class)->prefix('user')->name('user.')->group(function () {
            Route::put('/update_password', 'update_password')->name('update_password');
            Route::post('/update_profile', 'postProfile')->name(WebRouteNames::USER_UPDATE_PROFILE);
            Route::get('/', 'list')->name('list');
            Route::post('/', 'store')->name('create');
            Route::put('/{id}/activation/{status}', 'activation')->name(WebRouteNames::USER_ACTIVATION);
            Route::put('/{id}', 'update')->name('edit');
            Route::get('/profile', 'profile')->name('profile');
            Route::get('/update_profile', 'updateProfile')->name(WebRouteNames::USER_UPDATE_PROFILE_GET);
            Route::get('/reset_password', 'reset_password')->name('reset_password');
            Route::get('/trashed', 'trashed')->name('trashed');
        });

        // Roles
        Route::controller(RoleController::class)->prefix('roles')->name('roles.')->group(function () {
            Route::get('/{id}/edit', 'edit')->name(WebRouteNames::ROLES_EDIT);
            Route::put('/{id}', 'update')->name(WebRouteNames::ROLES_UPDATE);
            Route::get('/create', 'create')->name(WebRouteNames::ROLES_CREATE);
            Route::post('/', 'store')->name(WebRouteNames::ROLES_STORE);
        });

        Route::prefix('vocabularies')->group(function () {
            Route::post('/generate-language', [VocabulariesController::class, 'generateLanguage'])->name('vocabularies.generate-language');
        });

        Route::controller(EventController::class)
        ->prefix('event')
        ->name('event.')
        ->group(function () {
            // Route::get('/', 'list')->name('list');
            Route::get('/create', 'create')->name('create');
            Route::put('/{id}', 'update')->name('update');
            Route::get('/{id}/edit', 'edit')->name('edit');
            Route::post('/', 'store')->name('create');
            Route::get('/{id}/guest', 'guest')->name('guest');
            Route::put('/{id}/present', 'present')->name('event.present');
            Route::get('/{id}/listener', 'listener')->name('event.listener');
            Route::get('/{id}/attandance', 'attandance')->name('attandance');
            Route::get('/{id}/invitation', 'invitation')->name('invitation');
            Route::post('/{eventId}/invitation', 'import')->name('invitation.import');
        });

        Route::controller(PKMStudentHabitsController::class)
        ->prefix('p_k_m_student_habits')
        ->name('p_k_m_student_habits.')
        ->group(function () {
            Route::get('/', 'list')->name('list');
            Route::get('/create', 'create')->name('create');
            Route::post('/', 'store')->name('store');
            Route::get('/{id}/edit', 'edit')->name('edit');
            Route::put('/{id}', 'update')->name('edit');
        });

        // If you want to custom, please write above
        Route::controller(AppController::class)->prefix('{collection}')->name(request()->segment(2) . '.')->group(function () {
            Route::get('/', 'list')->name(WebRouteNames::COLLECTION_LIST);
            Route::get('/create', 'create')->name(WebRouteNames::COLLECTION_CREATE);
            Route::post('/', 'store')->name(WebRouteNames::COLLECTION_STORE);
            Route::get('/{id}/edit', 'edit')->name(WebRouteNames::COLLECTION_EDIT);
            Route::put('/{id}', 'update')->name(WebRouteNames::COLLECTION_UPDATE);
            Route::get('/{id}/detail', 'detail')->name(WebRouteNames::COLLECTION_DETAIL);
            Route::post('/{id}', 'delete')->name(WebRouteNames::COLLECTION_DELETE);
            Route::put('/{id}/trash', 'trash')->name(WebRouteNames::COLLECTION_TRASH);
            Route::get('/trashed', 'trashed')->name(WebRouteNames::COLLECTION_TRASHED);
            Route::put('/{id}/restore', 'restore')->name(WebRouteNames::COLLECTION_RESTORE);
        });
    });
});
