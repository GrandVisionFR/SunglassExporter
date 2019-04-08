<?php

namespace App\Imports;

class GopContactLensesImport extends ContactLensesImport
{

    /**
     * GopProductExport constructor.
     */
    public function __construct()
    {
        $this->catalog_version = getenv("GOP_CATALOG_CODE");
    }


}
