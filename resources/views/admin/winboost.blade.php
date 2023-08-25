@extends('base2')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Win Boosts List</h4>
                
                <div class="mb-3">
                </div>
                      
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Current Rank</th>
                                <th>Price</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($winboosts as $winboost)
                                <tr>
                                    <td>{{ $winboost->current_rank }}</td>
                                 
                                    <td>
                                        <input type="number" name="price{{ $winboost->id }}" value="{{ $winboost->price }}">
                                    </td>
                                    <td>
                                        <button class="btn btn-primary" onclick="updatePrice({{ $winboost->id }})">Update</button>
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
    function updatePrice(winBoostId) {
        var newPrice = document.querySelector('input[name="price' + winBoostId + '"]').value;        
        // Perform an AJAX request to update the price
        axios.post('{{ route("update.winboost.price") }}', {
            winBoostId: winBoostId,
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
