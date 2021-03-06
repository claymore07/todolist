<?php

namespace App\Http\Controllers;

use App\Http\Requests\TodoListCreatRequest;
use App\Todolist;
use Auth;
use Illuminate\Http\Request;

class TodoListController extends Controller
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
    public function index(Request $request)
    {

        $user = Auth::user();

        $todolists = $user->todolists()->with('tasks')->orderBy('updated_at', 'desc')->get();

         return view('todolists.index', compact('todolists'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $todolist = new Todolist();
        return view('todolists.form', compact('todolist'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TodoListCreatRequest $request)
    {
        //
        $input = $request->all();

        $todolist =  Auth::user()->todolists()->create($input);
        return view("todolists.item", compact('todolist'));
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
        $user =Auth::user();

        $todlist = Todolist::findOrFail($id);
        if($todlist->user_id != $user->id){
            return 'fuck';
        }
        $tasks = $todlist->tasks()->orderBy("created_at", "desc")->get();
        return view('tasks.index', compact('todlist','tasks'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit( $id)
    {
        //

        $todolist = Todolist::findOrFail($id);

        return view('todolists.form', compact('todolist'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TodoListCreatRequest $request, $id)
    {
        //
        $todolist =Todolist::findOrFail($id);

        $todolist->update($request->all());

        return view("todolists.item", compact('todolist'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $todolist = Todolist::findOrFail($id);
        $todolist->delete();
        return $todolist;
    }
}
