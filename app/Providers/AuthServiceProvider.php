<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Models\Contact;
use App\Models\User;
use App\Models\Todo;
use App\Policies\TodoPolicy;
use Illuminate\Auth\Access\Response;
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
        Todo::class => TodoPolicy::class
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        Gate::define('get-contact', function (User $user, Contact $contact) {
            return $user->id === $contact->user_id;
        });

        Gate::define('update-contact', function (User $user, Contact $contact) {
            return $user->id === $contact->user_id;
        });

        Gate::define('delete-contact', function (User $user, Contact $contact) {
            return $user->id === $contact->user_id;
        });

        Gate::define('create-contact', function (User $user) {
            if ($user->name === 'admin') {
                return  Response::allow();
            } else {
                return Response::deny('you are not admin');
            }
        });
    }
}
