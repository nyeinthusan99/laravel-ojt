@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="fw-bold my-3">Login Form</div>
                @error('credentials')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
                    <form action="{{ route('signIn') }}" method="POST">
                        @csrf
                        @method('POST')
                        <div class="mb-3 row">
                            <label for="email" class="col-md-4 col-form-label">Email</label>
                            <div class="col-md-8">
                                <input type="text" name="email"  class="form-control" id="email" value="{{ old('email') }}">
                                @error('email')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="password" class="col-md-4 col-form-label">Password</label>
                            <div class="col-md-8">
                                <input type="password" name="password" class="form-control" id="password" value="{{ old('password') }}">
                                @error('password')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        Remember Me
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-8 offset-md-4 ">
                                <a class="btn btn-link " href="{{ route('forget.password.get') }}">
                                    {{ __('Forgot Your Password?') }}
                                </a>
                            </div>
                        </div>


                        <div class="row mb-0">
                            <div class="col-md-4 offset-md-4 text-center">
                                <button type="submit" class="btn btn-primary w-50">
                                    Login
                                </button>
                            </div>
                        </div>

                    </form>
            </div>
        </div>
    </div>

@endsection
