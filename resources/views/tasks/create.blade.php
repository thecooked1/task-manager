@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8 col-lg-6">
        <div class="card task-card p-4">
            <h4 class="fw-bold mb-4">Create New Task</h4>
            
            <form action="{{ route('tasks.store') }}" method="POST">
                @csrf
                
                <div class="form-floating mb-3">
                    <input type="text" name="title" class="form-control" id="titleInput" placeholder="Task Title" required>
                    <label for="titleInput">Task Title</label>
                </div>

                <div class="form-floating mb-3">
                    <textarea name="description" class="form-control" id="descInput" placeholder="Description" style="height: 100px"></textarea>
                    <label for="descInput">Description (Optional)</label>
                </div>

                <div class="form-floating mb-4">
                    <input type="date" name="deadline" class="form-control" id="dateInput">
                    <label for="dateInput">Deadline (Optional)</label>
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary w-100">Save Task</button>
                    <a href="{{ route('tasks.index') }}" class="btn btn-light w-100 border">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection