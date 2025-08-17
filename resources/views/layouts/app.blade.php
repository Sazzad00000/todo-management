<!DOCTYPE html>
<html lang="{{ str_replace('_','-',app()->getLocale()) }}" data-theme="{{ $theme ?? 'light' }}">
<head>
    <meta charset="utf-8">
    <title>{{ config('app.name','To-Do') }}</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
    <style>
        body      { background:#f5f5f5; font-family:Inter, sans-serif; }
        .card     { max-width:640px; margin:auto; background:#fff; border-radius:12px; box-shadow:0 2px 10px rgba(0,0,0,.07); padding:2.5rem; }
        h1        { color:#673ab7; font-weight:600; }
        label     { font-weight:500; margin-top:1.25rem; display:block; }
        input[type=text], textarea, select {
            width:100%; padding:.75rem 1rem; border:1px solid #ddd;
            border-radius:8px; margin-top:.25rem;
        }
        button, .btn {
            background:#673ab7; color:#fff; padding:.6rem 1.6rem;
            border:none; border-radius:24px; cursor:pointer;
            transition:.2s;
        }
        button:hover { background:#5b2eb4; }
        .dark body   { background:#121212; }
        .dark .card  { background:#1e1e1e; color:#eee; }
    </style>
</head>
<body>

@auth
<form action="{{ route('theme.toggle') }}" method="POST" style="position:fixed;top:1rem;right:1rem;">
    @csrf
    <button type="submit" class="btn">{{ $theme==='dark' ? '☀️' : '🌙' }}</button>
</form>
@endauth
@auth
    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit" class="btn">Logout</button>
    </form>
@endauth


<div class="card">
    @yield('content')
</div>

</body>
</html>
