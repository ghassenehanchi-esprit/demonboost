@extends('base2')

@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">

<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Reports List</h4>

                <div class="mb-3"></div>

                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Order ID</th>
                                <th>Reason</th>
                                <th>Attachment</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($reports as $report)
                            <tr>
                                <td>{{ $report->valorantAccountOrder->id }}</td>
                                <td>{{ $report->reason }}</td>
                                <td>
                                    @if ($report->attachment)
                                    <a href="{{ asset('storage/' . $report->attachment) }}" target="_blank">View Attachment</a>
                                    @else
                                    N/A
                                    @endif
                                </td>
                                <td>
                                    <button class="btn btn-primary refund-button" data-order-id="{{ $report->valorantAccountOrder->id }}">Refund</button>
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

<!-- Include jQuery if not already included -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
   $(document).ready(function () {
    $('.refund-button').click(function () {
        var orderId = $(this).data('order-id');

        // Get the CSRF token value from the meta tag
        var csrfToken = $('meta[name="csrf-token"]').attr('content');

        // Send an AJAX request to the refund-order route
        $.ajax({
            url: '/admin/refund-order/' + orderId, // Include the 'admin' prefix
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': csrfToken // Include the CSRF token in the headers
            },
            success: function (response) {
                // Handle success response (e.g., show a success message)
                alert('Refund successful');
            },
            error: function (xhr, status, error) {
                // Handle error response (e.g., show an error message)
                alert('Refund failed');
            }
        });
    });
});

</script>
@endsection
