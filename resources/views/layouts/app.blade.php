<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Iland</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 0; padding: 0; background: #f6f8fb; }
        nav { background: #1f2937; color: #fff; padding: 12px 18px; display: flex; justify-content: space-between; align-items: center; }
        nav a { color: #fff; margin-right: 14px; text-decoration: none; font-weight: 600; }
        nav .brand { font-size: 18px; font-weight: 700; }
        .container { max-width: 900px; margin: 24px auto; padding: 0 16px; }
        .card { background: #fff; border-radius: 8px; padding: 20px; box-shadow: 0 2px 6px rgba(0,0,0,0.08); }
        .form-group { margin-bottom: 14px; display: flex; flex-direction: column; }
        label { font-weight: 700; margin-bottom: 6px; }
        input[type="text"], input[type="email"], input[type="password"], input[type="date"], textarea, select { padding: 10px; border: 1px solid #d1d5db; border-radius: 6px; }
        button { padding: 10px 16px; background: #2563eb; color: white; border: none; border-radius: 6px; cursor: pointer; font-weight: 700; }
        .nav-links { display: flex; align-items: center; }
        .nav-right form { display: inline; }
        .error { color: #b91c1c; margin-top: 4px; font-size: 14px; }
        .flash { background: #d1fae5; border: 1px solid #10b981; color: #065f46; padding: 10px; border-radius: 6px; margin-bottom: 16px; }
    </style>
</head>
<body>
<nav>
    <div class="nav-links">
        <span class="brand">Student Iland</span>
        @auth
            <a href="{{ route('dashboard') }}">Home</a>
            <a href="{{ route('students') }}">Students</a>
            <a href="{{ route('groups') }}">Groups</a>
            <a href="{{ route('messages') }}">Messages</a>
            <a href="{{ route('profile.show') }}">Profile</a>
        @endauth
    </div>
    <div class="nav-right">
        @auth
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit">Logout</button>
            </form>
        @else
            <a href="{{ route('login') }}">Login</a>
            <a href="{{ route('register') }}">Register</a>
        @endauth
    </div>
</nav>
<div class="container">
    @if (session('status'))
        <div class="flash">{{ session('status') }}</div>
    @endif
    @yield('content')
</div>
</body>
</html>
