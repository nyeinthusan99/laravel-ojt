@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="row d-flex">
            <form action="{{ route('userlist') }}" method="GET" class="col-md-9 d-flex">
                @csrf
                <div class="col-md-2 me-2">
                    <input type="text" value="{{ request()->input('name') }}" placeholder="Name" class="form-control" name="name" id="name">
                </div>
                <div class="col-md-2 me-2">
                    <input type="text" value="{{ request()->input('email') }}" placeholder="Email" class="form-control" name="email" id="email">
                </div>
                <div class="col-md-2 me-3">
                    <input type="date" value="{{ request()->input('created_from') }}" placeholder="Created From" class="form-control" name="created_from" id="created_from">
                </div>
                <div class="col-md-2 me-3">
                    <input type="date" value="{{ request()->input('created_to') }}" placeholder="Created To" class="form-control" name="created_to" id="created_to">
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary form-control">Search</button>
                </div>
            </form>
            <div class="col-md-2">
                <a href="{{ route('user.create')}}" class="btn btn-primary form-control">Add</a>
            </div>
            {{-- <div class="col-md-2">
                <a href="{{ route('post.upload')}}" class="btn btn-primary form-control">Upload</a>
            </div> --}}
            {{-- <form action="{{ route('post.export') }}" method="post" class="col-2">
                @csrf
                <button class="btn btn-primary form-control">Download</button>
            </form> --}}
        </div>
        <table class="table table-bordered m-auto w-75 mt-5" id="mytable" >
            <thead>
                <tr class="text-center">
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Created User</th>
                    <th scope="col">Phone</th>
                    <th scope="col">Birth Date</th>
                    <th scope="col">Address</th>
                    <th scope="col">Created Date</th>
                    <th scope="col">Updated Date</th>
                    <th scope="col" colspan="2">Action</th>
                </tr>
            </thead>
            <tbody>
                @if (count($users) == 0)
                    <tr>
                        <td colspan="6" class="text-center">There is no users</td>
                    </tr>
                @endif

                @foreach ( $users as $user )
                    <tr>
                        <td scope="row">
                            <a href="" data-bs-toggle="modal" data-bs-target="#detail{{ $user->id }}">
                                {{ $user->name }}
                            </a>
                        </td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->created_user }}</td>
                        <td>{{ $user->phone ?? '-' }}</td>
                        <td>{{ $user->dob ?? '-' }}</td>
                        <td>{{ $user->address ?? '-' }}</td>
                        <td>{{ date('Y/m/d', strtotime($user->created_at)) }}</td>
                        <td>{{ date('Y/m/d', strtotime($user->updated_at)) }}</td>
                        {{-- <td>
                            <a href="/post/update/{{ $post->id }}" class="btn btn-warning btn-sm form-control">Edit</a>
                        </td> --}}
                        <td>
                            @if(auth()->user()->id != $user->id)
                            <button type="button" class="btn btn-danger btn-sm form-control" data-bs-toggle="modal" data-bs-target="#Delete{{$user->id}}">Delete</button>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

         <!-- Pagination links -->
        {{ $users->links() }}


        <!-- Detail Modal -->
        @foreach ( $users as $user )
        <div class="modal fade" id="detail{{ $user->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">User Detail</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body m-auto w-75">
                    <div class="col-md-12">
                        <div class=" mb-3 text-center">
                            @if($user->profile)
                            <img src="{{ asset('storage/' . $user->id . '/' . $user->profile) }}" alt="profile" class="img-fluid rounded-circle w-50 h-50">
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
                    </div>
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
            </div>
        </div>
        @endforeach

        <!-- Delete Modal -->
        @foreach ( $users as $user )
        <div class="modal fade" id="Delete{{ $user->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Confirm Delete</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body ">
                    <h4 class="mb-3">Are you sure to delete?</h4>
                    <div class="col-md-12 w-75 m-auto">
                        <div class="row mb-3">
                            <label class="col-md-7">ID</label>
                            <label class="col-md-5">{{ $user->id }}</label>
                        </div>
                        <div class="row mb-3">
                            <label class="col-md-7">Title</label>
                            <label class="col-md-5">{{ $user->name }}</label>
                        </div>
                        <div class="row mb-3">
                            <label class="col-md-7">Description</label>
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
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <form action="/user/delete/{{ $user->id }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button  class="btn btn-danger">Delete</button>
                    </form>
                </div>
            </div>
            </div>
        </div>
        @endforeach

    </div>
@endsection
