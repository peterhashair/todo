<?php

namespace App\Providers;

use App\Observers\AssignObserver;
use App\Observers\TaskObserver;
use App\Task;
use App\TaskToUser;
use Illuminate\Support\ServiceProvider;

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
        // do the log start observe class watch the changes
        Task::observe(TaskObserver::class);
        TaskToUser::observe(AssignObserver::class);
    }
}
