@extends('admin.layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Edit Profile</h1>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('admin.profile.update') }}" method="post" enctype="multipart/form-data">
                                @csrf                                
                                <div class="row">
                                    <div class="col-md-3">
                                        <img src="{{ asset('uploads/admin/' . auth()->guard('admin')->user()->photo) ?? 'uploads/default.png' }}" alt="" class="profile-photo w_100_p">
                                        <input type="file" class="mt_10" name="photo">
                                    </div>
                                    <div class="col-md-9">
                                        <div class="mb-4">
                                            <label class="form-label">Name</label>
                                            <input type="text" class="form-control @error('title') is-invalid @enderror" name="name" value="{{ auth()->guard('admin')->user()->name }}">
                                            @error('name')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="mb-4">
                                            <label class="form-label">Email</label>
                                            <input type="text" class="form-control" name="email" value="{{ auth()->guard('admin')->user()->email }}" readonly>
                                        </div>
                                        <div class="mb-4">
                                            <label class="form-label">Password</label>
                                            <input type="password" class="form-control @error('title') is-invalid @enderror" name="password">
                                            @error('password')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="mb-4">
                                            <label class="form-label">Confirm Password</label>
                                            <input type="password" class="form-control" name="password_confirmation">
                                        </div>
                                        <div class="mb-4">
                                            <label class="form-label"></label>
                                            <button type="submit" class="btn btn-primary">Update</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection