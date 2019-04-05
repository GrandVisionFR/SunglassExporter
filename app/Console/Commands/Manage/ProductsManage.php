<?php

namespace App\Console\Commands\Manage;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class ProductsManage extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'manage:products';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import all file , ETL and Export';

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
        Artisan::call("importer:prices");
        Artisan::call("importer:stocks");
        Artisan::call("importer:frames");
        Artisan::call("importer:contact-lenses");

        Artisan::call("etl:clean");
        Artisan::call("etl:frames");
        //Artisan::call("etl:contact-lenses");

        Artisan::call("exporter:products");
        return;
    }

}
