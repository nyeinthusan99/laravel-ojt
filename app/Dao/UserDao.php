<?php

namespace App\Dao;
use Illuminate\Support\Facades\File;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Contracts\Dao\UserDaoInterface;

class UserDao implements UserDaoInterface
{
    public function index($request)
    {
        $name = $request->input('name');
        $email = $request->input('email');
        $created_from = $request->input('created_from');
        $created_to = $request->input('created_to');

        $users = DB::table('users as user')
            ->select('user.*', 'created_user.name as created_user', 'updated_user.name as updated_user')
            ->join('users as created_user', 'user.created_user_id', '=', 'created_user.id')
            ->join('users as updated_user', 'user.updated_user_id', '=', 'updated_user.id')
            ->whereNull('user.deleted_at');

        if ($name) {
            $users->where('user.name', 'LIKE', '%' . $name . '%');
        }

        if ($email) {
            $users->where('user.email', 'LIKE', '%' . $email . '%');
        }

        if ($created_from) {
            $users->whereDate('user.created_at', '>=', $created_from);
        }

        if ($created_to) {
            $users->whereDate('user.created_at', '<=', $created_to);
        }

        $users = $users->orderByDesc('user.id')
                    ->paginate(2)->withQueryString();

        return $users;
    }

    public function delete($userId,$deletedUserId)
    {
        $user = User::where('id', $userId)->first();
        //dd($post);
        if($user && !$user->deleted_user_id){
            $user->deleted_user_id = $deletedUserId;
            $user->update();
            $user->delete();
        }

        return $user;
    }

    public function getUserById($userId)
    {
        $user = User::where('id',$userId)->first();
        return $user;
    }

    public function store($request) {
        $user = new User();

        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->profile = $request->profileImage;
        $user->type = $request->type ;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->dob = $request->dob;
        $user->created_user_id = $request->user()->id;
        $user->updated_user_id = $request->user()->id;

        $user->save();

        if (!File::isDirectory(storage_path('app/public/'.$user->id))) {
            File::makeDirectory(storage_path('app/public/'.$user->id));
        }
        File::move(
            storage_path('app/public/tmp') .DIRECTORY_SEPARATOR. $user->profile,
            storage_path('app/public/'.$user->id) .DIRECTORY_SEPARATOR .  $user->profile,
        );

        return $user;
    }

    public function updateUser($request) {
       // dd($request);
        $user = User::find(Auth::user()->id);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->profile = $request->profileImage;
        $user->type = $request->type ;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->dob = $request->dob;
        $user->updated_user_id = $request->user()->id;

        $user->save();

        if (!File::isDirectory(storage_path('app/public/'.$user->id))) {
            File::makeDirectory(storage_path('app/public/'.$user->id));
        }

        $tmpFilePath = storage_path('app/public/tmp/' . $user->profile);
        $userFilePath = storage_path('app/public/'.$user->id) .DIRECTORY_SEPARATOR .  $user->profile;

        if (File::exists($tmpFilePath)) {
            File::move($tmpFilePath, $userFilePath);
        }

        return $user;

    }

    public function changePassword($validated)
     {

        $user = User::find(Auth::user()->id)->update([
            'password' => Hash::make($validated['new_password']),
            'updated_user_id' => Auth::user()->id
        ]);
        return $user;

    }
}
