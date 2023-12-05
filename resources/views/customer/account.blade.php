@extends('customer.layout')

@section('content')

    <h4 class="mt-3">Account Settings</h4>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)

                    <li>{{ $error }}</li>

                @endforeach
            </ul>
        </div>
    @endif

    @if($message = Session::get('success'))
        <div class="alert alert-success mt-3" role="alert">
            {{ $message }}
        </div>
    @endif

    <div class="card mt-4">
        <div class="card-body">
            <h5 class="mt-0">Account Edit</h5>
            <form method="post" action="{{ route('customer.accountUpdate', $data->id_c) }}">
                @csrf


                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" id="username" name="username"
                           value="{{ $data->username }}">
                </div>

                <div class="mb-3">
                    <label for="address" class="form-label">Address</label>
                    <input type="text" class="form-control" id="address" name="address" value="{{ $data->address }}">
                </div>

                <div class="mb-3">
                    <label for="contact" class="form-label">Contact</label>
                    <input type="number" class="form-control" id="contact" name="contact" value="{{ $data->contact }}">
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" value="{{ $data->password }}">
                </div>


                <div class="text-center">
                    <input type="submit" class="btn btn-primary" value="Update" />
                </div>

            </form>
        </div>
    </div>

    <div class="card mt-4">
        <div class="card-body">
            <h5 class="mt-1">Account Delete</h5>

            <label for="password" class="form-label">This account will DEATIVATE and can't be accesd</label>
            <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                    data-bs-target="#softDeleteAccount">
                Delete Account
            </button>

            <!-- Modal -->
            <div class="modal fade" id="softDeleteAccount" tabindex="-1"
                 aria-labelledby="softDeleteAccountLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="softDeleteAccountLabel">Confirmation</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                        </div>
                        <form method="POST" action="{{ route('customer.accountSoftDelete', ['id'=>$data->id_c]) }}">
                            @csrf
                            <div class="modal-body">
                                Are you sure want to DEACTIVATE this account?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-primary">Yes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>

@stop
