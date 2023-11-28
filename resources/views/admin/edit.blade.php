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

    <div class="card mt-4">
        <div class="card-body">
            <h5 class="card-title fw-bolder mb-3">Edit Unit</h5>
            <form method="post" action="{{ route('admin.update', $data->id_g) }}">
                @csrf

                <div class="mb-3">
                    <label for="id_g" class="form-label">Unit ID</label>
                    <input type="text" class="form-control" id="id_g" name="id_g"
                           value="{{ $data->id_g }}" disabled>
                </div>

                <div class="mb-3">
                    <label for="name_g" class="form-label">Unit Nama</label>
                    <input type="text" class="form-control" id="name_g" name="name_g"
                           value="{{ $data->name_g }}">
                </div>

                <div class="mb-3">
                    <label for="type_g" class="form-label">Unit Type</label>
                    <select name="type_g" id="type_g" class="form-control"
                        {{--                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 invalid:text-gray-500" --}}
                    >
                        <option value= "{{ $unitType->id_t  }}">{{ $unitType->name_t }}</option>
                        <option value = "1">SD</option>
                        <option value = "2">HG</option>
                        <option value = "3">RG</option>
                        <option value = "4">MG</option>
                        <option value = "5">PG</option>
                    </select>

                </div>

                <div class="mb-3">
                    <label for="price" class="form-label">Unit Price</label>
                    <input type="number" class="form-control" id="price" name="price" value="{{ $data->price }}">
                </div>


                <div class="text-center">
                    <input type="submit" class="btn btn-primary" value="Update" />
                </div>

            </form>
        </div>
    </div>
@stop
