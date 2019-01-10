<?php

namespace App\Providers;

use HMS\Auth\PasswordStore;
use HMS\Auth\PasswordStoreManager;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // helper for formatting pennies
        \Blade::directive('format_pennies', function ($pennies) {
            return "<?php setlocale(LC_MONETARY, 'en_GB.UTF-8'); echo money_format('%n', ($pennies)/100); ?>";
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(PasswordStore::class, function ($app) {
            $passwordStoreManager = new PasswordStoreManager($app);

            return $passwordStoreManager->driver();
        });
    }
}
