<?php

namespace App\Http\Controllers;

use App\Task;
use App\TaskToUser;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use phpDocumentor\Reflection\DocBlock\Tags\Reference\Fqsen;

class TaskController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tasks = Task::all();

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $users = User::select('id', 'name')->get();
        return view('task.create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // valid post varibles
        $request->validate([
            'title' => 'bail|required|unique:tasks|max:255',
            'assign' => 'required',
            'description' => 'required',
        ]);
        $task = new Task();
        $task->title = $request->input('title');
        $task->user_id = Auth::id();
        $task->body = $request->input('description');
        $task->status = 'New';
        if ($task->save()) {
            $assigns = explode(",", $request->input('assign'));
            foreach ($assigns as $row) {
                $task->user_id = Auth::id();
                $relation = new TaskToUser();
                $relation->task_id = $task->id;
                $relation->user_id = $row;
                $relation->save();
            }
            return redirect('home');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
