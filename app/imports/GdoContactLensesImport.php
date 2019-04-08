<?php

namespace App\Imports;

class GdoContactLensesImport extends ContactLensesImport
{

    /**
     * GdoProductExport constructor.
     */
    public function __construct()
    {
        $this->catalog_version = getenv("GDO_CATALOG_CODE");
    }


}
