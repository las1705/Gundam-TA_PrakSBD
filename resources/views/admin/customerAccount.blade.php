@extends('admin.layout')

@section('content')

    <div class="text_center">
        <h4 class="mt-3">Customer Account</h4>
    </div>

    @if($message = Session::get('success'))
        <div class="alert alert-success mt-3" role="alert">
            {{ $message }}
        </div>
    @endif

    @if($message = Session::get('warning'))
        <div class="alert alert-warning mt-3" role="alert">
            {{ $message }}
        </div>
    @endif

    @if($message = Session::get('danger'))
        <div class="alert alert-danger mt-3" role="alert">
            {{ $message }}
        </div>
    @endif

{{--    <div class="mt-2">--}}
{{--        <form method="GET" action="{{ route('admin.search', 'nav') }}">--}}
{{--            <div class="input-group">--}}
{{--                <input type="text" class="form-control" id="key" name="key" placeholder="Enter keyword">--}}
{{--                <button type="submit" class="btn btn-primary">Search</button>--}}
{{--            </div>--}}
{{--        </form>--}}
{{--    </div>--}}

{{--    <a href="{{ route('admin.add', ['status' => 'nav']) }}" type="button" class="btn btn-primary rounded-3">Add New Gunpla</a>--}}


    <h5 class="mt-4">Active</h5>
    <table class="table table-hover mt-2">
        <thead>
        <tr>
            <th>ID</th>
            <th>Username</th>
            <th>Password</th>
            <th>Address</th>
            <th>Contact</th>
            <th>Status</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        @foreach ($datas as $data)
            <tr>
                <td>{{ $data->id_c }}</td>
                <td>{{ $data->username }}</td>
                <td>{{ $data->password }}</td>
                <td>{{ $data->address }}</td>
                <td>{{ $data->contact }}</td>
                <td>{{ $data->status }}</td>

                <td>
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                            data-bs-target="#deactivateModal{{ $data->id_c }}">
                        Deactivate
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="deactivateModal{{ $data->id_c }}" tabindex="-1"
                         aria-labelledby="deactivateModallLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="deactivateModallLabel">Confirmation</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                </div>
                                <form method="POST" action="{{ route('admin.accountDeactivate', $data->id_c) }}">
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
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <h5 class="mt-4">Not Active</h5>
    <table class="table table-hover mt-2">
        <thead>
        <tr>
            <th>ID</th>
            <th>Username</th>
            <th>Password</th>
            <th>Address</th>
            <th>Contact</th>
            <th>Status</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        @foreach ($datas1 as $data1)
            <tr>
                <td>{{ $data1->id_c }}</td>
                <td>{{ $data1->username }}</td>
                <td>{{ $data1->password }}</td>
                <td>{{ $data1->address }}</td>
                <td>{{ $data1->contact }}</td>
                <td>{{ $data1->status }}</td>

                <td>
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-success" data-bs-toggle="modal"
                            data-bs-target="#activateModal{{ $data1->id_c }}">
                        Activate
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="activateModal{{ $data1->id_c }}" tabindex="-1"
                         aria-labelledby="activateModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="activateModallLabel">Confirmation</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                </div>
                                <form method="POST" action="{{ route('admin.accountActivate', $data1->id_c) }}">
                                    @csrf
                                    <div class="modal-body">
                                        Are you sure want to ACTIVATE this account?
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

                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                            data-bs-target="#deleteModal{{ $data1->id_c }}">
                        Delete
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="deleteModal{{ $data1->id_c }}" tabindex="-1"
                         aria-labelledby="deleteModallLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="deleteModalLabel">Confirmation</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                </div>
                                <form method="POST" action="{{ route('admin.accountDelete', $data1->id_c) }}">
                                    @csrf
                                    <div class="modal-body">
                                        Are you sure want to DELETE PERMANANENT this account?
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
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@stop
