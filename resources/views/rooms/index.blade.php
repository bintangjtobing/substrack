@extends('welcome')

@section('title', 'Rooms')

@section('addNewData')
    <div class="action-btn">
        <a href="#" class="btn btn-sm btn-primary btn-add" data-toggle="modal" data-target="#createRoomModal">
            <i class="la la-plus"></i> Add New @yield('title')</a>
    </div>

    <!-- Create Room Modal -->
    <div class="modal fade new-member" id="createRoomModal" tabindex="-1" role="dialog" aria-labelledby="createRoomModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content radius-xl">
                <form action="{{ route('rooms.store') }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="createRoomModalLabel">Add New Room</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="transaction_id">Transaction ID</label>
                            <select class="form-control ih-medium ip-gray radius-xs b-light px-15" id="transaction_id"
                                name="transaction_id">
                                <option value="" selected>Pilih Kode Order</option>
                                @foreach ($transactions as $transaction)
                                    <option value="{{ $transaction->id }}"
                                        data-supplier="{{ $transaction->supplier->name }}">{{ $transaction->order_code }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="services_name">Services Name</label>
                            <input type="text" class="form-control ih-medium ip-gray radius-xs b-light px-15"
                                id="services_name" name="services_name" readonly>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control ih-medium ip-gray radius-xs b-light px-15"
                                id="email" name="email" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="text" class="form-control ih-medium ip-gray radius-xs b-light px-15"
                                id="password" name="password" required>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="max_users">Max Users</label>
                                    <input type="number" class="form-control ih-medium ip-gray radius-xs b-light px-15"
                                        id="max_users" name="max_users" required>
                                </div>
                            </div>
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

    @foreach ($rooms as $room)
        <!-- Edit Room Modal -->
        <div class="modal fade new-member" id="editRoomModal{{ $room->id }}" tabindex="-1" role="dialog"
            aria-labelledby="editRoomModalLabel{{ $room->id }}" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content radius-xl">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editRoomModalLabel{{ $room->id }}">Edit Room</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('rooms.update', ['room' => $room->id]) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control ih-medium ip-gray radius-xs b-light px-15"
                                    id="email" name="email" value="{{ $room->email }}" required>
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="text" class="form-control ih-medium ip-gray radius-xs b-light px-15"
                                    id="password" name="password" value="{{ $room->password }}" required>
                            </div>
                            <div class="form-group">
                                <label for="max_users">Max Users:</label>
                                <input type="text" autofocus
                                    class="form-control ih-medium ip-gray radius-xs b-light px-15" id="max_users"
                                    name="max_users" value="{{ $room->max_users }}" required>
                            </div>
                            <div class="form-group">
                                <label for="available_users">Available Users:</label>
                                <input type="text" class="form-control ih-medium ip-gray radius-xs b-light px-15"
                                    id="available_users" name="available_users" value="{{ $room->available_users }}"
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
    @foreach ($rooms as $room)
        <div class="col-lg-4 mb-25">
            <div class="social-overview-wrap">
                <div class="ratio-box card">
                    <div class="card-body">
                        <h1 class="ratio-point">{{ $room->transaction->supplier->name }}</h1>
                        <p class="text-muted">Expired Date:
                            {{ \Carbon\Carbon::parse($room->transaction->transaction_date)->addMonths($room->transaction->qty)->subDay()->format('d-m-Y') }}
                        </p>
                        <div class="ratio-info d-flex justify-content-between align-items-center">
                            <h6 class="ratio-title">{{ $room->transaction->order_code }}</h6>
                        </div>
                        <div class="progress-wrap mb-0">
                            <div class="progress">
                                <div class="progress-bar bg-primary" role="progressbar"
                                    style="width: {{ ($room->available_users / $room->max_users) * 100 }}%;"
                                    aria-valuenow="{{ ($room->available_users / $room->max_users) * 100 }}"
                                    aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <span class="progress-text">
                                <span class="color-dark dark">{{ $room->available_users }} users</span>
                                <span class="progress-target">available out of {{ $room->max_users }} users</span>
                            </span>
                        </div>
                        <div class="action-icons mt-2">
                            <a href="{{ route('rooms.detail', $room->id) }}"
                                style="height: 40px; border-radius: 50%; color: #33bc4d !important;" class="btn btn-link">
                                <span data-feather="info"></span> Detail
                            </a>
                        </div>
                        <div class="action-icons mt-2">
                            <button style="height: 40px;border-radius: 50%;color: #6bd2eb !important;" type="button"
                                class="btn btn-link edit" data-toggle="modal"
                                data-target="#editRoomModal{{ $room->id }}">
                                <span data-feather="edit"></span> Edit
                            </button>
                            <form action="{{ route('rooms.destroy', $room->id) }}" method="POST" class="remove">
                                @csrf
                                @method('DELETE')
                                <button style="height: 40px;border-radius: 50%;color: #F59191 !important;" type="submit"
                                    class="btn btn-link remove"
                                    onclick="return confirm('Are you sure you want to delete this entry?')">
                                    <span data-feather="trash-2"></span> Delete
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

@endsection
@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Mendapatkan elemen select kode order
            const transactionSelect = document.getElementById('transaction_id');

            // Mendapatkan elemen input services name
            const servicesNameInput = document.getElementById('services_name');

            // Menambahkan event listener untuk merespons perubahan pada elemen select kode order
            transactionSelect.addEventListener('change', function(event) {
                // Mendapatkan nilai dari opsi yang dipilih
                const selectedOption = event.target.selectedOptions[0];

                // Memperbarui nilai input services name dengan nama supplier yang terkait
                servicesNameInput.value = selectedOption.dataset.supplier;
            });
        });
    </script>
@endsection
