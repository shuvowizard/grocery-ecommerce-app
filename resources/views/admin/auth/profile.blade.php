<a href="{{ route('admin.dashboard') }}">Dashboard</a> |
<a href="{{ route('admin.profile') }}">Edit Profile</a> |
<a href="{{ route('admin.logout') }}">Logout</a> |
<p>Welcome <b style="color: red;">{{ auth()->guard('admin')->user()->name }}</b> to the home page!</p>


<h2> Admin Profile </h2>

@if($errors->any())
    @foreach($errors->all() as $error)
        <p style="color: red;">{{ $error }}</p>
    @endforeach
@endif

@if(session('success'))
    <p style="color: green;">{{ session('success') }}</p>
@endif

@if(session('error'))
    <p style="color: red;">{{ session('error') }}</p>
@endif

<form action="{{ route('admin.profile.update') }}" method="post" enctype="multipart/form-data">
    @csrf
    <!-- make a form for update user -->
    <label for="name">Name:</label>
    <input type="text" name="name" value="{{ auth()->guard('admin')->user()->name }}"><br><br>

    <label for="email">Email:</label>
    <input type="email" name="email" value="{{  auth()->guard('admin')->user()->email }}" readonly><br><br>

    <label for="password">Password:</label>
    <input type="password" name="password"><br><br>

    <label for="password">Confirm Password:</label>
    <input type="password" name="password_confirmation"><br><br>

    <label for="image">Image:</label>
    <input type="file" name="photo">
    @if (auth()->guard('admin')->user()->photo)
        <img src="{{ asset('uploads/admin/' . auth()->guard('admin')->user()->photo) }}" alt="Admin Image" width="100" height="100">
    @endif
    <br><br>

    <button type="submit">Update</button>
</form>