<?php

namespace App\Imports;

use App\Models\Customer;
use App\Models\Purchase;
use Maatwebsite\Excel\Concerns\ToModel;

class CustomersImportRelationships implements ToModel
{
    private $customers;

    public function __construct()
    {
        //set the private variable
        //this way we doing one query to the database plus select only the fields that are needed
        $this->customers = Customer::select('id','first_name','last_name')->get()
            ->keyBy(function ($item){//grouping by firstname and lastname
               return $item->first_name . ' ' . $item->last_name;//firstname and last name come the key
            })->toArray();
    }

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        //every row will query the database
        return new Purchase([
            'customer_id' => $this->getCustomerId($row[1],$row[2]),
            'bank_acc_number' => $row[3],
            'company' => $row[4]
        ]);
    }

//    private function getCustomerIdDB($firstname, $lastname)
//    {
//        $customer = Customer::where('first_name',$firstname)->where('last_name',$lastname)->first();
//        if (!$customer) return null;
//
//        return $customer->id;
//    }

    private function getCustomerId($firstname,$lastname){
        $customer = $this->customers[$firstname.' '.$lastname] ?? null;
        if (!$customer) return null;

        return $customer['id'];
    }
}
