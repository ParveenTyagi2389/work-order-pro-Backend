<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8"/>
  <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
  <title>WorkOrder Pro - Admin Login</title>
  <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet"/>
  <link href="{{ asset('css/uicons-regular-straight.css') }}" rel="stylesheet"/>
  <link href="{{ asset('css/uicons-solid-rounded.css') }}" rel="stylesheet"/>
  <link href="{{ asset('css/uicons-brands.css') }}" rel="stylesheet"/>
  <link href="{{ asset('css/style.css') }}" rel="stylesheet"/>
  <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
</head>
<body class="login-page">
<div class="login-card">
  <img alt="WorkOrder Pro Logo" src="{{ asset('images/logo-2.svg') }}"/>

  {{-- Validation error messages --}}
  @if ($errors->any())
    <div class="alert alert-danger">
      <ul class="mb-0 ps-3">
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif

  {{-- Session status (e.g., password reset success) --}}
  @if (session('status'))
    <div class="alert alert-success">
      {{ session('status') }}
    </div>
  @endif

  <form method="POST" action="{{ route('login') }}">
    @csrf

    <div class="form-group">
      <label class="form-label" for="email">Email Address</label>
      <input
        id="email"
        name="email"
        type="email"
        class="form-control form-control-styled @error('email') is-invalid @enderror"
        placeholder="Enter your email"
        value="{{ old('email') }}"
        required
        autofocus
      />
      @error('email')
        <div class="invalid-feedback">{{ $message }}</div>
      @enderror
    </div>

    <div class="form-group">
      <label class="form-label" for="password">Password</label>
      <input
        id="password"
        name="password"
        type="password"
        class="form-control form-control-styled @error('password') is-invalid @enderror"
        placeholder="Enter your password"
        required
      />
      @error('password')
        <div class="invalid-feedback">{{ $message }}</div>
      @enderror
    </div>

    <div class="forgot-password-text">
      <a class="forgot-link forgot-password-text-a-custom" href="{{ route('password.request') }}">
        Forgot password?
      </a>
    </div>

    <button class="btn btn-primary btn-primary-custom sign-in" type="submit">
      Sign In
    </button>
  </form>
</div>
</body>
</html>