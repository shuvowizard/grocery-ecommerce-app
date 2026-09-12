@extends('admin.layouts.app')

@section('content')
    <section class="section">
        <div class="section-header justify-content-between">
            <h1>Specifications - {{ $product->name }}</h1>
            <div class="ml-auto">
                <a href="{{ route('admin.product.index') }}" class="btn btn-primary">
                    <i class="fas fa-arrow-left"></i> Back to Products
                </a>
            </div>
        </div>


        <div class="section-body">
            <div class="row">
                <!-- Add New Specification Form -->
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-header">
                            <h5>Add Specification</h5>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.product.specification.store', $product->id) }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label class="form-label">Label <span class="text-danger">*</span></label>
                                    <input type="text" name="label"
                                        class="form-control @error('label') is-invalid @enderror"
                                        value="{{ old('label') }}" placeholder="e.g. Origin">
                                    @error('label')
                                        <span class="text-danger small">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Value <span class="text-danger">*</span></label>
                                    <input type="text" name="value"
                                        class="form-control @error('value') is-invalid @enderror"
                                        value="{{ old('value') }}" placeholder="e.g. USA">
                                    @error('value')
                                        <span class="text-danger small">{{ $message }}</span>
                                    @enderror
                                </div>
                                <button type="submit" class="btn btn-success w-100">Add Specification</button>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Existing Specifications List -->
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-body">
                            <table class="table table-bordered" id="example1">
                                <thead>
                                    <tr>
                                        <th>#SL</th>
                                        <th>Label</th>
                                        <th>Value</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($specifications as $spec)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $spec->label }}</td>
                                            <td>{{ $spec->value }}</td>
                                            <td class="d-flex gap-2 py-3 align-middle">
                                                <button type="button" class="btn btn-warning btn-sm edit-spec-btn"
                                                    data-spec-id="{{ $spec->id }}" data-label="{{ $spec->label }}"
                                                    data-value="{{ $spec->value }}" data-bs-toggle="modal"
                                                    data-bs-target="#editSpecModal">
                                                    <i class="fas fa-pen"></i>
                                                </button>
                                                <form action="{{ route('admin.specification.destroy', $spec->id) }}"
                                                    method="POST" onsubmit="return confirm('Delete this specification?');">
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
                                            <td colspan="4" class="text-center py-3">No specifications added yet.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                            <!-- Edit Specification Modal -->
                            <div class="modal fade" id="editSpecModal" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Edit Specification</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">
                                            <input type="hidden" id="modalSpecId">
                                            <div class="mb-3">
                                                <label class="form-label">Label</label>
                                                <input type="text" id="modalLabelInput" class="form-control">
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Value</label>
                                                <input type="text" id="modalValueInput" class="form-control">
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Cancel</button>
                                            <button type="button" class="btn btn-success" id="confirmSpecUpdate">Save
                                                Changes</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {

            $(document).on('click', '.edit-spec-btn', function() {
                const specId = $(this).data('spec-id');
                const label = $(this).data('label');
                const value = $(this).data('value');

                $('#modalSpecId').val(specId);
                $('#modalLabelInput').val(label);
                $('#modalValueInput').val(value);
            });

            $('#confirmSpecUpdate').on('click', async function() {
                const specId = $('#modalSpecId').val();
                const label = $('#modalLabelInput').val().trim();
                const value = $('#modalValueInput').val().trim();

                if (!label || !value) {
                    iziToast.warning({
                        message: 'Label and value cannot be empty.',
                        position: 'topRight',
                        timeout: 3000
                    });
                    return;
                }

                try {
                    const response = await axios.put(`/admin/specifications/${specId}`, {
                        label,
                        value
                    });

                    iziToast.success({
                        message: response.data.message,
                        position: 'topRight',
                        timeout: 3000
                    });

                    bootstrap.Modal.getInstance(document.getElementById('editSpecModal')).hide();
                    location.reload();

                } catch (error) {
                    const message = error.response?.data?.message || 'Something went wrong.';
                    iziToast.error({
                        message: message,
                        position: 'topRight',
                        timeout: 3000
                    });
                }
            });

        });
    </script>
@endpush
