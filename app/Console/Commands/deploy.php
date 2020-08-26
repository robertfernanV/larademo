<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class deploy extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'deploy:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'command to install the application, with its migrations and its oauth keys';

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
        //
        $this->info("Reset in database :)");
        \Artisan::call('migrate:reset');
        $this->info("Migrating and seeding the tables...");
        \Artisan::call('migrate --seed');
        $this->info("Installing passport...");
        \Artisan::call('passport:install');
        $this->info("Deploy done. Thanks! :D");

    }
}
