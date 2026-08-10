@extends('admin.layouts.app')

@section('content')
    <section class="section">
        <div class="section-header justify-content-between">
            <h1>Coupon Code Generate</h1>
            <div class="ml-auto">
                <a href="{{ route('admin.coupon.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Create
                    new coupon</a>
            </div>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <table class="table table-bordered table-sm" id=example1>
                                <thead>
                                    <tr class="text-center">
                                        <th>SL</th>
                                        <th>Code</th>
                                        <th>Type</th>
                                        <th>Discount</th>
                                        <th>Start Date</th>
                                        <th>End Date</th>
                                        <th>Usage Limit</th>
                                        <th>Used Count</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($coupon_data as $coupon)
                                        <tr class="text-center">
                                            <td>{{ $loop->iteration }}</td>                                            
                                            <td>{{ $coupon->code }}</td>
                                            <td>{{ $coupon->discount_type }}</td>
                                            <td>
                                                @if($coupon->discount_type == 'fixed')
                                                    {{ $coupon->discount_value }}$
                                                @else
                                                    {{ $coupon->discount_value }}%
                                                @endif
                                            </td>
                                            <td>{{ $coupon->starts_at->format('Y-m-d') }}</td>
                                            <td>{{ $coupon->expires_at->format('Y-m-d') }}</td>
                                            <td>{{ $coupon->usage_limit }}</td>
                                            <td>{{ $coupon->used_count }}</td>
                                            <td>
                                                @if ($coupon->status == 1)
                                                    <span class="badge bg-success">Active</span>
                                                @elseif ($coupon->status == 0)
                                                    <span class="badge bg-warning">Inactive</span>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('admin.coupon.edit', $coupon->id) }}"
                                                    class="btn btn-warning btn-md "><i class="fas fa-edit"></i></a>
                                                {{-- Delete Button --}}
                                                <form action="{{ route('admin.coupon.delete', $coupon->id) }}" method="POST"
                                                    class="d-inline"
                                                    onsubmit="return confirm('Are you sure you want to delete this coupon?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-md">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
