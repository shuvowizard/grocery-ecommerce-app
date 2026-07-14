<h2>User Forget Password</h2>

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

<form action="{{ route('forget.password.submit') }}" method="post">
    @csrf
    <div>
        <label for="email">Email:</label>
        <input type="email" name="email" id="email" required>
    </div><br>
    <div>
        <a href="{{ route('login') }}">Back to Login</a>
    </div><br>
    <button type="submit">Submit</button>
</form>