@extends('admin.layouts.app')

@section('content')
    <section class="section">
        <div class="section-header justify-content-between">
            <h1>Edit FAQ</h1>
            <div class="ml-auto">
                <a href="{{ route('admin.faq.index') }}" class="btn btn-primary">
                    <i class="fas fa-arrow-left"></i> Back to FAQ
                </a>
            </div>
        </div>
        <div class="section-body">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('admin.faq.update', $faq->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row g-3">
                            <div class="col-md-12">
                                <label class="form-label">Question <span class="text-danger">*</span></label>
                                <input type="text" name="question"
                                    class="form-control @error('question') is-invalid @enderror"
                                    value="{{ old('question', $faq->question) }}">
                                @error('question')
                                    <span class="text-danger small">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-12">
                                <label class="form-label">Answer <span class="text-danger">*</span></label>
                                <textarea name="answer" rows="4" class="form-control h_100 @error('answer') is-invalid @enderror">{{ old('answer', $faq->answer) }}</textarea>
                                @error('answer')
                                    <span class="text-danger small">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Sort Order</label>
                                <input type="number" name="sort_order" class="form-control"
                                    value="{{ old('sort_order', $faq->sort_order) }}">
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn btn-success w-100">Update FAQ</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
