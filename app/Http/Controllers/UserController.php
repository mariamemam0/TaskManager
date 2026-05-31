<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Http\Resources\UserCollection;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::select('id','name','email')->with('projects')->paginate($this->paginate);
        if($users->isEmpty()){
            return apiResponse(404 , 'User not found');
        }
        return apiResponse(200 ,'Success',  new UserCollection($users));
    }

    public function store(UserRequest $request)
    {
        $data = $request->validated();
        $data['email_verified_at'] = now();
        $user = User::create($data);
        return apiResponse(200 , new UserResource($user));

    }

    public function show(string $id)
    {
        $user = User::find($id);
        if(!$user){
            return apiResponse(404 , 'User not found');
        }
        return apiResponse(200 , 'success', new UserResource($user));

    }


    public function update(UserRequest $request, string $id)
    {
        $user = User::find($id);
        if(!$user){
            return apiResponse(404 , 'User not found');
        }
        $user->update($request->validated());
        return apiResponse(200 , 'Updated Successfully', new UserResource($user));
    }

    public function destroy(string $id)
    {
        $user = User::find($id);
        if(!$user){
            return apiResponse(404 , 'User not found');
        }
        $user->delete();
        return apiResponse(200 , 'Deleted Successfully');
    }
}
