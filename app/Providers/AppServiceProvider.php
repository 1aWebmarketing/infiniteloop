<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\User;
use App\Models\Project;
use App\Models\Item;

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
        Gate::define('admin', function(){
            return auth()->user()->is_admin === 1;
        });
        Gate::define('edit-project', function(User $user, Project $project){
            return auth()->user()->is_admin === 1 || $project->user_id == auth()->id();
        });
        Gate::define('edit-item', function(User $user, Item $item){
            return auth()->user()->is_admin === 1 || $item->user_id == auth()->id();
        });
    }
}
