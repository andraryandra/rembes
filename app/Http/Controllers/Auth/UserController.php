<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request): \Illuminate\Contracts\View\View
    {
        // $data = \App\Models\User::latest()->paginate(5);
        $data = [
            'users' => \App\Models\User::latest()->paginate(5),
            'i' => ($request->input('page', 1) - 1) * 5,
            'active' => 'users'
        ];

        return view('pages.s_user.admin.m_user.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(): \Illuminate\Contracts\View\View
    {
        // $roles = Role::pluck('name', 'name')->all();
        $data = [
            'roles' => Role::pluck('name', 'name')->all(),
            'active' => 'users'
        ];

        return view('pages.s_user.admin.m_user.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request): \Illuminate\Http\RedirectResponse
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|same:confirm-password',
            'roles' => 'required'
        ]);

        $input = $request->all();
        $input['password'] = Hash::make($input['password']);

        $user = \App\Models\User::create($input);
        $user->assignRole($request->input('roles'));

        return redirect()->route('dashboard.users.index')
            ->with('success', 'User created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id): \Illuminate\Contracts\View\View
    {
        // $user = \App\Models\User::find($id);
        $data = [
            'user' => \App\Models\User::find($id),
            'active' => 'users'
        ];
        return view('pages.s_user.admin.m_user.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id): \Illuminate\Contracts\View\View
    {
        // $user = \App\Models\User::find($id);
        // $roles = Role::pluck('name', 'name')->all();
        // $userRole = $user->roles->pluck('name', 'name')->all();

        $data = [
            'user' => \App\Models\User::find($id),
            'roles' => Role::pluck('name', 'name')->all(),
            'userRole' => \App\Models\User::find($id)->roles->pluck('name', 'name')->all(),
            'active' => 'users'
        ];

        return view('pages.s_user.admin.m_user.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id): \Illuminate\Http\RedirectResponse
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'same:confirm-password',
            'roles' => 'required'
        ]);

        $input = $request->all();
        if (!empty($input['password'])) {
            $input['password'] = Hash::make($input['password']);
        } else {
            $input = Arr::except($input, array('password'));
        }

        $user = \App\Models\User::find($id);
        $user->update($input);
        DB::table('model_has_roles')->where('model_id', $id)->delete();

        $user->assignRole($request->input('roles'));

        return redirect()->route('dashboard.users.index')
            ->with('success', 'User updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id): \Illuminate\Http\RedirectResponse
    {
        \App\Models\User::find($id)->delete();
        return redirect()->route('dashboard.users.index')
            ->with('success', 'User deleted successfully');
    }
}
