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
                                name="product_id" required>
                                <option value="" selected>Pilih Product</option>
                                @foreach ($products as $product)
                                    <option value="{{ $product->id }}">{{ $product->name }}</option>
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
                        <button type="submit"
                            class="btn btn-primary btn-default btn-squared text-capitalize">Save</button>
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
    @foreach ($products as $product)
        <div class="cus-xl-3 col-lg-3 col-md-11 col-12 mb-30 px-10">
            <div class="card product product--grid">
                <div class="h-100">
                    <div class="product-item">
                        <div class="product-item__image">
                            <a href="#"><img class="card-img-top img-fluid" src="{{ $product->supplier->image }}"
                                    alt="{{ $product->name }} image cover"></a>
                        </div>
                        <div class="card-body px-20 pb-25 pt-20">
                            <div class="product-item__body text-capitalize">
                                <a href="product-details.html">
                                    <h6 class="card-title">{{ $product->name }}</h6>
                                    <span class="text-muted fs-12">{{ $product->description }}</span>
                                </a>
                                <div class="d-flex align-items-center mb-10 mt-10 flex-wrap">
                                    <span class="product-desc-price">Rp
                                        {{ number_format($product->price, 0, ',', '.') }}</span>
                                    <span class="product-price">Rp {{ number_format($product->cost, 0, ',', '.') }}</span>
                                    <span class="product-discount">Available quotas: {{ $product->qty }}</span>
                                </div>
                            </div>
                            <div class="product-item__button d-flex mt-20 flex-wrap">
                                <button class="btn btn-primary btn-default btn-squared border-0" data-toggle="modal"
                                    data-target="#createTransactionModal" data-product-id="{{ $product->id }}"
                                    data-product-price="{{ $product->price }}">
                                    <span data-feather="shopping-bag"></span>Buy Now
                                </button>
                                <button class="btn btn-default btn-icon btn-squared btn-outline-light" data-toggle="modal"
                                    data-target="#editProductModal{{ $product->id }}">
                                    <span data-feather="edit"></span>
                                </button>
                                <form action="{{ route('products.destroy', $product->id) }}" method="POST"
                                    class="remove">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-icon btn-squared btn-outline-danger "
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
                var productId = button.data('product-id'); // Ekstrak informasi dari atribut data-product-id
                var productPrice = button.data(
                'product-price'); // Ekstrak informasi dari atribut data-product-id
                var modal = $(this);
                modal.find('#product_id').val(productId);
                modal.find('#price').val(productPrice);
            });
        });
    </script>

@endsection
