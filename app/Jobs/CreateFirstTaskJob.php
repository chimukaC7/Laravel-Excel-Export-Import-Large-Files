<?php

namespace App\Jobs;

use Illuminate\Bus\Batchable;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class CreateFirstTaskJob implements ShouldQueue
{
    use Batchable,Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $user_id;

    public function __construct($user_id)
    {
        $this->user_id = $user_id;
    }

    public function handle()
    {

        if ($this->batch()->cancelled()){
            return;
        }

        Task::create([
            'user_id' => $this->user_id,
            'task' => "Your first task"
        ]);
    }
}