<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class BuildDev extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'build:dev';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Runs fresh migrations and seeds default test data';

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
        try {
            $this->info('Running migrations...');
            Artisan::call('migrate:fresh');
            $this->info('Migrations ran!');
            $this->info('Now seeding default test data...');
            Artisan::call('db:seed', [
                '--class' => 'BaseDataSeeder'
            ]);
            $this->info('Seeding done!');
            $this->info('Dev environment build!');
        } catch (\Exception $e) {
            $this->error('An error occured: ' . $e->getMessage());
        }
    }
}
