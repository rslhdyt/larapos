<?php
namespace Deployer;

require 'recipe/laravel.php';

// Project name
set('application', 'larapos');

// Project repository
set('repository', 'git@github.com:rslhdyt/larapos.git');

// [Optional] Allocate tty for git clone. Default value is false.
set('git_tty', true);

// Shared files/dirs between deploys
add('shared_files', []);
add('shared_dirs', []);

// Writable dirs by web server
add('writable_dirs', []);

// Hosts
host('sandbox.web.id')
    ->user('app')
    ->forwardAgent()
    ->stage('sandbox')
    ->set('composer_options', '{{composer_action}} --verbose --prefer-dist --no-progress --no-interaction --optimize-autoloader')
    ->set('deploy_path', '~/htdocs/{{application}}');
    
// Tasks
task('php-fpm:restart', function () {
    // The user must have rights for restart service
    // /etc/sudoers: username ALL=NOPASSWD:/bin/systemctl restart php-fpm.service
    run('sudo /etc/init.d/php7.2-fpm restart');
});
after('deploy:symlink', 'php-fpm:restart');

task('build', function () {
    run('cd {{release_path}} && build');
});

// [Optional] if deploy fails automatically unlock.
after('deploy:failed', 'deploy:unlock');

// Migrate database before symlink new release.

before('deploy:symlink', 'artisan:migrate');
