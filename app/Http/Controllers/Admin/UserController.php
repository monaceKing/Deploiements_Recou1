<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Portefeuille;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        $var = "juste Monace-King";
        return view("admin.users.index", compact("users", "var"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //Verification si l'utilisateur est un admin ou pas 
        if (Gate::denies('edit-users')) {
            return redirect()->back();
        }

        $portefeuilles = Portefeuille::all();
        $roles = Role::all();
        return view("admin.users.edit", compact("user","roles", "portefeuilles"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $user->roles()->sync($request->roles);
        $user->portefeuilles()->sync($request->portefeuilles);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();
        return redirect()->route("admin.users.index");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //Verification si l'utilisateur est un admin ou pas 
        if (Gate::denies('delete-users')) {
            return redirect()->back();
        }

        $user->roles()->detach();
        $user->portefeuilles()->detach();
        $user->delete();

        return redirect()->route("admin.users.index");
    }
}
