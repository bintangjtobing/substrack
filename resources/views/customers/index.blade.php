@extends('welcome')

@section('title', 'Customers')

@section('addNewData')
    <div class="action-btn">
        <a href="#" class="btn btn-sm btn-primary btn-add" data-toggle="modal" data-target="#createCustomerModal">
            <i class="la la-plus"></i> Add New @yield('title')</a>
    </div>
    <!-- Create Customer Modal -->
    <div class="modal fade new-member" id="createCustomerModal" tabindex="-1" role="dialog"
        aria-labelledby="createCustomerModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content radius-xl">
                <form action="{{ route('customers.store') }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="createCustomerModalLabel">Add New Customer</h5>
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
                            <label for="address">Address</label>
                            <input type="text" class="form-control ih-medium ip-gray radius-xs b-light px-15"
                                id="address" name="address" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control ih-medium ip-gray radius-xs b-light px-15"
                                id="email" name="email" required>
                        </div>
                        <div class="form-group">
                            <label for="phone_number">Phone Number</label>
                            <input type="text" class="form-control ih-medium ip-gray radius-xs b-light px-15"
                                id="phone_number" name="phone_number" required>
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

    @foreach ($customers as $customer)
        <!-- Edit Customer Modal -->
        <div class="modal fade new-member" id="editCustomerModal{{ $customer->id }}" tabindex="-1" role="dialog"
            aria-labelledby="editCustomerModalLabel{{ $customer->id }}" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content radius-xl">
                    <form action="{{ route('customers.update', $customer->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="modal-header">
                            <h5 class="modal-title" id="editCustomerModalLabel{{ $customer->id }}">Edit Customer</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="name{{ $customer->id }}">Name</label>
                                <input type="text" class="form-control ih-medium ip-gray radius-xs b-light px-15"
                                    id="name{{ $customer->id }}" name="name" autofocus value="{{ $customer->name }}"
                                    required>
                            </div>
                            <div class="form-group">
                                <label for="address{{ $customer->id }}">Address</label>
                                <input type="text" class="form-control ih-medium ip-gray radius-xs b-light px-15"
                                    id="address{{ $customer->id }}" name="address" value="{{ $customer->address }}"
                                    required>
                            </div>
                            <div class="form-group">
                                <label for="email{{ $customer->id }}">Email</label>
                                <input type="email" class="form-control ih-medium ip-gray radius-xs b-light px-15"
                                    id="email{{ $customer->id }}" name="email" value="{{ $customer->email }}" required>
                            </div>
                            <div class="form-group">
                                <label for="phone_number{{ $customer->id }}">Phone Number</label>
                                <input type="text" class="form-control ih-medium ip-gray radius-xs b-light px-15"
                                    id="phone_number{{ $customer->id }}" name="phone_number"
                                    value="{{ $customer->phone_number }}" required>
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
                                            <div class="userDatatable-title">Address</div>
                                        </th>
                                        <th>
                                            <div class="userDatatable-title">Email</div>
                                        </th>
                                        <th>
                                            <div class="userDatatable-title">WhatsApp No.</div>
                                        </th>
                                        <th>
                                            <div class="userDatatable-title">Action</div>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($customers as $customer)
                                        <tr>
                                            <td>
                                                <div class="d-flex">
                                                    <div class="userDatatable-inline-title">
                                                        <a href="#" class="text-dark fw-500">
                                                            <h6>{{ $customer->name }}</h6>
                                                        </a>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="userDatatable-content">
                                                    {{ $customer->address }}
                                                </div>
                                            </td>
                                            <td>
                                                <div class="userDatatable-content" style="text-transform: none;">
                                                    {{ $customer->email }}
                                                </div>
                                            </td>
                                            <td>
                                                <div class="userDatatable-content">
                                                    <a
                                                        href="http://wa.me/62{{ $customer->phone_number }}">{{ $customer->phone_number }}</a>
                                                </div>
                                            </td>
                                            <td>
                                                <ul class="orderDatatable_actions mb-0 d-flex flex-wrap">
                                                    <li>
                                                        <button
                                                            style="height: 40px;border-radius: 50%;color: #6bd2eb !important;"
                                                            type="button" class="btn btn-link edit" data-toggle="modal"
                                                            data-target="#editCustomerModal{{ $customer->id }}">
                                                            <span data-feather="edit"></span>
                                                        </button>
                                                    </li>

                                                    <li>
                                                        <form action="{{ route('customers.destroy', $customer->id) }}"
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
                                            <td colspan="5" class="text-center">
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
