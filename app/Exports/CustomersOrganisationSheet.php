<?php

namespace App\Exports;

use App\Models\Customer;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithTitle;

class CustomersOrganisationSheet implements FromCollection,WithTitle
{
    private $organisation;

    public function __construct($organisation)
    {
        $this->organisation = $organisation;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Customer::where('email','like','%'.$this->organisation)->get();
    }

    //title for the sheet
    public function title(): string
    {
        return 'Organisation '. $this->organisation;
    }
}
