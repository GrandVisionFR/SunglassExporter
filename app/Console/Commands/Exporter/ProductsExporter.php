<?php

namespace App\Console\Commands\Exporter;

use Illuminate\Console\Command;
use App\Exports\SunglassGopExport;
use App\Exports\SunglassGdoExport;
use Maatwebsite\Excel\Facades\Excel;

class ProductsExporter extends Command
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'exporter:products';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Export to CSV export products DB.';

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
        Excel::store(new SunglassGopExport, getenv("FRAMES_EXPORT_GOP"));
        Excel::store(new SunglassGdoExport, getenv("FRAMES_EXPORT_GDO"));
        return;
    }

}
