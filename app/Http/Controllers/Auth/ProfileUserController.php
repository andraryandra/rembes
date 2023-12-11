<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileUserController extends Controller
{
    public function index()
    {
        $data = [
            'active' => 'profile',
        ];

        return view('pages.s_user_profile.profile', $data);
    }

    public function edit($id)
    {
        $data = [
            'active' => 'profile',
            'user' => Auth::user(),
        ];

        return view('pages.s_user_profile.edit', $data);
    }
}
