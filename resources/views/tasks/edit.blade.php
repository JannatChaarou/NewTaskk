@extends('layouts.app')

@section('content')
<div class="todo-container">
<h1 class="todo-header">Edit Task</h1>
<form action="{{ route('tasks.update', $task->id) }}" method="POST" class="todo-form">
    @csrf
    @method('PUT')

    <div class="task-form-group">
        <label for="title" class="task-label">Title:</label>
        <input type="text" id="title" name="title" class="task-input" value="{{ old('title', $task->title) }}" required>
    </div>

    <div class="task-form-group">
        <label for="description" class="task-label">Description:</label>
        <textarea id="description" name="description" rows="4" class="task-textarea" required>{{ old('description', $task->description) }}</textarea>
    </div>

    <div class="task-form-group">
        <label for="priority" class="task-label">Priority:</label>
        <select id="priority" name="priority" class="task-select"required>
            <option value="low" {{ old('priority', $task->priority) == 'low' ? 'selected' : '' }}>Low</option>
            <option value="medium" {{ old('priority', $task->priority) == 'medium' ? 'selected' : '' }}>Medium</option>
            <option value="high" {{ old('priority', $task->priority) == 'high' ? 'selected' : '' }}>High</option>
        </select>
    </div>

    <div class="task-form-group">
        <label for="category_id" class="task-label">Category:</label>
        <select id="category_id" name="category_id"class="task-select"  required>
            @foreach($categories as $category)
                <option value="{{ $category->id }}" {{ old('category_id', $task->category_id) == $category->id ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="task-form-group">
        <button type="submit" class="task-submit-btn">Update Task</button>
    </div>
</form>
</div>
@endsection