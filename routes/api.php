<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Task;

Route::get('/tasks', function () {
    return response()->json([
        'success' => true,
        'message' => 'Tasks retrieved successfully',
        'data' => Task::with('user:id,name')->get()
    ]);
});
