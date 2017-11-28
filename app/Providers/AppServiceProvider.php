<?php

namespace App\Providers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Schema;
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
        Schema::defaultStringLength(191);

        ## Validation rule that fails if an element has been trashed
        Validator::extend('reject_soft_deleted', function($attribute, $value, $params, $validator) {
            $primaryKey = isset($params[1]) ? $params[1] : 'id';
            $entry = DB::table($params[0])
                        ->where($primaryKey, $value)
                        ->whereNull('deleted_at')
                        ->first();
            return (boolean) $entry;
        });

        \Shippo::setApiKey(env('SHIPPO_API_KEY'));
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
