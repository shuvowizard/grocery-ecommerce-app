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
                                    <div class="col-lg-6  mb-3">
                                        <label class="form-label">Name <span class="text-danger">*</span></label>
                                        <input type="text" name="name" value="" class="form-control">
                                    </div>
                                    <div class="col-lg-6  mb-3">
                                        <label class="form-label">Email <span class="text-danger">*</span></label>
                                        <input type="text" name="email" value="" class="form-control">
                                    </div>
                                    <div class="col-lg-6  mb-3">
                                        <label class="form-label">Phone</label>
                                        <input type="text" name="phone" value="" class="form-control">
                                    </div>
                                    <div class="col-lg-6  mb-3">
                                        <label class="form-label">Address</label>
                                        <input type="text" name="address" value="" class="form-control">
                                    </div>
                                    <div class="col-lg-6  mb-3">
                                        <label class="form-label" for="country">Country</label>
                                        <select class="form-select" name="country" id="country">
                                            <option value="" selected disabled>Select Country</option>
                                            <option value="USA">United States</option>
                                            <option value="Canada">Canada</option>
                                            <option value="UK">United Kingdom</option>
                                            <option value="Australia">Australia</option>
                                        </select>
                                    </div>
                                    <div class="col-lg-6  mb-3">
                                        <label class="form-label">State</label>
                                        <input type="text" name="state" value="" class="form-control">
                                    </div>
                                    <div class="col-lg-6  mb-3">
                                        <label class="form-label">City</label>
                                        <input type="text" name="city" value="" class="form-control">
                                    </div>
                                    <div class="col-lg-6  mb-3">
                                        <label class="form-label">Zip Code</label>
                                        <input type="text" name="zip" value="" class="form-control">
                                    </div>

                                    <!-- Status -->
                                    <div class="col-lg-6  mb-3">
                                        <label class="form-label">Status</label>
                                        <select name="status" class="form-select">
                                            <option value="" selected disabled>Select Status</option>
                                            <option value="0">Pending</option>
                                            <option value="1">Active</option>
                                            <option value="2">Suspended</option>
                                        </select>
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

                                            <input type="file" class="form-control" id="photo" name="photo"
                                                accept="image/*">

                                            {{-- cancel button, hidden by default, red circle with clear x mark --}}
                                            <button type="button" id="photo_undo_btn"
                                                class="btn btn-danger rounded-circle d-none flex-shrink-0 p-0 d-flex align-items-center justify-content-center"
                                                style="width:35px;height:35px;line-height:1;" title="Undo selected photo">
                                                <span style="font-size:16px;">&times;</span>
                                            </button>
                                        </div>
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