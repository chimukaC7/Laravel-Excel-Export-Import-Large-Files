<?php

namespace App\Http\Controllers;

use App\Exports\CustomersExport;
use App\Exports\CustomersExportDateformat;
use App\Exports\CustomersExportHeading;
use App\Exports\CustomersExportMapping;
use App\Exports\CustomersExportSheets;
use App\Exports\CustomersExportSize;
use App\Exports\CustomersExportStyling;
use App\Exports\CustomersExportView;
use App\Imports\CustomersImport;
use App\Imports\CustomersImportDateformat;
use App\Imports\CustomersImportErrors;
use App\Imports\CustomersImportLarge;
use App\Imports\CustomersImportRelationships;
use App\Models\Customer;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class CustomersController extends Controller
{
    public function index()
    {
        $customers = Customer::all();
        return view('customers.index', compact('customers'));
    }

    public function export()
    {
        return Excel::download(new CustomersExport(), 'customers.xlsx');
    }

    public function export_view()
    {
        return Excel::download(new CustomersExportView(), 'customers.xlsx');
    }

    public function export_store()
    {
//        Excel::store(new CustomersExport(), 'customers-' . now()->toDateString() . '.xlsx');
        Excel::store(new CustomersExport(), 'customers-' . now()->toDateString() . '.xlsx', 'public');
        return back();
    }

    public function export_format($format)
    {
        $extension = strtolower($format);
        if(in_array($format,['Mpdf','Dompdf','Tcpdf'])) $extension = 'pdf';
        return Excel::download(new CustomersExport(), 'customers.'.$extension, $format);
    }

    public function export_sheets()
    {
        return Excel::download(new CustomersExportSheets(), 'customers.xlsx');
    }

    public function export_heading()
    {
        return Excel::download(new CustomersExportHeading(), 'customers.xlsx');
    }

    public function export_mapping()
    {
        $now = now()->format('M-Y');

        ini_set('memory_limit', '-1');
        return Excel::download(new CustomersExportMapping(), "customers--{$now}.xlsx");
    }

    public function export_styling()
    {
        return Excel::download(new CustomersExportStyling(), 'customers.xlsx');
    }

    public function export_autosize()
    {
        return Excel::download(new CustomersExportSize(), 'customers.xlsx');
    }

    public function export_dateformat()
    {
        return Excel::download(new CustomersExportDateformat(), 'customers.xlsx');
    }

    public function import(Request $request)
    {
//        Excel::import(new CustomersImport(), $request->file('import'));
//        Excel::import(new CustomersImport(), $request->file('import'),null,'Xls');//xls
        Excel::import(new CustomersImport($request->delimiter), $request->file('import'),null,'Csv');//csv

        return redirect()->route('customers.index')->withMessage('Successfully imported');
    }

    public function import_large(Request $request)
    {
        $time_start = $this->microtime_float();

        Excel::import(new CustomersImportLarge(), $request->file('import'));

        $time_end = $this->microtime_float();

        $time = $time_end - $time_start;

        return redirect()->route('customers.index')->withMessage('Successfully imported in' . $time . ' seconds');
    }

    private function microtime_float(){
        list($usec,$sec) = explode(" ",microtime());
        return ((float) $usec + (float) $sec);
    }

    public function import_relationship(Request $request)
    {
        Excel::import(new CustomersImportRelationships(), $request->file('import'));

        return redirect()->route('customers.index')->withMessage('Successfully imported');
    }

    public function import_dateformat(Request $request)
    {
        Excel::import(new CustomersImportDateformat(), $request->file('import'));

        return redirect()->route('customers.index')->withMessage('Successfully imported');
    }

    public function import_errors(Request $request)
    {
        Excel::import(new CustomersImportErrors(), $request->file('import'));

        return redirect()->route('customers.index')->withMessage('Successfully imported');
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Customer $customer)
    {
        //
    }

    public function edit(Customer $customer)
    {
        //
    }

    public function update(Request $request, Customer $customer)
    {
        //
    }

    public function destroy(Customer $customer)
    {
        //
    }
}