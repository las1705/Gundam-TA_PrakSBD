@extends('admin.layout')
@section('content')

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if(isset($error_D))
        <div class="alert alert-danger">
            {{ $error_D }}
        </div>
    @endif

    <div class="card mt-4">
        <div class="card-body">
            <h5 class="card-title fw-bolder mb-3">Tambah Menu Ice Cream</h5>
            <form method="post" action="{{route('admin.insert', $status)}}">
                @csrf
                <div class="mb-3">
                    <label for="id_g" class="form-label">Unit ID</label>
                    <input type="number" class="form-control" id="id_g" name="id_g">
                </div>

                <div class="mb-3">
                    <label for="name_g" class="form-label">unit Name</label>
                    <input type="text" class="form-control" id="name_g" name="name_g">
                </div>

                <div class="mb-3">
                    <label for="type_g" class="form-label">Unit Type</label>
                    <select name="type_g" id="type_g" class="form-control">\
                        <option disabled selected></option>
                        <option value = "1">SD</option>
                        <option value = "2">HG</option>
                        <option value = "3">RG</option>
                        <option value = "4">MG</option>
                        <option value = "5">PG</option>
                    </select>

                </div>

                <div class="mb-3">
                    <label for="price" class="form-label">Unit Price</label>
                    <input type="number" class="form-control" id="price" name="price">
                </div>

                <div class="text-center">
                    <input type="submit" class="btn btn-primary" value="Tambah" />
                </div>

            </form>
        </div>
    </div>
@stop
