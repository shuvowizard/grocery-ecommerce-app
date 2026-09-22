@extends('admin.layouts.app')

@section('content')
    <section class="section">
        <div class="section-header justify-content-between">
            <h1>FAQs</h1>
            <a href="{{ route('admin.faq.create') }}" class="btn btn-success">Add FAQ</a>
        </div>

        <div class="section-body">
            <div class="card">
                <div class="card-body">
                    <table class="table table-bordered" id=example1>
                        <thead>
                            <tr class="text-center">
                                <th>#SL</th>
                                <th>Question</th>
                                <th>Order</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($faqs as $faq)
                                <tr class="text-center">
                                    <td>{{ $loop->iteration }}</td>
                                    <td class="text-start">{{ Str::limit($faq->question, 80) }}</td>
                                    <td>{{ $faq->sort_order }}</td>
                                    <td>
                                        <a href="{{  route('admin.faq.edit', $faq->id) }}" class="btn btn-warning btn-sm"><i class="fas fa-pen"></i></a>
                                        <form action="#" method="POST" class="d-inline"
                                            onsubmit="return confirm('Delete this FAQ?');">
                                            @csrf 
                                            @method('DELETE')
                                            <button class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center py-3">No FAQs found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
@endsection
