@extends('layouts.app')

@section('content')
<h1>Your To-Do List</h1>

<a href="{{ route('tasks.create') }}" class="btn" style="margin-top:1.5rem;">＋ Add Task</a>

@if(session('success'))
    <p style="color:green;margin-top:1rem;">{{ session('success') }}</p>
@endif

<ul style="margin-top:2rem;padding-left:0;list-style:none;">
@forelse($tasks as $task)
    <li style="margin-bottom:1.25rem;">
        <strong>{{ $task['title'] }}</strong><br>
        <small>{{ $task['description'] }}</small><br>
        <small>Status: {{ ($task['status']??0) ? 'Done' : 'Pending' }}</small><br>

        <a href="{{ route('tasks.edit',$task['id']) }}">Edit</a> ·
        <form action="{{ route('tasks.destroy',$task['id']) }}" method="POST" style="display:inline;">
            @csrf @method('DELETE')
            <button type="submit" style="background:none;color:#d33;">Delete</button>
        </form>
    </li>
@empty
    <p>No tasks yet.</p>
@endforelse
</ul>
@endsection
