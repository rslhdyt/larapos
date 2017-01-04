<?php

namespace App\Console\Commands;

use DB;
use File;
use Illuminate\Console\Command;

class LaraposInstaller extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'larapos:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Larapos Installer';

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
        // $applicationName = $this->ask('What is your application name?');

        if ($this->checkInstaller()) {
            $this->generateEnvFile();

            $this->call('key:generate');

            // check database
            if (DB::connection()->getDatabaseName()) {
                $this->info('Database connected');

                $this->info('Start migration and seeder');
                $this->call('migrate');
                $this->call('db:seed');

                $this->info('Installing passport');
                $this->call('passport:install');
            }
        }
    }

    private function checkInstaller()
    {
        if (File::exists('.env')) {
            return $this->confirm('Your environment file already exists, continue instalation (reinstall) ?');
        }

        return true;
    }

    /**
     * generate .env file and fill the value from command.
     */
    private function generateEnvFile()
    {
        // database section
        $databaseDriver = $this->anticipate('Database driver ? (mysql or pgsql)', ['pgsql', 'mysql']);
        $databaseHost = $this->ask('Database host?', 'localhost');
        $databasePort = $this->ask('Database port?', ($databaseDriver == 'pgsql') ? '5432' : '3306');
        $databaseName = $this->ask('Database name?');
        $databaseUser = $this->ask('Database user?');
        $databasePassword = $this->secret('Database password?');

        File::copy('.env.example', '.env');

        $envContents = fopen('.env', 'r+');

        $newEnv = '';

        while (!feof($envContents)) {
            $env = explode('=', fgets($envContents));

            $envKey = $env[0];
            $envVal = !empty($env[1]) ? $env[1] : null;

            if ($envKey != "\n" && $envKey != '') {
                switch ($envKey) {
                    case 'DB_CONNECTION':
                        $newEnv .= $envKey.'='.$databaseDriver.PHP_EOL;
                        break;
                    case 'DB_HOST':
                        $newEnv .= $envKey.'='.$databaseHost.PHP_EOL;
                        break;
                    case 'DB_PORT':
                        if (empty($databasePort)) {
                            $databasePort = ($databaseDriver == 'pgsql') ? '5432' : '3306';
                        }

                        $newEnv .= $envKey.'='.$databasePort.PHP_EOL;
                        break;
                    case 'DB_DATABASE':
                        $newEnv .= $envKey.'='.$databaseName.PHP_EOL;
                        break;
                    case 'DB_USERNAME':
                        $newEnv .= $envKey.'='.$databaseUser.PHP_EOL;
                        break;
                    case 'DB_PASSWORD':
                        $newEnv .= $envKey.'='.$databasePassword.PHP_EOL;
                        break;

                    default:
                        $newEnv .= $envKey.'='.$envVal;

                        break;
                }
            } else {
                $newEnv .= "\n";
            }
        }

        file_put_contents('.env', $newEnv);

        fclose($envContents);
    }
}
