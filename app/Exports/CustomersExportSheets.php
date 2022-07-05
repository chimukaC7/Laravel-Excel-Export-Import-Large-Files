<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class CustomersExportSheets implements WithMultipleSheets
{
    use Exportable;

    public function sheets(): array
    {
        $sheets = [];

        $organisations = ['example.net','example.com','example.org'];//sheets grouped by
        //every sheet would rep an organisation

        foreach ($organisations as $organisation){
            $sheets[] = new CustomersOrganisationSheet($organisation);
        }

        return $sheets;
    }
}
