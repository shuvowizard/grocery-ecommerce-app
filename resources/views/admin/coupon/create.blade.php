@extends('admin.layouts.app')

@section('content')
    <section class="section">
        <div class="section-header justify-content-between">
            <h1>Create New Coupon</h1>
            <div class="ml-auto">
                <a href="{{ route('admin.coupon.index') }}" class="btn btn-primary"><i class="fas fa-eye"></i> All
                    Coupons</a>
            </div>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('admin.coupon.store') }}" method="post">
                                @csrf
                                <div class="row">
                                    {{-- Coupon Code --}}
                                    <div class="col-lg-4 mb-3">
                                        <label class="form-label">Coupon Code<span class="text-danger">*</span></label>
                                        <input type="text" name="code" value="{{ old('code') }}"
                                            class="form-control @error('code') is-invalid @enderror"
                                            placeholder="e.g. SAVE20">
                                        @error('code')
                                            <span class="text-danger small">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    {{-- Status --}}
                                    <div class="col-lg-4 mb-3">
                                        <label class="form-label">Status<span class="text-danger">*</span></label>
                                        <select name="status" class="form-control @error('status') is-invalid @enderror">
                                            <option value="1" {{ old('status', '1') == '1' ? 'selected' : '' }}>Active</option>
                                            <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>Inactive</option>
                                        </select>
                                        @error('status')
                                            <span class="text-danger small">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    {{-- Discount Type --}}
                                    <div class="col-lg-4 mb-3">
                                        <label class="form-label">Discount Type<span class="text-danger">*</span></label>
                                        <select name="discount_type" id="discountType"
                                            class="form-control @error('discount_type') is-invalid @enderror">
                                            <option value="percentage" {{ old('discount_type', 'percentage') == 'percentage' ? 'selected' : '' }}>Percentage (%)</option>
                                            <option value="fixed" {{ old('discount_type') == 'fixed' ? 'selected' : '' }}>Fixed Amount ($)</option>
                                        </select>
                                        @error('discount_type')
                                            <span class="text-danger small">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    {{-- Discount Value --}}
                                    <div class="col-lg-6 mb-3">
                                        <label class="form-label">Discount Value<span class="text-danger">*</span></label>
                                        <input type="number" name="discount_value" value="{{ old('discount_value') }}"
                                            class="form-control @error('discount_value') is-invalid @enderror"
                                            placeholder="e.g. 20" id="discountValueInput">
                                        <small class="text-muted" id="discountHint">Enter percentage (0-100)</small>
                                        @error('discount_value')
                                            <span class="text-danger small">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    {{-- Usage Limit --}}
                                    <div class="col-lg-6 mb-3">
                                        <label class="form-label">Usage Limit</label>
                                        <input type="number" name="usage_limit" value="{{ old('usage_limit') }}"
                                            class="form-control @error('usage_limit') is-invalid @enderror"
                                            placeholder="Leave empty for unlimited">
                                        @error('usage_limit')
                                            <span class="text-danger small">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    {{-- Starts At --}}
                                    <div class="col-lg-6 mb-3">
                                        <label class="form-label">Starts At<span class="text-danger">*</span></label>
                                        <input id="datepicker" type="date" name="starts_at" value="{{ old('starts_at') }}"
                                            class="form-control @error('starts_at') is-invalid @enderror">
                                        @error('starts_at')
                                            <span class="text-danger small">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    {{-- Expires At --}}
                                    <div class="col-lg-6 mb-3">
                                        <label class="form-label">Expires At<span class="text-danger">*</span></label>
                                        <input id="datepicker2" type="date" name="expires_at" value="{{ old('expires_at') }}"
                                            class="form-control @error('expires_at') is-invalid @enderror">
                                        @error('expires_at')
                                            <span class="text-danger small">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-lg-12 mb-3">
                                        <button type="submit" class="btn btn-primary w-100">Save Coupon</button>
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
        // Discount type onujayi hint text change (UX improvement)
        document.getElementById('discountType').addEventListener('change', function () {
            const hint = document.getElementById('discountHint');
            const input = document.getElementById('discountValueInput');

            if (this.value === 'percentage') {
                hint.textContent = 'Enter percentage (0-100)';
                input.setAttribute('max', 100);
            } else {
                hint.textContent = 'Enter fixed amount';
                input.removeAttribute('max');
            }
        });
    </script>
@endpush