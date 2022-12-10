<?php

namespace App\Http\Controllers;

use App\Jobs\CreateFirstTaskJob;
use App\Jobs\SendRegisteredUserNotificationJob;
use App\Jobs\SendWelcomeMessageJob;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Bus\Batch;
use Illuminate\Http\Request;
use App\Exports\TransactionsExport;
use App\Imports\TransactionsImport;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;

class HomeController extends Controller
{
    public function index()
    {
        $transactions = Transaction::with('user')->simplePaginate(30);

        return view('home', compact('transactions'));
    }

    public function export()
    {
        return Excel::download(new TransactionsExport, 'transactions.csv');
    }

    public function import(Request $request)
    {
        $request->validate([
            'import_file' => 'required',
        ]);

        Excel::import(new TransactionsImport, request()->file('import_file'));

        return back()->withStatus('Import done!');
    }

    public function registeredUser()
    {

        SendRegisteredUserNotificationJob::dispatch();//dispatching the job
        $this->dispatch(new SendRegisteredUserNotificationJob());

    }

    public function registeredUserAdvanceChain()
    {
        Bus::chain([
            new CreateFirstTaskJob($user->id),
            new SendWelcomeMessageJob($user->id),
            new SendRegisteredUserNotificationJob($user->id),
        ])->catch(function ($ex){
            //notify admin
        })->dispatch();
    }


    public function registeredUserAdvanceBatch()
    {
        //ensure each job is batchable
        Bus::batch([
            new CreateFirstTaskJob($user->id),
            new SendWelcomeMessageJob($user->id),
            new SendRegisteredUserNotificationJob($user->id),
        ])->then(function (Batch $batch){
            info('called when batch is finished executing');
        })->finally(function (Batch $batch){
            info('whatever happens execute this');
        })->catch(function ($ex){
            //notify admin
        })->dispatch();
    }

    public function multipleRegistered(Request $request){

        $user = User::create([
            'name' => $request->name,
            'email'=> $request->email,
            'password' => Hash::make($request->password)
        ]);

        $jobs = [];
        foreach (User::where('id','!=',$user->id)->pluck('id') as $recipient){
            $jobs[] = new SendWelcomeMessageJob($user->id,$recipient);
        }

        $batch = Bus::batch($jobs)->dispatch();

        return redirect('/dashboard?batch_id=' .$batch->id);
    }

    public function registeredPriority(){

        CreateFirstTaskJob::dispatch();
        SendWelcomeMessageJob::dispatch();
        SendRegisteredUserNotificationJob::dispatch()->onQueue('priority');


    }

}
