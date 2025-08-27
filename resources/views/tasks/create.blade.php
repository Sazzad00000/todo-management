@extends('layouts.app')

@section('content')
    <div class="card"
         style="max-width: 600px; margin: 2rem auto;
                padding: 2rem; border-radius: 12px;
                box-shadow: 0 4px 8px rgba(0,0,0,.1);">

        <h1 style="text-align:center; margin-bottom:1.5rem;">Add New Task</h1>

        {{-- Collective Form --}}
        {!! Form::open(['route' => 'tasks.store']) !!}  {{-- Form ওপেন --}}

        {{-- Title --}}
        <div style="margin-bottom:1rem;">
            {!! Form::label('title', 'Task Title', ['style' => 'font-weight:bold;']) !!}
            {!! Form::text('title', old('title'),
                    ['class' => 'form-control',
                     'style' => 'width:100%; padding:.5rem; border:1px solid #ccc; border-radius:8px;',
                     'required' => true]) !!}
            @error('title')
                <span class="text-danger" style="display:block;">{{ $message }}</span>
            @enderror
        </div>

        {{-- Description --}}
        <div style="margin-bottom:1rem;">
            {!! Form::label('description', 'Description', ['style' => 'font-weight:bold;']) !!}
            {!! Form::textarea('description', old('description'),
                    ['class' => 'form-control',
                     'style' => 'width:100%; min-height:100px; padding:.5rem; border:1px solid #ccc; border-radius:8px;']) !!}
            @error('description')
                <span class="text-danger" style="display:block;">{{ $message }}</span>
            @enderror
        </div>

        {{-- Submit --}}
        {!! Form::submit('Add Task',
                ['class' => 'btn btn-primary',
                 'style' => 'width:100%; padding:.75rem; border:none; border-radius:24px;']) !!}

        {!! Form::close() !!}  {{-- Form ক্লোজ --}}
    </div>

    {{-- Dark-mode overrides --}}
    <style>
        body.dark .card            {background:#1e1e1e; color:#fff;}
        body.dark input,
        body.dark textarea         {background:#333; color:#fff; border-color:#555;}
        body.dark .btn-primary     {background:#0d6efd;}
    </style>
@endsection
