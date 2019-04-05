<?php

namespace App\Console\Commands\Etl;

use Illuminate\Console\Command;
use App\Models\Importer\Prices;
use App\Models\Importer\Stocks;
use App\Models\Importer\ContactLenses;
use App\Models\Importer\ContactLensesVariant;
use App\Models\Exporter\ExportProducts;

class ContactLensesEtl extends Command
{

    const PRODUCT_TYPE_FRAME                = 'Lunettes de vue';
    const PRODUCT_TYPE_SUNGLASS             = 'Lunettes de soleil';

    const PRODUCT_GOOGLE_CATEGORY_FRAME     = 524;
    const PRODUCT_GOOGLE_CATEGORY_SUNGLASS  = 178;

    protected $sessionTpl = [
        'id'                            => '',
        'export_type'                   => '',
        'title'                         => '',
        'description'                   => '',
        'price'                         => '',
        'sale_price'                    => '',
        'sale_price_effective_date'     => '',
        'link'                          => '',
        'condition'                     => 'new',
        'product_type'                  => '',
        'brand'                         => '',
        'gtin'                          => '',
        'image_link'                    => '',
        'google_product_category'       => '',
        'shipping'                      => 'FR:::4.90 EUR',
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
        $products = ContactLensesVariant::distinct('code')->get();
        foreach($products as $product){

            if($product->sapid == "sapid")
                continue;

            $productBase = ContactLenses::where('code', $product->base_product)
                ->where('catalog_version', $product->catalog_version)
                ->first();

            // Bypass variant if no baseProduct found
            if(!$productBase)
                continue;

            $productPrice = Prices::where('catalog_version', $product->catalog_version)
                ->where('product', $product->base_product)
                ->orderBy('start_time', 'DESC')
                ->get();

            // Bypass variant if no priceRow found
            if(!$productPrice)
                continue;

            $nSession = (object) $this->sessionTpl;

            $nSession->export_type              = $product->catalog_version;
            $nSession->id                       = $product->code;


            /*
            $productStocks = Stocks::where('productCode', $product->code)
                ->first();

            // Bypass variant if no stock info found
            if(!$productStocks)
                continue;

            // Bypass variant if ean length is not 12 or 13
            if(strlen($product->ean) < 12 || strlen($product->ean) > 13)
                continue;

            $nSession->color                    = str_replace(',', '/', $product->frame_web_colour);
            $nSession->gtin                     = $product->ean;
            $nSession->promosticker             = $product->promo_stickers;

            $nSession->material                 = $productBase->frame_material;
            $nSession->size                     = $productBase->nose_size;
            $nSession->brand                    = $productBase->brand_name;

            $nSession->availability             = $productStocks->stock_text;

            $nSession->product_type             = $this->getProductType($productBase->code);
            $nSession->google_product_category  = $this->getProductGoogleCategory($productBase->code);
            $nSession->title                    = $this->getProductTitle($productBase->code, $productBase->brand_name, $productBase->frame_genre, $productBase->age_range, $product->frame_web_colour, $product->synergie_name_fr);
            $nSession->description              = $this->getProductDescription($productBase->code, $productBase->brand_name, $productBase->frame_material, $product->frame_web_colour, $product->synergie_name_fr);
            $nSession->age_group                = $this->getProductAgeGroup($productBase->age_range, $productBase->frame_genre);
            $nSession->gender                   = $this->getProductGender($productBase->frame_genre);

            if($product->catalog_version == getenv("GOP_CATALOG_CODE")) {
                $nSession->link = "https://www.grandoptical.com/p/" . $product->code;
                $nSession->image_link = 'https://images.grandoptical.com/gvfrance?set=angle%5B1%5D%2CarticleNumber%5B' . $product->sapid . '%5D%2Ccompany%5Bgdo%5D%2CfinalSize%5Bproductdetails%5D&call=url%5Bfile:common/productPresentation0517%5D';
            } elseif($product->catalog_version == getenv("GDO_CATALOG_CODE")) {
                $nSession->link = "https://www.generale-optique.com/p/" . $product->code;
                $nSession->image_link = 'https://images.generale-optique.com/gvfrance?set=angle%5B1%5D%2CarticleNumber%5B' . $product->sapid . '%5D%2Ccompany%5Bgdo%5D%2CfinalSize%5Bproductdetails%5D&call=url%5Bfile:common/productPresentation0517%5D';
            } else {
                continue;
            }
*/

            $found = false;
            $defaultOriginalPrice = null;
            if(count($productPrice) > 0) {
                foreach ($productPrice as $price) {
                    if ($found == false) {
                        $currentDate = date('Y-m-d');
                        $startDate = explode('T', $price->start_time)[0];
                        $endDate = explode('T', $price->end_time)[0];
                        if($startDate == '' && $endDate == ''){
                            $defaultOriginalPrice = number_format($price->price, 2) . " EUR";
                        } else if ($currentDate >= $startDate && $endDate >= $currentDate) {
                            $found = true;
                            $nSession->price = number_format($price->original_price, 2) . " EUR";
                            $nSession->sale_price = number_format($price->price, 2) . " EUR";
                            $nSession->sale_price_effective_date = $price->start_time . '/' . $price->end_time;
                        }
                    }
                }
                if ($found == false) {
                    $nSession->price = $defaultOriginalPrice;
                }
            } else{
                continue;
            }

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
