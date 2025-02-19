@extends('layouts.app')

@section('content')
    <div class="category-page">
        <div class="category-container">
            <h1 class="text-3xl font-bold mb-4 {{ $task->completed ? 'line-through text-green-500' : 'text-gray-900' }}">
                {{ $task->title }}
            </h1>
            <p class="text-gray-500 text-sm mb-2">
                <strong>Category:</strong> {{ $task->category->name }}<br>
                <strong>Priority:</strong> {{ ucfirst($task->priority) }}<br>
                <strong>Created:</strong> {{ \Carbon\Carbon::parse($task->created_at)->format('d/m/Y H:i') }}
            </p>
            <p class="text-gray-800 mb-4">
                <strong>Description:</strong> {{ $task->description }}
            </p>

            <div class="editask">
                <a href="{{ route('tasks.edit', $task->id) }}" class="task-submit-btn" >Edit Task</a>
            </div>
        </div>
    </div>
@endsection
