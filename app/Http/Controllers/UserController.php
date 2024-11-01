<?php

namespace App\Http\Controllers;

use App\Http\Requests\userStoreRequest;
use App\Http\Requests\userUpdateRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // USERS
    public function index()
    {
        $users = User::all();
        return view('user.index', compact('users'));
    }

    public function create()
    {
        return view('user.create');
    }
    public function store(userStoreRequest $request)
    {
        $validated = $request->validated();
        // create a user and hash the password
        User::create(array_merge(Arr::except($validated, ['password']), ['password' => Hash::make($request->password)]));
        // dd($user);
        return redirect()->route('user.index');
    }
    public function show($id)
    {
        $user = User::find($id);
        return view('user.show', compact('user'));
    }
    public function edit($id)
    {
        $user = User::find($id);
        return view('user.edit', compact('user'));
    }
    public function update(userUpdateRequest $request, $id)
    {
        $validated = $request->validated();
        $user = User::find($id);
        $user->update($validated);
        return redirect()->route('user.index');
    }
    public function destroy($id)
    {
        User::find($id)->delete();
        return redirect()->route('user.index');
    }
}
