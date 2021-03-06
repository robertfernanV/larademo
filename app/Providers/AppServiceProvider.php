<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\SocialUserResolver;
use Coderello\SocialGrant\Resolvers\SocialUserResolverInterface;

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

    /*protected $policies = [
        'App\Model' => 'App\Polices\ModelPolicy'
    ];*/

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        
    }

    public $bindings = [
        SocialUserResolverInterface::class => SocialUserResolver::class,
    ];
}
