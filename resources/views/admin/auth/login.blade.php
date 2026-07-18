@extends('admin.layouts.base')

@section('childContent')

    <section class="section">
        <div class="container container-login">
            <div class="row">
                <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
                    <div class="card card-primary border-box">
                        <div class="card-header card-header-auth">
                            <h4 class="text-center">Admin Panel Login</h4>
                        </div>
                        <div class="card-body card-body-auth">
                            <form action="{{ route('admin.login.store') }}" method="post">
                                @csrf

                                <div class="form-group">
                                    <input type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                                        placeholder="Email Address" value="{{ old('email') }}" autofocus>
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <input type="password" class="form-control" name="password" placeholder="Password">
                                </div>

                                <div class="form-group d-flex justify-content-between align-items-center mb-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember">
                                        <label class="form-check-label" for="remember">
                                            Remember Me
                                        </label>
                                    </div>
                                    <div>
                                        <a href="{{ route('admin.forget.password') }}">Forget Password?</a>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary btn-lg w_100_p">
                                        Login
                                    </button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection