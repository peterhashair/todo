<?php

namespace App\Http\Controllers;

use App\Task;
use App\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $tasks = Task::all();
        return view('home', compact('tasks'));
    }

    public function getTask(Request $request)
    {
        $tasks = Task::where('status', $request->input('status'))->get();
        return response()->json($tasks);
    }


    public function users()
    {
        $users = User::all();
    }
}
