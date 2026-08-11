@extends('admin.layouts.app')

@section('content')
    <section class="section">
        <div class="section-header justify-content-between">
            <h1>Delivery Options</h1>
            <div class="ml-auto">
                <a href="{{ route('admin.delivery.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Create
                    new delivery option</a>
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
                                        <th>Name</th>
                                        <th>Description</th>
                                        <th>Charge</th>
                                        <th>Is Default</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($delivery_data as $delivery)
                                        <tr class="text-center">
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $delivery->name }}</td>
                                            <td>{{ $delivery->description }}</td>
                                            <td>{{ $delivery->charge }}</td>
                                            <td>
                                                @if ($delivery->status == 1)
                                                    <span class="badge bg-success">Yes</span>
                                                @elseif ($delivery->status == 0)
                                                    <span class="badge bg-warning">No</span>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('admin.delivery.edit', $delivery->id) }}"
                                                    class="btn btn-warning btn-md "><i class="fas fa-edit"></i></a>
                                                {{-- Delete Button --}}
                                                <form action="{{ route('admin.delivery.delete', $delivery->id) }}" method="POST"
                                                    class="d-inline"
                                                    onsubmit="return confirm('Are you sure you want to delete this delivery?');">
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
