<?php namespace App\Subsystems\IntegrationHub\Providers;

use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider;
use App\Subsystems\IntegrationHub\Services\Navigator;
use App\Subsystems\IntegrationHub\Services\RequestValidation;
use App\Subsystems\IntegrationHub\Repositories\UserRepository;
use App\Subsystems\IntegrationHub\Http\Middleware\Authenticate;
use App\Subsystems\IntegrationHub\Http\Middleware\CorsMiddleware;
use App\Subsystems\IntegrationHub\Interfaces\Services\Navigation;
use App\Subsystems\IntegrationHub\Http\Middleware\ApiAuthenticate;
use App\Subsystems\IntegrationHub\Repositories\ApplicationRepository;
use App\Subsystems\IntegrationHub\Interfaces\Repositories\UserRepository as IUserRepository;
use App\Subsystems\IntegrationHub\Interfaces\Services\RequestValidation as IRequestValidation;
use App\Subsystems\IntegrationHub\Interfaces\Repositories\ApplicationRepository as IApplicationRepository;

class IntegrationHubProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->register(EventServiceProvider::class);
        $this->app->singleton(Navigation::class, Navigator::class);
        $this->app->singleton(IApplicationRepository::class, ApplicationRepository::class);
        $this->app->singleton(IRequestValidation::class, RequestValidation::class);
        $this->app->singleton(IUserRepository::class, function () {
            return new UserRepository(config('ihub.login', ''), config('ihub.password', ''));
        });
    }

    public function boot(Router $router): void
    {
        $router->pushMiddlewareToGroup('api', CorsMiddleware::class);

        $router->aliasMiddleware('b2bAuth', ApiAuthenticate::class);
        $router->aliasMiddleware('auth', Authenticate::class);

        $this->loadRoutesFrom(__DIR__ . '/../routes/web.php');
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
        $this->loadTranslationsFrom(__DIR__ . '/../resources/lang', 'IntegrationHub');

        /** @var Navigation $navigationService */
        $navigationService = app(Navigation::class);
        $navigationService->register('Settings', 'Приложения', '/index.html');
    }
}