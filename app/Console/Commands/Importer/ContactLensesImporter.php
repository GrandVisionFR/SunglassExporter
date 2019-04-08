<?php
namespace App\Console\Commands\Importer;

use Illuminate\Console\Command;
use App\Imports\GopContactLensesImport;
use App\Imports\GdoContactLensesImport;
use App\Models\Importer\ContactLenses;
use Maatwebsite\Excel\Facades\Excel;

class ContactLensesImporter extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'importer:contact-lenses';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import & Syncronise contact lenses database';

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
        ContactLenses::truncate();

        Excel::import(new GopContactLensesImport, storage_path(getenv("CONTACT_LENSES_GOP_FILE")));
        Excel::import(new GdoContactLensesImport, storage_path(getenv("CONTACT_LENSES_GDO_FILE")));

        return true;
    }
}
