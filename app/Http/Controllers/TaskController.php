<?php

namespace App\Http\Controllers;

use App\Task;
use App\TaskToUser;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use phpDocumentor\Reflection\DocBlock\Tags\Reference\Fqsen;

class TaskController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $users = User::select('id', 'name')->where('id', "!=", Auth::id())->get();
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
            'title' => 'required|max:255',
            'description' => 'required',
        ]);
        // create new task
        $task = new Task();
        $task->title = $request->input('title');
        $task->user_id = Auth::id();
        $task->body = $request->input('description');
        $task->status = 'New';

        //when the task create success add a relationship
        if ($task->save()) {
            $this->updateTaskToUser($task->id, Auth::id(), $request->input('assign'));
            return redirect('home')->with('message', 'Task successful saved');
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
        //if task belong to login user.
        $task = Task::whereHas('assign', function ($query) {
            $query->where('user_id', Auth::id())->orwhere('tasks.user_id', Auth::id());
        })->find($id);
        if ($task) {
            $assigns = array();
            foreach ($task->assign as $ass) {
                if ($ass->id != Auth::id()) {
                    $assigns[] = array(
                        'id' => $ass->id,
                        'name' => $ass->name
                    );
                }
            }
            $assigns = json_encode($assigns);
            $users = User::select('id', 'name')->where('id', "!=", Auth::id())->get();
            return view('task.show', compact('task', 'users', 'assigns'));
        } else {
            return redirect('home')->with('message', 'Task not found');;
        }
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
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
        ]);
        $task = Task::whereHas('assign', function ($query) {
            $query->where('user_id', Auth::id())->orwhere('tasks.user_id', Auth::id());
        })->find($id);

        if ($task) {
            $task->title = $request->input('title');
            $task->user_id = Auth::id();
            $task->status = $request->input('status');
            $task->body = $request->input('description');
            if ($task->save()) {
                $this->updateTaskToUser($task->id, $request->input('assign'));

                return redirect('home')->with('message', 'Successfully updated todo!');
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Task::where('user_id', Auth::id())->find($id)->delete())
            return response('success', 202);
    }

    protected function updateTaskToUser($taskId, $assign)
    {
        TaskToUser::where('task_id', $taskId)->delete();
        $data = array();
        if ($assign) {
            $data = explode(",", $assign);
        }
        if (!in_array(Auth::id(), $data)) {
            $data[] = Auth::id();
        }
        foreach ($data as $row) {
            $relation = new TaskToUser();
            $relation->task_id = $taskId;
            $relation->user_id = $row;
            $relation->save();
        }

    }
}
