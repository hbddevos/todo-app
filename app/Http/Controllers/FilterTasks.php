<?php

namespace App\Http\Controllers;

use App\Models\TaskToDo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;

class FilterTasks extends Controller
{
    //

    public function recycle()
    {
        // $query = TaskToDo::query();
        // $tasksRecycled = $query->trashed()->get();
        $trashed = TaskToDo::onlyTrashed()->get();

        // dd($trashed);

        return view('filter.recycle', [
            'tasks' => $trashed
        ]);
    }

    /**
     * Method to force deleting
     * @param TaskToDo $task
     * @return \Illuminate\Http\RedirectResponse
     */

    public function foreverDelete(TaskToDo $task)
    {
        dd($task);
        //$task = TaskToDo::find($task->id);

        $task->forceDelete();

        return back()->with('success', 'Definitivement supprimé de la base de donnée');
    }


    /**
     * Display a completed tasks
     */
    public function completed()
    {
        $taksCompleted = TaskToDo::query()->withTrashed()->where('done', '=', 1)->get();
        // dd($taksCompleted);

        return view('filter.completed', ['tasks' => $taksCompleted]);
    }

    /**
     * Display a pending task
     */

    public function pending()
    {
        $today = Date::now()->toDateString();
        $taksPending = TaskToDo::query()->where('done', '=', 0)->whereDate('dateExecution', '=', $today)->get();
        //dd($taksPending->all()[0]['dateExecution'] == $today);
        // dd($today);
        // dd($taksPending);

        return view('filter.pending', ['tasks' => $taksPending]);
    }

    public function expired()
    {
        $today = Date::now()->toDateString();
        $taksPending = TaskToDo::query()->whereDate('dateExecution', '<', $today)->get();
        //$taksPending = TaskToDo::query()->where('done', '=', 0)->where('dateExecution', '<', $today)->get();

        return view('filter.expired', ['tasks' => $taksPending]);
    }

    public function planned()
    {
        $today = Date::now()->toDateString();
        $taksPending = TaskToDo::query()->whereDate('dateExecution', '>', $today)->get();
        return view('filter.planned', ['tasks' => $taksPending]);
    }

    public function today()
    {
        $today = Date::now()->toDateString();
        $today_tasks = TaskToDo::query()->whereDate('dateExecution', '=', $today)->get();
        //$today_tasks = TaskToDo::query()->where('done', '=', 0)->where('dateExecution', '=', $today)->get();

        return view('filter.today', ['tasks' => $today_tasks]);
    }


}
