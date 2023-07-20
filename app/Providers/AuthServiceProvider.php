<?php

namespace App\Providers;

use App\Models\Admin\Category;
use App\Models\Admin\Post;
use App\Models\Role;
use App\Policies\CategoryPolicy;
use App\Policies\PostPolicy;
use App\Policies\RolePolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
        Post::class => PostPolicy::class,
        Category::class => CategoryPolicy::class,
        Role::class => RolePolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('isAuthor', function ( $user) {
            return $user->role->name == 'author';
        });

        Gate::define('isAdmin', function ( $user) {
            return $user->role->name == 'admin';
        });

        Gate::define('isUser', function ( $user) {
            return $user->role->name == 'user';
        });

        Gate::define('isManager', function ( $user) {
            return $user->role->name == 'manager';
        });
    }
}
