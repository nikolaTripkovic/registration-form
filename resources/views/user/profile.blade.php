<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container">
    <div class="row justify-content-center">
        <div class="d-flex col-md-4 justify-content-center">
            <h4>Hi {{ $user->username }}, you are logged in :)</h4>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="d-flex col-md-4 justify-content-center">
            <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                @csrf
                <div class="col-md-4">
                    <button type="submit" class="btn btn-dark btn-block">Logout</button>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>
