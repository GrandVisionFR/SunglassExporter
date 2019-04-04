<?php

namespace App\Exports;

class GdoProductExport extends ProductExport
{

    /**
     * @param string $exportType
     */
    public function __construct()
    {
        $this->exportType = getenv("GDO_CATALOG_CODE");
    }


}
