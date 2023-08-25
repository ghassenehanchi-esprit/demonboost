@extends('base2')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Rank Boosts List</h4>
                
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
                                <th>Desired Rank</th>
                                <th>Server</th>
                                <th>Current RR</th>
                                <th>Username</th>
                                <th>Password</th>
                                <th style="min-width:150px;">Status</th>
                            </tr>
                        </thead>
                        <tbody id="rankboost-orders-body">
                            @foreach($rankboostorders as $rankboostorder)
                                <tr class="rank-boost-row" data-status="{{ $rankboostorder->status }}">
                                    <td>{{ $rankboostorder->user->first_name }} {{ $rankboostorder->user->last_name }}</td>
                                    <td>{{ $rankboostorder->total_price }}</td>
                                    <td>{{ $rankboostorder->special_agent }}</td>
                                    <td>{{ $rankboostorder->p_with_booster }}</td>
                                    <td>{{ $rankboostorder->is_priority }}</td>
                                    <td>{{ $rankboostorder->current_rank }}</td>
                                    <td>{{ $rankboostorder->desired_rank }}</td>
                                    <td>{{ $rankboostorder->server }}</td>
                                    <td>{{ $rankboostorder->current_rr }}</td>
                                    <td>{{ $rankboostorder->username }}</td>
                                    <td>{{ $rankboostorder->password }}</td>
                                    <td>
                                        <select class="form-control status-select" name="status" id="status_{{ $rankboostorder->id }}" onchange="updateRankBoostOrderStatus({{ $rankboostorder->id }})">
                                            <option value="new" {{ $rankboostorder->status === 'new' ? 'selected' : '' }}>New</option>
                                            <option value="in progress" {{ $rankboostorder->status === 'in progress' ? 'selected' : '' }}>In Progress</option>
                                            <option value="complete" {{ $rankboostorder->status === 'complete' ? 'selected' : '' }}>Complete</option>
                                        </select>
                                        
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="mt-3">
                    {{ $rankboostorders->appends(request()->except('page'))->links('custom') }}
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
   function updateRankBoostOrderStatus(rankBoostId) {
    const statusSelect = document.getElementById(`status_${rankBoostId}`);
    const status = statusSelect.value;

    axios.post(`{{ route('rankboostorders.updateStatus') }}`, { 
        rankBoostId: rankBoostId,
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
        filterRankBoostOrders(status,username);
    });

    // Filter button click event
    const filterButtons = document.querySelectorAll('.filter-button');
    filterButtons.forEach(button => {
        button.addEventListener('click', () => {
            const status = button.dataset.status;
            const username = filterInput.value.trim();
            filterRankBoostOrders(status, username);
        });
    });

    // Function to filter rank boost orders by status and username using AJAX
    function filterRankBoostOrders(status, username) {
        axios.get(`{{ route('rankboostorders.filter') }}?status=${status}&username=${username}`)
            .then(response => {
                const rankBoostOrdersBody = document.getElementById('rankboost-orders-body');
                rankBoostOrdersBody.innerHTML = response.data.html;
            })
            .catch(error => {
                console.error(error);
            });
    }
</script>


@endsection
