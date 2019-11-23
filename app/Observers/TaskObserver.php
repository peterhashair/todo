<?php

namespace App\Observers;

use App\Logs;
use App\Task;
use Illuminate\Support\Facades\Auth;
use const http\Client\Curl\AUTH_ANY;

class TaskObserver
{
    /**
     * Handle the task "created" event.
     *
     * @param  \App\Task  $task
     * @return void
     */
    public function created(Task $task)
    {
        $log = new Logs();
        $log->user_id =Auth::id();
        $log->description = "User #".Auth::id()." Create task #".$task->id;
        $log->save();
        //
    }

    /**
     * Handle the task "updated" event.
     *
     * @param  \App\Task  $task
     * @return void
     */
    public function updated(Task $task)
    {
        //
        $log = new Logs();
        $description = "User #".Auth::id()." Update task #".$task->id;
        if($task->isDirty('title')){
            $description .= " set title from ".$task->getOriginal('title')." to ".$task->title;
        }
        if($task->isDirty('body')){
            $description .= " changed description";
        }
        if($task->isDirty('status')){
            $description .= " set status from ".$task->getOriginal('status')." to ".$task->status;
        }
        $log->description= $description;
        $log->user_id =Auth::id();
        $log->save();
    }

    /**
     * Handle the task "deleted" event.
     *
     * @param  \App\Task  $task
     * @return void
     */
    public function deleted(Task $task)
    {
        //
        $log = new Logs();
        $log->user_id =Auth::id();
        $log->description = "User #".Auth::id()." Delete task #".$task->id;
        $log->save();
    }

    /**
     * Handle the task "restored" event.
     *
     * @param  \App\Task  $task
     * @return void
     */
    public function restored(Task $task)
    {
        //
    }

    /**
     * Handle the task "force deleted" event.
     *
     * @param  \App\Task  $task
     * @return void
     */
    public function forceDeleted(Task $task)
    {
        //
    }
}
