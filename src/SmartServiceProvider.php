<?php
/**
 * Created by PhpStorm.
 * User: MR.Z < zsh2088@gmail.com >
 * Date: 2017/9/28
 * Time: 13:25
 */
namespace Smart;

use App\Service\MerTokenService;
use Illuminate\Support\ServiceProvider;
use Smart\Interfaces\TokenService;

class SmartServiceProvider extends ServiceProvider{

    public function boot(){

        $this->loadViewsFrom( __DIR__.'/../resources/views' ,'backend');

        $this->loadRoutesFrom( __DIR__ . '/../router/routes.php');

        $this->publishes([ __DIR__.'/../config/' => config_path()] , 'backend');

        if(!file_exists(app_path('Http/Controllers/Api/Service'))){
            mkdir(app_path('Http/Controllers/Api/Service') , 0777 ,true);
            chmod(app_path('Http/Controllers/Api/Service') , 0777);
        }

        $this->publishes([ __DIR__.'/../resources/Api' => app_path('Http/Controllers/Api')] , 'backend');

        $this->publishes([ __DIR__.'/../resources/assets/' => public_path('static')] , 'backend');



    }

    public function register(){
        $this->app->singleton( TokenService::class , function($app){
            return new MerTokenService();
        });

        $this->mergeConfigFrom( __DIR__.'/../config/backend.php' ,'backend' );
    }

}

