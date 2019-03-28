<?php
namespace App\Console\Commands\Importer;

use Illuminate\Console\Command;
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

        Sunglass::truncate();
        Stocks::truncate();
        Sunglass_variant::truncate();
        Price::truncate();
        $sunglass = storage_path(getenv("SUNGLASS_FILE"));
        $sunglassVariant = storage_path(getenv("SUNGLASS_VARIANT_FILE"));
        $priceFile = storage_path(getenv("SUNGLASS_PRICE_FILE"));
        $stockFile = storage_path(getenv("SUNGLASS_STOCK_1_FILE"));
        $stockFile2 = storage_path(getenv("SUNGLASS_STOCK_2_FILE"));
        Excel::import(new StocksImport, $stockFile);
        Excel::import(new StocksImport, $stockFile2);
        Excel::import(new SunglassImport, $sunglass);
        Excel::import(new SunglassVariantImport, $sunglassVariant);
        Excel::import(new PriceImport, $priceFile);
        Artisan::call("exporter:sunglass");
        return true;
    }
}
