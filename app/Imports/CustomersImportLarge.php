<?php

namespace App\Imports;

use App\Models\Customer;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;

class CustomersImportLarge implements ToModel,WithBatchInserts,WithChunkReading,ShouldQueue
{
    //if ShouldQueue is enabled then in .env put database
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


    //speed related
    public function batchSize(): int
    {
        return 1000;
    }

    //memory related
    public function chunkSize(): int
    {
        return 1000;
    }
}
