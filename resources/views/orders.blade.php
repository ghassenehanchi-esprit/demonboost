@extends('base')

@section('title', 'My Orders')

@section('content')

<div class="row py-5 px-4" style="margin-top: 200px;margin-right:100px;">
    <div class="col-md-3">
        <!-- Menu bar -->
        <div class="list-group">
            <a href="#placement-orders" id="placement-orders-link" class="list-group-item list-group-item-action {{ Request::segment(2) == 'placement-orders' ? 'active' : '' }}">Placement Boost Orders</a>
            <a href="#rank-orders" id="rank-orders-link" class="list-group-item list-group-item-action {{ Request::segment(2) == 'rank-orders' ? 'active' : '' }}">Rank Boost Orders</a>
            <a href="#smurf-orders" id="smurf-orders-link" class="list-group-item list-group-item-action {{ Request::segment(2) == 'smurf-orders' ? 'active' : '' }}">Smurf Account Orders</a>
            <a href="#valorant-orders" id="valorant-orders-link" class="list-group-item list-group-item-action {{ Request::segment(2) == 'valorant-orders' ? 'active' : '' }}">Valorant Account Orders</a>
        </div>
    </div>
    <div class="col-md-9">
        <div class="bg-white shadow rounded overflow-hidden pt-5 pb-5">
            <div class="col-md-12 mb-4 ml-4">
                <p style="color: black;">Need to update your public profile? Go to <a href="{{ route('profile.show', ['id' => Auth::user()->profile->id]) }}">My Profile</a></p>
            </div>
            <hr style="margin-left: 50px;margin-right: 50px;">

            <div id="placement-orders" class="{{ Request::segment(2) == 'placement-orders' ? 'd-block' : 'd-none' }}">
                <h2>Placement Boost Orders</h2>
                <!-- Display the placement boost orders in a table -->
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Price</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($placementOrders as $order)
                            <tr>
                                <td>{{ $order->id }}</td>
                                <td>{{ $order->total_price }}</td>
                                <td>{{ $order->status }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div id="rank-orders" class="{{ Request::segment(2) == 'rank-orders' ? 'd-block' : 'd-none' }}">
                <h2>Rank Boost Orders</h2>
                <!-- Display the rank boost orders in a table -->
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Price</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($rankOrders as $order)
                            <tr>
                                <td>{{ $order->id }}</td>
                                <td>{{ $order->total_price }}</td>
                                <td>{{ $order->status }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div id="smurf-orders" class="{{ Request::segment(2) == 'smurf-orders' ? 'd-block' : 'd-none' }}">
                <h2>Smurf Account Orders</h2>
                <!-- Display the smurf account orders in a table -->
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Price</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($smurfOrders as $order)
                            <tr>
                                <td>{{ $order->id }}</td>
                                <td>{{ $order->price }}</td>
                                <td>{{ $order->status }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div id="valorant-orders" class="{{ Request::segment(2) == 'valorant-orders' ? 'd-block' : 'd-none' }}">
                <h2>Valorant Account Orders</h2>
                <!-- Display the Valorant account orders in a table -->
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Price</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($valorantOrders as $order)
                            <tr>
                                <td>{{ $order->id }}</td>
                                <td>{{ $order->valorantAccount->price }}</td>
                                <td>
                                    <!-- Add the "Report" button with a link to report the order -->
                                    <form action="{{ route('report.order', ['orderId' => $order->id]) }}" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <textarea name="reason" rows="3" placeholder="Reason for reporting" class="form-control" required></textarea>
                                        <input type="file" name="attachment" class="form-control">
                                        <button type="submit" class="btn btn-danger">Report</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    
                </table>
            </div>
        </div>
    </div>
</div>
<!-- Include jQuery library -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function() {
        // Get the current URL
        var currentUrl = window.location.href;

        // Handle click on Placement Boost Orders link
        $('#placement-orders-link').on('click', function(e) {
            e.preventDefault();
            $('#placement-orders').addClass('d-block').removeClass('d-none');
            $('#rank-orders, #smurf-orders, #valorant-orders').removeClass('d-block').addClass('d-none');
            $(this).addClass('active');
            $('#rank-orders-link, #smurf-orders-link, #valorant-orders-link').removeClass('active');
        });

        // Handle click on Rank Boost Orders link
        $('#rank-orders-link').on('click', function(e) {
            e.preventDefault();
            $('#rank-orders').addClass('d-block').removeClass('d-none');
            $('#placement-orders, #smurf-orders, #valorant-orders').removeClass('d-block').addClass('d-none');
            $(this).addClass('active');
            $('#placement-orders-link, #smurf-orders-link, #valorant-orders-link').removeClass('active');
        });

        // Handle click on Smurf Account Orders link
        $('#smurf-orders-link').on('click', function(e) {
            e.preventDefault();
            $('#smurf-orders').addClass('d-block').removeClass('d-none');
            $('#placement-orders, #rank-orders, #valorant-orders').removeClass('d-block').addClass('d-none');
            $(this).addClass('active');
            $('#placement-orders-link, #rank-orders-link, #valorant-orders-link').removeClass('active');
        });

        // Handle click on Valorant Account Orders link
        $('#valorant-orders-link').on('click', function(e) {
            e.preventDefault();
            $('#valorant-orders').addClass('d-block').removeClass('d-none');
            $('#placement-orders, #rank-orders, #smurf-orders').removeClass('d-block').addClass('d-none');
            $(this).addClass('active');
            $('#placement-orders-link, #rank-orders-link, #smurf-orders-link').removeClass('active');
        });

        // Check the current URL and update the menu item accordingly
        if (currentUrl.includes('#placement-orders')) {
            $('#placement-orders').addClass('d-block').removeClass('d-none');
            $('#placement-orders-link').addClass('active');
            $('#rank-orders-link, #smurf-orders-link, #valorant-orders-link').removeClass('active');
        } else if (currentUrl.includes('#rank-orders')) {
            $('#rank-orders').addClass('d-block').removeClass('d-none');
            $('#rank-orders-link').addClass('active');
            $('#placement-orders-link, #smurf-orders-link, #valorant-orders-link').removeClass('active');
        } else if (currentUrl.includes('#smurf-orders')) {
            $('#smurf-orders').addClass('d-block').removeClass('d-none');
            $('#smurf-orders-link').addClass('active');
            $('#placement-orders-link, #rank-orders-link, #valorant-orders-link').removeClass('active');
        } else if (currentUrl.includes('#valorant-orders')) {
            $('#valorant-orders').addClass('d-block').removeClass('d-none');
            $('#valorant-orders-link').addClass('active');
            $('#placement-orders-link, #rank-orders-link, #smurf-orders-link').removeClass('active');
        } else {
            // Default to Placement Boost Orders
            $('#placement-orders').addClass('d-block').removeClass('d-none');
            $('#placement-orders-link').addClass('active');
            $('#rank-orders-link, #smurf-orders-link, #valorant-orders-link').removeClass('active');
        }
    });
</script>
