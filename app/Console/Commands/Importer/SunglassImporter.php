<?php
namespace App\Console\Commands\Importer;

use Illuminate\Console\Command;
use App\Imports\FramesImport;
use App\Imports\SunglassImport;
use App\Imports\SunglassVariantImport;
use App\Imports\PriceImport;
use App\Imports\StocksImport;
use Illuminate\Support\Facades\Artisan;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Importer\Sunglass;
use App\Models\Importer\Price;
use App\Models\Importer\Sunglass_variant;
use App\Models\Importer\Stocks;

class SunglassImporter extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'importer:sunglass';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import & Syncronise sunglass database';

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
        Price::truncate();
        Stocks::truncate();
        Sunglass::truncate();
        Sunglass_variant::truncate();

        Excel::import(new PriceImport, storage_path(getenv("SUNGLASS_PRICE_FILE")));
        Excel::import(new StocksImport, storage_path(getenv("SUNGLASS_STOCK_1_FILE")));
        Excel::import(new StocksImport, storage_path(getenv("SUNGLASS_STOCK_2_FILE")));
        Excel::import(new SunglassImport, storage_path(getenv("SUNGLASS_FILE")));
        Excel::import(new SunglassVariantImport, storage_path(getenv("SUNGLASS_VARIANT_FILE")));

        //Artisan::call("exporter:sunglass");
        return true;
    }
}
