<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileRequest;
use App\Models\Chamados;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    protected $request;
    private $repository;

    public function __construct(Request $request, User $user)
    {
        // $this->middleware('auth');
        $this->request = $request;
        $this->repository = $user;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth()->user();
        $chamados = Chamados::where('user_id', $user->id)->get();
        return view('admin.users.profile', compact('user', 'chamados'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProfileRequest $request, $id)
    {
        $user = $this->repository->where('id', $id)->first();

        $data = $request->all();
        // dd($data);

        $data['image'] = $user->image;

        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            if ($user->image && Storage::exists($user->image)) {
                Storage::delete($user->image);
            }
            $imagePath = $request->image->store('users');
            $data['image'] = $imagePath;
        }

        $update = $user->update($data);

        $notify = [
            'alert-type' => 'success',
            'message' => 'Atualizado com sucesso',
        ];

        if ($update) {
            return redirect()->route('dashboard.perfil.index')->with($notify);
        }

        return redirect()->back()->with('error', 'Falha ao atualizar o perfil...');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //taicy_0127
    }
}
