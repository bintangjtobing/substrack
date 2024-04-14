@extends('welcome')

@section('title', 'Transactions')

@section('addNewData')
    <div class="action-btn">
        <a href="#" class="btn btn-sm btn-primary btn-add" data-toggle="modal" data-target="#createTransactionModal">
            <i class="la la-plus"></i> Add New @yield('title')</a>
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
                                id="transaction_date" name="transaction_date" required>
                        </div>
                        <div class="form-group">
                            <label for="customer_id">Customer</label>
                            <select class="form-control ih-medium ip-gray radius-xs b-light px-15" id="customer_id"
                                name="customer_id">
                                <option value="" selected>Pilih Customer</option>
                                @foreach ($customers as $customer)
                                    <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="product_id">Product</label>
                            <select class="form-control ih-medium ip-gray radius-xs b-light px-15" id="product_id"
                                name="product_id">
                                <option value="" selected>Pilih Product</option>
                                @foreach ($products as $product)
                                    <option value="{{ $product->id }}">{{ $product->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="supplier_id">Supplier</label>
                            <select class="form-control ih-medium ip-gray radius-xs b-light px-15" id="supplier_id"
                                name="supplier_id">
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
                                id="qty" name="qty" required>
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
    @foreach ($transactions as $transaction)
        <!-- Edit Transaction Modal -->
        <div class="modal fade new-member" id="editTransactionModal{{ $transaction->id }}" tabindex="-1" role="dialog"
            aria-labelledby="editTransactionModalLabel{{ $transaction->id }}" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content radius-xl">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editTransactionModalLabel{{ $transaction->id }}">Edit Transaction</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('transactions.update', ['transaction' => $transaction->id]) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="transaction_date">Transaction Date:</label>
                                <input type="date" class="form-control ih-medium ip-gray radius-xs b-light px-15"
                                    id="transaction_date" name="transaction_date"
                                    value="{{ $transaction->transaction_date }}" required>
                            </div>
                            <div class="form-group">
                                <label for="customer_id">Customer</label>
                                <select class="form-control ih-medium ip-gray radius-xs b-light px-15" id="customer_id"
                                    name="customer_id" required>
                                    @foreach ($customers as $customer)
                                        <option value="{{ $customer->id }}"
                                            {{ $transaction->customer_id == $customer->id ? 'selected' : '' }}>
                                            {{ $customer->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="product_id">Product</label>
                                <select class="form-control ih-medium ip-gray radius-xs b-light px-15" id="product_id"
                                    name="product_id" required>
                                    @foreach ($products as $product)
                                        <option value="{{ $product->id }}"
                                            {{ $transaction->product_id == $product->id ? 'selected' : '' }}>
                                            {{ $product->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="supplier_id">Supplier</label>
                                <select class="form-control ih-medium ip-gray radius-xs b-light px-15" id="supplier_id"
                                    name="supplier_id" required>
                                    @foreach ($suppliers as $supplier)
                                        <option value="{{ $supplier->id }}"
                                            {{ $transaction->supplier_id == $supplier->id ? 'selected' : '' }}>
                                            {{ $supplier->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="subscription_model">Subscription Model:</label>
                                <input type="text" class="form-control ih-medium ip-gray radius-xs b-light px-15"
                                    id="subscription_model" name="subscription_model"
                                    value="{{ $transaction->subscription_model }}" required>
                            </div>
                            <div class="form-group">
                                <label for="price">Price:</label>
                                <input type="text" class="form-control ih-medium ip-gray radius-xs b-light px-15"
                                    id="price" name="price" value="{{ $transaction->price }}" required>
                            </div>
                            <div class="form-group">
                                <label for="qty">Quantity:</label>
                                <input type="text" class="form-control ih-medium ip-gray radius-xs b-light px-15"
                                    id="qty" name="qty" value="{{ $transaction->qty }}" required>
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
    <div class="col-lg-12 mb-25">
        <div class="social-overview-wrap">
            <div class="card border-0">
                <div class="card-body p-0">
                    <div class="table4 table5 p-25 bg-white">
                        <div class="table-responsive">
                            <table class="table mb-0">
                                <thead>
                                    <tr class="userDatatable-header">
                                        <th>
                                            <div class="userDatatable-title">Kode Transaksi</div>
                                        </th>
                                        <th>
                                            <div class="userDatatable-title">Transaction Date</div>
                                        </th>
                                        <th>
                                            <div class="userDatatable-title">Customer</div>
                                        </th>
                                        <th>
                                            <div class="userDatatable-title">Type</div>
                                        </th>
                                        <th>
                                            <div class="userDatatable-title">Product</div>
                                        </th>
                                        <th>
                                            <div class="userDatatable-title">Harga Satuan</div>
                                        </th>
                                        <th>
                                            <div class="userDatatable-title">Quantity</div>
                                        </th>
                                        <th>
                                            <div class="userDatatable-title">Total Tagihan</div>
                                        </th>
                                        <th>
                                            <div class="userDatatable-title">Action</div>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($transactions as $transaction)
                                        <tr>
                                            <td>
                                                <div class="d-flex">
                                                    <div class="userDatatable-inline-title">
                                                        <a href="#" class="text-dark fw-500">
                                                            <h6>{{ $transaction->order_code }}</h6>
                                                        </a>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="d-flex">
                                                    <div class="userDatatable-content">
                                                        {{ $transaction->transaction_date ?? 'N/A' }}
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="userDatatable-content">
                                                    {{ $transaction->customer->name ?? 'Pembelian ' . $transaction->supplier->name }}
                                                </div>
                                            </td>
                                            <td>
                                                <div class="userDatatable-content">
                                                    {{ $transaction->subscription_model ?? 'N/A' }}
                                                </div>
                                            </td>
                                            <td>
                                                <div class="userDatatable-content">
                                                    {{ $transaction->product->name ?? 'N/A' }}
                                                </div>
                                            </td>
                                            <td>
                                                <div class="userDatatable-content">
                                                    Rp {{ number_format($transaction->price, 0, ',', '.') }}
                                                </div>
                                            </td>
                                            <td>
                                                <div class="userDatatable-content">
                                                    {{ $transaction->qty }} Months
                                                </div>
                                            </td>
                                            <td>
                                                <div class="userDatatable-content">
                                                    Rp
                                                    {{ number_format($transaction->price * $transaction->qty, 0, ',', '.') }}
                                                </div>
                                            </td>
                                            <td>
                                                <ul class="orderDatatable_actions mb-0 d-flex flex-wrap">
                                                    <li>
                                                        <button
                                                            style="height: 40px;border-radius: 50%;color: #6bd2eb !important;"
                                                            type="button" class="btn btn-link edit" data-toggle="modal"
                                                            data-target="#editTransactionModal{{ $transaction->id }}">
                                                            <span data-feather="edit"></span>
                                                        </button>
                                                    </li>

                                                    <li>
                                                        <form
                                                            action="{{ route('transactions.destroy', $transaction->id) }}"
                                                            method="POST" class="remove">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button
                                                                style="height: 40px;border-radius: 50%;color: #F59191 !important;"
                                                                type="submit" class="btn btn-link remove"
                                                                onclick="return confirm('Are you sure you want to delete this entry?')">
                                                                <span data-feather="trash-2"></span>
                                                            </button>
                                                        </form>
                                                    </li>
                                                </ul>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="8" class="text-center">
                                                <div class="userDatatable-content">No data available in the database</div>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
