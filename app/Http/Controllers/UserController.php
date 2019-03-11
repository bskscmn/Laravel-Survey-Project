<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\User;
use App\Role;

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
        $messages = [
            'name.required' => 'İsim alanı zorunludur.',
            'username.required' => 'Kullanıcı adı alanı zorunludur',
            'username.unique' => 'Kullanıcı adı zaten var.',
            'email.required' => 'Geçerli bir e-posta giriniz.',
            'email.unique' => 'E-posta zaten var.',
            'role.required' => 'Yetki seçiniz.',
            'password.required' => 'Şifre giriniz.',
            'password.min' => 'Şifre minimum 6 karakter olmalıdır.'
        ];
        $this->validate($request,[
            'name' => 'required|string|max:255',
            'username' => 'required|string|unique:users|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'role' => 'required|integer',
            'password' => 'required|string|min:6',
        ], $messages);
    
        $user = User::create([
            'name' => $request['name'],
            'username' => $request['username'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
        ]);
        $user->roles()->attach(Role::where('id', $request['role'])->first());
        $users = User::all();
        $roles = Role::all();
	    return view('admin.users', ['users' => $users, 'roles' => $roles]);
    }
    public function update(Request $request)
    {
    	$user = User::findOrFail($request['id']);

        $messages = [
            'name.required' => 'İsim alanı zorunludur.',
            'username.required' => 'Kullanıcı adı alanı zorunludur',
            'username.unique' => 'Kullanıcı adı zaten var.',
            'email.required' => 'Geçerli bir e-posta giriniz.',
            'email.unique' => 'E-posta zaten var.',
            'password.min' => 'Şifre minimum 6 karakter olmalıdır.'
        ];
        $this->validate($request,[
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username,'.$user->id,
            'email' => 'required|string|email|max:255|unique:users,email,'.$user->id,
            'password' => 'sometimes|string|min:6',
        ], $messages);

		if(isset($request['password'])) { $request['password'] =  Hash::make($request['password']); }

        $user->update($request->all());
        $user->roles()->sync(Role::where('id', $request['role'])->first());
        $users = User::all();
        $roles = Role::all();
	    return view('admin.users', ['users' => $users, 'roles' => $roles]);
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect('/users')->with('success', 'Silindi.');
    }
}
