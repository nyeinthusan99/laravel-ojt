<?php

namespace App\Dao;
use App\Models\User;
use App\Contracts\Dao\UserDaoInterface;
use Illuminate\Support\Facades\DB;

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
            $users->where('user.created_at', '>=', $created_from);
        }

        if ($created_to) {
            $users->where('user.created_at', '<=', $created_to);
        }

        $users = $users->orderByDesc('user.id')
                    ->paginate(10);


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
}
