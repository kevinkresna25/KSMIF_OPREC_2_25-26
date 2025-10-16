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

        // Custom route model binding for team submissions
        // This ensures that when a team tries to access a submission,
        // it will only find submissions that belong to that team
        \Illuminate\Support\Facades\Route::bind('submission', function ($value) {
            // Check if we're in a team context (not operator)
            if (auth()->guard('team')->check()) {
                $team = auth()->guard('team')->user();
                
                // Find submission that belongs to the authenticated team
                $submission = TeamSubmission::where('id', $value)
                    ->where('team_id', $team->id)
                    ->first();
                    
                if (!$submission) {
                    abort(404, 'Submission tidak ditemukan atau bukan milik tim Anda.');
                }
                
                return $submission;
            }
            
            // For operators or other contexts, find submission normally
            return TeamSubmission::findOrFail($value);
        });
    }
}
