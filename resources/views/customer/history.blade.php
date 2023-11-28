@extends('customer.layout')

@section('content')

    <h4 class="mt-3">History Transaction</h4>

    @if($message = Session::get('success'))
        <div class="alert alert-success mt-3" role="alert">
            {{ $message }}
        </div>
    @endif

    <table class="table table-hover mt-2">
        <thead>
        <tr>
            <th>Customer Username</th>
            <th>Unit</th>
            <th>Type</th>
            <th>Quantity</th>
            <th>Total Price</th>
            <th>Time</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($datas as $data)
            <tr>
                <td>{{ $data->customer }}</td>
                <td>{{ $data->unit }}</td>
                <td>{{ $data->type }}</td>
                <td>{{ $data->quantity }}</td>
                <td>{{ str_replace(',', '.', number_format($data->price)) }}</td>
                <td>{{ $data->time }}</td>

            </tr>
        @endforeach
        </tbody>
    </table>


@stop
