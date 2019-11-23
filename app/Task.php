<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    //
    protected $table = "tasks";
    protected $fillable = ['title', 'body', 'status'];

    public function replies()
    {
        return $this->hasMany('App\Replis', 'id', 'task_id');
    }

    public function owner()
    {
        return $this->hasOne('App\User', 'user_id', 'id');
    }

    public function assign()
    {
        return $this->hasOneThrough('App\User', 'App\TaskToUser','task_id','id','id','user_id');

    }

    public function logs()
    {
        return $this->hasMany('App\Logs', 'id', 'task_id');
    }

}
