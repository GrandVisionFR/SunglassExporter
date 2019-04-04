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

    const PRODUCT_TYPE_FRAME    = 'Lunettes de vue';
    const PRODUCT_TYPE_SUNGLASS = 'Lunettes de soleil';

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
        'gender' => '',
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
        'gender',
        'promosticker',
        'export_type',
    ];

    protected $ageGroupMapping = [
        'AGE_0_3'   => 'bébés',
        'AGE_4_6'   => 'tout-petits',
        'AGE_7_12'  => 'enfants',
        'AGE_13_13' => 'enfants',
        'DEFAULT'   => 'adultes',
    ];

    protected $genderMapping = [
        'Homme'         => 'homme',
        'Femme'         => 'femme',
        'Homme,Femme'   => 'unisexe',
        'Enfant'        => 'unisexe',
        'DEFAULT'       => '',
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
            if($product->sunglass_variant_sapid == "sapid")
                continue;
                
            $productBase = Sunglass::where('sunglass_code', $product->sunglass_variant_base_product)
                ->where('sunglass_catalog_version', $product->sunglass_variant_catalog_version)
                ->first();

            // Bypass variant if no baseProduct found
            if(!$productBase)
                continue;

            $productPrice = Price::where('price_catalog_version', $product->sunglass_variant_catalog_version)
                ->where('price_product', $product->sunglass_variant_code)
                ->orderBy('price_start_time', 'DESC')
                ->get();

            // Bypass variant if no priceRow found
            if(!$productPrice)
                continue;

            $productStocks = Stocks::where('productCode', $product->sunglass_variant_code)
                ->first();

            // Bypass variant if no stock info found
            if(!$productStocks)
                continue;

            $nSession = (object) $this->sessionTpl;

            $nSession->export_type              = $product->sunglass_variant_catalog_version;
            $nSession->id                       = $product->sunglass_variant_code;
            $nSession->color                    = $product->sunglass_variant_frame_web_colour;
            $nSession->gtin                     = $product->sunglass_variant_ean;
            $nSession->promosticker             = $product->sunglass_variant_promo_stickers;

            $nSession->material                 = $productBase->sunglass_frame_material;
            $nSession->size                     = $productBase->sunglass_nose_size;
            $nSession->shape                    = $productBase->sunglass_frame_shape;
            $nSession->brand                    = $productBase->sunglass_brand_name;

            $nSession->availability             = $productStocks->stock_text;

            $nSession->product_type             = $this->getProductType($productBase->sunglass_code);
            $nSession->title                    = $this->getProductTitle($productBase->sunglass_code, $productBase->sunglass_brand_name, $productBase->sunglass_frame_genre, $productBase->sunglass_age_range, $product->sunglass_variant_frame_web_colour, $product->sunglass_variant_synergie_name_fr);
            $nSession->description              = $this->getProductDescription($productBase->sunglass_code, $productBase->sunglass_brand_name, $productBase->sunglass_frame_material, $product->sunglass_variant_frame_web_colour, $product->sunglass_variant_synergie_name_fr);
            $nSession->age_group                = $this->getProductAgeGroup($productBase->sunglass_age_range);
            $nSession->gender                   = $this->getProductGender($productBase->sunglass_frame_genre);

            $nSession->condition                = "new";
            $nSession->google_product_category  = "178";
            $nSession->shipping                 = "FR:::4.90 EUR";

            if($product->sunglass_variant_catalog_version == getenv("GOP_CATALOG_CODE")) {
                $nSession->link = "https://www.grandoptical.com/p/" . $product->sunglass_variant_code;
                $nSession->image_link = 'https://images.grandoptical.com/gvfrance?set=angle%5B1%5D%2CarticleNumber%5B' . $product->sunglass_variant_sapid . '%5D%2Ccompany%5Bgdo%5D%2CfinalSize%5Bproductdetails%5D&call=url%5Bfile:common/productPresentation0517%5D';
            } elseif($product->sunglass_variant_catalog_version == getenv("GDO_CATALOG_CODE")) {
                $nSession->link = "https://www.generale-optique.com/p/" . $product->sunglass_variant_code;
                $nSession->image_link = 'https://images.generale-optique.com/gvfrance?set=angle%5B1%5D%2CarticleNumber%5B' . $product->sunglass_variant_sapid . '%5D%2Ccompany%5Bgdo%5D%2CfinalSize%5Bproductdetails%5D&call=url%5Bfile:common/productPresentation0517%5D';
            } else {
                continue;
            }

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

        Excel::store(new SunglassGopExport, getenv("SUNGLASS_EXPORT_GOP"));
        Excel::store(new SunglassGdoExport, getenv("SUNGLASS_EXPORT_GDO"));
        return;
    }

    /**
     * @param $baseProductCode
     * @return string
     */
    protected function getProductType($baseProductCode){
        if(substr($baseProductCode, 0, 1) == 'M') {
            return self::PRODUCT_TYPE_FRAME;
        }elseif(substr($baseProductCode, 0, 1) == 'S'){
            return self::PRODUCT_TYPE_SUNGLASS;
        }
    }

    /**
     * @param $ageGroup
     * @return mixed
     */
    protected function getProductAgeGroup($ageGroup){
        if(isset($this->ageGroupMapping[$ageGroup])){
            return $this->ageGroupMapping[$ageGroup];
        }
        return $this->ageGroupMapping['DEFAULT'];
    }

    /**
     * @param $ageGroup
     * @return mixed
     */
    protected function getProductGender($gender){
        if(isset($this->genderMapping[$gender])){
            return $this->genderMapping[$gender];
        }
        return $this->genderMapping['DEFAULT'];
    }

    /**
     * @param $productType
     * @param $brand
     * @param $gender
     * @param $ageGroup
     * @param $color
     * @param $synergieName
     * @return string
     */
    protected function getProductTitle($baseProductCode, $brand, $gender, $ageGroup, $color, $synergieName){
        $title = '';

        if(isset($brand)){
            $title .= ucfirst($brand) . ' - ';
        }

        $title .= $this->getProductType($baseProductCode);

        if(isset($this->ageGroupMapping[$ageGroup])){
            $title .= ' ' . $this->ageGroupMapping[$ageGroup];
        } else {
            $title .= ' ' . $gender;
        }

        if(isset($color)){
            $title .= ' ' . $color;
        }

        if(strtoupper(preg_replace('/[ -]+/','', $brand)) == 'RAYBAN'){
            $title .= ' - ' . $synergieName;
        }

        return $title;
    }

    /**
     * @param $baseProductCode
     * @param $brand
     * @param $material
     * @param $color
     * @param $synergieName
     * @return string
     */
    protected function getProductDescription($baseProductCode, $brand, $material, $color, $synergieName){
        $description = $this->getProductType($baseProductCode);

        if(isset($brand)){
            $description .= ' ' . $brand;
        }

        if(isset($synergieName)){
            $description .= ' ' . $synergieName;
        }

        if(isset($material)){
            $description .= ' en ' . $material;
        }

        if(isset($color)){
            $description .= ' ' . $color;
        }

        return $description;
    }

}
