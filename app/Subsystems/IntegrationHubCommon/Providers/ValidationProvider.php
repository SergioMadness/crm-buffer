<?php

namespace App\Subsystems\IntegrationHubCommon\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;

class ValidationProvider extends ServiceProvider
{
    public function boot(): void
    {
        Validator::extend('equal', function ($attribute, $value, $parameters, $validator) {
            return $value === $parameters;
        });
    }
}
