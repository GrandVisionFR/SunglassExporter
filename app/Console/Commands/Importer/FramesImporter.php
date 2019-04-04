<?php
namespace App\Console\Commands\Importer;

use Illuminate\Console\Command;
use App\Imports\FramesImport;
use App\Imports\FramesVariantImport;
use App\Models\Importer\Frames;
use App\Models\Importer\FramesVariant;
use Maatwebsite\Excel\Facades\Excel;

class FramesImporter extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'importer:frames';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import & Syncronise frames database';

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
        Frames::truncate();
        FramesVariant::truncate();

        Excel::import(new FramesImport, storage_path(getenv("FRAMES_FILE")));
        Excel::import(new FramesVariantImport, storage_path(getenv("FRAMES_VARIANT_FILE")));

        return true;
    }
}
