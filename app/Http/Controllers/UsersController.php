<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserRequest;
use App\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Requests\UpdateUser;

class UsersController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$users = User::all();

		return view('admin.users.index', compact('users'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$roles = Role::all();
		return view('admin.users.create', compact('roles'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param Request $request
	 * @return void
	 */
	public function store(CreateUserRequest $request)
	{
		
		$data = $request->all();

		$user = User::create($data);
		

		$roles = $request->roles;

		$user->assignRole($roles);

		$notification = array(
            'message' => 'Cadastrado com sucesso!',
            'alert-type' => 'success'
        );

		return redirect()->route('dashboard.users.index')->with($notification);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param User $user
	 * @return Response
	 */
	public function show(User $user)
	{
		return view('admin.users.show', compact('user'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param User $user
	 * @return Response
	 */
	public function edit(User $user)
	{
		$roles = Role::all();
		return view('admin.users.edit', compact('user', 'roles'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param Request $request
	 * @param User $user
	 * @return Response
	 */
	public function update(UpdateUser $request , User $user)
	{
		$user->roles()->sync($request->roles);

		$data = $request->all();
		$user->update($data);

		$notification = array(
            'message' => 'Atualizado com sucesso!',
            'alert-type' => 'success'
        );

		return redirect()->route('dashboard.users.index')->with($notification);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param int $id
	 * @return Response
	 */
	public function destroy(User $user)
	{
		$user->roles()->detach();
		$user->delete();

		$notification = array(
            'message' => 'Excluído com sucesso!',
            'alert-type' => 'success'
        );

		return redirect()->route('dashboard.users.index')->with($notification);
	}
}
