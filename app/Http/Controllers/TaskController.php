<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;

class TaskController extends Controller
{
    public function index(Request $request)
    {
        $query = Task::query();

        // Search functionality (Bonus)
        if ($request->has('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        // Filtering functionality
        if ($request->has('status') && in_array($request->status, ['pending', 'done'])) {
            $query->where('status', $request->status);
        }

        // Pagination (Bonus)
        $tasks = $query->orderBy('deadline', 'asc')->paginate(5);

        return view('tasks.index', compact('tasks'));
    }
}
