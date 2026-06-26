@extends('layouts.app')

@section('header', 'Edit Task')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8 col-lg-6">
        <div class="card task-card p-4 shadow-sm border-0 bg-white">
            <h4 class="fw-bold mb-4">Edit Task</h4>
            
            <!-- Added enctype for file uploads -->
            <form action="{{ route('tasks.update', $task) }}" method="POST" enctype="multipart/form-data">
                @csrf @method('PUT')
                
                <!-- Display validation errors here -->
                @include('partials.errors')
                
                <!-- Task Title -->
                <div class="form-floating mb-3">
                    <input type="text" name="title" class="form-control" id="titleInput" value="{{ $task->title }}" required>
                    <label for="titleInput">Task Title</label>
                </div>

                <!-- Description -->
                <div class="form-floating mb-3">
                    <textarea name="description" class="form-control" id="descInput" style="height: 100px">{{ $task->description }}</textarea>
                    <label for="descInput">Description</label>
                </div>

                <!-- Status & Deadline side-by-side -->
                <div class="row mb-3">
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

                <!-- Tags Selection (Many-to-Many Relationship) -->
                <div class="mb-3">
                    <label class="form-label text-muted small fw-semibold">Tags (Hold CTRL to select multiple)</label>
                    <select name="tags[]" class="form-select" multiple>
                        @foreach(\App\Models\Tag::all() as $tag)
                            <option value="{{ $tag->id }}" {{ $task->tags->contains($tag->id) ? 'selected' : '' }}>
                                {{ $tag->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- File Attachment Input (with live thumbnail of current image) -->
                <div class="mb-4">
                    <label class="form-label text-muted small fw-semibold">Task Attachment (Image)</label>
                    <input type="file" name="image" class="form-control">
                    @if($task->image_path)
                        <div class="mt-2">
                            <span class="text-muted d-block small mb-1">Current Image:</span>
                            <img src="{{ asset('storage/' . $task->image_path) }}" alt="Current Image" class="img-thumbnail" style="max-height: 80px;">
                        </div>
                    @endif
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