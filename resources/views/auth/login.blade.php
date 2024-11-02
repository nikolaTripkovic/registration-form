<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card">
                <h3 class="card-header text-center">Login</h3>
                <div class="card-body">
                    @if(session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="form-group mb-3">
                            <label for="username">Username</label>
                            <input type="text" placeholder="Username" id="username" class="form-control"
                                   name="username" required autofocus>
                            @if ($errors->has('username'))
                                <span class="text-danger">{{ $errors->first('username') }}</span>
                            @endif
                        </div>
                        <div class="form-group mb-3">
                            <label for="password">Password</label>
                            <input type="password" placeholder="Password" id="password" class="form-control"
                                   name="password" required>
                            @if ($errors->has('password'))
                                <span class="text-danger">{{ $errors->first('password') }}</span>
                            @endif
                        </div>
                        <div class="form-group mb-3 d-grid">
                            <button type="submit" class="btn btn-dark btn-block">Sign In</button>
                        </div>
                    </form>
                    <form action="{{ route('register-form') }}" method="GET">
                        @csrf
                        <div class="form-group md-3">
                            <label for="login">Don't have an account?</label>
                            <div class="d-grid">
                                <button type="submit" class="btn btn-secondary btn-block">Sign Up</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
