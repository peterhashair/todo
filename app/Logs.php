<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Logs extends Model
{
    protected $table = "todo_logs";
    protected $fillable = ['description'];

    public function user()
    {
        return $this->hasOne('App\User', 'id', 'user_id');
    }
}
