<?php

namespace Deployer;

require 'recipe/common.php';

// Config

set('git_tty', true);
set('git_ssh_command', 'ssh'); // Fix unsupported option "accept-new" (OpenSSH version older than v7.6)

set('repository', 'git@github.com:mgkprod/magenta-machine');

// Hosts

host('o2switch')
    ->set('remote_user', 'mgkprod')
    ->set('deploy_path', '~/magenta-machine.mgk.dev')
    ->setLabels(['env' => 'production']);

// Hooks

task('npm:ci', function () {
    cd('{{release_path}}');
    run('npm ci');
});

task('npm:build', function () {
    cd('{{release_path}}');
    run('npm run build');
});

after('deploy:writable', 'npm:ci');
after('npm:ci', 'npm:build');
after('deploy:failed', 'deploy:unlock');
