<?php

namespace App\Http\Controllers;

use App\Logs;
use Illuminate\Http\Request;

class LogController extends Controller
{

    //Auth login
    public function __construct()
    {
        $this->middleware('auth');
    }

    //show all log
    public function index()
    {
        $logs = Logs::paginate(15);
        return view('log.show', ['logs' => $logs]);

    }
}
