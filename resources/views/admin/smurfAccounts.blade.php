@extends('base2')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Smurf Account List</h4>
                
                <div class="mb-3">
                </div>
                      
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Type</th>
                                <th>Sold</th>
                                <th>Username</th>
                                <th>Password</th>
                                <th>Email</th>
                                <th>Email Password</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($smurfaccounts as $smurfaccount)
                                <tr>
                                    <td>{{ $smurfaccount->type }}</td>
                                    <td>{{ $smurfaccount->is_sold }}</td>
                                    <td>{{ $smurfaccount->username }}</td>
                                    <td>{{ \Illuminate\Support\Facades\Hash::check('password_to_check', $smurfaccount->password) ? $smurfaccount->password : '********' }}</td>
                                    <td>{{ $smurfaccount->email }}</td>
                                    <td>{{ \Illuminate\Support\Facades\Hash::check('email_password_to_check', $smurfaccount->email_password) ? $smurfaccount->email_password : '********' }}</td>
                                    <td>
                                        <form id="delete-form-{{ $smurfaccount->id }}" action="{{ route('smurf-accounts.destroy', $smurfaccount->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn btn-primary" onclick="deleteSmurfAccount({{ $smurfaccount->id }})">Delete</button>
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
</div>


<script>
    function deleteSmurfAccount(id) {
        if (confirm('Are you sure you want to delete this smurf account?')) {
            document.getElementById('delete-form-' + id).submit();
        }
    }
</script>


@endsection
