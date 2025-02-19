<?php
namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;

use App\Models\Category;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class TaskController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
    }

    /**
     * Display a listing of the tasks.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $priority = $request->get('priority');
        $title = $request->get('title');

        $tasks = Task::where('user_id', Auth::id())->with('category');  
        if ($priority) {
            $tasks = $tasks->where('priority', $priority);
        }

        if ($title) {
            $tasks = $tasks->where('title', 'like', '%' . $title . '%');
        }

        $tasks = $tasks->get();

        return view('tasks.index', compact('tasks'));
    }

    /**
     * Show the form for creating a new task.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('tasks.create', compact('categories'));
    }

    /**
     * Store a newly created task in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'priority' => 'required|in:low,medium,high',
            'category_id' => 'required|exists:categories,id', 
        ]);
    
        $task = Task::create(array_merge($validated, ['user_id' => Auth::id()]));
    
        return redirect()->route('tasks.index')->with('success', 'Task created successfully!');
    }
    


    /**
     * Display the specified task.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        if ($task->user_id !== Auth::id()) {
            return redirect()->route('tasks.index')->with('error', 'You do not have permission to view this task.');
        }

        return view('tasks.show', compact('task'));
    }

    /**
     * Show the form for editing the specified task.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task)
    {
        if ($task->user_id !== Auth::id()) {
            return redirect()->route('tasks.index')->with('error', 'You do not have permission to edit this task.');
        }

        $categories = Category::all(); 
        return view('tasks.edit', compact('task', 'categories'));
    }

    /**
     * Update the specified task in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Task $task)
    {
        if ($task->user_id !== Auth::id()) {
            return redirect()->route('tasks.index')->with('error', 'You do not have permission to update this task.');
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'priority' => 'required|in:low,medium,high',
            'category_id' => 'required|exists:categories,id', 
        ]);

        $task->update($validated);

        return redirect()->route('tasks.index')->with('success', 'Task updated successfully!');
    }

    /**
     * Remove the specified task from storage.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        if ($task->user_id !== Auth::id()) {
            return redirect()->route('tasks.index')->with('error', 'You do not have permission to delete this task.');
        }

        $task->delete();

        return redirect()->route('tasks.index')->with('success', 'Task deleted successfully!');
    }

    public function toggle(Task $task)
{
    if ($task->user_id !== Auth::id()) {
        return redirect()->route('tasks.index')->with('error', 'You do not have permission to update this task.');
    }

    
    return redirect()->route('tasks.show', $task->id)->with('success', 'Task updated successfully!');
}

public function generatePDF()
{
    $tasks = Task::all();

    $pdf = PDF::loadView('tasks.pdf', compact('tasks'));

    return $pdf->download('tasks_list.pdf');
}

public function bulkDelete(Request $request)
{
    $taskIds = $request->task_ids;

    if (!$taskIds || !is_array($taskIds)) {
        return response()->json(['success' => false, 'message' => 'Invalid request']);
    }

    Task::whereIn('id', $taskIds)->where('user_id', Auth::id())->delete();

    return response()->json(['success' => true, 'message' => 'Tasks deleted successfully']);
}



}
