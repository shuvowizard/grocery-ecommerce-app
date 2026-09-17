@extends('admin.layouts.app')

@section('content')
    <section class="section">
        <div class="section-header justify-content-between">
            <h1>Sliders</h1>
            <a href="{{ route('admin.slider.create') }}" class="btn btn-success"><i class="fa fa-plus"></i> Add Slider</a>
        </div>

        <div class="section-body">
            <div class="card">
                <div class="card-body">
                    <table class="table table-bordered table-sm" id=example1>
                        <thead>
                            <tr class="text-center">
                                <th>#SL</th>
                                <th>Photo</th>
                                <th>Title</th>
                                <th>Order</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($sliders as $slider)
                                <tr class="text-center">
                                    <td>{{ $loop->iteration }}</td>
                                    <td><img src="{{ asset('uploads/slider/' . $slider->photo) }}" width="100"></td>
                                    <td>{{ $slider->title }}</td>
                                    <td>{{ $slider->sort_order }}</td>
                                    <td>
                                        <span class="badge {{ $slider->status ? 'bg-success' : 'bg-secondary' }}">
                                            {{ $slider->status ? 'Active' : 'Inactive' }}
                                        </span>
                                    </td>
                                    <td>
                                        <a href="#"
                                            class="btn btn-warning btn-sm"><i class="fas fa-pen"></i></a>
                                        <form action="#" method="POST"
                                            class="d-inline" onsubmit="return confirm('Delete this slider?');">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center py-3">No sliders found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
@endsection
