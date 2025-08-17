<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class TaskController extends Controller
{
    private function allTasks(): array
    {
        return session('tasks', []);
    }

    private function saveTasks(array $tasks): void
    {
        session(['tasks' => $tasks]);
    }

    public function index(Request $request)
    {
        return view('tasks.index', [
            'tasks' => $this->allTasks(),
            'theme' => $request->cookie('theme', 'light'),
        ]);
    }

    public function create(Request $request)
    {
        return view('tasks.form', [
            'task'  => null,
            'theme' => $request->cookie('theme', 'light'),
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title'       => 'required|min:3',
            'description' => 'nullable|max:255',
            'status'      => 'nullable|boolean',
        ]);

        $tasks = $this->allTasks();
        $id    = (string) Str::uuid();
        $tasks[$id] = array_merge($data, ['id' => $id]);
        $this->saveTasks($tasks);

        return to_route('tasks.index')->with('success', 'Task added.');
    }

    public function edit(string $id, Request $request)
    {
        $task = Arr::get($this->allTasks(), $id);
        abort_unless($task, 404);

        return view('tasks.form', [
            'task'  => $task,
            'theme' => $request->cookie('theme', 'light'),
        ]);
    }

    public function update(string $id, Request $request)
    {
        $data = $request->validate([
            'title'       => 'required|min:3',
            'description' => 'nullable|max:255',
            'status'      => 'nullable|boolean',
        ]);

        $tasks = $this->allTasks();
        abort_unless(isset($tasks[$id]), 404);

        $tasks[$id] = array_merge($tasks[$id], $data);
        $this->saveTasks($tasks);

        return to_route('tasks.index')->with('success', 'Task updated.');
    }

    public function destroy(string $id)
    {
        $tasks = $this->allTasks();
        unset($tasks[$id]);
        $this->saveTasks($tasks);

        return back()->with('success', 'Task deleted.');
    }

    public function toggleTheme(Request $request)
    {
        $current = $request->cookie('theme', 'light');
        $new     = $current === 'light' ? 'dark' : 'light';

        return back()->withCookie(cookie('theme', $new, 60*24*365));
    }
}
