@extends('frontend.layouts.app')

@section('title', 'Reset Password')

@section('content')
    <!-- Forget Password Section -->
    <section class="forget-password-section py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-5">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body p-5">

                            <h3 class="text-center fw-bold mb-4">Forgot Password?</h3>

                            <form action="{{ route('reset.password.submit') }}" method="post">
                                @csrf

                                <input type="hidden" name="token" value="{{ $token }}">

                                <div class="mb-4">
                                    <label class="form-label">Your Email Address</label>
                                    <input type="text" class="form-control" name="email" value="{{ $email }}" readonly>
                                </div>

                                <div class="mb-4">
                                    <label class="form-label" for="password">Password <span class="text-danger">*</span></label>
                                    <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror">
                                    @error('password')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="mb-4">
                                    <label class="form-label" for="confirm_password">Confirm Password <span class="text-danger">*</span></label>
                                    <input type="password" class="form-control" name="password_confirmation" id="confirm_password">
                                </div>

                                <button type="submit" class="btn btn-success w-100 mb-3">
                                    <i class="bi bi-send me-2"></i>Submit
                                </button>

                                <div class="text-center">
                                    <a href="{{ route('login') }}" class="text-decoration-none">
                                        <i class="bi bi-arrow-left me-1"></i>Back to Login
                                    </a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection