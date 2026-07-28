@extends('admin.layouts.app')

@section('content')
    <section class="section">
        <div class="section-header justify-content-between">
            <h1>Create New User</h1>
            <div class="ml-auto">
                <a href="{{ route('admin.user.index') }}" class="btn btn-primary"><i class="fas fa-users"></i> All Users</a>
            </div>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('admin.user.store') }}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-lg-6 mb-3">
                                        <label class="form-label">Name <span class="text-danger">*</span></label>
                                        <input type="text" name="name" value="{{ old('name') }}"
                                            class="form-control @error('name') is-invalid @enderror">
                                        @error('name')
                                            <span class="text-danger small">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class=" col-lg-6 mb-3">
                                        <label class="form-label">Email <span class="text-danger">*</span></label>
                                        <input type="email" name="email" value="{{ old('email') }}"
                                            class=" form-control @error('email') is-invalid @enderror">
                                        @error('email')
                                            <span class="text-danger small">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-lg-6 mb-3">
                                        <label class="form-label">Phone</label>
                                        <input type="tel" name="phone" value="{{ old('phone') }}"
                                            class="form-control @error('phone') is-invalid @enderror">
                                        @error('phone')
                                            <span class="text-danger small">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-lg-6 mb-3">
                                        <label class="form-label">Address</label>
                                        <input type="text" name="address" value="{{ old('address') }}"
                                            class="form-control @error('address') is-invalid @enderror">
                                        @error('address')
                                            <span class="text-danger small">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-lg-6 mb-3">
                                        <label class="form-label" for="country">Country</label>
                                        <select class="form-select @error('country') is-invalid @enderror" name="country"
                                            id="country">
                                            <option value="" disabled {{ old('country') == '' ? 'selected' : '' }}>Select
                                                Country</option>
                                            <option value="USA" {{ old('country') == 'USA' ? 'selected' : '' }}>United States
                                            </option>
                                            <option value="Canada" {{ old('country') == 'Canada' ? 'selected' : '' }}>Canada
                                            </option>
                                            <option value="UK" {{ old('country') == 'UK' ? 'selected' : '' }}>United Kingdom
                                            </option>
                                            <option value="Australia" {{ old('country') == 'Australia' ? 'selected' : '' }}>
                                                Australia</option>
                                        </select>
                                        @error('country')
                                            <span class="text-danger small">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-lg-6 mb-3">
                                        <label class="form-label">State</label>
                                        <input type="text" name="state" value="{{ old('state') }}"
                                            class="form-control @error('state') is-invalid @enderror">
                                        @error('state')
                                            <span class="text-danger small">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-lg-6 mb-3">
                                        <label class="form-label">City</label>
                                        <input type="text" name="city" value="{{ old('city') }}"
                                            class="form-control @error('city') is-invalid @enderror">
                                        @error('city')
                                            <span class="text-danger small">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-lg-6 mb-3">
                                        <label class="form-label">Zip Code</label>
                                        <input type="text" name="zip" value="{{ old('zip') }}"
                                            class="form-control @error('zip') is-invalid @enderror">
                                        @error('zip')
                                            <span class="text-danger small">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <!-- Status -->
                                    <div class="col-lg-6 mb-3">
                                        <label class="form-label">Status <span class="text-danger">*</span></label>
                                        <select name="status" class="form-select @error('status') is-invalid @enderror">
                                            <option value="" disabled {{ old('status') == '' ? 'selected' : '' }}>Select
                                                Status</option>
                                            <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>Pending</option>
                                            <option value="1" {{ old('status') == '1' ? 'selected' : '' }}>Active</option>
                                            <option value="2" {{ old('status') == '2' ? 'selected' : '' }}>Suspended</option>
                                        </select>
                                        @error('status')
                                            <span class="text-danger small">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <!-- Profile Photo -->
                                    <div class="col-lg-6 mb-3">
                                        <label class="form-label d-block">Profile Photo</label>

                                        <div class="d-flex align-items-center gap-2">
                                            <div class="rounded-circle border d-flex align-items-center justify-content-center overflow-hidden bg-light flex-shrink-0"
                                                style="width:50px;height:50px;">
                                                <img id="photo_preview" src="{{ asset('uploads/default.png') }}"
                                                    alt="Profile Photo"
                                                    style="width:100%;height:100%;object-fit:cover;object-position:center;display:block;">
                                            </div>

                                            <input type="file" class="form-control @error('title') is-invalid @enderror"
                                                id="photo" name="photo" accept="image/*">

                                            {{-- cancel button, hidden by default, red circle with clear x mark --}}
                                            <button type="button" id="photo_undo_btn"
                                                class="btn btn-danger rounded-circle d-none flex-shrink-0 p-0 d-flex align-items-center justify-content-center"
                                                style="width:35px;height:35px;line-height:1;" title="Undo selected photo">
                                                <span style="font-size:16px;">&times;</span>
                                            </button>
                                        </div>
                                        @error('photo')
                                            <span class="text-danger small">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-lg-12 mb-3">
                                        <button type="submit" class="btn btn-primary w-100">Submit</button>
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
        $(document).ready(function () {
            $('#photo').on('change', function () {
                let reader = new window.FileReader();
                reader.onload = (e) => {
                    $('#photo_preview').attr('src', e.target.result);
                    $('#photo_undo_btn').removeClass('d-none');
                }
                reader.readAsDataURL(this.files[0]);
            });
            $('#photo_undo_btn').on('click', function () {
                $('#photo_preview').attr('src', "{{ asset('uploads/default.png') }}");
                $('#photo_undo_btn').addClass('d-none');
                $('#photo').val('');
            });
        });
    </script>
@endpush