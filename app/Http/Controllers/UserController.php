<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UserEditRequest;
use App\Http\Requests\UserCreateRequest;
use App\Contracts\Services\UserServiceInterface;
use App\Http\Requests\ChangePasswordRequest;
use Illuminate\Support\Facades\Storage;

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
        if(!session('persists')) {
            session()->forget('createUserData');
        }
        return view('user.create');
    }

    public function createSubmit(UserCreateRequest $request)
    {
        $request->validated();

        if($request->hasFile('profile')) {
            $fileName = rand().'_'.now()->format('Y-m-d');
            $request->file('profile')->storeAs('tmp', $fileName.'.'.$request->file('profile')->getClientOriginalExtension());
            $request->merge(['profileImage' =>  $fileName.'.'.$request->file('profile')->getClientOriginalExtension()]);
        }
        session(['createUserData' => $request->except('profile')]);
        //dd(session('createUserData'));
        return to_route('userCreate.confirm');
    }

    public function confirmView()
    {
        session()->flash('persists', true);
        if (!session('createUserData')) {
            return redirect()->route('user.create');
        }

        return view('user.create-confirm');

    }

     public function store(Request $request)
     {
        //dd(session('createUserData'));
        // dd(storage_path('tmp') . session('createUserData')['profileImage']);

         $request->merge(session('createUserData'));
         $this->userService->store($request);
         return redirect()->route('userlist');
     }

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
            if(!session('persists')) {
                session()->forget('editUserData');
            }

            $userId = Auth::user()->id;
            $user = $this->userService->getUserById($userId);
            return view('user.edit',['user' => $user]);
        }

        public function editProfileSubmit(UserEditRequest $request)
        {
            $request->validated();

            $oldProfile = Auth::user()->profile;
            //dd($request);
            if($request->hasFile('profile')) {
                $fileName = rand().'_'.now()->format('Y-m-d');
                $request->file('profile')->storeAs('tmp', $fileName.'.'.$request->file('profile')->getClientOriginalExtension());
                $request->merge(['profileImage' =>  $fileName.'.'.$request->file('profile')->getClientOriginalExtension()]);
            }else {
                $request->merge(['profileImage' =>  $oldProfile ]);
            }
            session(['editUserData' => $request->except('profile')]);

            return to_route('userProfileUpdate.confirm');
        }

        public function editProfileConfirmView()
        {
            $userId = Auth::user()->id;
            $user = $this->userService->getUserById($userId);

            session()->flash('persists', true);
            if (!session('editUserData')) {
                return redirect()->route('user.edit');
            }

            return view('user.edit-confirm',['user' => $user]);
        }

        public function editProfileStore(Request $request)
        {
            $request->merge(session('editUserData'));

            $this->userService->updateUser($request);
            return redirect()->route('user.profile');
        }

        public function changePasswordView()
        {
            return view('user.change-password');
        }

        public function changePassword(ChangePasswordRequest $request)
        {
            $validated = $request->validated();
            $this->userService->changePassword($validated);
            return redirect()->route('login');
        }
 }
