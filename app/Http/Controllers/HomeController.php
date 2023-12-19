<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function admin()
    {
        $total_user = \App\Models\User::count();
        return view('pages.s_user.admin.home_admin', [
            'total_user' => $total_user,
            'active' => 'dashboard'
        ]);
    }

    public function karyawan()
    {
        return view('pages.s_user.karyawan.home_karyawan', [
            'active' => 'dashboard'
        ]);
    }

    public function manager()
    {
        return view('pages.s_user.manager.home_manager', [
            'active' => 'dashboard'
        ]);
    }

    public function bendahara()
    {
        return view('pages.s_user.bendahara.home_bendahara', [
            'active' => 'dashboard'
        ]);
    }
}
