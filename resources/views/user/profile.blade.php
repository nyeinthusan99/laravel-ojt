@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-md-6">
                <div class="card">
                    <h4 class="card-header fw-bold">
                        Profile
                    </h4>
                    <div class="card-body">
                        <div class="row mb-3">
                            <label class="col-md-4">Name</label>
                            <label class="col-md-8">{{ $user->name }}</label>
                            <img src="" alt="">
                        </div>
                        <div class="row mb-3">
                            <label class="col-md-4">Email</label>
                            <label class="col-md-8">{{ $user->email }}</label>
                        </div>
                        <div class="row mb-3">
                            <label class="col-md-4">Type</label>
                            @if ( $user->type == 0)
                            <label class="col-md-8">Admin</label>
                            @else
                            <label class="col-md-8">User</label>
                             @endif
                        </div>
                        <div class="row mb-3">
                            <label class="col-md-4">Phone</label>
                            <label class="col-md-8">{{ $user->phone }}</label>
                        </div>
                        <div class="row mb-3">
                            <label class="col-md-4">Date of Birth</label>
                            <label class="col-md-8">{{ $user->dob }}</label>
                        </div>
                        <div class="row mb-3">
                            <label class="col-md-4">Address</label>
                            <label class="col-md-8">{{ $user->address }}</label>
                        </div>
                        <div class=" d-flex justify-content-end me-5">
                            <a type="button" class="btn btn-primary" href="/user/profile/update">
                                Edit
                            </a>
                          </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
