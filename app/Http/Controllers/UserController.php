<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\StoreUserRequest;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.create');
        // return view('users.create')->with('user', Auth::user());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'surname1' => ['required', 'string', 'max:255'],
            'surname2' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'min:9', 'max:9'],
            'email' => [
                'required', 'string', 'email', 'max:255',
                Rule::unique('users'),
            ],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'others' => ['string', 'max:500', 'nullable'],
        ]);

        // User::create($validated);
        // dd($request->has('is_admin'));

        User::create([
            'name' => $request->input('name'),
            'surname1' => $request->input('surname1'),
            'surname2' => $request->input('surname2'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
            'password' => Hash::make($request->input('password')),
            'admin' => $request->has('is_admin')
        ]);

        return view('users.index',[
            'users' => User::all()
        ])->with('success',__('Usuario creado correctamente.'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        return view('users.show')->with('user', Auth::user());
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        return view('users.edit')->with('user', $user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $user_id = null)
    {
        if ($user_id != null) {
            $user = User::find($user_id);
        }
        else{
            $user = User::find(Auth::user()->id);
        }      

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'surname1' => ['required', 'string', 'max:255'],
            'surname2' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'min:9', 'max:9'],
            'email' => [
                'required', 'string', 'email', 'max:255',
                Rule::unique('users')->ignore($user->id),
            ],
            'others' => ['string', 'max:500', 'nullable'],
        ]);
        $user->update($validated);

        if ($user_id != null) {
            return redirect()->route('users.edit', [
                'id' => $user->id
            ])->with('success',__('Usuario actualizado correctamente.'));
        }
        else{
            return redirect()->route('users.show');
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::destroy($id);
        return back()->with('success',__('Usuario eliminado correctamente.'));
        //return redirect()->back();
    }
}
