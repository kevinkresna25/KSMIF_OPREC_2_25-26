<?php

namespace App\Providers;

use App\Models\TeamSubmission;
use App\Observers\TeamSubmissionObserver;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Register observers
        TeamSubmission::observe(TeamSubmissionObserver::class);

        // Prevent lazy loading in development
        Model::preventLazyLoading(!$this->app->isProduction());

        // Prevent silently discarding attributes
        Model::preventSilentlyDiscardingAttributes(!$this->app->isProduction());

        // Prevent accessing missing attributes
        Model::preventAccessingMissingAttributes(!$this->app->isProduction());

        // Implicitly grant "Super Admin" role all permissions
        Gate::before(function ($user, $ability) {
            return $user->isOperator() ? true : null;
        });
    }
}
