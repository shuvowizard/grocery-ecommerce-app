@extends('admin.layouts.app')

@section('content')
    <section class="section">
        <div class="section-header justify-content-between">
            <h1>Product Ratings</h1>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            {{-- Filter by rating --}}
                            <form method="GET" class="mb-3 d-flex align-items-center gap-2">
                                <label class="form-label mb-0">Filter by rating:</label>
                                <select name="rating" class="form-select form-select-sm" style="width: auto;" onchange="this.form.submit()">
                                    <option value="">All</option>
                                    @for($i = 5; $i >= 1; $i--)
                                        <option value="{{ $i }}" {{ request('rating') == $i ? 'selected' : '' }}>{{ $i }} Star</option>
                                    @endfor
                                </select>
                            </form>

                            <table class="table table-bordered table-sm" id=example1>
                                <thead>
                                    <tr class="text-center">
                                        <th>#SL</th>
                                        <th>Product</th>
                                        <th>User</th>
                                        <th>Rating</th>
                                        <th>Comment</th>
                                        <th>Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($reviews as $review)
                                        <tr class="text-center">
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                @if($review->product)
                                                    <a href="{{ route('product', $review->product->slug) }}" target="_blank">
                                                        {{ $review->product->name }}
                                                    </a>
                                                @else
                                                    <span class="text-muted">Product deleted</span>
                                                @endif
                                            </td>
                                            <td>{{ $review->user->name ?? 'N/A' }}</td>
                                            <td>
                                                <span class="text-warning">
                                                    @for($i = 1; $i <= 5; $i++)
                                                        <i class="bi bi-star{{ $i <= $review->rating ? '-fill' : '' }}"></i>
                                                    @endfor
                                                </span>
                                            </td>
                                            <td class="text-start">
                                                {{ $review->comment ? \Illuminate\Support\Str::limit($review->comment, 60) : '—' }}
                                            </td>
                                            <td>{{ $review->created_at->format('d M Y') }}</td>
                                            <td>
                                                <form action="{{ route('admin.rating.destroy', $review->id) }}" method="POST"
                                                    onsubmit="return confirm('Are you sure you want to delete this review?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" class="text-center py-3">No reviews found.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection