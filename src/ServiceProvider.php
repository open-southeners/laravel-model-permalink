<?php

namespace OpenSoutheners\LaravelModelPermalink;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider as BaseServiceProvider;
use OpenSoutheners\LaravelModelPermalink\Controllers\ModelPermalinkController;

class ServiceProvider extends BaseServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Route::group([
            'as' => 'model_permalinks.',
            'prefix' => config('model-permalink.path', 'permalinks'),
            'middleware' => config('model-permalink.middleware', ['web', 'auth']),
        ], function () {
            Route::get('{model_permalink}', ModelPermalinkController::class)->name('show');
        });

        $this->publishes([
            __DIR__.'/../database/migrations' => database_path('migrations'),
        ], 'migrations');

        $this->publishes([
            __DIR__.'/../config/model-permalink.php' => config_path('model-permalink.php'),
        ], 'config');

        Gate::define('viewModelPermalink', function (?User $user, Model $model) {
            return true;
        });
    }
}
