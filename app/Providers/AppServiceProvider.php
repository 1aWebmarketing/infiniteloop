<?php

namespace App\Providers;

use App\Models\Item;
use App\Models\Project;
use App\Models\User;
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
        Gate::define('admin', function () {
            $user = auth()->user();

            return $user && $user->currentTeam && $user->id === $user->currentTeam->user_id;
        });

        Gate::define('edit-project', function (User $user, Project $project) {
            return ($user->currentTeam && $user->id === $user->currentTeam->user_id) || $project->user_id == $user->id;
        });

        Gate::define('edit-item', function (User $user, Item $item) {
            return ($user->currentTeam && $user->id === $user->currentTeam->user_id) || $item->user_id == $user->id;
        });
    }
}
