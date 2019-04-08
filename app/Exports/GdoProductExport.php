<?php

namespace App\Exports;

class GdoProductExport extends ProductExport
{

    /**
     * GdoProductExport constructor.
     */
    public function __construct()
    {
        $this->exportType = getenv("GDO_CATALOG_CODE");
    }


}
