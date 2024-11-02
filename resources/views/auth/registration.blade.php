<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .required {
            color: red;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card">
                <h3 class="card-header text-center">Sign Up</h3>
                <div class="card-body">
                    <form action="{{ route('register') }}" method="POST">
                        @csrf
                        <div class="form-group mb-3">
                            <label for="username">Username<span class="required">*</span></label>
                            <input type="text" placeholder="Username" id="username" class="form-control" name="username"
                                   value="{{ old('username') }}"
                                   required autofocus>
                            @if ($errors->has('username'))
                                <span class="text-danger">{{ $errors->first('username') }}</span>
                            @endif
                        </div>
                        <div class="form-group mb-3">
                            <label for="email">Email<span class="required">*</span></label>
                            <input type="text" placeholder="Email" id="email" class="form-control"
                                   name="email" value="{{ old('email') }}" required autofocus>
                            @if ($errors->has('email'))
                                <span class="text-danger">{{ $errors->first('email') }}</span>
                            @endif
                        </div>
                        <div class="form-group mb-3">
                            <label for="password">Pasword<span class="required">*</span></label>
                            <input type="password" placeholder="Password" id="password" class="form-control"
                                   name="password" required>
                            @if ($errors->has('password'))
                                <span class="text-danger">{{ $errors->first('password') }}</span>
                            @endif
                        </div>
                        <div class="form-group mb-3">
                            <label for="password_confirmation">Confirm password<span class="required">*</span></label>
                            <input type="password" placeholder="Confirm password" id="password_confirmation"
                                   class="form-control"
                                   name="password_confirmation" required>
                            @if ($errors->has('password_confirmation'))
                                <span class="text-danger small">{{ $errors->first('password_confirmation') }}</span>
                            @endif
                        </div>
                        <div class="form-group mb-3">
                            <div class="checkbox">
                                <input type="checkbox" name="agreement" class="form-check-input"
                                    {{ old('agreement') ? 'checked' : '' }}>
                                <label for="agreement">
                                    I Agree<span class="required">*</span>
                                </label>
                                @if ($errors->has('agreement'))
                                    <span class="text-danger">{{ $errors->first('agreement') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-dark btn-block">Sign Up</button>
                        </div>
                    </form>
                    <form action="{{ route('login-form') }}" method="GET">
                        @csrf
                        <div class="form-group md-3">
                            <label for="login">Already have an account?</label>
                            <div class="d-grid">
                                <button type="submit" class="btn btn-secondary btn-block">Log In</button>
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
