@extends('base2')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Smurf Account Orders</h4>
                
                <div class="mb-3">
                    <!-- Filter buttons -->
                  
                   
                </div>
                      
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Full Name</th>
                                <th>Total Price</th>
                                <th>Smurf Account Type</th>
                                <th>Server</th>
                                <th>Payment Status</th>
                                <th>Token</th>
                            </tr>
                        </thead>
                        <tbody id="rankboost-orders-body">
                            @foreach($smurforders as $smurforder)
                                <tr>
                                    <td>{{ $smurforder->user->first_name }} {{ $smurforder->user->last_name }}</td>
                                    <td>{{ $smurforder->price }}</td>
                                    <td>{{ $smurforder->smurf_account_type }}</td>
                                    <td>{{ $smurforder->server }}</td>
                                    <td>{{ $smurforder->payment_status }}</td>
                                    <td>{{ $smurforder->smurf_account_token }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="mt-3">
                    {{ $smurforders->appends(request()->except('page'))->links('custom') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection