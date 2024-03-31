<?php

use Illuminate\Console\Command;
use Gedachtegoed\Workspace\Core\Builder;
use Gedachtegoed\Workspace\Integrations\Pint\Pint;
use Gedachtegoed\Workspace\Integrations\TLint\TLint;
use Gedachtegoed\Workspace\Integrations\Composer\Aliases;
use Gedachtegoed\Workspace\Integrations\Larastan\Larastan;
use Gedachtegoed\Workspace\Integrations\IDEHelper\IDEHelper;
use Gedachtegoed\Workspace\Integrations\Workflows\Workflows;
use Gedachtegoed\Workspace\Integrations\PHPCSFixer\PHPCSFixer;
use Gedachtegoed\Workspace\Integrations\PrettierBlade\PrettierBlade;
use Gedachtegoed\Workspace\Integrations\EditorDefaults\EditorDefaults;
use Gedachtegoed\Workspace\Integrations\PHPCodeSniffer\PHPCodeSniffer;

return [
    EditorDefaults::class,
    PHPCodeSniffer::class,
    PrettierBlade::class,
    PHPCSFixer::class,
    IDEHelper::class,
    Workflows::class,
    Larastan::class,
    Aliases::class,
    TLint::class,
    Pint::class,

    Builder::make()
        // Register composer dependencies
        ->composerRequireDev('laravel/telescope:^4')
        ->composerUpdate('laravel/telescope')

        // Hook into afterInstall to configure Telescope
        ->afterInstall(function (Command $command) {
            $command->call('telescope:install');
            $command->call('artisan migrate');

            // NOTE: You can use Laravel Prompts in here to make anything interactive
        }),
];
