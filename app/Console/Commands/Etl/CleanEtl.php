<?php

namespace App\Console\Commands\Etl;

use Illuminate\Console\Command;
use App\Models\Exporter\ExportProducts;

class CleanEtl extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'etl:clean';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clean export products';

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
        ExportProducts::truncate();
        return;
    }
}
