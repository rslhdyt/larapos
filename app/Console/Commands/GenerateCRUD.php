<?php

namespace App\Console\Commands;

use Artisan;
use Illuminate\Console\Command;

class GenerateCRUD extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'larapos:generate {name} {--m|migration}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $model = studly_case($this->argument('name'));
        $withMigration = ($this->option('migration')) ? true : false;
        $modelPath = sprintf('Models/%s', $model);
        $controllerPath = sprintf('%sController', $model);
        $controllerApiPath = sprintf('Api/%sController', $model);
        $requestPath = sprintf('%sRequest', $model);
        $factoryPath = sprintf('%sFactory', $model);
        $testPath = sprintf('%sTest', $model);
        $viewPath = resource_path('views/' . str_plural(snake_case($model)));

        // create model
        Artisan::call('make:model', [
            'name' => $modelPath,
            '-m' => $withMigration,
        ]);

        // craete controller
        Artisan::call('make:controller', [
            'name' => $controllerPath,
            '--model' => $modelPath,
        ]);
        
        Artisan::call('make:controller', [
            'name' => $controllerApiPath,
            '--model' => $modelPath,
        ]);

        // create request
        Artisan::call('make:request', [
            'name' => $requestPath
        ]);

        // create factory
        Artisan::call('make:factory', [
            'name' => $factoryPath
        ]);

        // create test
        Artisan::call('make:test', [
            'name' => $testPath
        ]);

        // create view folder
        if (!file_exists($viewPath)) {
            mkdir($viewPath, 0755, true);
        }
    }
}
