<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\article;
use Image;
use Bouncer;

class UserController extends Controller
{
    public function __construct()
    {
        // This methods are for authentecated users 
        $this->middleware('auth')->only(['delete', 'edit', 'update']);
    }

    public function index(User $user)
    {
        $articles = article::where('owner_id', $user->id)->orderBy('created_at', 'desc')->get();
        return view('auth.profile', compact('user', 'articles'));
    }

    /**
     * Edit user details [name, avatar, bio, about etc.]
     * 
     * @param \App\User $user
     */
    public function edit(User $user)
    {
        if($user->id === Auth::id() || Auth::user()->isA('superadmin')){
            return view('User.edit', compact('user'));
        }
        return abort('403');
    }

    /**
     * Update user details [name, avatar, bio, about etc.]
     * 
     * @param \App\User $user
     */
    public function update(User $user, Request $request)
    {
        if($user->id === Auth::user()->id || Auth::user()->isA('superadmin') || Auth::user()->isA('editor')){
            if($request->hasFile('avatar')){
                $avatar = $request->file('avatar');
                $filename = time() . '.' . $avatar->getClientOriginalExtension();
                Image::make($avatar)->resize(300, 300)->save( public_path('/uploads/avatars/' . $filename));

                $user = auth()->user();
                $user->avatar = $filename;
                $user->save();
            }
            $user->update($this->ValidateUser());
            return redirect('/');
        }
        return abort('403');
    }

    public function delete(User $user)
    {
        $user->delete();
        return redirect('/');
    }

    /**
     * Validate user
     */
    public function ValidateUser(){
        return request()->validate([
            'name' => 'required|string|min:3|max:19',
            'bio' => 'nullable|string|min:3|max:200',
            'lives_in' => 'nullable|string|min:3|max:50',
            'from' => 'nullable|string|min:3|max:50',
            'works_at' => 'nullable|string|min:3|max:50',
            'studied_at' => 'nullable|string|min:3|max:50',
            'website' => 'nullable|string|min:3|max:50'
        ]);
    }


    // public function createRole()
    // {
    //     return view('Admin.newRole');
    // }

    // public function storeRole()
    // {
    //     $admin = Bouncer::role()->firstOrCreate([
    //         'name' => request()->name,
    //     ]);
    //     return redirect('/');
    // }

    // public function createAbility()
    // {
    //     return view('Admin.newAbility');
    // }

    // public function storeAbility()
    // {
    //     $admin = Bouncer::role()->firstOrCreate([
    //         'name' => request()->name,
    //     ]);
    //     return redirect('/');
    // }

    public function assign(){
        return view('Admin.assign');
    }

    public function assignTo(){
        Bouncer::assign(request()->role)->to(request()->userId);
        return redirect('/');
    }
}