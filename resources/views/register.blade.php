<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">Register as Customer</div>

                @if($message = Session::get('success'))
                    <div class="alert alert-warning mt-3" role="alert">
                        {{ $message }}
                    </div>
                @endif

                <div class="card-body">
                    <form method="POST" action="{{ route('verify') }}">
                        @csrf

                        <div class="form-group mt-3">
                            <label for="username">Username</label>
                            <input id="username" type="text" class="form-control" name="username" >
                        </div>

                        <div class="form-group mt-3">
                            <label for="address">Address</label>
                            <input id="address" type="text" class="form-control" name="address" >
                        </div>

                        <div class="form-group mt-3">
                            <label for="contact">Contact</label>
                            <input id="contact" type="text" class="form-control" name="contact" >
                        </div>

                        <div class="form-group">
                            <label for="password">Password</label>
                            <input id="password" type="password" class="form-control" name="password">
                        </div>

                        <div class="form-group text-center mt-3">
                            <button type="submit" class="btn btn-primary">
                                Register
                            </button>

                            @if (Route::has('password.request'))
                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    {{ __('Forgot Your Password?') }}
                                </a>
                            @endif
                        </div>

                    </form>
                </div>


            </div>
        </div>
    </div>
    <div class="text-center mt-3">
        <p><a class="link-opacity-100" href="{{route('login')}}">Back to Login</a></p>
    </div>
</div>
</body>
</html>
