<?php

namespace App\Console\Commands;

use App\Models\Category;
use App\Models\Product;
use GuzzleHttp\Client;
use Illuminate\Console\Command;

class ImportProducts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'product:import';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import of products from rozetka.com.ua';

    /**
     * @var string
     */
    protected $rozetkaApiUrl = 'https://xl-catalog-api.rozetka.com.ua/v4/goods/';

    protected $client;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->client = new Client();
        parent::__construct();
    }

    public function handle()
    {
        if (Product::first()) {
            $this->info('Products are already imported!');
            return;
        }
        foreach (Category::all() as $category) {
            for ($pageNumber = 1; $pageNumber < 3; $pageNumber++) {
                $productIds = implode (",", json_decode($this->client->get(
                    "{$this->rozetkaApiUrl}get?preset={$category->rozetka_id}&category_id=80004&page={$pageNumber}"
                )->getBody(), true)['data']['ids']);

                $products = json_decode($this->client->get(
                    "{$this->rozetkaApiUrl}getDetails?&with_docket=1&product_ids={$productIds}"
                )->getBody(), true)['data'];

                foreach ($products as $product) {
                    $product['image_url'] = $product['image_main'];
                    $dbProduct = Product::firstOrCreate(['id' => $product['id']], $product);
                    $dbProduct->categories()->attach($category->id);
                }
            }
        }
        $this->info('Products imported successfully!');
    }
}
