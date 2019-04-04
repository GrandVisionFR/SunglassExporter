<?php
namespace App\Console\Commands\Importer;

use Illuminate\Console\Command;
use App\Imports\PricesImport;
use App\Models\Importer\Prices;
use Maatwebsite\Excel\Facades\Excel;

class PricesImporter extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'importer:prices';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import & Syncronise price database';

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
        Prices::truncate();

        Excel::import(new PricesImport, storage_path(getenv("PRICES_FILE")));

        return true;
    }
}
