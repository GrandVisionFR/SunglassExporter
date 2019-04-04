<?php
namespace App\Console\Commands\Importer;

use Illuminate\Console\Command;
use App\Imports\StocksImport;
use App\Models\Importer\Stocks;
use Maatwebsite\Excel\Facades\Excel;

class StocksImporter extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'importer:stocks';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import & Syncronise stock database';

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
        Stocks::truncate();

        Excel::import(new StocksImport, storage_path(getenv("STOCKS_1_FILE")));
        Excel::import(new StocksImport, storage_path(getenv("STOCKS_2_FILE")));

        return true;
    }
}
