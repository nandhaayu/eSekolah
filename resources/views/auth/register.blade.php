@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-header bg-primary text-white text-center">
                    <h4><i class="fas fa-user-plus me-2"></i> Daftar Akun eSekolah</h4>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <!-- Name -->
                        <div class="mb-3">
                            <label for="name" class="form-label text-dark">
                                <i class="fas fa-user me-1"></i> Nama
                            </label>
                            <input id="name" type="text"
                                   class="form-control @error('name') is-invalid @enderror"
                                   name="name" value="{{ old('name') }}" required autofocus>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div class="mb-3">
                            <label for="email" class="form-label text-dark">
                                <i class="fas fa-envelope me-1"></i> Email
                            </label>
                            <input id="email" type="email"
                                   class="form-control @error('email') is-invalid @enderror"
                                   name="email" value="{{ old('email') }}" required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Password -->
                        <div class="mb-3">
                            <label for="password" class="form-label text-dark">
                                <i class="fas fa-lock me-1"></i> Password
                            </label>
                            <input id="password" type="password"
                                   class="form-control @error('password') is-invalid @enderror"
                                   name="password" required>
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Confirm Password -->
                        <div class="mb-3">
                            <label for="password-confirm" class="form-label text-dark">
                                <i class="fas fa-lock me-1"></i> Konfirmasi Password
                            </label>
                            <input id="password-confirm" type="password"
                                   class="form-control"
                                   name="password_confirmation" required>
                        </div>

                        <!-- Submit -->
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary fw-semibold">
                                <i class="fas fa-user-plus me-1"></i> Register
                            </button>
                        </div>
                    </form>
                </div>
                <div class="card-footer text-center bg-light">
                    Sudah punya akun?
                    <a href="{{ route('login') }}" class="fw-semibold text-primary text-decoration-none">Login</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
