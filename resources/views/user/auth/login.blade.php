@include('user.top')

<h2>User Login</h2>

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
    <form action="{{ route('login') }}" method="post">
        @csrf
        <div>
            <label for="email">Email:</label>
            <input type="email" name="email" id="email">
        </div><br>
        <div>
            <label for="password">Password:</label>
            <input type="password" name="password" id="password">
        </div><br>
        <div>
            <input type="checkbox" name="remember" id="remember">
            <label for="remember">Remember Me</label>
        </div><br>
        <div>
            <a href="{{ route('forget.password') }}">Forgot Your Password?</a>
        </div><br>
        <div>
            <a href="{{ route('register') }}">Don't have an account?</a>
        </div><br>
        <button type="submit">Login</button>
    </form>
</div>