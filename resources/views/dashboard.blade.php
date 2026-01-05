<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
</head>
<body>
    <h1>Selamat datang, {{ Auth::user()->name }}!</h1>
    <p>Email: {{ Auth::user()->email }}</p>
    
    <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit">Logout</button>
    </form>
</body>
</html>