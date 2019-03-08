<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Repositories\TaskRepository;
use App\Task;

class TaskController extends Controller
{
    /**
     * The task repository instance.
     *
     * @var TaskRepository
     */
    protected $tasks;

    /**
     * Create a new controller instance.
     *
     * @param  TaskRepository  $tasks
     * @return void.
     */
    public function __construct(TaskRepository $tasks)
    {
        $this->middleware('auth');

        $this->tasks = $tasks;
    }

    /**
     * Displaying a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view('tasks.index', [
            'tasks' => $this->tasks->forUser($request->user())
        ]);
    }

    /**
     * Get list of the tasks for a given user.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getTasks(Request $request)
    {
        $tasks = $this->tasks->forUser($request->user());

        return response()->json(compact('tasks'));
    }

    /**
     * Get list of the completed tasks for a given user.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getCompletedTasks(Request $request)
    {
        $completed = $this->tasks->completedForUser($request->user());

        return response()->json(compact('completed'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:255'
        ]);

        $task = $request->user()->tasks()->create([
            'name' => $request->name,
        ]);

        return response()->json(compact('task'));
    }

    /**
     * Destroy the give task.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Task                      $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Task $task)
    {
        $this->authorize('destroy', $task);

        $task->delete();
    }

    /**
     * Uncomplete the given task.
     *
     * @param  Task                      $task
     * @return \Illuminate\Http\Response
     */
    public function update($task)
    {
        $task = Task::withTrashed()
            ->where('id', $task)
            ->first();

        $this->authorize('destroy', $task);

        $task->restore();
    }
}
