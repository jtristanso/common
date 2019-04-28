<?php

namespace Increment\Common\Rating;

use Illuminate\Support\ServiceProvider;

class RatingServiceProvider extends ServiceProvider{

  public function boot(){
    $this->loadMigrationsFrom(__DIR__.'/migrations');
    $this->loadRoutesFrom(__DIR__.'/routes/web.php');
  }

  public function register(){
  }
}