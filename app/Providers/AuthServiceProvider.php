<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Notifications\Messages\MailMessage;


class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
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
        
 ResetPassword::toMailUsing(function($notifiable, $token) {
            $email = $notifiable->getEmailForPasswordReset();

            
            $emailResetUrl = url(route('password.reset', [
                    'token' => $token,
                    'email' => $email,
                ], false));
            
            // this is where you generate your own email
            return (new MailMessage)
                ->subject('Password Reset Link')
                ->view('auth.template', [
                    'url' => $emailResetUrl
                ]);
        });  //
    }
}
