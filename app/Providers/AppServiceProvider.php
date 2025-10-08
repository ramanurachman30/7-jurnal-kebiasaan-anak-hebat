<?php

namespace App\Providers;

use App\Observers\EventObserver;
use App\Observers\FileUploadObserver;
use App\Observers\InputRepeaterObserver;
use App\Observers\OwnersObserver;
use App\Observers\TrancientObserver;
use App\Observers\UsersObserver;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $segment = request()->segment(2);

        if (file_exists(app_path('Models/' . Str::studly($segment)) . '.php')) {
            $model = app("App\Models\\" . Str::studly($segment));
            if ($segment == 'user') {
                $model::observe(UsersObserver::class);
            }else if($segment == 'event'){
                $model::observe([
                    OwnersObserver::class,
                    TrancientObserver::class,
                    EventObserver::class
                    // InputRepeaterObserver::class,
                ]);
            }
            else {
                $model::observe([
                    OwnersObserver::class,
                    FileUploadObserver::class,
                    TrancientObserver::class,
                    // InputRepeaterObserver::class,
                ]);
            }
        }

        if(!empty($_ENV['HTTP_X_SCHEME'])){
            if($_ENV['HTTP_X_SCHEME'] == 'https'){
                URL::forceScheme('https');
            }
        }


        Validator::extend('webp', function ($attribute, $value, $parameters, $validator) {
            $mimeType = $value->getClientMimeType();
            if ($mimeType !== 'image/webp') {
                return false;
            }
            return true;
        }, 'The :attribute must be a valid webp image.');
        Blueprint::macro('owners', function () {
            $this->unsignedBigInteger('created_by')->nullable();
            $this->unsignedBigInteger('updated_by')->nullable();
            $this->timestamps();
            $this->softDeletes();
        });
    }
}
