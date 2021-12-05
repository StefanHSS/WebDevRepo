<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    public function edit(User $user)
    {
        $roles = Role::all();
        return view('users.edit', compact('user', 'roles'));
    }

    public function update(User $user)
    {
        //dd(request()->all());
        $userInputs = request()->validate([
            'firstName' => 'string|max:50',
            'lastName' => 'string|max:50',
            'email' => 'email'
        ]);

        $postInputs = request()->validate([
            'avatar' => 'file'
        ]);

        $user->update($userInputs);

        $image = new Image;
        if(request('file'))
        {
            if($user->avatar)
            {
                $postInputs['avatar'] = request('file')->store('images');
                $user->avatar()->update($postInputs);
            }
            else
            {
                $postInputs['avatar'] = request('file')->store('images');
                $image->avatar = $postInputs['avatar'];
                $user->avatar()->save($image);
            }
        }

        return back();
    }
}
