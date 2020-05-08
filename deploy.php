<?php

namespace Deployer;

use Deployer\Utility\Httpie;

require 'recipe/common.php';
require 'recipe/laravel.php';

// Project name
set('application', 'integration-hub');

// Project repository
set('repository', 'https://lab.systembox.org/lms/crm-buffer.git');

// [Optional] Allocate tty for git clone. Default value is false.
set('git_tty', true);

// Shared files/dirs between deploys 
add('shared_files', ['.env']);
add('shared_dirs', ['storage']);

// Writable dirs by web server 
add('writable_dirs', []);


// Hosts

host('prod')
    ->hostname('94.130.248.10')
    ->set('branch', 'develop')
    ->user('deploy')
    ->port(2022)
    ->set('deploy_path', '/var/www/dev_buffer');

// Tasks
set('composer_options', 'install --verbose');

task('build', function () {
    run('cd {{release_path}} && build');
});

task('artisan:config:cache', function () {
});
task('artisan:optimize', function () {
});

// [Optional] if deploy fails automatically unlock.
after('deploy:failed', 'deploy:unlock');

// Migrate database before symlink new release.
before('deploy:symlink', 'artisan:migrate');

