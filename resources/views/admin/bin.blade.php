@extends('admin.layout')

@section('content')

    <h4 class="mt-3">Recycle Bin</h4>

    @if($message = Session::get('success'))
        <div class="alert alert-success mt-3" role="alert">
            {{ $message }}
        </div>
    @endif

    <div class="mt-2">
        <form method="GET" action="{{ route('admin.search', 'nav') }}">
            <div class="input-group">
                <input type="text" class="form-control" id="key" name="key" placeholder="Enter keyword">
                <button type="submit" class="btn btn-primary">Search</button>
            </div>
        </form>
    </div>

    <a href="{{ route('admin.add', ['status' => 'nav']) }}" type="button" class="btn btn-primary rounded-3">Add New Gunpla</a>

    <div class="mt-1">
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-success" data-bs-toggle="modal"
                data-bs-target="#restoresAllModal">
            Restore All
        </button>

        <!-- Modal -->
        <div class="modal fade" id="restoresAllModal" tabindex="-1"
             aria-labelledby="restoresAllModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="restoresAllModalLabel">Confirmation</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                    </div>
                    <form method="POST" action="{{ route('admin.restoreAll') }}">
                        @csrf
                        <div class="modal-body">
                            Are you sure want to RESTORE All unit in Recycle bin?
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
                data-bs-target="#deleteAllModal">
            Delete All
        </button>

        <!-- Modal -->
        <div class="modal fade" id="deleteAllModal" tabindex="-1"
             aria-labelledby="deleteAllModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteAllModalLabel">Confirmation</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                    </div>
                    <form method="POST" action="{{ route('admin.deleteAll') }}">
                        @csrf
                        <div class="modal-body">
                            Are you sure want to RESTORE All unit in Recycle bin?
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

    <table class="table table-hover mt-2">
        <thead>
        <tr>
            <th>ID</th>
            <th>Unit Name</th>
            <th>Type</th>
            <th>Price</th>
            <th></th>
            <th></th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        @foreach ($datas as $data)
            <tr>
                <td>{{ $data->id }}</td>
                <td>{{ $data->name }}</td>
                <td>{{ $data->type }}</td>
                <td>{{ $data->price }}</td>

                <td>
                    <a href="{{ route('admin.edit', ['id' =>$data->id] ) }}" type="button"
                       class="btn btn-info rounded-3">Edit</a>
                </td>

                <td>
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-success" data-bs-toggle="modal"
                            data-bs-target="#restoresSingleModal{{ $data->id }}">
                        Restore
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="restoresSingleModal{{ $data->id }}" tabindex="-1"
                         aria-labelledby="restoresSingleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="restoresSingleModalLabel">Confirmation</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                </div>
                                <form method="POST" action="{{ route('admin.restoreSingle', $data->id) }}">
                                    @csrf
                                    <div class="modal-body">
                                        Are you sure want to RESTORE this unit?
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

                <td>
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                            data-bs-target="#deletesSingleModal{{ $data->id }}">
                        Destroy
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="deletesSingleModal{{ $data->id }}" tabindex="-1"
                         aria-labelledby="deletesSingleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="deletesSingleModalLabel">Confirmation</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                </div>
                                <form method="POST" action="{{ route('admin.deleteSingle', $data->id) }}">
                                    @csrf
                                    <div class="modal-body">
                                        Are you sure want to restore this unit?
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
