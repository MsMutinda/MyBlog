<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function profile()
    {
        $blogs = Blog::all();
        return view('pages.profile.index')->with('blogs', $blogs);
    }

    public function editProfile() {
        return view('pages.profile.edit');
    }

    public function updateProfile(Request $request) {
        $request->validate([
            'fname'  => 'required|string|max:255',
            'lname'  => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,'.auth()->id(),
            'phone'  => 'required|string|max:255',
            'gender'  => 'required|string|max:255',
            'hobbies'  => 'required|string|max:255',
        ]);

        $user = auth()->user();

        $user->update([
            'fname'   => $request->fname,
            'lname'   => $request->lname,
            'email'   => $request->email,
            'phone'   => $request->phone,
            'gender'  => $request->gender,
            'hobbies' => $request->hobbies
        ]);

        return redirect()->route('profile');
    }
}
