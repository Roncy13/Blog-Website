<?php
namespace App\Providers;
use Laravel\Passport\Passport; 
use Illuminate\Support\Facades\Gate; 
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

use App\Policies\CategoryPolicy;
use App\Policies\MediaPolicy;
use App\Policies\PostMediaPolicy;

class AuthServiceProvider extends ServiceProvider 
{ 
    /** 
     * The policy mappings for the application. 
     * 
     * @var array 
     */ 
    protected $policies = [
        \App\Post::class => App\Policies\PostPolicy::class, 
        \App\Models\Category::class => CategoryPolicy::class,
        \App\Models\Media::class => MediaPolicy::class,
        \App\Models\PostMedia::class => PostMediaPolicy::class
    ];
/** 
     * Register any authentication / authorization services. 
     * 
     * @return void 
     */ 
    public function boot() 
    { 
        $this->registerPolicies(); 
        
        Passport::routes(); 

        Passport::tokensExpireIn(now()->addDays(15));

        Passport::refreshTokensExpireIn(now()->addDays(30));
    } 
}