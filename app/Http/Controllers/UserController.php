<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\User;
use App\Role;
use Auth;

class UserController extends Controller
{
	public function index()
    {
        $users = User::all();
        $roles = Role::all();
	    return view('admin.users', ['users' => $users, 'roles' => $roles]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function profile()
    {
    	$roles = Role::all();
        return view('profile', ['roles' => $roles]);
    }

    protected function store(Request $request)
    {
        $this->validate($request,[
            'name' => 'required|string|max:255',
            'username' => 'required|string|unique:users|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'role' => 'required',
            'password' => 'required|string|min:6',
        ]);
    
        $user = User::create([
            'name' => $request['name'],
            'username' => $request['username'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
        ]);
        foreach ($request->role as $role) {
            $user->roles()->attach(Role::where('id', $role)->first());
        }
        
        $users = User::all();
        $roles = Role::all();
	    return view('admin.users', ['users' => $users, 'roles' => $roles]);
    }
    public function update(Request $request)
    {
    	$user = User::findOrFail($request['id']);

        $this->validate($request,[
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username,'.$user->id,
            'email' => 'required|string|email|max:255|unique:users,email,'.$user->id,
            'password' => 'nullable|sometimes|string|min:6',
            'role' => 'required',
        ]);

		if($request['password']) { 
            $request['password'] =  Hash::make($request['password']); 
            $user->update($request->all());
        }else{
            $user->update($request->except('password'));
        }
        $user->roles()->detach();
        foreach ($request->role as $role) {
            $user->roles()->attach(Role::where('id', $role)->first());
        }
        
        $users = User::all();
        $roles = Role::all();
	    return view('admin.users', ['users' => $users, 'roles' => $roles]);
    }

    public function profileupdate(Request $request)
    {
        $user = Auth::user();

        $this->validate($request,[
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username,'.$user->id,
            'email' => 'required|string|email|max:255|unique:users,email,'.$user->id,
            'password' => 'nullable|sometimes|string|min:6',
        ]);

        if($request['password']) { 
            $request['password'] =  Hash::make($request['password']); 
            $user->update($request->all());
        }else{
             $user->update($request->except('password'));
        }

        $roles = Role::all();
        return view('profile', ['roles' => $roles])->with('success', 'Düzenlendi.');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->roles()->detach();
        $user->delete();
        return redirect('/users')->with('success', 'Silindi.');
    }
}
