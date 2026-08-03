@extends('admin.layouts.app')

@section('content')
    <section class="section">
        <div class="section-header justify-content-between">
            <h1>Edit Product</h1>
            <div class="ml-auto">
                <a href="{{ route('admin.product.index') }}" class="btn btn-primary"><i class="fas fa-eye"></i> All
                    Products</a>
            </div>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('admin.product.update', $product->id) }}" method="post"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <!-- Product Photo -->
                                    <div class="col-lg-12 mb-3">
                                        <label class="form-label">Product Photo <span class="text-danger">*</span></label>
                                        <div class="d-flex align-items-center gap-2">
                                            <div class="rounded-circle border d-flex align-items-center justify-content-center overflow-hidden bg-light flex-shrink-0"
                                                style="width:50px;height:50px;">
                                                <img id="photo_preview"
                                                    src="{{ asset('uploads/product/' . $product->photo) }}"
                                                    alt="Product Photo"
                                                    style="width:100%;height:100%;object-fit:cover;object-position:center;display:block;">
                                            </div>
                                            <input type="file" class="@error('photo') is-invalid @enderror" id="photo"
                                                name="photo" accept="image/*">

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

                                    {{-- Product Name --}}
                                    <div class="col-lg-6 mb-3">
                                        <label class="form-label">Product Name <span class="text-danger">*</span></label>
                                        <input type="text" name="name" value="{{ old('name', $product->name) }}"
                                            class="form-control @error('name') is-invalid @enderror">
                                        @error('name')
                                            <span class="text-danger small">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    {{-- Category --}}
                                    <div class="col-lg-6 mb-3">
                                        <label class="form-label">Product Category <span
                                                class="text-danger">*</span></label>
                                        <select name="category_id"
                                            class="form-select @error('category_id') is-invalid @enderror">
                                            <option value="" disabled {{ old('category_id', $product->category_id) == '' ? 'selected' : '' }}>--
                                                Select Category --</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                                                    {{ $category->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('category_id')
                                            <span class="text-danger small">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    {{-- Product Short Description --}}
                                    <div class="col-lg-12 mb-3">
                                        <label class="form-label">Short Description <span
                                                class="text-danger">*</span></label>
                                        <textarea name="short_description"
                                            class="form-control h_100 @error('short_description') is-invalid @enderror">{{ old('short_description', $product->short_description) }}</textarea>
                                        @error('short_description')
                                            <span class="text-danger small">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    {{-- Product Description --}}
                                    <div class="col-lg-12 mb-3">
                                        <label class="form-label">Description <span class="text-danger">*</span></label>
                                        <textarea name="description" rows="4"
                                            class="form-control editor @error('description') is-invalid @enderror">{{ old('description', $product->description) }}</textarea>
                                        @error('description')
                                            <span class="text-danger small">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-lg-12 mb-3">
                                        <button type="submit" class="btn btn-primary w-100">Update product</button>
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
                $('#photo_preview').attr('src', "{{ asset('uploads/product/' . $product->photo) }}");
                $('#photo_undo_btn').addClass('d-none');
                $('#photo').val('');
            });
        });
    </script>
@endpush