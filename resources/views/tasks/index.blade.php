@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>My Tasks</h2>
    <a href="{{ route('tasks.create') }}" class="btn btn-primary"><i class="bi bi-plus"></i> New Task</a>
</div>

<div class="card mb-4">
    <div class="card-body">
        <form action="{{ route('tasks.index') }}" method="GET" class="row g-3">
            <div class="col-md-6">
                <input type="text" name="search" class="form-control" placeholder="Search tasks..." value="{{ request('search') }}">
            </div>
            <div class="col-md-4">
                <select name="status" class="form-select">
                    <option value="">All Statuses</option>
                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="done" {{ request('status') == 'done' ? 'selected' : '' }}>Done</option>
                </select>
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-secondary w-100">Filter</button>
            </div>
        </form>
    </div>
</div>

<div class="card">
    <ul class="list-group list-group-flush">
        @forelse($tasks as $task)
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <div>
                    <h5 class="{{ $task->status === 'done' ? 'text-decoration-line-through text-muted' : '' }}">
                        {{ $task->title }}
                    </h5>
                    <small class="text-muted">Deadline: {{ $task->deadline ?? 'No deadline' }}</small>
                </div>
                <div class="d-flex gap-2">
                    <!-- Toggle Status -->
                    <form action="{{ route('tasks.toggle', $task) }}" method="POST">
                        @csrf @method('PATCH')
                        <button type="submit" class="btn btn-sm {{ $task->status === 'done' ? 'btn-warning' : 'btn-success' }}">
                            {{ $task->status === 'done' ? 'Mark Pending' : 'Mark Done' }}
                        </button>
                    </form>
                    
                    <a href="{{ route('tasks.edit', $task) }}" class="btn btn-sm btn-info text-white">Edit</a>
                    
                    <form action="{{ route('tasks.destroy', $task) }}" method="POST" onsubmit="return confirm('Are you sure?');">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                    </form>
                </div>
            </li>
        @empty
            <li class="list-group-item text-center">No tasks found.</li>
        @endforelse
    </ul>
</div>

<div class="mt-3">
    {{ $tasks->withQueryString()->links() }}
</div>
@endsection