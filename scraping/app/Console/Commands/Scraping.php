<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use GuzzleHttp\Client;
use Symfony\Component\DomCrawler\Crawler;

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

        // 事前準備
        $this->client = new Client();
    }

    /**
     * Execute the console command.
     * [NOTE]
     * 実行　./vendor/bin/sail artisan scraping:execution
     */
    public function handle()
    {
        // 指定URL
        $url = "XXXXXXXXXXXX";

        // クロール
        $response = $this->client->request(
            'GET',
            $url,
            // ['auth' => ['XXXXXXXXXXXX', 'XXXXXXXXXXXX']],   // Basic認証が必要な場合
        );

        // 指定ページのHTMLをstring型で取得
        $html = $response->getBody()->getContents();

        // ページのDOM構成をいじる準備
        $crawler      = new Crawler($html);
        // CSSセレクタで要素指定し、さらにプロパティを指定する
        $page_results = $crawler->filter('XXXXXXXXXXXX')->attr('XXXXXXXXXXXX');

        var_dump($page_results);exit;

        return 0;
    }
}
