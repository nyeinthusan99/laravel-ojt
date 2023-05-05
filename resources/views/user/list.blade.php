@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="row d-flex">
            <form action="{{ route('userlist') }}" method="GET" class="col-md-10 d-flex">
                @csrf
                <div class="col-md-2 me-2">
                    <input type="text" value="{{ request()->input('name') }}" placeholder="Name" class="form-control" name="name" id="name">
                </div>
                <div class="col-md-2 me-2">
                    <input type="text" value="{{ request()->input('email') }}" placeholder="Email" class="form-control" name="email" id="email">
                </div>
                <div class="col-md-3 me-3">
                    <input type="date" value="{{ request()->input('created_from') }}" placeholder="Created From" class="form-control" name="created_from" id="created_from">
                </div>
                <div class="col-md-3 me-3">
                    <input type="date" value="{{ request()->input('created_to') }}" placeholder="Created To" class="form-control" name="created_to" id="created_to">
                </div>
                <div class="col-md-1">
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
                        <td>{{ $user->created_user}}</td>
                        <td>{{ $user->phone }}</td>
                        <td>{{ $user->dob }}</td>
                        <td>{{ $user->address }}</td>
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
                <div class="modal-body">
                    <div class="col-md-12">
                        <div class="row mb-2">
                            <label class="col-md-4">Name</label>
                            <label class="col-md-8">{{ $user->name }}</label>
                        </div>
                        <div class="row mb-2">
                            <label class="col-md-4">Email</label>
                            <label class="col-md-8">{{ $user->email }}</label>
                        </div>
                        <div class="row mb-2">
                            <label class="col-md-4">Type</label>
                            @if ( $user->type == 0)
                            <label class="col-md-8">Admin</label>
                            @else
                            <label class="col-md-8">User</label>
                             @endif
                        </div>
                        <div class="row mb-2">
                            <label class="col-md-4">Phone</label>
                            <label class="col-md-8">{{ $user->phone }}</label>
                        </div>
                        <div class="row mb-2">
                            <label class="col-md-4">Date of Birth</label>
                            <label class="col-md-8">{{ $user->dob }}</label>
                        </div>
                        <div class="row mb-2">
                            <label class="col-md-4">Address</label>
                            <label class="col-md-8">{{ $user->address }}</label>
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
                <div class="modal-body">
                    <h4 class="">Are you sure to delete?</h4>
                    <div class="col-md-12">
                        <div class="row mb-2">
                            <label class="col-md-4">ID</label>
                            <label class="col-md-8">{{ $user->id }}</label>
                        </div>
                        <div class="row mb-2">
                            <label class="col-md-4">Title</label>
                            <label class="col-md-8">{{ $user->name }}</label>
                        </div>
                        <div class="row mb-2">
                            <label class="col-md-4">Description</label>
                            <label class="col-md-8">{{ $user->email }}</label>
                        </div>
                        <div class="row mb-2">
                            <label class="col-md-4">Type</label>
                            @if ( $user->type == 0)
                                <label class="col-md-8">Admin</label>
                            @else
                                <label class="col-md-8">User</label>
                            @endif
                        </div>
                        <div class="row mb-2">
                            <label class="col-md-4">Phone</label>
                            <label class="col-md-8">{{ $user->phone }}</label>
                        </div>
                        <div class="row mb-2">
                            <label class="col-md-4">Date of Birth</label>
                            <label class="col-md-8">{{ $user->dob }}</label>
                        </div>
                        <div class="row mb-2">
                            <label class="col-md-4">Address</label>
                            <label class="col-md-8">{{ $user->address }}</label>
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
