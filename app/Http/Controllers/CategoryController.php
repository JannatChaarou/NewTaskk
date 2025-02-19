<?php
namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {   
        $userId = Auth::id(); 

        $categories = Category::whereHas('tasks', function ($query) use ($userId) {
            $query->where('user_id', $userId);
        })->with(['tasks' => function ($query) use ($userId) {
            $query->where('user_id', $userId);
        }])->get();

        return view('categories.index', compact('categories'));
    }

    public function create()
    {
        return view('categories.create');
    }

    public function store(Request $request)
    {
    }

    public function edit(Category $category)
    {
        
    }

    public function update(Request $request, Category $category)
    {
       
    }

    public function destroy(Category $category)
    {
       
    }
}
