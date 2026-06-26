@extends('layouts.app')

@section('header', 'Create New Task')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8 col-lg-6">
        <div class="card task-card p-4 shadow-sm border-0 bg-white">
            <h4 class="fw-bold mb-4">Create New Task</h4>

            <form action="{{ route('tasks.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <!-- Display validation errors here -->
                @include('partials.errors')

                <!-- Title Input -->
                <div class="form-floating mb-3">
                    <input type="text" name="title" class="form-control" id="titleInput" placeholder="Task Title" required>
                    <label for="titleInput">Task Title</label>
                </div>

                <!-- Description Textarea -->
                <div class="form-floating mb-3">
                    <textarea name="description" class="form-control" id="descInput" placeholder="Description" style="height: 100px"></textarea>
                    <label for="descInput">Description (Optional)</label>
                </div>

                <!-- Deadline Date -->
                <div class="form-floating mb-3">
                    <input type="date" name="deadline" class="form-control" id="dateInput">
                    <label for="dateInput">Deadline (Optional)</label>
                </div>

                <!-- Tags Selection (Many-to-Many) -->
                <div class="mb-3">
                    <label class="form-label text-muted small fw-semibold">Tags (Hold CTRL to select multiple)</label>
                    <select name="tags[]" class="form-select" multiple>
                        @foreach(\App\Models\Tag::all() as $tag)
                            <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- File Attachment Input -->
                <div class="mb-4">
                    <label class="form-label text-muted small fw-semibold">Task Attachment (Image)</label>
                    <input type="file" name="image" class="form-control">
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