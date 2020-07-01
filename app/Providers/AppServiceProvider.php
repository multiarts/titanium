<?php

namespace App\Providers;

use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Schema;
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
    $this->app->singleton(\Faker\Generator::class, function () {
      return \Faker\Factory::create('pt_BR');
    });
  }

  /**
   * Bootstrap any application services.
   *
   * @return void
   */
  public function boot()
  {
    Route::resourceVerbs([
      'create' => 'novo',
      'edit' => 'editar',
    ]);

    Schema::defaultStringLength(191);

    if (config('app.env') === 'production') {
      URL::forceScheme('https');
    }
  }
}
