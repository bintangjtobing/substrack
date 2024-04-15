@extends('welcome')

@section('title', 'Suppliers')

@section('addNewData')
    <div class="action-btn">
        <a href="#" class="btn btn-sm btn-primary btn-add" data-toggle="modal" data-target="#createSupplierModal">
            <i class="la la-plus"></i> Add New @yield('title')</a>
    </div>

    <!-- Create Supplier Modal -->
    <div class="modal fade new-member" id="createSupplierModal" tabindex="-1" role="dialog"
        aria-labelledby="createSupplierModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content radius-xl">
                <form action="{{ route('suppliers.store') }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="createSupplierModalLabel">Add New Supplier</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control ih-medium ip-gray radius-xs b-light px-15"
                                id="name" name="name" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button"
                            class="btn btn-light btn-default btn-squared fw-400 text-capitalize b-light color-light"
                            data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary btn-default btn-squared text-capitalize">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Create Transaction Modal -->
    <div class="modal fade new-member" id="createTransactionModal" tabindex="-1" role="dialog"
        aria-labelledby="createTransactionModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content radius-xl">
                <form action="{{ route('transactions.store') }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="createTransactionModalLabel">Add New Transaction</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="transaction_date">Transaction Date</label>
                            <input type="date" autofocus class="form-control ih-medium ip-gray radius-xs b-light px-15"
                                id="transaction_date" name="transaction_date" value="{{ date('Y-m-d') }}" required>
                        </div>
                        <div class="form-group">
                            <label for="supplier_id">Supplier</label>
                            <select class="form-control ih-medium ip-gray radius-xs b-light px-15" id="supplier_id"
                                name="supplier_id" required>
                                <option value="" selected>Pilih Supplier</option>
                                @foreach ($suppliers as $supplier)
                                    <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="price">Price</label>
                            <input type="number" class="form-control ih-medium ip-gray radius-xs b-light px-15"
                                id="price" name="price" required>
                        </div>
                        <div class="form-group">
                            <label for="qty">Quantity</label>
                            <input type="number" class="form-control ih-medium ip-gray radius-xs b-light px-15"
                                id="qty" name="qty" value="1" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button"
                            class="btn btn-light btn-default btn-squared fw-400 text-capitalize b-light color-light"
                            data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary btn-default btn-squared text-capitalize">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @foreach ($suppliers as $supplier)
        <!-- Edit Supplier Modal -->
        <div class="modal fade new-member" id="editSupplierModal{{ $supplier->id }}" tabindex="-1" role="dialog"
            aria-labelledby="editSupplierModalLabel{{ $supplier->id }}" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content radius-xl">
                    <form action="{{ route('suppliers.update', $supplier->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="modal-header">
                            <h5 class="modal-title" id="editSupplierModalLabel{{ $supplier->id }}">Edit Supplier</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="name{{ $supplier->id }}">Name</label>
                                <input type="text" class="form-control ih-medium ip-gray radius-xs b-light px-15"
                                    id="name{{ $supplier->id }}" name="name" autofocus value="{{ $supplier->name }}"
                                    required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button"
                                class="btn btn-light btn-default btn-squared fw-400 text-capitalize b-light color-light"
                                data-dismiss="modal">Close</button>
                            <button type="submit"
                                class="btn btn-primary btn-default btn-squared text-capitalize">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach

@endsection


@section('content')
    @if (session('success'))
        {!! showSuccessToast(session('success')) !!}
        {{ Session::forget('success') }}
    @endif
    @foreach ($suppliers as $supplier)
        <div class="col-md-6 col-sm-12 mb-25">
            <div class="media  py-30  pl-30 pr-20 bg-white radius-xl users-list ">
                <img class=" mr-20 w-50 bg-opacity-primary  " src="{{ $supplier->image }}"
                    alt="{{ $supplier->name }} image profile">
                <div class="media-body d-xl-flex users-list-body">
                    <div class="flex-1 pr-xl-30 users-list-body__title">
                        <h6 class="mt-0 fw-500">{{ $supplier->name }} </h6>
                        <span>Joined since {{ $supplier->created_at->diffForHumans() }}<br>at
                            {{ $supplier->created_at->format('jS F Y') }}
                        </span>
                    </div>
                    <div class="users-list__button mt-xl-0 mt-15">
                        <button class="btn btn-primary btn-default btn-rounded text-capitalize px-20 mb-10 global-shadow"
                            data-toggle="modal" data-target="#createTransactionModal"
                            data-supplier-id="{{ $supplier->id }}"><i class="la la-shopping-bag"></i>
                            Order
                        </button>
                        <div class="card-body pr-0">
                            <div class="atbd-button-list d-flex flex-wrap">
                                <button class="btn btn-icon btn-circle btn-outline-warning" data-toggle="modal"
                                    data-target="#editSupplierModal{{ $supplier->id }}">
                                    <span data-feather="edit"></span>
                                </button>
                                <form action="{{ route('suppliers.destroy', $supplier->id) }}" method="POST"
                                    class="remove">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-icon btn-circle btn-outline-danger"
                                        onclick="return confirm('Are you sure you want to delete this entry?')">
                                        <span data-feather="trash-2"></span>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    @endforeach
@endsection
@section('scripts')
    <script>
        $(document).ready(function() {
            $('#createTransactionModal').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget); // Tombol yang mengaktifkan modal
                var supplierId = button.data('supplier-id');
                var modal = $(this);
                modal.find('#supplier_id').val(supplierId);
            });
        });
    </script>

@endsection
