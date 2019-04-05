<?php
namespace App\Console\Commands\Importer;

use Illuminate\Console\Command;
use App\Imports\ContactLensesImport;
use App\Imports\ContactLensesVariantImport;
use App\Models\Importer\ContactLenses;
use App\Models\Importer\ContactLensesVariant;
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
        ContactLensesVariant::truncate();

        Excel::import(new ContactLensesImport, storage_path(getenv("CONTACT_LENSES_FILE")));
        Excel::import(new ContactLensesVariantImport, storage_path(getenv("CONTACT_LENSES_VARIANT_FILE")));

        return true;
    }
}
