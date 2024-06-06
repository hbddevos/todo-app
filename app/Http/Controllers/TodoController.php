<?php

namespace App\Http\Controllers;

use App\Http\Requests\TodoRequestForm;
use App\Models\TaskToDo;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        // $query = TaskToDo::query();
        return view('task.index', ['tasks' => TaskToDo::all()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $task = new TaskToDo();
        return view('task.create', [
            'task' => $task
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TodoRequestForm $request)
    {
        //
        $taks = TaskToDo::create($request->validated());
        // dd($request->validated());
        return to_route('task.index')->with('success', 'Tâche créée avec succès');
    }

    /**
     * Display the specified resource.
     */
    public function show(TaskToDo $task)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TaskToDo $task)
    {
        //

        return view('task.edit', ['task' => $task]);


    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TodoRequestForm $request, TaskToDo $task)
    {
        //
        $task->update($request->validated());

        return to_route('task.index')->with('success', 'Tâche modifiée avec succès');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TaskToDo $task)
    {
        //

        //dd($task);
        $task->delete();

        return to_route('task.index')->with('success', 'Tâche supprimée avec succès');
    }


//    public function foreverDelete(TaskToDo $task)
//    {
//
//        dd($task);
//        $task->forceDelete();
//
//        return to_route('filter.recycle')->with('success', 'Tâche supprimée avec succès');
//    }
}
