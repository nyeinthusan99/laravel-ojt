@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header fw-bold ">Change Password</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('changePassword') }}">
                            @csrf

                            <div class="form-group row mb-3">
                                <label for="password" class="col-md-4 col-form-label text-md-right">Current Password</label>

                                <div class="col-md-7">
                                    <input id="password" type="password" class="form-control" name="current_password"
                                        autocomplete="current-password">
                                    @error('current_password')
                                        <span class="text-danger" id="err">{{ $message }}</span>
                                    @enderror
                                    @error('errorMsg')
                                        <span class="text-danger" id="err">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-3">
                                <label for="password" class="col-md-4 col-form-label text-md-right">New Password</label>

                                <div class="col-md-7">
                                    <input id="new_password" type="password" class="form-control" name="new_password"
                                        autocomplete="current-password">
                                    @error('new_password')
                                        <span class="text-danger" id="err">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-3">
                                <label for="password" class="col-md-4 col-form-label text-md-right">New Confirm
                                    Password</label>

                                <div class="col-md-7">
                                    <input id="new_confirm_password" type="password" class="form-control"
                                        name="new_confirm_password" autocomplete="current-password">
                                    @error('new_confirm_password')
                                        <span class="text-danger" id="err">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        Update Password
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
