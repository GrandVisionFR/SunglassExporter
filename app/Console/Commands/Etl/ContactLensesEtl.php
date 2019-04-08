<?php

namespace App\Console\Commands\Etl;

use Illuminate\Console\Command;
use App\Models\Importer\Prices;
use App\Models\Importer\Stocks;
use App\Models\Importer\ContactLenses;
use App\Models\Exporter\ExportProducts;

class ContactLensesEtl extends Command
{

    protected $sessionTpl = [
        'id'                            => '',
        'export_type'                   => '',
        'title'                         => '',
        'description'                   => '',
        'price'                         => '',
        'sale_price'                    => '',
        'sale_price_effective_date'     => '',
        'link'                          => '',
        'condition'                     => '',
        'product_type'                  => '',
        'brand'                         => '',
        'gtin'                          => '',
        'image_link'                    => '',
        'google_product_category'       => '',
        'shipping'                      => '',
        'availability'                  => '',
        'material'                      => '',
        'color'                         => '',
        'size'                          => '',
        'age_group'                     => '',
        'gender'                        => '',
        'excluded_destination'          => 'shopping',
        'promosticker'                  => '',
    ];

    protected $availableFields = [
        'id',
        'title',
        'description',
        'price',
        'sale_price',
        'sale_price_effective_date',
        'link',
        'condition',
        'product_type',
        'brand',
        'gtin',
        'image_link',
        'google_product_category',
        'shipping',
        'availability',
        'material',
        'color',
        'size',
        'age_group',
        'gender',
        'promosticker',
        'excluded_destination',
        'export_type',
    ];

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'etl:contact-lenses';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Etl from contact-lenses to export products';

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
        $products = ContactLenses::distinct('id')->get();
        foreach($products as $product){

            if($product->id == "id" || $product->id == null)
                continue;

            $nSession = (object) $this->sessionTpl;

            $nSession->id                           = $product->id;
            $nSession->title                        = $product->title;
            $nSession->description                  = $product->description;
            $nSession->price                        = $product->price;
            $nSession->sale_price                   = $product->sale_price;
            $nSession->sale_price_effective_date    = $product->sale_price_effective_date;
            $nSession->link                         = $product->link;
            $nSession->condition                    = $product->condition;
            $nSession->product_type                 = $product->product_type;
            $nSession->brand                        = $product->brand;
            $nSession->gtin                         = $product->gtin;
            $nSession->image_link                   = $product->image_link;
            $nSession->google_product_category      = $product->google_product_category;
            $nSession->shipping                     = $product->shipping;
            $nSession->availability                 = $product->availability;
            $nSession->material                     = $product->material;
            $nSession->color                        = $product->color;
            $nSession->size                         = $product->size;
            $nSession->age_group                    = $product->age_group;
            $nSession->gender                       = $product->gender;

            $nSession->promosticker                 = $product->custom_label_0;
            $nSession->export_type                  = $product->catalog_version;

            $nSession = (array) $nSession;
            $exportProducts = new ExportProducts();
            foreach(array_keys($nSession) as $key){
                if(in_array($key, $this->availableFields)) {
                    $exportProducts->$key = $nSession[$key];
                }
            }
            $exportProducts->save();
        }

        return;
    }

}
