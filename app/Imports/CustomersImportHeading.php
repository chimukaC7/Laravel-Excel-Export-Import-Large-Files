<?php

namespace App\Imports;

use App\Models\Customer;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class CustomersImportHeading implements ToModel,WithHeadingRow
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
            'first_name' => $row['first_name'],
            'last_name' => $row['last_name'],
            'email' => $row['email']
        ]);
    }

    public function headingRow():int{
        return 1;
    }
}
