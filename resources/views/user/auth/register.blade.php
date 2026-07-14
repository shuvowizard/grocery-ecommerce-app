@include('user.top')

<h2>User Register</h2>

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
    <form action="#" method="post">
        @csrf
        <div>
            <label for="name">Name:</label>
            <input type="text" name="name" id="name">
        </div><br>
        <div>
            <label for="email">Email:</label>
            <input type="email" name="email" id="email">
        </div><br>
        <div>
            <label for="password">Password:</label>
            <input type="password" name="password" id="password">
        </div><br>
        <div>
            <label for="confirm_password">Confirm Password:</label>
            <input type="password" name="password_confirmation" id="confirm_password">
        </div><br>
        <div>
            <a href="{{ route('login') }}">If you already have an account?</a>
        </div><br>
        <button type="submit">Register</button>
    </form>
</div>