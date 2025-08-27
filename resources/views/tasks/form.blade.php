@extends('layouts.app')

@section('content')
<h1>{{ $task ? 'Edit Task' : 'New Task' }}</h1>

@if($errors->any())
    <ul style="color:#d33;">
        @foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach
    </ul>
@endif

<form action="{{ $task ? route('tasks.update',$task['id']) : route('tasks.store') }}" method="POST" style="margin-top:1.5rem;">
    @csrf
    @if($task) @method('PUT') @endif

    <label>Title
        <input type="text" name="title" value="{{ old('title', $task['title'] ?? '') }}" required>
    </label>

    <label>Description
        <textarea name="description" rows="3">{{ old('description', $task['description'] ?? '') }}</textarea>
    </label>

    <label>Status
        <select name="status">
            <option value="0" @selected(old('status',$task['status'] ?? 0)==0)>Pending</option>
            <option value="1" @selected(old('status',$task['status'] ?? 0)==1)>Done</option>
        </select>
    </label>

    <button type="submit" style="margin-top:1.5rem;">Save</button>
</form>
@endsection
