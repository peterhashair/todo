<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Replis extends Model
{
    //
    protected $table = "task_replies";
    protected $fillable = ['message'];
}
