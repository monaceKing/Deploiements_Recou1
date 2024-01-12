<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Portefeuille;
use App\Models\Recouvrement;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
        $data = Recouvrement::all()->where("id_agent", "=", $user->id);
        return view('factures_recouvrees', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
{
    // Vérification si l'utilisateur est un admin ou pas 
    if (Gate::denies('edit-users')) {
        return redirect()->back();
    }

    // Récupérer tous les portefeuilles
    $portefeuilles = Portefeuille::all();

    // Récupérer les rôles
    $roles = Role::all();

    // Récupérer les portefeuilles attribués à l'utilisateur
    $portefeuillesUtilisateur = $user->portefeuilles;

    // Exclure les portefeuilles déjà attribués à d'autres utilisateurs
    $portefeuillesDisponibles = $user->portefeuillesDisponibles();
    // dd($portefeuillesDisponibles);
    return view("admin.users.edit", compact("user", "roles", "portefeuillesDisponibles", "portefeuillesUtilisateur"));
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

    public function factures_recouvrees($idClient){
        $efface = Recouvrement::where('idClient', $idClient)->first();

        if ($efface) {
            $efface->delete();
        }
    
        return redirect()->back();
    }
}
