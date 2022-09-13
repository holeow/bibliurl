<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Models\Bookmark;
use App\Models\Folder;
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
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('access-folder', function(User $user,Folder $folder){
                return $user->id === $folder->WebUser;
        });
        Gate::define('access-bookmark', function(User $user, Bookmark $book){
            return $user->id === $book->folder()->first()->WebUser;
        });

        //
    }
}
