<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Todo;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class TodosController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('jwt-auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = JWTAuth::parseToken()->toUser();

        $todos = $user->todos()->orderBy('created_at', 'desc')->get();
        return response()->json($todos, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = JWTAuth::parseToken()->toUser();

        $todo = new Todo;
        $todo->content = $request->input('content');
        $todo->priority = $request->input('priority');

        $todo->user_id = $user->id;

        $todo->save();
        return response()->json($todo, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $todo = Todo::find($id);
        if ($todo) {
            return response()->json($todo, 200);
        }
        else {
            return response()->json($todo, 404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $todo = Todo::find($id);
        
        if (!$todo) {
            $todo = new Todo;
            $todo->content = $request->input('content');
            $todo->priority = $request->input('priority');
            $todo->save();
            return response()->json($todo, 201);
        }

        $todo->content = $request->input('content');
        $todo->priority = $request->input('priority');
        $todo->done = $request->input('done');
        $todo->save();
        return response()->json($todo, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $todo = Todo::find($id);
        if (!$todo) {
            return response()->json('Todo not found', 404);
        }
        $todo->delete();
        return response()->json($todo, 200);
    }
}
