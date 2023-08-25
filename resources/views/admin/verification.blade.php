@extends('base2')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Verifications List</h4>

                <div class="mb-3">
                    <!-- Filter buttons -->
                    <div class="btn-group mb-5">
                        <button class="btn btn-primary filter-button" data-status="all">All</button>
                        <button class="btn btn-primary filter-button" data-status="pending">Pending</button>
                        <button class="btn btn-primary filter-button" data-status="completed">Completed</button>
                    </div>
                    <div class="input-group">
                        <input type="text" id="filter-input" class="form-control" placeholder="Search by discord username">
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Full Name</th>
                                <th>Discord</th>
                                <th>Date</th>
                                <th>Status</th>
                                <th>Action</th> <!-- Added column for buttons -->
                            </tr>
                        </thead>
                        <tbody id="verification-list-body">
                            @foreach($verifications as $verification)
                                <tr class="verification-row" data-status="{{ $verification->status }}">
                                    <td>{{ $verification->user->first_name }} {{ $verification->user->last_name }}</td>
                                    <td>{{ $verification->username }}</td>
                                    <td>{{ $verification->date }}</td>
                                    <td>
                                        <select class="form-control status-select" name="status" id="status_{{ $verification->id }}" onchange="updateVerificationStatus({{ $verification->id }})">
                                            <option value="pending" {{ $verification->status === 'pending' ? 'selected' : '' }}>Pending</option>
                                            <option value="invitation sent" {{ $verification->status === 'invitation sent' ? 'selected' : '' }}>Invitation sent</option>
                                            <option value="completed" {{ $verification->status === 'completed' ? 'selected' : '' }}>Completed</option>
                                            <option value="accepted" {{ $verification->status === 'accepted' ? 'selected' : '' }}>Accepted</option>
                                        </select>
                                    </td>
                                    <td> <!-- Added buttons -->
                                        @if ($verification->status === 'accepted')
                                            <button class="btn btn-success" disabled>Accepted</button>
                                        @else
                                            <button class="btn btn-success" onclick="acceptVerification({{ $verification->id }})">Accept</button>
                                        @endif
                                        @if ($verification->status !== 'accepted')
                                            <button class="btn btn-danger" onclick="declineVerification({{ $verification->id }})">Decline</button>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="mt-3">
                    {{ $verifications->appends(request()->except('page'))->links('custom') }}
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

<script>
    function updateVerificationStatus(verificationId) {
        const statusSelect = document.getElementById(`status_${verificationId}`);
        const status = statusSelect.value;

        axios.post(`{{ route('verifications.update') }}`, {
                verificationId: verificationId,
                status: status
            })
            .then(response => {
                // Handle success response, such as updating UI
                console.log(response.data);
            })
            .catch(error => {
                // Handle error response
                console.error(error);
            });
    }

    function acceptVerification(verificationId) {
        axios.post('{{ route('verifications.accept') }}', {
            verificationId: verificationId,
            status: 'accepted'
        })
        .then(response => {
            // Handle success response
            console.log(response.data);
        })
        .catch(error => {
            // Handle error response
            console.error(error);
        });
    }

    function declineVerification(verificationId) {
        axios.post('{{ route('verifications.update') }}', {
            verificationId: verificationId,
            status: 'decline'
        })
        .then(response => {
            // Handle success response
            console.log(response.data);
        })
        .catch(error => {
            // Handle error response
            console.error(error);
        });
    }
</script>

@endsection

