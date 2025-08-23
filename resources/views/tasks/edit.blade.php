@extends('layouts.app')

@section('content')
    <h1>Edit Task</h1>

    {!! Form::model($task, ['route' => ['tasks.update', $task->id], 'method' => 'PUT']) !!}  <!-- মডেল বাইন্ডিং -->

    {!! Form::label('title', 'Task Title') !!}
    {!! Form::text('title', old('title', $task->title), ['class' => 'form-control', 'required' => true]) !!}
    @error('title')
        <span class="text-danger">{{ $message }}</span>
    @enderror

    {!! Form::label('description', 'Description') !!}
    {!! Form::textarea('description', old('description', $task->description), ['class' => 'form-control']) !!}
    @error('description')
        <span class="text-danger">{{ $message }}</span>
    @enderror

    {!! Form::label('status', 'Status') !!}
    {!! Form::select('status', ['Pending' => 'Pending', 'Completed' => 'Completed'], old('status', $task->status), ['class' => 'form-control']) !!}

    {!! Form::submit('Update Task', ['class' => 'btn btn-primary']) !!}

    {!! Form::close() !!}
@endsection
