<?php

namespace App\Contracts\Dao;

use Illuminate\Http\Request;

interface UserDaoInterface
{
     public function index($request);
    public function store(Request $request);
     public function delete($userId,$deletedUserId);
     public function getUserById($userId);
    public function updateUser($request);
}
