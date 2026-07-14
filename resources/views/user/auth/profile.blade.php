@include('user.top')

<h2> User Profile </h2>

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

<form action="{{ route('profile.update') }}" method="post" enctype="multipart/form-data">
    @csrf
    <!-- make a form for update user -->
    <label for="name">Name:</label>
    <input type="text" name="name" value="{{ auth()->guard('web')->user()->name }}"><br><br>

    <label for="email">Email:</label>
    <input type="email" name="email" value="{{ auth()->guard('web')->user()->email }}"><br><br>

    <label for="password">Password:</label>
    <input type="password" name="password"><br><br>

    <label for="password">Confirm Password:</label>
    <input type="password" name="password_confirmation"><br><br>

    <label for="image">Image:</label>
    <input type="file" name="photo">
    @if (auth()->guard('web')->user()->photo)
        <img src="{{ asset('uploads/user/' . auth()->guard('web')->user()->photo) }}" alt="User Image" width="100" height="100">
    @endif
    <br><br>

    <label for="phone">Phone:</label>
    <input type="text" name="phone" value="{{ auth()->guard('web')->user()->phone }}"><br><br>
    
    <label for="address">Address:</label>
    <input type="text" name="address" value="{{ auth()->guard('web')->user()->address }}"><br><br>
    
    <label for="country">Country:</label>
    <input type="text" name="country" value="{{ auth()->guard('web')->user()->country }}"><br><br>

    <label for="state">State:</label>
    <input type="text" name="state" value="{{ auth()->guard('web')->user()->state }}"><br><br>

    <label for="city">City:</label>
    <input type="text" name="city" value="{{ auth()->guard('web')->user()->city }}"><br><br>

    <label for="zip">Zip:</label>
    <input type="text" name="zip" value="{{ auth()->guard('web')->user()->zip }}"><br><br>

    <button type="submit">Update</button>
</form>