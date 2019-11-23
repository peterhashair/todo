<?php

namespace App\Http\Controllers;

use App\Task;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        return view('home');
    }

    public function getTask(Request $request)
    {
        $tasks = Task::whereHas('assign', function ($query) {
            $query->where('user_id', Auth::id())->orwhere('tasks.user_id',Auth::id());
        })->where('status', $request->input('status'))->get();
        return response()->json($tasks);
    }

    public function changeTaskStatus(Request $request,$id)
    {
        $task = Task::whereHas('assign', function ($query) {
            $query->where('user_id', Auth::id())->orwhere('tasks.user_id', Auth::id());
        })->find($id);
        $task->status = $request->input('status');
        $task->save();
        return response()->json('success');
    }

    public function users()
    {
        $users = User::all();
    }
}
