<?php

namespace App\Observers;

use App\Logs;
use App\TaskToUser;
use Illuminate\Support\Facades\Auth;
use const http\Client\Curl\AUTH_ANY;

class AssignObserver
{
    /**
     * Handle the task "created" event.
     *
     * @param \App\Assign $assign
     * @return void
     */
    public function created(TaskToUser $assign)
    {
        $log = new Logs();
        $log->user_id = Auth::id();
        $log->description = "User #" . Auth::id() . " resign task #" . $assign->task_id . " to " . $assign->user_id;
        $log->save();
        //
    }

}
