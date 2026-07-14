<a href="{{ route('admin.dashboard') }}">Dashboard</a> |
<a href="{{ route('admin.profile') }}">Edit Profile</a> |
<a href="{{ route('admin.logout') }}">Logout</a> |
<p>Welcome <b style="color: red;">{{ auth()->guard('admin')->user()->name }}</b> to the home page!</p>


<h2>Admin Dashboard</h2><br>
