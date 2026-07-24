@extends('frontend.layouts.app')

@section('title', 'Register')

@section('content')
    <!-- Registration Section -->
    <section class="registration-section py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body p-5">
                            <h3 class="text-center fw-bold mb-4">Create Account</h3>

                            <form method="POST" action="{{ route('register.store') }}">
                                @csrf
                                <div class="row g-3">
                                    <div class="col-md-12">
                                        <label class="form-label" for="name">Name <span class="text-danger">*</span></label>
                                        <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror">
                                        @error('name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-12">
                                        <label class="form-label" for="email">Email Address <span class="text-danger">*</span></label>
                                        <input type="text" name="email" id="email" class="form-control @error('email') is-invalid @enderror">
                                        @error('email')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-12">
                                        <label class="form-label" for="password">Password <span class="text-danger">*</span></label>
                                        <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror" >
                                        @error('password')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-12">
                                        <label class="form-label" for="confirm_password">Confirm Password <span
                                                class="text-danger">*</span></label>
                                        <input type="password" class="form-control" name="password_confirmation" id="confirm_password">
                                    </div>

                                    <div class="col-12">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="terms" required>
                                            <label class="form-check-label" for="terms">
                                                I agree to the <a href="{{ route('terms') }}" class="text-success">Terms & Conditions</a>
                                            </label>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <button type="submit" class="btn btn-success w-100">
                                            <i class="bi bi-person-plus me-2"></i>Create Account
                                        </button>
                                    </div>
                                </div>
                            </form>

                            <hr class="my-4">

                            <p class="text-center mb-0">
                                Already have an account?
                                <a href="{{ route('login') }}" class="text-success text-decoration-none fw-bold">Login</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection