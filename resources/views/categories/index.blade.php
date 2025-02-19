@extends('layouts.app')

@section('content')
   <div class="category-page">
    <h1>Here! Your tasks find their place</h1>
    <div class="category-container">
    @if(session('success'))
            <div class="p">
                {{ session('success') }}
            </div>
        @endif
        @foreach($categories as $category)
            <div class="category-card" style="background-image: url('{{ asset('storage/' . (isset($categoryImages[$category->name]) ? $categoryImages[$category->name] : 'images/default.jpg')) }}');">
                <h3>{{ $category->name }}</h3>

                <div class="category-btn-container">
                    @if($category->tasks->count() > 0)
                        <ul>
                            @foreach($category->tasks as $task)
                            <li class="task-item">
                              <div style="display: flex; align-items: center;">
                                <p style="margin-right: 160px;">{{ $task->created_at->format('Y-m-d') }}</p>
                                 <p>{{ $task->title }}</p>
                              </div>
                                <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="category-delete">❌</button>
                                </form>
                                </li>

                            @endforeach
                        </ul>
                    @else
                        <p>No tasks in this category.</p>
                    @endif
                </div>
            </div>
        @endforeach
    </div>
</div>

@endsection
