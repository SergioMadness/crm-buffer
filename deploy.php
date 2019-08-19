<?php

namespace Deployer;

use Dotenv\Dotenv;
use Deployer\Utility\Httpie;

require 'recipe/common.php';
require 'recipe/laravel.php';

$dotenv = new Dotenv(__DIR__);
$dotenv->load();

// Project name
set('application', 'integration-hub');

// Project repository
set('repository', getenv('DEPLOY_REPOSITORY'));

// [Optional] Allocate tty for git clone. Default value is false.
set('git_tty', true);

// Shared files/dirs between deploys 
add('shared_files', ['.env']);
add('shared_dirs', ['storage', 'config']);

// Writable dirs by web server 
add('writable_dirs', []);

//Configuration Rollbar report
set('rollbar_token', getenv('ROLLBAR_TOKEN'));
set('rollbar_comment', '_{{user}}_ deploying `{{branch}}` to *{{target}}*');
set('rollbar_username', getenv('ROLLBAR_USERNAME'));


// Hosts

host('prod')
    ->hostname(getenv('DEPLOY_HOST'))
    ->user(getenv('DEPLOY_USER'))
    ->port(getenv('DEPLOY_PORT'))
    ->set('deploy_path', getenv('DEPLOY_PATH'));

host('dev')
    ->hostname(getenv('DEV_DEPLOY_HOST'))
    ->user(getenv('DEV_DEPLOY_USER'))
    ->port(getenv('DEV_DEPLOY_PORT'))
    ->set('deploy_path', getenv('DEV_DEPLOY_PATH'));

// Tasks
set('composer_options', 'install --verbose');

//Rollbar report process
task('rollbar:notify', function () {
    if (!get('rollbar_token', false)) {
        return;
    }
    $params = [
        'access_token'     => get('rollbar_token'),
        'environment'      => get('target'),
        'revision'         => runLocally('git log -n 1 --format="%h"'),
        'local_username'   => get('user'),
        'rollbar_username' => get('rollbar_username'),
        'comment'          => get('rollbar_comment'),
    ];
    Httpie::post('https://api.rollbar.com/api/1/deploy/')->form($params)->send();
})->onHosts('prod')->once()->shallow()->setPrivate();

task('build', function () {
    run('cd {{release_path}} && build');
});

task('artisan:config:cache', function () {
});
task('artisan:optimize', function () {
});

// [Optional] if deploy fails automatically unlock.
after('deploy:failed', 'deploy:unlock');

//Rollbar report notify
after('deploy', 'rollbar:notify');

// Migrate database before symlink new release.
before('deploy:symlink', 'artisan:migrate');

