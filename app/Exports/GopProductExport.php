<?php

namespace App\Exports;

class GopProductExport extends ProductExport
{

    /**
     * GopProductExport constructor.
     */
    public function __construct()
    {
        $this->exportType = getenv("GOP_CATALOG_CODE");
    }


}
