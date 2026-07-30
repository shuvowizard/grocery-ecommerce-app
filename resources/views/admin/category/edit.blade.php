@extends('admin.layouts.app')

@section('content')
    <section class="section">
        <div class="section-header justify-content-between">
            <h1>Edit Category</h1>
            <div class="ml-auto">
                <a href="{{ route('admin.category.index') }}" class="btn btn-primary"><i class="fas fa-users"></i> All
                    Categories</a>
            </div>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('admin.category.update', $category->id) }}" method="post">
                                @method('PUT')
                                @csrf
                                <div class="row">

                                    <div class="col-lg-6 mb-3">
                                        <label class="form-label">Name <span class="text-danger">*</span></label>
                                        <input type="text" name="name" value="{{ old('name', $category->name) }}"
                                            class="form-control @error('name') is-invalid @enderror">
                                        @error('name')
                                            <span class="text-danger small">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-lg-6 mb-3">
                                        <label class="form-label">Status <span class="text-danger">*</span></label>
                                        <select name="status" class="form-select @error('status') is-invalid @enderror">
                                            <option value="1" {{ old('status', $category->status) == '1' ? 'selected' : '' }}>Active</option>
                                            <option value="0" {{ old('status', $category->status) == '0' ? 'selected' : '' }}>Inactive</option>
                                        </select>
                                        @error('status')
                                            <span class="text-danger small">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-lg-12 mb-3">
                                        <button type="submit" class="btn btn-primary w-100">Update</button>
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