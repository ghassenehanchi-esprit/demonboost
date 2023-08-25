@extends('base')

@section('title', 'Profile')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8" style="margin-top: 8rem;">
                <div class="card" >
                    <div class="card-header">Your Accounts</div>

                    <div class="card-body">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Account ID</th>
                                    <th>Username</th>
                                    <th>Email</th>
                                    <th>Full Access</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($accounts as $account)
                                    <tr>
                                        <td>{{ $account->id }}</td>
                                        <td>{{ $account->username }}</td>
                                        <td>{{ $account->email }}</td>
                                        <td>{{ $account->full_access ? 'Yes' : 'No' }}</td>
                                        <td>
                                            @if (!$account->is_sold)
                                                <form method="POST" action="{{ route('account.delete', ['id' => $account->id]) }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">Delete</button>
                                                </form>
                                            @endif
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
@endsection
