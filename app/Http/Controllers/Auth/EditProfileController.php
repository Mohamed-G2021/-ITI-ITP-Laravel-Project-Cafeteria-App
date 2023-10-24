<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class EditProfileController extends Controller
{

    public function edit(User $user)
    {
        return view('auth.edit', ['user' => $user]);
    }


    
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required',
            'email' => [
                'required',
                'email',
                Rule::unique('users')->ignore($user->id)

            ],
            'image' => 'required','mimes:jpg,bmp,png',
            'password' => 'required',
            'password_confirmation' =>'required',

        ]);

        $request_data = $request->all();
        if (request()->file("image")) {
        
            $image = request()->file("image");
            $path = $image->store("users_images", 'usersimg_uploads');
            $request_data["image"] = $path;
        }

        $user = User::findorfail($user->id);
        $user->update($request_data);
      
    if ($user->role === 'admin') {
        return redirect()->route('admin-users.index');
    } else {
        return redirect()->route('order-products.index');
    }
    }
}
