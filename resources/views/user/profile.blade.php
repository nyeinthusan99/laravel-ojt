@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-md-6">
                <div class="card">
                    <h4 class="card-header fw-bold">
                        Profile
                    </h4>
                    <div class="card-body m-auto w-75">
                        <div class=" mb-3 text-center">
                            @if($user->profile)
                            <img src="{{ asset('storage/' . $user->id . '/' . $user->profile) }}" alt="profile" class="img-fluid rounded w-50 h-50">
                            @else
                            <img src="{{ asset('storage/man.png') }}" alt="Default profile image" class="img-fluid w-50 h-50">
                            @endif
                        </div>
                        <div class="row mb-3">
                            <label class="col-md-7">Name</label>
                            <label class="col-md-5">{{ $user->name }}</label>
                        </div>
                        <div class="row mb-3">
                            <label class="col-md-7">Email</label>
                            <label class="col-md-5">{{ $user->email }}</label>
                        </div>
                        <div class="row mb-3">
                            <label class="col-md-7">Type</label>
                            @if ( $user->type == 0)
                            <label class="col-md-5">Admin</label>
                            @else
                            <label class="col-md-5">User</label>
                             @endif
                        </div>
                        <div class="row mb-3">
                            <label class="col-md-7">Phone</label>
                            <label class="col-md-5">{{ $user->phone ?? '-' }}</label>
                        </div>
                        <div class="row mb-3">
                            <label class="col-md-7">Date of Birth</label>
                            <label class="col-md-5">{{ $user->dob ?? '-' }}</label>
                        </div>
                        <div class="row mb-3">
                            <label class="col-md-7">Address</label>
                            <label class="col-md-5">{{ $user->address ?? '-' }}</label>
                        </div>
                        <div class=" d-flex justify-content-end me-5">
                            <a type="button" class="btn btn-primary" href="/user/profile/update">
                                <i class="fa-sharp fa-solid fa-pen-to-square"></i> Edit
                            </a>
                          </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
