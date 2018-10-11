<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
 
    //Show all
    public function index()
    {
        return User::all();
    }

    //show one
    public function show($id)
    {
        return User::find($id);
    }
 
    //create
    public function store(Request $request)
    {
        return User::create([
            'email' => $request['email'],
            'password' => $request['password']
        ]);
    }

    //edit + update
    public function editAndUpdate(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->email = $request['email'];
        $user->password = $request['password'];
        $user->save();
    }

    //delete
    public function destroy($id)
    {
        User::destroy($id);
    }

    public function login (Request $request)
    {

    }
}

