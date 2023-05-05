@extends('layouts.app')
@section('content')

<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
        <div class="fw-bold mt-5">Create User</div>
          <form method="POST" action="{{ route('user.create') }}" id="myForm">
            @csrf
            <div class="form-group row my-3">
              <label for="name" class="col-md-4 col-form-label text-md-right required">Name<span class="text-danger ms-2">*</span></label>

              <div class="col-md-6">
                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}">
                @error('name')
                    <span class="text-danger" id="err">{{ $message }}</span>
                @enderror
              </div>
            </div>
            <div class="form-group row my-3">
                <label for="email" class="col-md-4 col-form-label text-md-right required">Email Address<span class="text-danger ms-2">*</span></label>

                <div class="col-md-6">
                  <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}">
                  @error('email')
                      <span class="text-danger" id="err">{{ $message }}</span>
                  @enderror
                </div>
              </div>
              <div class="form-group row my-3">
                <label for="password" class="col-md-4 col-form-label text-md-right required">Password<span class="text-danger ms-2">*</span></label>

                <div class="col-md-6">
                  <input id="password" type="password" class="form-control" name="password" value="{{ old('password') }}">
                  @error('password')
                      <span class="text-danger" id="err">{{ $message }}</span>
                  @enderror
                </div>
              </div>
              <div class="form-group row my-3">
                <label for="confirmPassword" class="col-md-4 col-form-label text-md-right required">Confirm Password<span class="text-danger ms-2">*</span></label>

                <div class="col-md-6">
                  <input id="confirmPassword" type="password" class="form-control" name="confirmPassword" value="{{ old('confirmPassword') }}">
                  @error('confirmPassword')
                      <span class="text-danger" id="err">{{ $message }}</span>
                  @enderror
                </div>
              </div>
              <div class="form-group row my-3">
                <label for="type" class="col-md-4 col-form-label text-md-right required">Type<span class="text-danger ms-2">*</span></label>

                <div class="col-md-6">
                  <select name="type" id="type" class="form-control" value="{{ old('type') }}">
                    <option value="" selected disabled>--- Select one ---</option>
                    <option value="0">Admin</option>
                    <option value="1">User</option>
                  </select>
                  @error('type')
                      <span class="text-danger" id="err">{{ $message }}</span>
                  @enderror
                </div>
              </div>
              <div class="form-group row my-3">
                <label for="phone" class="col-md-4 col-form-label text-md-right required">Phone</label>

                <div class="col-md-6">
                  <input id="phone"  type="text" class="form-control" name="phone" value="{{ old('phone') }}">
                  @error('phone')
                      <span class="text-danger" id="err">{{ $message }}</span>
                  @enderror
                </div>
              </div>
              <div class="form-group row my-3">
                <label for="dob" class="col-md-4 col-form-label text-md-right required">Date Of Birth</label>

                <div class="col-md-6">
                  <input id="dob" max="<?= date('Y-m-d'); ?>" type="date" class="form-control" name="dob" value="{{ old('dob') }}">
                  @error('dob')
                      <span class="text-danger" id="err">{{ $message }}</span>
                  @enderror
                </div>
              </div>

            <div class="form-group row my-3">
              <label for="address" class="col-md-4 col-form-label text-md-right required">Address</label>

              <div class="col-md-6">
                <textarea id="address" type="text" class="form-control" name="address">{{ old('address') }}</textarea>
                @error('address')
                    <span class="text-danger" id="err">{{ $message }}</span>
                @enderror
              </div>
            </div>

            <div class="form-group row my-3">
                <label for="profile" class="col-md-4 col-form-label text-md-right required">Profile</label>

                <div class="col-md-6">
                  <input id="profile"  type="file" class="form-control" name="profile" value="{{ old('profile') }}">
                  @error('profile')
                      <span class="text-danger" id="err">{{ $message }}</span>
                  @enderror
                </div>
              </div>

            <div class="form-group row mb-0">
              <div class="col-md-6 offset-md-4">
                <button type="submit" class="btn btn-primary me-3">
                  Confirm
                </button>
                <button type="reset" class="btn btn-secondary" id=""
                    >
                  Clear
                </button>
              </div>
            </div>
          </form>
    </div>
  </div>
</div>


@endsection


