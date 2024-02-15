<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class Scraping extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'scraping:execution';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Scraping';

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
     * [NOTE]
     * 実行　./vendor/bin/sail artisan scraping:vanila
     */
    public function handle()
    {
        echo 10 . PHP_EOL;
        return 0;
    }
}
