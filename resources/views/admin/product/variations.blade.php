@extends('admin.layouts.app')

@section('content')
    <section class="section">
        <div class="section-header justify-content-between">
            <h1>Product Variations for <span class="text-primary">{{ $product->name }}</span></h1>
            <div class="ml-auto">
                <a href="{{ route('admin.product.index') }}" class="btn btn-primary">
                    <i class="fas fa-eye"></i> All Products</a>
            </div>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    
                    @php
                        $editErrorVariationId = old('variation_id');
                    @endphp

                    <div class="card">
                        <div class="card-body">
                            <form method="POST" action="{{ route('admin.product.variation.store', $product->id) }}">
                                @csrf
                                <div class="row">
                                    <div class="col-lg-4 mb-3">
                                        <label class="form-label" for="label">Label <span
                                                class="text-danger">*</span></label>
                                        <input type="text" name="label"
                                            value="{{ $editErrorVariationId ? '' : old('label') }}"
                                            class="form-control @if (!$editErrorVariationId) @error('label') is-invalid @enderror @endif"
                                            id="label">
                                        @if (!$editErrorVariationId)
                                            @error('label')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        @endif
                                    </div>
                                    <div class="col-lg-2 mb-2">
                                        <label class="form-label" for="sale_price">Sale Price <span
                                                class="text-danger">*</span></label>
                                        <input type="text" name="sale_price"
                                            value="{{ $editErrorVariationId ? '' : old('sale_price') }}"
                                            class="form-control @if (!$editErrorVariationId) @error('sale_price') is-invalid @enderror @endif"
                                            id="sale_price">
                                        @if (!$editErrorVariationId)
                                            @error('sale_price')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        @endif
                                    </div>
                                    <div class="col-lg-2 mb-3">
                                        <label class="form-label" for="regular_price">Regular Price <span
                                                class="text-danger">*</span></label>
                                        <input type="text" name="regular_price"
                                            value="{{ $editErrorVariationId ? '' : old('regular_price') }}"
                                            class="form-control @if (!$editErrorVariationId) @error('regular_price') is-invalid @enderror @endif"
                                            id="regular_price">
                                        @if (!$editErrorVariationId)
                                            @error('regular_price')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        @endif
                                    </div>
                                    <div class="col-lg-2 mb-3">
                                        <label class="form-label" for="stock">Stock <span
                                                class="text-danger">*</span></label>
                                        <input type="text" name="stock"
                                            value="{{ $editErrorVariationId ? '' : old('stock') }}"
                                            class="form-control @if (!$editErrorVariationId) @error('stock') is-invalid @enderror @endif"
                                            id="stock">
                                        @if (!$editErrorVariationId)
                                            @error('stock')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        @endif
                                    </div>
                                    <div class="col-lg-2 mb-3">
                                        <label class="form-label" for="sort_order">Order <span
                                                class="text-danger">*</span></label>
                                        <input type="text" name="sort_order"
                                            value="{{ $editErrorVariationId ? '' : old('sort_order') }}"
                                            class="form-control @if (!$editErrorVariationId) @error('sort_order') is-invalid @enderror @endif"
                                            id="sort_order">
                                        @if (!$editErrorVariationId)
                                            @error('sort_order')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        @endif
                                    </div>
                                    <div class="col-lg-3 mb-3">
                                        <button type="submit" class="btn btn-primary mt-4">Add Variation</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-body">
                            <table class="table table-bordered table-sm" id=example1>
                                <thead>
                                    <tr class="text-center">
                                        <th>SL</th>
                                        <th>Product Name</th>
                                        <th>Label</th>
                                        <th>Sell Price</th>
                                        <th>Regular Price</th>
                                        <th>Stock</th>
                                        <th>Sort Order</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($product->variations as $variation)                                        
                                        @php
                                            $isThisVariationError = $editErrorVariationId == $variation->id;
                                        @endphp
                                        <tr class="text-center">
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $variation->product->name }}</td>
                                            <td>{{ $variation->label }}</td>
                                            <td>{{ $variation->sale_price }}</td>
                                            <td>{{ $variation->regular_price }}</td>
                                            <td>{{ $variation->stock }}</td>
                                            <td>{{ $variation->sort_order }}</td>
                                            <td>
                                                <a href="#" data-bs-toggle="modal"
                                                    data-bs-target="#modal_{{ $variation->id }}"
                                                    class="btn btn-warning btn-md "><i class="fas fa-edit"></i></a>
                                                {{-- Delete Button --}}
                                                <form
                                                    action="{{ route('admin.product.variation.delete', $variation->id) }}"
                                                    method="POST" class="d-inline"
                                                    onsubmit="return confirm('Are you sure you want to delete this product variation?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-md">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>

                                        {{-- Edit Modal for this variation --}}
                                        <div class="modal fade" id="modal_{{ $variation->id }}" tabindex="-1"
                                            aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Edit Product Variation</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form
                                                            action="{{ route('admin.product.variation.update', $variation->id) }}"
                                                            method="POST">
                                                            @method('PUT')
                                                            @csrf

                                                            {{-- kon variation-er form submit hoyechilo seta track korar jonno --}}
                                                            <input type="hidden" name="variation_id" value="{{ $variation->id }}">

                                                            <div class="row">
                                                                <div class="mb-3">
                                                                    <label class="form-label" for="label">Label
                                                                        <span class="text-danger">*</span></label>
                                                                    <input type="text" name="label"
                                                                        value="{{ $isThisVariationError ? old('label', $variation->label) : $variation->label }}"
                                                                        class="form-control @if ($isThisVariationError) @error('label') is-invalid @enderror @endif"
                                                                        id="label">
                                                                    @if ($isThisVariationError)
                                                                        @error('label')
                                                                            <div class="invalid-feedback d-block">
                                                                                {{ $message }}</div>
                                                                        @enderror
                                                                    @endif
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label class="form-label" for="sale_price">Sale
                                                                        Price <span
                                                                            class="text-danger">*</span></label>
                                                                    <input type="text" name="sale_price"
                                                                        value="{{ $isThisVariationError ? old('sale_price', $variation->sale_price) : $variation->sale_price }}"
                                                                        class="form-control @if ($isThisVariationError) @error('sale_price') is-invalid @enderror @endif"
                                                                        id="sale_price">
                                                                    @if ($isThisVariationError)
                                                                        @error('sale_price')
                                                                            <div class="invalid-feedback d-block">
                                                                                {{ $message }}</div>
                                                                        @enderror
                                                                    @endif
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label class="form-label"
                                                                        for="regular_price">Regular Price <span
                                                                            class="text-danger">*</span></label>
                                                                    <input type="text" name="regular_price"
                                                                        value="{{ $isThisVariationError ? old('regular_price', $variation->regular_price) : $variation->regular_price }}"
                                                                        class="form-control @if ($isThisVariationError) @error('regular_price') is-invalid @enderror @endif"
                                                                        id="regular_price">
                                                                    @if ($isThisVariationError)
                                                                        @error('regular_price')
                                                                            <div class="invalid-feedback d-block">
                                                                                {{ $message }}</div>
                                                                        @enderror
                                                                    @endif
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label class="form-label" for="stock">Stock
                                                                        <span class="text-danger">*</span></label>
                                                                    <input type="text" name="stock"
                                                                        value="{{ $isThisVariationError ? old('stock', $variation->stock) : $variation->stock }}"
                                                                        class="form-control @if ($isThisVariationError) @error('stock') is-invalid @enderror @endif"
                                                                        id="stock">
                                                                    @if ($isThisVariationError)
                                                                        @error('stock')
                                                                            <div class="invalid-feedback d-block">
                                                                                {{ $message }}</div>
                                                                        @enderror
                                                                    @endif
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label class="form-label" for="sort_order">Sort Order
                                                                        <span class="text-danger">*</span></label>
                                                                    <input type="text" name="sort_order"
                                                                        value="{{ $isThisVariationError ? old('sort_order', $variation->sort_order) : $variation->sort_order }}"
                                                                        class="form-control @if ($isThisVariationError) @error('sort_order') is-invalid @enderror @endif"
                                                                        id="sort_order">
                                                                    @if ($isThisVariationError)
                                                                        @error('sort_order')
                                                                            <div class="invalid-feedback d-block">
                                                                                {{ $message }}</div>
                                                                        @enderror
                                                                    @endif
                                                                </div>
                                                                <div class="mb-3">
                                                                    <button type="submit"
                                                                        class="btn btn-primary mt-4 w-100">Update
                                                                        Variation</button>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{--  --}}
    @if ($errors->any() && old('variation_id'))
        @push('scripts')
            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    var modalEl = document.getElementById('modal_{{ old('variation_id') }}');
                    if (modalEl) {
                        var modal = new bootstrap.Modal(modalEl);
                        modal.show();
                    }
                });
            </script>
        @endpush
    @endif
@endsection