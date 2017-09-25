<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskCreateRequest;
use App\Task;
use App\Todolist;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function __construct()
    {
        // check if session expired for ajax request
        $this->middleware('ajax-session-expired');
        // check if user is autenticated for non-ajax request
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TaskCreateRequest $request, $todoListId)
    {
        //
        $todoList = Todolist::findOrFail($todoListId);
        $task = $todoList->tasks()->create($request->all());
        return view('tasks.item', compact('task'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $todoListId,$id)
    {
        //
        $task = Task::findOrFail($id);
        $task->completed_at = $request['completed'] == 'true' ? Carbon::now() : null;
        $affectedRow = $task->update();
        echo $affectedRow;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($todoListId, $id)
    {
        //
        $task = Task::findOrFail($id);
        $task->delete();
        return $task;
    }
}
