@extends('welcome')

@section('title', 'List Users')

@section('addNewData')
    <div class="action-btn">
        <a href="#" class="btn btn-sm btn-primary btn-add" data-toggle="modal" data-target="#createCustomerModal">
            <i class="la la-plus"></i> Add New User</a>
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
    @foreach ($customers as $customer)
        <div class="col-md-6 col-sm-12 mb-25">
            <div class="media  py-30  pl-30 pr-20 bg-white radius-xl users-list ">
                <img class=" mr-20 rounded-circle wh-80 bg-opacity-primary  "
                    src="https://media.istockphoto.com/id/1337144146/vector/default-avatar-profile-icon-vector.jpg?s=612x612&w=0&k=20&c=BIbFwuv7FxTWvh5S3vB6bkT0Qv8Vn8N5Ffseq84ClGI="
                    alt="{{ $customer->name }} image profile">
                <div class="media-body d-xl-flex users-list-body">
                    <div class="flex-1 pr-xl-30 users-list-body__title">
                        <h6 class="mt-0 fw-500">{{ $customer->name }} </h6>
                        <span>Joined since {{ $customer->created_at->diffForHumans() }}<br>at
                            {{ $customer->created_at->format('jS F Y') }}
                        </span>
                        <div class="users-list-body__bottom">
                            <span class="ml-0"><span class="fw-600">
                                    Rp. {{ number_format($customerEarnings[$customer->id], 2) }}
                                </span> earned</span>
                        </div>
                    </div>
                    <div class="users-list__button mt-xl-0 mt-15">
                        <a class="btn btn-primary btn-default btn-rounded text-capitalize px-20 mb-10 global-shadow"
                            href="mailto:{{ $customer->email }}"><i class="la la-envelope-open-text"></i>
                            Email
                        </a>
                        <a class="btn btn-success btn-default btn-rounded text-capitalize px-20 mb-10 global-shadow"
                            href="https://wa.me/62{{ $customer->phone_number }}">
                            <i class="la la-whatsapp"></i>message</button>
                        </a>
                        <div class="card-body pr-0">
                            <div class="atbd-button-list d-flex flex-wrap">
                                <button class="btn btn-icon btn-circle btn-outline-warning" data-toggle="modal"
                                    data-target="#editCustomerModal{{ $customer->id }}">
                                    <span data-feather="edit"></span>
                                </button>
                                <form action="{{ route('customers.destroy', $customer->id) }}" method="POST"
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
