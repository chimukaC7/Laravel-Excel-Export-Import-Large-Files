<?php

namespace App\Imports;

use App\Models\Customer;
use Maatwebsite\Excel\Concerns\ToModel;

class CustomersImport implements ToModel
{
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
}
