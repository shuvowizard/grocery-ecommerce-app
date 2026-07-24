@extends('frontend.layouts.app')

@section('title', 'Forget Password')

@section('content')
    <!-- Forget Password Section -->
    <section class="forget-password-section py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-5">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body p-5">

                            <h3 class="text-center fw-bold mb-4">Forgot Password?</h3>

                            <form action="{{ route('forget.password.submit') }}" method="post">
                                @csrf
                                <div class="mb-4">
                                    <label class="form-label">Email Address <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="email">
                                </div>

                                <button type="submit" class="btn btn-success w-100 mb-3">
                                    <i class="bi bi-send me-2"></i>Send Reset Link
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