<?php

namespace App\Jobs;

use App\Mail\RegisteredUserMail;
use App\Models\User;
use Illuminate\Bus\Batchable;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendRegisteredUserNotificationJob implements ShouldQueue
{
    use Batchable,Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    //specifying the number of retries on a specific job
    //the number of times the job may be attempted
    public $tries = 5;

    //the number of seconds the job can run before timing out
    public $timeout = 120;

    public function __construct()
    {
    }

    public function handle()
    {
        if ($this->user->email_verified_at) {

            $admins = User::where('is_admin', 1)->get();

            foreach ($admins as $admin) {
                Mail::to($admin)->send(new RegisteredUserMail());
            }

        }else{

            if ($this->attempts() < 2){
                $this->release(60);//1 min
            }else{
                $this->release(60 * 10);//10 min
            }

        }
    }

    //send a notification to the adminstrator or log something on failed job
    public function failed(\Throwable $throwable){

        Mail::to('admin@admin.com')->send();
        info('Failed to process notification: ' .get_class($throwable) .' - '.$throwable->getMessage());
    }
}