@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-md-10 fw-bold ">Upload CSV FIle</div>
            <div class="col-md-6 mt-3">
                <div class="card-header bg-white border-bottom-0">Import File From:</div>
                <div class="card">
                    <div class="card-body">
                        <form method="POST" action="{{ route('postUpload.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <input id="csvFile" type="file" class=" form-control" name="csvFile"
                                        value="{{ old('csvFile') }}">

                                    @error('csvFile')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror

                                    @if (session('errorMessages'))
                                        <div class="mt-3 text-danger">
                                            <ul>
                                                @foreach (session('errorMessages') as $errorMessage)
                                                    <li>{{ $errorMessage }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row mb-0 mt-3">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-outline-primary">
                                        Import FIle
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
