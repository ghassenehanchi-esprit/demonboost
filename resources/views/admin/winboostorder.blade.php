@extends('base2')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Win Boost Orders</h4>
                
                <div class="mb-3">
                    <!-- Filter buttons -->
                    <div class="btn-group mb-5">
                        <button class="btn btn-primary filter-button" data-status="all">All</button>
                        <button class="btn btn-primary filter-button" data-status="new">New</button>
                        <button class="btn btn-primary filter-button" data-status="in progress">In Progress</button>
                        <button class="btn btn-primary filter-button" data-status="complete">Complete</button>
                    </div>
                    <div class="input-group">
                        <input type="text" id="filter-input" class="form-control" placeholder="Search by username">
                       
                    </div>
                </div>
                      
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Full Name</th>
                                <th>Total Price</th>
                                <th>Special Agent</th>
                                <th>Play With Booster</th>
                                <th>Priority</th>
                                <th>Current Rank</th>
                                <th>Number of Games</th>
                                <th>Server</th>
                                <th>Username</th>
                                <th>Password</th>
                                <th style="min-width:150px;">Status</th>
                            </tr>
                        </thead>
                        <tbody id="winboost-orders-body">
                            @foreach($winboostorders as $winboostorder)
                                <tr class="win-boost-row" data-status="{{ $winboostorder->status }}">
                                    <td>{{ $winboostorder->user->first_name }} {{ $winboostorder->user->last_name }}</td>
                                    <td>{{ $winboostorder->total_price }}</td>
                                    <td>{{ $winboostorder->special_agent }}</td>
                                    <td>{{ $winboostorder->p_with_booster }}</td>
                                    <td>{{ $winboostorder->is_priority }}</td>
                                    <td>{{ $winboostorder->current_rank }}</td>
                                    <td>{{ $winboostorder->wins_amount }}</td>
                                    <td>{{ $winboostorder->server }}</td>
                                    <td>{{ $winboostorder->username }}</td>
                                    <td>{{ $winboostorder->password }}</td>
                                    <td>
                                        <select class="form-control status-select" name="status" id="status_{{ $winboostorder->id }}" onchange="updateWinBoostOrderStatus({{ $winboostorder->id }})">
                                            <option value="new" {{ $winboostorder->status === 'new' ? 'selected' : '' }}>New</option>
                                            <option value="in progress" {{ $winboostorder->status === 'in progress' ? 'selected' : '' }}>In Progress</option>
                                            <option value="complete" {{ $winboostorder->status === 'complete' ? 'selected' : '' }}>Complete</option>
                                        </select>
                                        
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="mt-3">
                    {{ $winboostorders->appends(request()->except('page'))->links('custom') }}
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
   function updateWinBoostOrderStatus(winBoostId) {
    const statusSelect = document.getElementById(`status_${winBoostId}`);
    const status = statusSelect.value;

    axios.post(`{{ route('winboostorders.updateStatus') }}`, { 
        winBoostId: winBoostId,
        status: status })
        .then(response => {
            // Handle success if needed
            console.log(response.data);
        })
        .catch(error => {
            console.error(error);
        });
}


    </script>
<script>
    // Filter input keyup event
    const filterInput = document.getElementById('filter-input');
    filterInput.addEventListener('keyup', () => {
        const username = filterInput.value.trim();
        filterWinBoostOrders(status,username);
    });

    // Filter button click event
    const filterButtons = document.querySelectorAll('.filter-button');
    filterButtons.forEach(button => {
        button.addEventListener('click', () => {
            const status = button.dataset.status;
            const username = filterInput.value.trim();
            filterWinBoostOrders(status, username);
        });
    });

    // Function to filter rank boost orders by status and username using AJAX
    function filterWinBoostOrders(status, username) {
        axios.get(`{{ route('winboostorders.filter') }}?status=${status}&username=${username}`)
            .then(response => {
                const rankBoostOrdersBody = document.getElementById('winboost-orders-body');
                rankBoostOrdersBody.innerHTML = response.data.html;
            })
            .catch(error => {
                console.error(error);
            });
    }
</script>


@endsection
