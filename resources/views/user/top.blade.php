<a href="{{ route('home') }}">Home</a> | 
@if (auth()->guard('web')->check())
<a href="{{ route('dashboard') }}">Dashboard</a> | 
<a href="{{ route('profile') }}">Edit Profile</a> | 
<a href="{{ route('logout') }}">Logout</a> | 
<p>Welcome <b style="color: red;">{{ auth()->guard('web')->user()->name }}</b> to the home page!</p>
@else
<a href="{{ route('login') }}">Login</a> | 
<a href="{{ route('register') }}">Register</a>
@endif
