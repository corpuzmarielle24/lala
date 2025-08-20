<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
            'address' => ['nullable', 'string', 'max:255'],
            'mobile' => ['nullable', 'string', 'max:20'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        try {
            $request = app('request');

            // if($request->hasfile('image')){
            //     $file = $request->file('image');
            //     $extension = $file->getClientOriginalExtension();
            //     $origname = $file->getClientOriginalName();
            //     // $user1 = auth()->user()->name.'-'.auth()->user()->id;
            //     $filename = 'id-image'.time().'.'.$extension;
            //     $file->move('uploads/id_image/', $filename);
            // }

            return User::create([
                'name' => $data['name'],
                // 'username' => $data['username'],
                'password' => Hash::make($data['password']),
                // 'id_image' => $filename,
                'address' => isset($data['address']) ? $data['address'] : null,
                'mobile' => isset($data['mobile']) ? $data['mobile'] : null,
                // 'birthdate' => $data['birthdate'],
                // 'gender' => $data['gender'],
                'email' => $data['email'],
                'is_approved' => 1, // Auto-approve new users
                'role' => 1, // Default role for regular users
                'email_verified_at' => now(), // Auto-verify email
            ]);
        } catch (\Exception $e) {
            // Log the error and redirect back with error message
            Log::error('Registration failed: ' . $e->getMessage());
            throw new \Exception('Registration failed. Please ensure the database is properly configured.');
        }
    }
}
