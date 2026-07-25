@extends('frontend.layouts.app')

@section('title', 'Profile')

@section('content')
    <!-- Breadcrumb -->
    <section class="breadcrumb-section py-3 bg-light">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-success">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}" class="text-success">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Profile Settings</li>
                </ol>
            </nav>
        </div>
    </section>

    <!-- Customer Profile Section -->
    <section class="customer-dashboard customer-profile py-5">
        <div class="container">
            <div class="row">
                <!-- Sidebar -->
                @include('user.auth.sidebar')

                <!-- Profile Content -->
                <div class="col-lg-9">
                    <h3 class="fw-bold mb-4">Profile Settings</h3>

                    <!-- Personal Information -->
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-header bg-white py-3">
                            <h5 class="mb-0 fw-bold">Personal Information</h5>
                        </div>
                        <div class="card-body p-4">
                            <form action="{{ route('profile.update') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="row g-3">
                                    <!-- Photo Upload -->
                                    <div class="col-md-12">
                                        <label class="form-label d-block">Profile Photo</label>
                                        <div class="d-flex align-items-center gap-3">
                                            <div class="position-relative" style="width:100px;height:100px;">

                                                {{-- existing/preview image --}}
                                                <img id="photo_preview"
                                                    src="{{ asset('uploads/default.png') }}"
                                                    alt="Profile Photo" class="rounded-circle border"
                                                    style="width:100px;height:100px;object-fit:cover;">

                                                {{-- undo icon, hidden by default --}}
                                                <span id="photo_undo_btn"
                                                    class="position-absolute top-0 start-100 translate-middle bg-danger rounded-circle d-none"
                                                    style="width:26px;height:26px;cursor:pointer;line-height:26px;text-align:center;"
                                                    title="Undo selected photo">
                                                    <i class="bi bi-x text-white"></i>
                                                </span>
                                            </div>
                                            <div>
                                                <input type="file" class="form-control" id="photo" name="photo"
                                                    accept="image/*">
                                                <small class="text-muted d-block mt-1">Allowed: JPG, PNG. Max size:
                                                    2MB.</small>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Profile Photo Section End -->

                                    <div class="col-md-6">
                                        <label class="form-label" for="name">Name <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="name" name="name"
                                            value="{{ auth()->guard('web')->user()->name }}">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label" for="email">Email Address <span
                                                class="text-danger">*</span></label>
                                        <input type="email" class="form-control" id="email" name="email"
                                            value="{{ auth()->guard('web')->user()->email }}">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label" for="new_pass">New Password</label>
                                        <input type="password" class="form-control" id="new_pass" name="password">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label" for="con_pass">Confirm New Password</label>
                                        <input type="password" class="form-control" id="con_pass"
                                            name="password_confirmation">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label" for="phone">Phone Number <span
                                                class="text-danger">*</span></label>
                                        <input type="tel" class="form-control" id="phone" name="phone"
                                            value="{{ auth()->guard('web')->user()->phone }}">
                                    </div>
                                    <div class="col-6">
                                        <label class="form-label" for="address">Address <span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="address" name="address"
                                            value="{{ auth()->guard('web')->user()->address }}">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label" for="country">Country <span
                                                class="text-danger">*</span></label>
                                        @php
                                            $selectedCountry = old('country', auth()->guard('web')->user()->country);
                                        @endphp
                                        <select class="form-select" name="country" id="country">
                                            <option value="" disabled {{ $selectedCountry == '' ? 'selected' : '' }}>Select
                                                Country</option>
                                            <option value="USA" {{ $selectedCountry == 'USA' ? 'selected' : '' }}>United
                                                States</option>
                                            <option value="Canada" {{ $selectedCountry == 'Canada' ? 'selected' : '' }}>Canada
                                            </option>
                                            <option value="UK" {{ $selectedCountry == 'UK' ? 'selected' : '' }}>United Kingdom
                                            </option>
                                            <option value="Australia" {{ $selectedCountry == 'Australia' ? 'selected' : '' }}>
                                                Australia</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label" for="state">State <span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="state" name="state"
                                            value="{{ auth()->guard('web')->user()->state }}">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label" for="city">City <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="city" name="city"
                                            value="{{ auth()->guard('web')->user()->city }}">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label" for="zip">ZIP Code <span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="zip" name="zip"
                                            value="{{ auth()->guard('web')->user()->zip }}">
                                    </div>
                                    <div class="col-md-12">
                                        <button type="submit" class="btn btn-success w-100">
                                            <i class="bi bi-check-circle me-2"></i>Update Profile
                                        </button>
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

@push('scripts')
    <script>
        // photo input, preview image, undo button - element get
        const photoInput = document.getElementById('photo');
        const photoPreview = document.getElementById('photo_preview');
        const undoBtn = document.getElementById('photo_undo_btn');

        // original image
        const originalPhotoSrc = photoPreview.src;

        // photo input change
        photoInput.addEventListener('change', function () {
            const file = this.files[0];

            if (file) {
                // file reader instance create for preview image
                const reader = new window.FileReader();
                reader.onload = function (e) {
                    photoPreview.src = e.target.result; // preview change
                    undoBtn.classList.remove('d-none');  // undo icon show
                };
                reader.readAsDataURL(file);
            }
        });

        // undo button click - old image show and undo icon hide 
        undoBtn.addEventListener('click', function () {
            photoInput.value = '';                 // file input clear
            photoPreview.src = originalPhotoSrc;    // old image show
            undoBtn.classList.add('d-none');        // undo icon hide
        });
    </script>
@endpush