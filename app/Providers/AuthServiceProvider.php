<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Models\idea;
use App\Models\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        // Gate::define('admin', function (): bool {
        //     return (bool)auth()->user()->id_admin;
        // });
        // Gate::define('idea.delete', function (User $user, idea $idea): bool {
        //     return ((bool)auth()->user()->id_admin|| auth()->id() === $idea->user_id);
        // });
        // Gate::define('idea.update', function (User $user, idea $idea): bool {
        //     return ((bool)auth()->user()->id_admin || auth()->id() === $idea->user_id);
        // });
    }
}
