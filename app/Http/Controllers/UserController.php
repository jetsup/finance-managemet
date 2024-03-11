<?php

namespace App\Http\Controllers;

use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    // show register form
    public function create()
    {
        return view("register");
    }

    // create a new user
    public function store(Request $request)
    {
        // dd($request);
        $formFields = $request->validate([
            'first_name' => ['required', 'min:3'],
            'last_name' => ['required', 'min:3'],
            'username' => ['required', 'min:3', Rule::unique('users', 'username')],
            'phone' => ['required', Rule::unique('users', 'phone')],
            // specify that the gender input can either be 1,2 or 3
            'gender_id' => ['required', Rule::in([1, 2, 3])],
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            // ensure it is a strong password
            'password' => ['required', 'min:8', 'confirmed', 'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/'],
            'account_type_id' => [Rule::in([0, 1, 2])],
            'dp' => ['required', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:6144'],
        ]);
        $imagePath = $request->file('dp')->store('img/dp', 'public');
        $formFields['dp'] = $imagePath;

        // hash the password
        $formFields['password'] = bcrypt($formFields['password']);
        // create the user
        $user = User::create($formFields);

        // login the user after creation
        auth()->login($user);

        // redirect to home page
        return redirect('/')->with('message', 'You have been logged in. Your account was created successfully!');
    }

    // logout the user
    public function logout(Request $request)
    {
        auth()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // redirect to home page
        return redirect('/')->with('message', 'You have been logged out!');
    }

    // show login form
    public function login()
    {
        return view('login');
    }

    // login the user
    public function signin(Request $request)
    {
        // dd($request);
        $formFields = $request->validate([
            'username' => ['required', 'min:3'],
            'password' => ['required', 'min:8'],
        ]);

        // attempt to login the user
        if (!auth()->attempt($formFields)) {
            return back()->withErrors([
                'message' => 'User with those credentials does not exist',
            ])->onlyInput();
        } else {
            // redirect to home page
            return redirect('/')->with('message', 'You have been logged in!');
        }
    }
}
