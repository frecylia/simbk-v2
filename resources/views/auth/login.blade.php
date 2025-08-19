@extends('layouts.app')

@section('title', 'Login')

@section('content')
<style>
    body {
        background: url('/images/bg-login.jpg') no-repeat center center fixed;
        background-size: cover;
    }

    .login-container {
        background-color: rgba(255, 255, 255, 0.95);
        padding: 30px;
        max-width: 400px;
        margin: 60px auto;
        box-shadow: 0 0 10px rgba(0,0,0,0.3);
        border-radius: 10px;
    }

    .login-title {
        font-size: 24px;
        font-weight: bold;
        text-align: center;
        margin-bottom: 20px;
        color: #007B9E;
    }

    .login-subtitle {
        font-size: 16px;
        text-align: center;
        margin-bottom: 30px;
        color: #555;
    }

    .form-control {
        border-radius: 8px;
    }

    .btn-primary {
        background-color: #007B9E;
        border: none;
        width: 100%;
        padding: 10px;
        border-radius: 8px;
    }
</style>

<div class="login-container">
    <div class="login-title">SIMBK</div>
    <div class="login-subtitle">(Sistem Bimbingan Konseling)</div>

    <form method="POST" action="{{ route('authenticate') }}">
        @csrf
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input id="email" type="email" class="form-control" name="email" required autofocus placeholder="Enter your Email">
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input id="password" type="password" class="form-control" name="password" required placeholder="Enter your password">
        </div>

        <button type="submit" class="btn btn-primary">Login</button>
    </form>
</div>
@endsection
