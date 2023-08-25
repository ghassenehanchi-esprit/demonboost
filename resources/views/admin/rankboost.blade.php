@extends('base2')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Rank Boosts List</h4>
                
                <div class="mb-3">
                </div>
                      
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Current Rank</th>
                                <th>Desired Rank</th>
                                <th>Price</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($rankboosts as $rankboost)
                                <tr>
                                    <td>{{ $rankboost->current_rank }}</td>
                                    <td>{{ $rankboost->desired_rank }}</td>
                                    <td>
                                        <input type="number" name="price{{ $rankboost->id }}" value="{{ $rankboost->price }}">
                                    </td>
                                    <td>
                                        <button class="btn btn-primary" onclick="updatePrice({{ $rankboost->id }})">Update</button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
    function updatePrice(rankBoostId) {
        var newPrice = document.querySelector('input[name="price' + rankBoostId + '"]').value;        
        // Perform an AJAX request to update the price
        axios.post('{{ route("update.rankboost.price") }}', {
            rankBoostId: rankBoostId,
            newPrice: newPrice
        })
        .then(function (response) {
            // Handle success response
            console.log(response.data);
        })
        .catch(function (error) {
            // Handle error response
            console.log(error);
        });
    }
</script>
@endsection
