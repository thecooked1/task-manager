@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8 col-lg-6">
        <div class="card task-card p-4">
            <h4 class="fw-bold mb-4">Edit Task</h4>
            
            <form action="{{ route('tasks.update', $task) }}" method="POST">
                @csrf @method('PUT')
                
                <div class="form-floating mb-3">
                    <input type="text" name="title" class="form-control" id="titleInput" value="{{ $task->title }}" required>
                    <label for="titleInput">Task Title</label>
                </div>

                <div class="form-floating mb-3">
                    <textarea name="description" class="form-control" id="descInput" style="height: 100px">{{ $task->description }}</textarea>
                    <label for="descInput">Description</label>
                </div>

                <div class="row mb-4">
                    <div class="col-md-6">
                        <div class="form-floating">
                            <select name="status" class="form-select" id="statusInput">
                                <option value="pending" {{ $task->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="done" {{ $task->status == 'done' ? 'selected' : '' }}>Done</option>
                            </select>
                            <label for="statusInput">Status</label>
                        </div>
                    </div>
                    <div class="col-md-6 mt-3 mt-md-0">
                        <div class="form-floating">
                            <input type="date" name="deadline" class="form-control" id="dateInput" value="{{ $task->deadline }}">
                            <label for="dateInput">Deadline</label>
                        </div>
                    </div>
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary w-100">Update Task</button>
                    <a href="{{ route('tasks.index') }}" class="btn btn-light w-100 border">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection