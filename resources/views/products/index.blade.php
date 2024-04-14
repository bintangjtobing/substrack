@extends('welcome')

@section('title', 'Products')

@section('addNewData')
    <div class="action-btn">
        <a href="#" class="btn btn-sm btn-primary btn-add" data-toggle="modal" data-target="#createProductModal">
            <i class="la la-plus"></i> Add New @yield('title')</a>
    </div>

    <!-- Create Product Modal -->
    <div class="modal fade new-member" id="createProductModal" tabindex="-1" role="dialog"
        aria-labelledby="createProductModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content radius-xl">
                <form action="{{ route('products.store') }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="createProductModalLabel">Add New Product</h5>
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
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea class="form-control ih-medium ip-gray radius-xs b-light px-15" id="description" name="description"
                                rows="3" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="sales_type">Sales Type</label>
                            <input type="text" class="form-control ih-medium ip-gray radius-xs b-light px-15"
                                id="sales_type" name="sales_type" required>
                        </div>
                        <div class="form-group">
                            <label for="subscription_model">Subscription Model</label>
                            <input type="text" class="form-control ih-medium ip-gray radius-xs b-light px-15"
                                id="subscription_model" name="subscription_model" required>
                        </div>
                        <div class="form-group">
                            <label for="price">Harga Jual</label>
                            <input type="number" class="form-control ih-medium ip-gray radius-xs b-light px-15"
                                id="price" name="price" required>
                        </div>
                        <div class="form-group">
                            <label for="cost">Harga Beli</label>
                            <input type="number" class="form-control ih-medium ip-gray radius-xs b-light px-15"
                                id="cost" name="cost" required>
                        </div>
                        <div class="form-group">
                            <label for="qty">Quantity</label>
                            <input type="number" class="form-control ih-medium ip-gray radius-xs b-light px-15"
                                id="qty" name="qty" required>
                        </div>
                        <div class="form-group">
                            <label for="supplier_id">Supplier</label>
                            <select class="form-control ih-medium ip-gray radius-xs b-light px-15" id="supplier_id"
                                name="supplier_id" required>
                                @foreach ($suppliers as $supplier)
                                    <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                                @endforeach
                            </select>
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

    @foreach ($products as $product)
        <!-- Edit Product Modal -->
        <div class="modal fade new-member" id="editProductModal{{ $product->id }}" tabindex="-1" role="dialog"
            aria-labelledby="editProductModalLabel{{ $product->id }}" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content radius-xl">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editProductModalLabel{{ $product->id }}">Edit Product</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('products.update', ['product' => $product->id]) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="name">Name:</label>
                                <input type="text" class="form-control ih-medium ip-gray radius-xs b-light px-15"
                                    id="name" name="name" autofocus value="{{ $product->name }}" required>
                            </div>
                            <div class="form-group">
                                <label for="description">Description:</label>
                                <textarea class="form-control ih-medium ip-gray radius-xs b-light px-15" id="description" name="description"
                                    rows="3" required>{{ $product->description }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="sales_type">Sales Type:</label>
                                <input type="text" class="form-control ih-medium ip-gray radius-xs b-light px-15"
                                    id="sales_type" name="sales_type" value="{{ $product->sales_type }}" required>
                            </div>
                            <div class="form-group">
                                <label for="subscription_model">Subscription Model:</label>
                                <input type="text" class="form-control ih-medium ip-gray radius-xs b-light px-15"
                                    id="subscription_model" name="subscription_model"
                                    value="{{ $product->subscription_model }}" required>
                            </div>
                            <div class="form-group">
                                <label for="price">Harga Jual:</label>
                                <input type="text" class="form-control ih-medium ip-gray radius-xs b-light px-15"
                                    id="price" name="price" value="{{ $product->price }}" required>
                            </div>
                            <div class="form-group">
                                <label for="cost">Harga Beli:</label>
                                <input type="text" class="form-control ih-medium ip-gray radius-xs b-light px-15"
                                    id="cost" name="cost" value="{{ $product->cost }}" required>
                            </div>
                            <div class="form-group">
                                <label for="qty">Quantity:</label>
                                <input type="text" class="form-control ih-medium ip-gray radius-xs b-light px-15"
                                    id="qty" name="qty" value="{{ $product->qty }}" required>
                            </div>
                            <div class="form-group">
                                <label for="supplier_id">Supplier:</label>
                                <select class="form-control ih-medium ip-gray radius-xs b-light px-15" id="supplier_id"
                                    name="supplier_id" required>
                                    @foreach ($suppliers as $supplier)
                                        <option value="{{ $supplier->id }}"
                                            {{ $product->supplier_id == $supplier->id ? 'selected' : '' }}>
                                            {{ $supplier->name }}</option>
                                    @endforeach
                                </select>
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
                                            <div class="userDatatable-title">Name</div>
                                        </th>
                                        <th>
                                            <div class="userDatatable-title">Desc</div>
                                        </th>
                                        <th>
                                            <div class="userDatatable-title">Type</div>
                                        </th>
                                        <th>
                                            <div class="userDatatable-title">Subscription</div>
                                        </th>
                                        <th>
                                            <div class="userDatatable-title">Harga Jual</div>
                                        </th>
                                        <th>
                                            <div class="userDatatable-title">Harga Beli</div>
                                        </th>
                                        <th>
                                            <div class="userDatatable-title">Quantity</div>
                                        </th>
                                        <th>
                                            <div class="userDatatable-title">Supplier</div>
                                        </th>
                                        <th>
                                            <div class="userDatatable-title">Action</div>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($products as $product)
                                        <tr>
                                            <td>
                                                <div class="d-flex">
                                                    <div class="userDatatable-inline-title">
                                                        <a href="#" class="text-dark fw-500">
                                                            <h6>{{ $product->name }}</h6>
                                                        </a>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="userDatatable-content">
                                                    {{ Str::limit($product->description, 30) }}
                                                </div>
                                            </td>
                                            <td>
                                                <div class="userDatatable-content">
                                                    {{ $product->sales_type }}
                                                </div>
                                            </td>
                                            <td>
                                                <div class="userDatatable-content">
                                                    {{ $product->subscription_model }}
                                                </div>
                                            </td>
                                            <td>
                                                <div class="userDatatable-content">
                                                    Rp {{ number_format($product->price, 0, ',', '.') }}
                                                </div>
                                            </td>
                                            <td>
                                                <div class="userDatatable-content">
                                                    Rp {{ number_format($product->cost, 0, ',', '.') }}
                                                </div>
                                            </td>
                                            <td>
                                                <div class="userDatatable-content">
                                                    {{ $product->qty }} Quota
                                                </div>
                                            </td>
                                            <td>
                                                <div class="userDatatable-content">
                                                    {{ $product->supplier->name ?? 'N/A' }}
                                                </div>
                                            </td>
                                            <td>
                                                <ul class="orderDatatable_actions mb-0 d-flex flex-wrap">
                                                    <li>
                                                        <button
                                                            style="height: 40px;border-radius: 50%;color: #6bd2eb !important;"
                                                            type="button" class="btn btn-link edit" data-toggle="modal"
                                                            data-target="#editProductModal{{ $product->id }}">
                                                            <span data-feather="edit"></span>
                                                        </button>
                                                    </li>

                                                    <li>
                                                        <form action="{{ route('products.destroy', $product->id) }}"
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
                                            <td colspan="9" class="text-center">
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
