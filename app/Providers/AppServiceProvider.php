<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Dusterio\LumenPassport\LumenPassport;
use Laravel\Passport\Passport;
use Carbon\Carbon;
use Folklore\GraphQL\GraphQL;

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
     * Boot the authentication services for the application.
     *
     * @return void
     */
    public function boot()
    {
        // TODO: EMAIL support.
        // $this->registerMailService();
        // $this->app->singleton('graphql', function ($app) {
        //         $graphql = new GraphQL($app);
        //         return $graphql;
        //     });

        LumenPassport::routes($this->app, ['prefix' => 'api/oauth']);
        LumenPassport::allowMultipleTokens();
        LumenPassport::tokensExpireIn(Carbon::now()->addDays(2));
        Passport::refreshTokensExpireIn(Carbon::now()->addDays(10));
    }

    /**
     * Register the Client service.
     *
     * @return void
     */
    protected function registerMailService()
    {
      $this->app->singleton('mailer', function ($app) {
          $app->configure('mail');
          return $app->loadComponent('mail', 'Illuminate\Mail\MailServiceProvider', 'mailer');
      });
    }
}
