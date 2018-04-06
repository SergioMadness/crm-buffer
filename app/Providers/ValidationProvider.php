<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;

class ValidationProvider extends ServiceProvider
{
    public function boot()
    {
        Validator::extend('equal', function ($attribute, $value, $parameters, $validator) {
            return $value === $parameters;
        });
    }
}
