<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UserEditRequest;
use App\Http\Requests\UserCreateRequest;
use App\Contracts\Services\UserServiceInterface;

class UserController extends Controller
{
    private $userService;
    public function __construct(UserServiceInterface $userService)
    {
        $this->userService = $userService;
    }

    public function index(Request $request)
    {
        $users = $this->userService->index($request);
        return view('user.list',['users' => $users]);
    }

    public function createView()
    {
        return view('user.create');
    }

    public function createSubmit(UserCreateRequest $request)
    {
        $request->validated();
        session(['createUserData' => $request->all()]);
        return to_route('userCreate.confirm');
    }

    public function confirmView()
    {
        if (!session('createUserData')) {
            return redirect()->route('user.create');
        }

        return view('user.create-confirm');

    }

//     public function store(Request $request)
//     {
//         $this->userService->store($request);
//         return redirect()->route('userlist');
//     }

        public function delete($userId)
        {
            $deletedUserId = Auth::user()->id;
            $this->userService->delete($userId,$deletedUserId);
            return redirect()->route('userlist');
        }

        public function showProfile()
        {
            $userId = Auth::user()->id;
            $user = $this->userService->getUserById($userId);
            return view('user.profile',['user' => $user]);
        }


        public function editProfileView()
        {
            $userId = Auth::user()->id;
            $user = $this->userService->getUserById($userId);
            return view('user.edit',['user' => $user]);
        }

        public function editProfileSubmit(UserEditRequest $request)
        {
            $request->validated();
            //session(['editUserData' => $request->all()]);
            return to_route('userProfileUpdate.confirm');
        }

        public function editProfileConfirmView($postId)
        {
            // if (!session('editPostData')) {
            //     return redirect()->route('post.edit');
            // }

            return view('user.edit-confirm');
        }

        // public function editProfileStore(Request $request)
        // {
        //     $this->UserService->updatePost($request);
        //     return redirect()->route('userlist');
        // }
 }
