<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

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
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'image' => ['required']

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

        $request_data = $data;;
        if (request()->input('image') != '') {
            $image = request()->input("image");
            $path = $image->store("users_images", 'usersimg_uploads');
            $request_data["image"] = $path;
            dd($request_data['image']);
        }


        $user = User::create([
            'name' => $request_data['name'],
            'email' => $request_data['email'],
            'password' => Hash::make($request_data['password']),
            'image' => $request_data['image'],
        ]);

        return $user;
    }
}


// $request_data = $data;
//         if ($data['image'] != '') {
//             $image = $data["image"];
//             dd($image);
//             $path = $image->store("users_images", 'usersimg_uploads');
//             $request_data["image"] = $path;
//             dd($request_data['image']);
//         }


//         $user = User::create([
//             'name' => $request_data['name'],
//             'email' => $request_data['email'],
//             'password' => Hash::make($request_data['password']),
//             'image' => $request_data['image'],
//         ]);