<h2>
    User Reset Password
</h2><br>

@if($errors->any())
    @foreach($errors->all() as $error)
        {{ $error }}
    @endforeach
@endif

@if(session('success'))
    {{ session('success') }}
@endif

@if(session('error'))
    {{ session('error') }}
@endif

<div>
    <form action="{{ route('reset.password.submit') }}" method="post">
        @csrf
        <input type="hidden" name="token" value="{{ $token }}">
        <div>
            <label for="email">Email:</label>
            <input type="email" name="email" id="email" value="{{ $email }}" readonly>
        </div><br>
        <div>
            <label for="password">Password:</label>
            <input type="password" name="password" id="password" placeholder="Enter new password" required>
        </div><br>
        <div>
            <label for="password_confirmation">Confirm Password:</label>
            <input type="password" name="password_confirmation" id="password_confirmation"
                placeholder="Confirm new password" required>
        </div><br>
        <button type="submit">Submit</button>
    </form>
</div>