<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class EditProfileController extends Controller
{

    public function edit(User $user)
    {
        return view('auth.edit', ['user' => $user]);
    }


    public function update(Request $request, User $user)
    {
    }
}
