<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;


class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
{
    // Validate the incoming request
    $this->validator($request->all())->validate();

    try {
        // Create the new user
        $user = User::create([
            'first_name' => $request->first_name,
            'middle_name' => $request->middle_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'rs' => $request->rs, // Store the RSBA number
            'password' => Hash::make($request->password),
        ]);

        // Log the user in after registration
        Auth::login($user);

        // Flash a success message to the session
        Session::flash('success', 'Registration successful!');
    } catch (\Exception $e) {
        // Flash an error message in case of any exception
        Session::flash('error', 'An error occurred during registration. Please try again.');
    }

    // Redirect to the login page or a different route with the success/error message
    return redirect()->route('login');
}
public function registers(Request $request)
{
    // Validate the incoming request
    $this->validator($request->all())->validate();

    try {
        // Create the new user
        $user = User::create([
            'first_name' => $request->first_name,
            'middle_name' => $request->middle_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'rs' => $request->rs, // Store the RSBA number
            'password' => Hash::make($request->password),
            'status' => 'Once registered', // Set the status to "Once registered"
        ]);

        // Log the user in after registration
        Auth::login($user);

        // Flash a success message to the session
        Session::flash('success', 'Registration successful!');

    } catch (\Exception $e) {
        // Flash an error message in case of any exception
        Session::flash('error', 'An error occurred during registration. Please try again.');
    }

    // Redirect to the login page or a different route with the success/error message
    return redirect()->back()->with('success', 'Successful');
}


    protected function validator(array $data)
    {
        return Validator::make($data, [
            'first_name' => ['required', 'string', 'max:255'],
            'middle_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],

            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'], // Ensure email is unique
            'rs' => ['required', 'string'], // RSBA number field validation
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }
}
