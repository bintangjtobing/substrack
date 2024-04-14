@extends('welcome')

@section('title', 'Room Detail')

@section('content')
    <div class="row">
        <div class="col-lg-12">
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
    </div>

    <div class="row mt-4">
        <div class="col-lg-12">
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
    </div>

    <div class="row mt-4">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Customer Detail</h5>
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
                                    <td>Customer ID</td>
                                    <td>{{ $customer->id }}</td>
                                </tr>
                                <tr>
                                    <td>Name</td>
                                    <td>{{ $customer->name }}</td>
                                </tr>
                                <tr>
                                    <td>Address</td>
                                    <td>{{ $customer->address }}</td>
                                </tr>
                                <tr>
                                    <td>Email</td>
                                    <td>{{ $customer->email }}</td>
                                </tr>
                                <tr>
                                    <td>Phone Number</td>
                                    <td>{{ $customer->phone_number }}</td>
                                </tr>
                                <!-- Tambahkan atribut lainnya yang diinginkan di sini -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
