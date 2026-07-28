@extends('admin.layouts.app')

@section('content')
    <section class="section">
        <div class="section-header justify-content-between">
            <h1>User Management</h1>
            <div class="ml-auto">
                <a href="{{ route('admin.user.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Create
                    User</a>
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
                                        <th>Image</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                        <tr class="text-center">
                                            <td>{{ $loop->iteration }}</td>
                                            <td><img src="{{ asset('uploads/user/' . $user->photo ?? 'uploads/default.png') }}"
                                                    alt="User image" width="100px" height="auto"></td>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>{{ $user->phone }}</td>
                                            <td>
                                                @if ($user->status == 1)
                                                    <span class="badge bg-success">Active</span>
                                                @elseif ($user->status == 0)
                                                    <span class="badge bg-danger">Pending</span>
                                                @elseif ($user->status == 2)
                                                    <span class="badge bg-warning">Suspended</span>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="#" class="btn btn-warning btn-md "><i class="fas fa-edit"></i></a>
                                                <a href="#" class="btn btn-danger btn-md"
                                                    onclick="return confirm('Are you sure?')"><i class="fas fa-trash"></i></a>
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