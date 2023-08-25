@extends('base2')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Placement Boosts List</h4>
                
                <div class="mb-3">
                </div>
                      
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Previous Rank</th>
                                <th>Price</th>
                                <th>Match Amount</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($placementboosts as $placementboost)
                                <tr>
                                    <td>{{ $placementboost->previous_rank }}</td>
                                    <td>
                                        <input type="number" name="price{{ $placementboost->id }}" value="{{ $placementboost->price }}">
                                    </td>
                                    <td>{{ $placementboost->match_amount }}</td>
                                    <td>
                                        <button class="btn btn-primary" onclick="updatePrice({{ $placementboost->id }})">Update</button>
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
    function updatePrice(placementBoostId) {
        var newPrice = document.querySelector('input[name="price' + placementBoostId + '"]').value;
        
        // Perform an AJAX request to update the price
        axios.post('{{ route("update.placementboost.price") }}', {
            placementBoostId: placementBoostId,
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
