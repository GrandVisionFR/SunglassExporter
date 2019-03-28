<?php

namespace App\Console\Commands\Exporter;

use Illuminate\Console\Command;
use App\Models\Importer\Sunglass;
use App\Models\Importer\Sunglass_variant;
use App\Models\Exporter\Export_sunglass;
use App\Models\Importer\Price;
use App\Exports\SunglassGopExport;
use App\Exports\SunglassGdoExport;
use App\Models\Importer\Stocks;
use Maatwebsite\Excel\Facades\Excel;

class SunglassExporter extends Command
{

    protected $sessionTpl = [
        'id' => '',
        'export_type' => '',
        'title' => '',
        'description' => '',
        'price' => '',
        'sale_price' => '',
        'sale_price_effective_date' => '',
        'link' => '',
        'condition' => '',
        'product_type' => '',
        'brand' => '',
        'gtin' => '',
        'image_link' => '',
        'google_product_category' => '',
        'shipping' => '',
        'availability' => '',
        'material' => '',
        'color' => '',
        'size' => '',
        'shape' => '',
        'age_group' => '',
        'promosticker' => '',
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
        'shape',
        'age_group',
        'promosticker',
        'export_type',
    ];

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'exporter:sunglass';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Export to CSV sunglasses DB.';

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
        Export_sunglass::truncate();

        $products = Sunglass_variant::distinct('sunglass_variant_code')->get();
        foreach($products as $product){
            if($product->sunglass_variant_sapid != "sapid") {
                $productBase = Sunglass::where('sunglass_code', $product->sunglass_variant_base_product)->first();
                if(!$productBase)
                    continue;
                $productPrice = Price::where('price_catalog_version', $product->sunglass_variant_catalog_version)
                    ->where('price_product', $product->sunglass_variant_code)
                    ->orderBy('price_start_time', 'DESC')
                    ->get();
                if(!$productPrice)
                    continue;
                $productStocks = Stocks::where('productCode', $product->sunglass_variant_code)->first();
                if(!$productStocks)
                    continue;
                $nSession = (object) $this->sessionTpl;
                $nSession->export_type = $product->sunglass_variant_catalog_version;
                $nSession->id = $product->sunglass_variant_code;
                $nSession->title = "Lunettes de soleil " . $productBase->sunglass_brand_name. ' ' . $product->sunglass_variant_synergie_name_fr;
                $nSession->description = "Lunettes de soleil " . $productBase->sunglass_brand_name. ' ' . $product->sunglass_variant_synergie_name_fr . ' en ' . $productBase->sunglass_frame_material . ' ' . $product->sunglass_variant_frame_web_colour;
                if($product->sunglass_variant_catalog_version == getenv("GOP_CATALOG_CODE")) {
                    $nSession->link = "https://www.grandoptical.com/p/" . $product->sunglass_variant_code;
                    $nSession->image_link = 'https://images.grandoptical.com/gvfrance?set=angle%5B1%5D%2CarticleNumber%5B' . $product->sunglass_variant_sapid . '%5D%2Ccompany%5Bgdo%5D%2CfinalSize%5Bproductdetails%5D&call=url%5Bfile:common/productPresentation0517%5D';
                } elseif($product->sunglass_variant_catalog_version == getenv("GDO_CATALOG_CODE")) {
                    $nSession->link = "https://www.generale-optique.com/p/" . $product->sunglass_variant_code;
                    $nSession->image_link = 'https://images.generale-optique.com/gvfrance?set=angle%5B1%5D%2CarticleNumber%5B' . $product->sunglass_variant_sapid . '%5D%2Ccompany%5Bgdo%5D%2CfinalSize%5Bproductdetails%5D&call=url%5Bfile:common/productPresentation0517%5D';
                } else {
                    continue;
                }
                $nSession->condition = "new";
                $nSession->product_type = "Lunettes de soleil";
                $nSession->brand = $productBase->sunglass_brand_name;
                $nSession->gtin = $product->sunglass_variant_ean;
                $nSession->google_product_category = "178";
                $nSession->shipping = "FR:::4.90 EUR";
                $nSession->availability = $productStocks->stock_text;
                $nSession->material = $productBase->sunglass_frame_material;
                $nSession->color = $product->sunglass_variant_frame_web_colour;
                $nSession->size = $productBase->sunglass_nose_size;
                $nSession->shape = $productBase->sunglass_frame_shape;
                $nSession->age_group = $productBase->sunglass_age_range;
                $nSession->promosticker = $productBase->sunglass_promo_stickers;
                $found = false;
                $defaultOriginalPrice = null;

                if(count($productPrice) > 0) {
                    foreach ($productPrice as $price) {
                        if ($found == false) {
                            $currentDate = date('Y-m-d');
                            $startDate = explode('T', $price->price_start_time)[0];
                            $endDate = explode('T', $price->price_end_time)[0];
                            if($startDate == '' && $endDate == ''){
                                $defaultOriginalPrice = $price->price_price . " EUR";
                            } else if ($currentDate >= $startDate && $endDate >= $currentDate) {
                                $found = true;
                                $nSession->price = $price->price_original_price . " EUR";
                                $nSession->sale_price = $price->price_price . " EUR";
                                $nSession->sale_price_effective_date = $price->price_start_time . '/' . $price->price_end_time;
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
                $exportSunglass = new Export_sunglass();
                foreach(array_keys($nSession) as $key){
                    if(in_array($key, $this->availableFields)) {
                        $exportSunglass->$key = $nSession[$key];
                    }
                }
                $exportSunglass->save();
            }
        }

        Excel::store(new SunglassGopExport, getenv("SUNGLASS_EXPORT_GOP"),null, \Maatwebsite\Excel\Excel::CSV);
        Excel::store(new SunglassGdoExport, getenv("SUNGLASS_EXPORT_GDO"),null, \Maatwebsite\Excel\Excel::CSV);
        return;
    }
}
