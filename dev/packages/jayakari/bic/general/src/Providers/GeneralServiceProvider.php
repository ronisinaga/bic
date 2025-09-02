<?php
/**
 * Created by PhpStorm.
 * User: Roni Sinaga
 * Date: 11/23/2017
 * Time: 4:06 AM
 */

namespace jayakari\bic\general\Providers;
use Illuminate\Support\ServiceProvider;

/*
 * AdminServiceProvider Class
 */
class GeneralServiceProvider extends ServiceProvider{

    /*
     * Bootstrap the application services
     * @return void
     */
    public function boot(){
        $this->loadRoutesFrom(__DIR__.'/../routes.php');
        $this->loadViewsFrom(__DIR__.'/../Views','jayakari.bic.general');
    }

    /*
     * Register the application services
     * @return void
     */
    public function register(){

    }
}