<?php

namespace App\Http\Controllers;

use App\Models\Task;                   // 🔹 Task মডেল
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;   // 🔹 Auth Facade

class TaskController extends Controller
{
    /* ---------- LIST ---------- */
    public function index(Request $request)
    {
        $tasks = Auth::user()->tasks()->latest()->get();   // DB থেকে শুধু লগ-ইন ইউজারের টাস্ক

        return view('tasks.index', [
            'tasks' => $tasks,
            'theme' => $request->cookie('theme', 'light'),
        ]);
    }

    /* ---------- CREATE FORM ---------- */
    public function create(Request $request)
    {
        return view('tasks.form', [     // অথবা create.blade.php
            'task'  => null,
            'theme' => $request->cookie('theme', 'light'),
        ]);
    }

    /* ---------- STORE ---------- */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'       => 'required|min:3',
            'description' => 'nullable|max:255',
        ]);

        try {
            Auth::user()->tasks()->create($validated + ['status' => 'Pending']);
        } catch (\Exception $e) {
            return back()
                ->withErrors(['error' => $e->getMessage()])
                ->withInput();
        }

        return redirect()
            ->route('tasks.index')
            ->with('success', 'Task added!');
    }

    /* ---------- EDIT FORM ---------- */
    public function edit(Task $task, Request $request)   // Route–Model binding
    {
        abort_if($task->user_id !== Auth::id(), 403);

        return view('tasks.form', [
            'task'  => $task,
            'theme' => $request->cookie('theme', 'light'),
        ]);
    }

    /* ---------- UPDATE ---------- */
    public function update(Request $request, Task $task)
    {
        abort_if($task->user_id !== Auth::id(), 403);

        $data = $request->validate([
            'title'       => 'required|min:3',
            'description' => 'nullable|max:255',
            'status'      => 'nullable|in:Pending,Completed',
        ]);

        $task->update($data);

        return redirect()
            ->route('tasks.index')
            ->with('success', 'Task updated.');
    }

    /* ---------- DELETE ---------- */
    public function destroy(Task $task)
    {
        abort_if($task->user_id !== Auth::id(), 403);

        $task->delete();

        return back()->with('success', 'Task deleted.');
    }

    /* ---------- THEME TOGGLE ---------- */
    public function toggleTheme(Request $request)
    {
        $new = $request->cookie('theme', 'light') === 'light' ? 'dark' : 'light';

        return back()->withCookie(cookie('theme', $new, 60 * 24 * 365));
    }
}
