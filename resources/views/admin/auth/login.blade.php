<h2>Admin Login</h2>

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

<div>
    <form action="{{ route('admin.login.store') }}" method="post">
        @csrf
        <div>
            <label for="email">Email:</label>
            <input type="email" name="email" id="email" required>
        </div><br>
        <div>
            <label for="password">Password:</label>
            <input type="password" name="password" id="password" required>
        </div><br>
        <div>
            <input type="checkbox" name="remember" id="remember">
            <label for="remember">Remember Me</label>
        </div><br>
        <div>
            <a href="{{ route('admin.forget.password') }}">Forgot Your Password?</a>
        </div><br>
        <button type="submit">Login</button>
    </form>
</div>