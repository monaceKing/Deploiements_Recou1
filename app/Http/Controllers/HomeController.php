<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
    // public function index()
    // {
    //     $data = ModelCompteT ::join('F_ECRITUREC', 'F_COMPTET.CT_Num', '=', 'F_ECRITUREC.CT_Num')
    //     ->join('F_COLLABORATEUR', 'F_COMPTET.CO_No', '=', 'F_COLLABORATEUR.CO_No')
    //     ->select('F_COMPTET.CO_No','F_COLLABORATEUR.CO_Nom', 'F_ECRITUREC.CT_Num', 'F_ECRITUREC.EC_Intitule', 'F_ECRITUREC.EC_sens', 'F_ECRITUREC.Ec_Montant', 'F_ECRITUREC.EC_Echeance')
    //     ->where('F_ECRITUREC.CT_Num', 'like', 'CL%')
    //     ->orderBy('F_ECRITUREC.CT_Num')
    //     // ->whereYear('EC_Echeance','2023')
    //     ->get();
    //     $moa = "Monace-King";
    //     return view('home', compact('moa', 'data', 'moa'));
    // }


    public function index(){
        // Vérifiez d'abord si un utilisateur est connecté
        if (Auth::check()) {
            // Récupérez l'ID de l'utilisateur connecté
            $userId = Auth::id();
        
            // Maintenant, vous pouvez utiliser $userId dans votre requête
            $data = DB::table('F_ECRITUREC')
                ->join('F_COMPTET', 'F_ECRITUREC.CT_Num', '=', 'F_COMPTET.CT_Num')
                ->join('F_COLLABORATEUR', 'F_COMPTET.CO_No', '=', 'F_COLLABORATEUR.CO_No')
                ->join('portefeuilles', 'F_COLLABORATEUR.CO_Nom', '=', 'portefeuilles.name')
                ->join('portefeuille_user', 'portefeuilles.id', '=', 'portefeuille_user.portefeuille_id')
                ->join('users', 'portefeuille_user.user_id', '=', 'users.id')
                ->select(
                    'F_COMPTET.CO_No',
                    'F_COMPTET.CT_Intitule',
                    'F_COMPTET.CT_Telephone',
                    'F_COMPTET.CT_EMail',
                    'F_COLLABORATEUR.CO_Nom',
                    'F_ECRITUREC.CT_Num',
                    'F_ECRITUREC.EC_Intitule',
                    'F_ECRITUREC.EC_sens',
                    'F_ECRITUREC.Ec_Montant',
                    'F_ECRITUREC.EC_Echeance',
                    'F_ECRITUREC.EC_RefPiece',
                    'F_ECRITUREC.EC_Lettre',
                )
                ->where('F_ECRITUREC.EC_Lettre','=', 0)
                ->where('F_ECRITUREC.CT_Num', 'like', 'CL%')
                ->where('users.id', '=', $userId)
                ->orderBy('F_ECRITUREC.CT_Num')
                ->get();
                return view('home', compact('data'));
        } else {
            return redirect()->back();
        }
        
            }
}
