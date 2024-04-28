@extends('welcome')

@section('title', 'Room Detail')

@section('content')
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Room Detail</h5>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Attribute</th>
                                    <th>Value</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Room ID</td>
                                    <td>{{ $room->id }}</td>
                                </tr>
                                <tr>
                                    <td>Email</td>
                                    <td>{{ $room->email }}</td>
                                </tr>
                                <tr>
                                    <td>Password</td>
                                    <td>{{ $room->password }}</td>
                                </tr>
                                <tr>
                                    <td>Max Users</td>
                                    <td>{{ $room->max_users }}</td>
                                </tr>
                                <tr>
                                    <td>Available Users</td>
                                    <td>{{ $room->available_users }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Transaction Detail</h5>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Attribute</th>
                                    <th>Value</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Order Code</td>
                                    <td>{{ $transaction->order_code }}</td>
                                </tr>
                                <tr>
                                    <td>Transaction Date</td>
                                    <td>{{ $transaction->transaction_date }}</td>
                                </tr>
                                <!-- Tambahkan atribut lainnya yang diinginkan di sini -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-12 mt-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Customer Detail</h5>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>CustomerID</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone Number</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($customers as $customer)
                            <tr>
                                <td>{{ $customer->id }}</td>
                                <td>{{ $customer->name }}</td>
                                <td><a href="https://mailto:{{ $customer->email }}" target="_blank">{{ $customer->email }}</a></td>
                                <td><a href="https://wa.me/62{{ $customer->phone_number }}" target="_blank">{{ $customer->phone_number }}</a></td>
                            </tr>
                        @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>


@endsection
