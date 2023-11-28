@extends('customer.layout')

@section('content')

    <h4 class="mt-5">home customer</h4>

    @if($message = Session::get('success'))
        <div class="alert alert-success mt-3" role="alert">
            {{ $message }}
        </div>
    @endif

    <div class="mt-2">
        <form method="GET" action="{{ route('customer.search') }}">
            <div class="input-group">
                <input type="text" class="form-control" id="key" name="key" placeholder="Enter keyword">
                <button type="submit" class="btn btn-primary">Search</button>
            </div>
        </form>
    </div>

    <table class="table table-hover mt-2">
        <thead>
        <tr>
            <th>ID</th>
            <th>Unit Name</th>
            <th>Type</th>
            <th>Price</th>
            <th></th>

        </tr>
        </thead>
        <tbody>
        @foreach ($datas as $data)
            <tr>
                <td>{{ $data->id }}</td>
                <td>{{ $data->name }}</td>
                <td>{{ $data->type }}</td>
                <td>{{ str_replace(',', '.', number_format($data->price)) }}</td>

                <td>
                    <form method="POST" action="{{ route('customer.buy', ['product' => $data->id, 'user' =>$user->id_c] )}}">
                        @csrf
                        </style>
                        <div class="input-group">
                            <span class="input-group-text" id="addon-wrapping">quantity</span>
                            <input type="number" name="quantity" class="w-5" placeholder="0" aria-label="0" aria-describedby="addon-wrapping", min="0">
                            <button type="submit" class="btn btn-primary">Buy</button>
                        </div>

                    </form>

                </td>



            </tr>
        @endforeach
        </tbody>
    </table>


@stop
