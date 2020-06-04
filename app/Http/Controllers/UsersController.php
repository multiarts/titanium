<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUser;
use App\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

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
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param Request $request
	 * @return void
	 */
	public function store(Request $request)
	{
		//
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
//		dd($request->roles);
		/* $user->roles()->sync(request('roles'));

		$user->name = request('name');
		$user->email = request('email');
		$user->username = request('username');


		if ($user->save()) {
			request()->session()->flash('success', 'Usuário ' . $user->name . ' atualizado com sucesso.');
		} else {
			request()->session()->flash('error', 'Houve uma falha ao atualizar o usuário!');
		} */

		$user->roles()->sync(request('roles'));

		$data = $request->all();
		$user->update($data);

		return redirect()->route('dashboard.users.index');
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

		return redirect()->route('dashboard.users.index');
	}
}
