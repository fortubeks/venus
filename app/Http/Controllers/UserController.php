<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\UserStoreRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(User $model)
    {
        return view('pages.users.index', ['users' => $model->paginate(15)]);
    }

    public function create()
    {
        return view('pages.users.create');
    }

    public function show(User $user)
    {
        return view('pages.users.show')->with('user',$user);
    }

    public function store(UserStoreRequest $request){
        $request->merge([
            'user_account_id' => auth()->user()->user_account_id,
        ]);
        $user = User::create($request->all());
        $user->password = Hash::make($request->password);
        $user->save();
        
        // if ($request->hasFile('profile_photo')) {
        // $user->photo = upload_file($request->file('photo'), 'images/bar/' . request('bar')->name . '/photos/');
        // }
        // $user->save();
        
        return redirect('users')->with('success', 'User added');
    }

    public function update(Request $request, User $user)
    {
        $user->update($request->all());
        return redirect('users/'.$user->id)->with('status','User updated successfully');
    }

    public function updatePassword(Request $request){
        $request->validate(  [
            'current_password' => 'required',
            'new_password' => ['required', 'confirmed', 'min:8', Password::defaults()],
        ]);
        if (!Hash::check($request->current_password, auth()->user()->password)) {
            return back()->with('status','Old password not correct');
        }
        auth()->user()->password = Hash::make($request->new_password);
        auth()->user()->save();
        return redirect()->back();
    }
}
