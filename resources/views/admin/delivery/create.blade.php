@extends('admin.layouts.app')

@section('content')
    <section class="section">
        <div class="section-header justify-content-between">
            <h1>Create New Delivery Option</h1>
            <div class="ml-auto">
                <a href="{{ route('admin.delivery.index') }}" class="btn btn-primary"><i class="fas fa-eye"></i> All
                    Delivery Options</a>
            </div>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('admin.delivery.store') }}" method="post">
                                @csrf
                                <div class="row">
                                    {{-- Name --}}
                                    <div class="col-lg-4 mb-3">
                                        <label class="form-label">Name<span class="text-danger">*</span></label>
                                        <input type="text" name="name" value="{{ old('name') }}"
                                            class="form-control @error('name') is-invalid @enderror"
                                            placeholder="e.g. Standard Delivery">
                                        @error('name')
                                            <span class="text-danger small">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    {{-- Status --}}
                                    <div class="col-lg-4 mb-3">
                                        <label class="form-label">Is Default<span class="text-danger">*</span></label>
                                        <select name="status" class="form-control @error('status') is-invalid @enderror">
                                            <option value="1" {{ old('status', '1') == '1' ? 'selected' : '' }}>Yes</option>
                                            <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>No</option>
                                        </select>
                                        @error('status')
                                            <span class="text-danger small">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    {{-- Charge --}}
                                    <div class="col-lg-4 mb-3">
                                        <label class="form-label">Charge<span class="text-danger">*</span></label>
                                        <input type="number" name="charge" value="{{ old('charge') }}"
                                            class="form-control @error('charge') is-invalid @enderror"
                                            placeholder="e.g. 50">
                                        @error('charge')
                                            <span class="text-danger small">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    {{-- Description --}}
                                    <div class="col-lg-12 mb-3">
                                        <label class="form-label">Description<span class="text-danger">*</span></label>
                                        <textarea type="text" name="description" rows="3"
                                            class="form-control h_100 @error('description') is-invalid @enderror">{{ old('description') }}"</textarea>
                                        @error('description')
                                            <span class="text-danger small">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-lg-12 mb-3">
                                        <button type="submit" class="btn btn-primary w-100">Save Delivery Option</button>
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
