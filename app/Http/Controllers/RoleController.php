<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class RoleController extends Controller
{
    public function adminIndex()
    {
        return view('adminHome');
    }

    public function index()
    {
        $roles = Role::all();
        return view('roles.index', compact('roles'));
    }

    public function attach(Role $role)
    {
        $user = User::findOrFail(request('userAttach'));
        $user->roles()->attach($role);

        Session::flash('success', "User roles updated successfully");
        return back();
    }

    public function detach(Role $role)
    {
        $user = User::findOrFail(request('userDetach'));
        $user->roles()->detach($role);

        Session::flash('success', "User roles updated successfully");
        return back();
    }
}
