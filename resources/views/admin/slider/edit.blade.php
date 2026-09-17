@extends('admin.layouts.app')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Edit Slider</h1>
    </div>
    <div class="section-body">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('admin.slider.update', $slider->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    
                    <div class="row g-3">
                        
                        <!-- Title -->
                        <div class="col-md-6">
                            <label class="form-label">Title</label>
                            <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title', $slider->title) }}">
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Subtitle -->
                        <div class="col-md-6">
                            <label class="form-label">Subtitle</label>
                            <input type="text" name="subtitle" class="form-control @error('subtitle') is-invalid @enderror" value="{{ old('subtitle', $slider->subtitle) }}">
                            @error('subtitle')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Button Text -->
                        <div class="col-md-6">
                            <label class="form-label">Button Text</label>
                            <input type="text" name="button_text" class="form-control @error('button_text') is-invalid @enderror" value="{{ old('button_text', $slider->button_text) }}">
                            @error('button_text')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Button Link -->
                        <div class="col-md-6">
                            <label class="form-label">Button Link</label>
                            <input type="text" name="button_link" class="form-control @error('button_link') is-invalid @enderror" value="{{ old('button_link', $slider->button_link) }}">
                            @error('button_link')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Sort Order -->
                        <div class="col-md-6">
                            <label class="form-label">Sort Order</label>
                            <input type="number" name="sort_order" class="form-control @error('sort_order') is-invalid @enderror" value="{{ old('sort_order', $slider->sort_order) }}">
                            @error('sort_order')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Status -->
                        <div class="col-md-6">
                            <label class="form-label">Status</label>
                            <select name="status" class="form-select @error('status') is-invalid @enderror">
                                <option value="1" {{ old('status', $slider->status) == '1' ? 'selected' : '' }}>Active</option>
                                <option value="0" {{ old('status', $slider->status) == '0' ? 'selected' : '' }}>Inactive</option>
                            </select>
                            @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Current Photo Preview Section -->
                        <div class="col-md-12">
                            <label class="form-label">Current Photo</label>
                            <div class="mb-3">
                                <!-- Added ID: photo_preview for image preview -->
                                <img id="photo_preview" 
                                     src="{{ $slider->photo ? asset('uploads/slider/' . $slider->photo) : asset('uploads/default.png') }}" 
                                     alt="Slider Photo" 
                                     class="img-thumbnail border" 
                                     style="max-height: 200px; max-width: 100%;">
                                <br>
                                <!-- Undo Button (initially hidden) -->
                                <button type="button" id="photo_undo_btn" class="btn btn-sm btn-danger mt-2 d-none">
                                    <i class="fas fa-undo"></i> Cancel Selection
                                </button>
                            </div>
                        </div>

                        <!-- New Photo Upload Section -->
                        <div class="col-md-12">
                            <label class="form-label">Change Photo <span class="text-muted">(Leave empty to keep current)</span></label>
                            <!-- Added ID: photo for file input -->
                            <input type="file" id="photo" name="photo" class="form-control @error('photo') is-invalid @enderror" accept="image/*">
                            <small class="text-muted">Supported formats: jpeg, png, jpg, gif, webp (Max 2MB)</small>
                            @error('photo')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Submit Button -->
                        <div class="col-12 mt-4">
                            <button type="submit" class="btn btn-primary w-100">Update Slider</button>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<!-- Image preview and undo script -->
@push('scripts')
<script>
    $(document).ready(function () {
        // Store the original image URL to restore it when undoing
        const originalImageSrc = $('#photo_preview').attr('src');

        $('#photo').on('change', function () {
            if (this.files && this.files[0]) {
                let reader = new window.FileReader();
                reader.onload = (e) => {
                    $('#photo_preview').attr('src', e.target.result);
                    $('#photo_undo_btn').removeClass('d-none'); // Show the undo button
                }
                reader.readAsDataURL(this.files[0]);
            }
        });

        $('#photo_undo_btn').on('click', function () {
            $('#photo_preview').attr('src', originalImageSrc); // Reset to the original image
            $('#photo_undo_btn').addClass('d-none'); // Hide the button again
            $('#photo').val(''); // Clear the file input
        });
    });
</script>
@endpush
@endsection