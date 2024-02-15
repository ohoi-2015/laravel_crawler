<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

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

    private $client;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->client = new Client();
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
