<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\UserRequest;
use App\Handlers\ImageUploadHandler;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['show']]);
    }

    public function show(User $user){
        return view('users.show',compact('user'));
    }

    public function edit(User $user){
        $this->authorize('update', $user);
        return view('users.edit',compact('user'));
    }

    public function update(UserRequest $request,User $user,ImageUploadHandler $upload){
        $this->authorize('update', $user);
        $date = $request->all();
        if ($request->avatar){
            $result = $upload->save($request->avatar,'avatars',$user->id,362);
            if ($result) {
                $date['avatar'] = $result['path'];
            }
        }
        $user->update($date);
        return redirect()->route('users.show',$user->id)->with('success','个人资料修改成功');
    }
}
