<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function edit(User $user){
        return view('users.edit', compact('user'));
    }

    public function update(Request $request,$user){
        $data = request()->validate([
            'phonenumber'=> ['required', 'numeric'] ,
            'city'=>['required', 'string', 'max:255'],
            'address'=>['required', 'string', 'max:255'],
            'name'=>['required', 'string', 'max:255'],

        ]);

        $userEdit = User::findOrFail($user);
        $userEdit->phonenumber=request('phonenumber');
        $userEdit->city=request('city');
        $userEdit->address=request('address');
        $userEdit->name=request('name');
        $userEdit->save();

        return redirect("/");
    }
}