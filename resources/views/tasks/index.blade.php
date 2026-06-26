<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('My Tasks') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h3 class="fw-bold text-secondary">My Tasks</h3>
                <a href="{{ route('tasks.create') }}" class="btn btn-primary shadow-sm">
                    <i class="bi bi-plus-lg"></i> New Task
                </a>
            </div>

            <div class="card task-card mb-5 shadow-sm border-0">
                <div class="card-body p-4">
                    <form action="{{ route('tasks.index') }}" method="GET" class="row g-3 align-items-center">
                        <div class="col-md-5">
                            <div class="input-group">
                                <span class="input-group-text bg-white border-end-0"><i class="bi bi-search text-muted"></i></span>
                                <input type="text" name="search" class="form-control border-start-0 ps-0" placeholder="Search tasks..." value="{{ request('search') }}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <select name="status" class="form-select text-muted">
                                <option value="">All Statuses</option>
                                <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending Tasks</option>
                                <option value="done" {{ request('status') == 'done' ? 'selected' : '' }}>Completed Tasks</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <button type="submit" class="btn btn-dark w-100">Filter Results</button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="row">
                @forelse($tasks as $task)
                    <div class="col-12 mb-3">
                        <div class="card task-card shadow-sm border-0 {{ $task->status === 'done' ? 'bg-light' : '' }}">
                            <div class="card-body d-flex justify-content-between align-items-center p-4">
                                <div>
                                    <div class="d-flex align-items-center gap-3 mb-1">
                                        <h5 class="mb-0 fw-semibold {{ $task->status === 'done' ? 'text-decoration-line-through text-muted' : '' }}">
                                            {{ $task->title }}
                                        </h5>
                                        @if($task->status === 'done')
                                            <span class="badge bg-success bg-opacity-10 text-success border border-success">Done</span>
                                        @else
                                            <span class="badge bg-warning bg-opacity-10 text-warning border border-warning">Pending</span>
                                        @endif
                                    </div>
                                    
                                    <p class="text-muted mb-1 small">{{ Str::limit($task->description, 60) }}</p>
                                    
                                    <!-- Image Display (Added from File Upload Step) -->
                                    @if($task->image_path)
                                        <div class="mt-2 mb-2">
                                            <img src="{{ asset('storage/' . $task->image_path) }}" alt="Task Attachment" class="img-thumbnail rounded" style="max-height: 120px;">
                                        </div>
                                    @endif
                                    
                                    <div class="text-muted small">
                                        <i class="bi bi-calendar-event me-1"></i> 
                                        {{ $task->deadline ? \Carbon\Carbon::parse($task->deadline)->format('M d, Y') : 'No deadline set' }}
                                    </div>
                                </div>

                                <div class="d-flex gap-2 align-items-center">
                                    <form action="{{ route('tasks.toggle', $task) }}" method="POST">
                                        @csrf @method('PATCH')
                                        <button type="submit" class="btn btn-sm {{ $task->status === 'done' ? 'btn-outline-secondary' : 'btn-outline-success' }}" title="Toggle Status">
                                            <i class="bi {{ $task->status === 'done' ? 'bi-arrow-counterclockwise' : 'bi-check-lg' }} fs-5"></i>
                                        </button>
                                    </form>
                                    
                                    <a href="{{ route('tasks.edit', $task) }}" class="btn btn-sm btn-outline-primary" title="Edit">
                                        <i class="bi bi-pencil-square fs-5"></i>
                                    </a>
                                    
                                    <form action="{{ route('tasks.destroy', $task) }}" method="POST" onsubmit="return confirm('Delete this task?');">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger" title="Delete">
                                            <i class="bi bi-trash fs-5"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center py-5">
                        <i class="bi bi-clipboard-x text-muted" style="font-size: 3rem;"></i>
                        <h5 class="mt-3 text-muted">No tasks found</h5>
                        <p class="text-muted small">Try adjusting your filters or create a new task.</p>
                    </div>
                @endforelse
            </div>

            <div class="mt-4 d-flex justify-content-center">
                {{ $tasks->withQueryString()->links() }}
            </div>

        </div>
    </div>
</x-app-layout>