<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserRequest;
use App\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Requests\UpdateUser;
use App\Models\Chamados;

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

	public function searchIndex()
	{
		$chamados = Chamados::all();
		return view('admin.users.search', compact('chamados'));
	}

	public function search(Request $request, Chamados $users)
	{
		// Search for a user based on their name.
		if ($request->has('tecnico_id')) {
			return $users->where('tecnico_id', $request->input('tecnico_id'))->get();
		}
	
		// Search for a user based on their company.
		if ($request->has('created_at')) {
			$date = date("d/m/Y", strtotime($request->input('created_at')));
			return $users->where('created_at', $date)
				->get();
				dd($date);
		}
	
		// Search for a user based on their city.
		if ($request->has('city')) {
			return $users->where('city', $request->input('city'))->get();
		}
	
		// Continue for all of the filters.
	
		// No filters have been provided, so
		// let's return all users. This is
		// bad - we should paginate in
		// reality.

		return $users->name;
	}
}
