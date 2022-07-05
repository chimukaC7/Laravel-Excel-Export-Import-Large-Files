<?php

namespace App\Imports;

use App\Models\Customer;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithCustomCsvSettings;

class CustomersImportCustomDelimiter implements ToModel,WithCustomCsvSettings
{
    private $delimiter;

    public function __construct($delimiter){

        $this->delimiter = $delimiter;
    }

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Customer([
            //which fields need to be filed by which row
            //useful wen there are no column rows
            'first_name' => $row[1],
            'last_name' => $row[2],
            'email' => $row[3]
        ]);
    }

    public function getCsvSettings(): array
    {
        return [
//            'delimiter' => ','
            'delimiter' => $this->delimiter
        ];
    }
}
