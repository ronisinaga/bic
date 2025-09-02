<?php
/**
 * Created by PhpStorm.
 * User: Roni Sinaga
 * Date: 11/17/2017
 * Time: 2:36 AM
 */

namespace jayakari\bic\admin\Providers;
use Illuminate\Support\ServiceProvider;

/*
 * AdminServiceProvider Class
 */
class AdminServiceProvider extends ServiceProvider{

    /*
     * Bootstrap the application services
     * @return void
     */
    public function boot(){
        $this->loadRoutesFrom(__DIR__.'/../routes.php');
        $this->loadViewsFrom(__DIR__.'/../Views','jayakari.bic.admin');
    }

    /*
     * Register the application services
     * @return void
     */
    public function register(){

    }
}